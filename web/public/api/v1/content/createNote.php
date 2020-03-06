<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");

$data = json_decode(file_get_contents('php://input'), true);
require($_SERVER["DOCUMENT_ROOT"] . '/../vendor/autoload.php');
include '../../inc/connect.php';
include '../auth/auth.php';

/* Authentication "middleware" that makes this route protected from random access
 * and also returns the token data of the user requesting this route
 */
$token_data = Auth::authenticateRoute();
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
  http_response_code(200);
  exit();
}

if (isset($data['title'])) {
  $res = array('error' => '');
  if (empty($data['title']) || empty($data['class']) || empty($data['description'])) {
    http_response_code(400);
    $res['error'] = "Missing data";
    echo json_encode($res);
    exit();
  }
  $date = date("Y-m-d");
  $downloads = 0;
  $title = mysqli_real_escape_string($conn, $data['title']);
  $subject = mysqli_real_escape_string($conn, $data['class']);
  $description = mysqli_real_escape_string($conn, $data['description']);
  $user = $token_data['username'];
  $sql = "INSERT INTO notes (a_title, a_subject, a_author, a_date, a_description, a_downloads, a_directory) VALUES ('$title', '$subject', '$user', '$date', '$description', $downloads, '')";

  if (mysqli_query($conn, $sql)) {
    // $res['res'] = "Success!";
  } else {
    http_response_code(400);
    $res['error'] = "Couldn't update database";
    $res['sql_error'] = "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
    echo json_encode($res);
    exit();
  }
  $note_id = $conn->insert_id;

  try {
    $s3Client = new Aws\S3\S3Client([
        'version'  => '2006-03-01',
        'region'   => getenv('S3_REGION'),
        'signatureVersion' => 'v4'
    ]);
    $bucket = getenv('S3_BUCKET_NAME')?: die('No "S3_BUCKET_NAME" config var in found in env!');

    $extension="pdf";
    $key = 'notes/' . $user . '/' . $note_id.'_'.$subject.'_'.$title.'.'.$extension;
    $cmd = $s3Client->getCommand('PutObject', [
        'Bucket' => $bucket,
        'Key' => $key,
        'ACL' => 'public-read'
    ]);

    // TODO: Need to do transaction in future, where both sql queries are reverted if something goes wrong
    $sql2 = "UPDATE notes SET a_directory = '$key' WHERE a_id = $note_id";
    if(!mysqli_query($conn, $sql2)) {
      http_response_code(400);
      $res['error'] = "Couldn't update database";
      $res['sql_error'] = "ERROR: Could not able to execute $sql2. " . mysqli_error($conn);
      echo json_encode($res);
      exit();
    }

    $signedRequest = $s3Client->createPresignedRequest($cmd, '+20 minutes');
    $presignedUrl = (string)$signedRequest->getUri();

    $res['signedUrl'] = $presignedUrl; // put request to this URL allows you to view the object
    $res['key'] = $key;
    echo json_encode($res);
  }
  catch(Exception $error) {
    http_response_code(420);
    $res["error"] = "Something went wrong";
    print_r($error);
    echo json_encode($res);
  }
}
