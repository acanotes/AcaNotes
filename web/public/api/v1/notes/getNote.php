<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");

$data = json_decode(file_get_contents('php://input'), true);
require($_SERVER["DOCUMENT_ROOT"] . '/../vendor/autoload.php');
include '../../inc/connect.php';
include '../auth/auth.php';

// $token_data = Auth::authenticateRoute();
$res = array('error' => '');
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
else {
  http_response_code(400);
  $res['error'] = "Incorrect use";
  echo json_encode($res);
  exit();
}
