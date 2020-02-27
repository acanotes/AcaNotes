<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");

require($_SERVER["DOCUMENT_ROOT"] . '/../vendor/autoload.php');
include '../../inc/connect.php';
use \Firebase\JWT\JWT;

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['token']))
{

  $res = array('error' => '');

  $key = getenv('JWT_KEY');
  $jwt = $data['token'];
  try {
    $verified = JWT::decode($jwt, $key, array('HS256'));
    $res['verified'] = true;
    echo json_encode($res);
    exit();
  }
  catch (Exception $error) {
    http_response_code(420);
    $res['error'] = "Token invalid";
    echo json_encode($res);
    exit();
  }
}
else {
  echo "npfailed\n";
  exit();
}
