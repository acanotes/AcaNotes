<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");

$data = json_decode(file_get_contents('php://input'), true);
require($_SERVER["DOCUMENT_ROOT"] . '/../vendor/autoload.php');
include '../../inc/connect.php';
include '../auth/auth.php';
include '../../inc/s3.php'; // expose s3Client to globals

$token_data = Auth::authenticateRoute();

$res = array('error' => '');
if (!isset($_GET['id'])) {
  http_response_code(400);
  $res['error'] = "No ID given";
  echo json_encode($res);
  exit();
}
if ($_SERVER['REQUEST_METHOD'] === 'GET') {

  $id = mysqli_real_escape_string($conn, $_GET['id']);
  if (empty($id)) {
    http_response_code(400);
    $res['error'] = "No ID or faulty ID given";
    echo json_encode($res);
  }

  // Get S3 client to prepare a signed url
  try {
    $key = 'users/' . $id . '/resources/profilePicture.png';
    $cmd = $s3Client->getCommand('GetObject', [
        'Bucket' => $s3Bucket,
        'Key' => $key
    ]);
    $response = $s3Client->doesObjectExist($s3Bucket, $key);
    if ($response) {
      $signedRequest = $s3Client->createPresignedRequest($cmd, '+20 minutes');
      $presignedUrl = (string)$signedRequest->getUri();

      $res['signedUrl'] = $presignedUrl; // get request to this URL allows you to view the object
      echo json_encode($res);
    }
    else {
      // no profile picture, return no url
      $res['signedUrl'] = '';
      echo json_encode($res);
    }
  }
  catch (Exception $error) {
    http_response_code(420);
    $res["error"] = "Something went wrong";
    echo json_encode($res);
  }
}
else if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
  $res = array('error' => '');
  $id = mysqli_real_escape_string($conn, $_GET['id']);
  if (empty($id)) {
    http_response_code(400);
    $res['error'] = "No ID or faulty ID given";
    echo json_encode($res);
  }

  // Get S3 client to prepare a signed url
  try {
    $key = 'users/' . $id . '/resources/profilePicture.png';
    $cmd = $s3Client->getCommand('PutObject', [
        'Bucket' => $s3Bucket,
        'Key' => $key,
        'ACL' => 'public-read'
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
