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
// $token_data = Auth::authenticateRoute();
use Aws\S3\S3Client;
use Aws\Exception\AwsException;

$res = array("error" => "");
try {
  $s3Client = new Aws\S3\S3Client([
      'version'  => '2006-03-01',
      'region'   => getenv('S3_REGION'),
  ]);
  $bucket = getenv('S3_BUCKET_NAME')?: die('No "S3_BUCKET_NAME" config var in found in env!');

  $cmd = $s3Client->getCommand('GetObject', [
      'Bucket' => $bucket,
      'Key' => 'nodejsStreams.png'
  ]);


  $signedRequest = $s3Client->createPresignedRequest($cmd, '+5 minutes');
  $presignedUrl = (string)$signedRequest->getUri();



  $res['signedUrl'] = $presignedUrl; // get request to this URL allows you to view the object

  echo json_encode($res);
}
catch(Exception $error) {
  $res["error"] = "Something went wrong";
  echo json_encode($res);
}

?>
