<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE, PATCH");

$data = json_decode(file_get_contents('php://input'), true);
require_once($_SERVER["DOCUMENT_ROOT"] . '/api/inc/base.php');

include '../../inc/connect.php';
include '../auth/auth.php';

$token_data = Auth::authenticateRoute();
$res = array('error' => '');
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
  http_response_code(200);
  exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {

  $count = 5;
  $id = mysqli_real_escape_string($conn, $_GET['id']);
  $sql = "SELECT * FROM notes WHERE a_id = " . $id;

  if ($result = mysqli_query($conn, $sql)) {
    $resultCheck = mysqli_num_rows($result);
    if($resultCheck < 1) {
        http_response_code(420);
        $res['error'] = "No resource found";
        echo json_encode($res);
        exit();
    }
    $row_res;
    $row_res = mysqli_fetch_assoc($result);

    try {
      $s3Client = new Aws\S3\S3Client([
          'version'  => '2006-03-01',
          'region'   => getenv('S3_REGION'),
          'signatureVersion' => 'v4'
      ]);
      $bucket = getenv('S3_BUCKET_NAME')?: die('No "S3_BUCKET_NAME" config var in found in env!');

      $key = $row_res['a_directory'];
      $cmd = $s3Client->getCommand('GetObject', [
          'Bucket' => $bucket,
          'Key' => $key
      ]);

      $signedRequest = $s3Client->createPresignedRequest($cmd, '+20 minutes');
      $presignedUrl = (string)$signedRequest->getUri();

      $res['signedUrl'] = $presignedUrl; // get request to this URL allows you to view the object
      $res['key'] = $key;
      $res['note'] = json_encode($row_res);
      echo json_encode($res);
    }
    catch (Exception $error) {
      http_response_code(420);
      $res["error"] = "Something went wrong";
      echo json_encode($res);
    }
  }
  else {
    http_response_code(420);
    $res['error'] = "Error with sql query";
    echo json_encode($res);
    exit();
  }
}
else if ($_SERVER['REQUEST_METHOD'] === 'PATCH' && isset($data['note_id'])) {
  $id = mysqli_real_escape_string($conn, $data['note_id']);
  $sql = "SELECT * FROM notes WHERE a_id = " . $id;
  if ($result = mysqli_query($conn, $sql)) {
    $resultCheck = mysqli_num_rows($result);
    if($resultCheck < 1) {
        http_response_code(420);
        $res['error'] = "No resource found";
        echo json_encode($res);
        exit();
    }
    $row_res = mysqli_fetch_assoc($result);
  }
  $new_downloads = $row_res['a_downloads'] + 1;
  $user = $row_res['a_author'];
  $sql2 = "UPDATE notes SET a_downloads = '$new_downloads' WHERE a_id = $id";
  $sql3 = "UPDATE users SET user_downloads = '$new_downloads' WHERE user_uid = '$user'";
  if ($result = mysqli_query($conn, $sql2) && $result = mysqli_query($conn, $sql3)) {
    echo json_encode($res);
    exit();
  }
  else {
    http_response_code(420);
    $res['error'] = "Couldn't update download stats: ";
    $res['sql'] = $sql2;
    echo json_encode($res);
    exit();
  }
}
else {
  http_response_code(400);
  $res['error'] = "Incorrect use";
  echo json_encode($res);
  exit();
}
