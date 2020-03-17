<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");

require_once($_SERVER["DOCUMENT_ROOT"] . '/../vendor/autoload.php');
$dotenv = Dotenv\Dotenv::createImmutable($_SERVER['DOCUMENT_ROOT'] . '/../');
$dotenv->load();

include '../../inc/connect.php';
include './auth.php';

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['token']))
{

  $res = array('error' => '');

  $jwt = $data['token'];
  if (Auth::verifyToken($jwt))  {
    $res['verified'] = true;
    echo json_encode($res);
    exit();
  }
  else {
    http_response_code(420);
    $res['error'] = "Token invalid";
    echo json_encode($res);
    exit();
  }
  try {

  }
  catch (Exception $error) {

  }
}
else {
  echo "npfailed\n";
  exit();
}
