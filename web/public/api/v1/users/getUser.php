<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");

$data = json_decode(file_get_contents('php://input'), true);
require($_SERVER["DOCUMENT_ROOT"] . '/../vendor/autoload.php');
include '../../inc/connect.php';
include '../auth/auth.php';

$token_data = Auth::authenticateRoute();

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
  $res = array('error' => '');
  $id = mysqli_real_escape_string($conn, $_GET['id']);
  if (empty($id)) {
    http_response_code(400);
    $res['error'] = "No ID or faulty ID given";
    echo json_encode($res);
  }
  $sql = "SELECT * FROM users WHERE user_uid = '$id' OR user_email = '$id'";

  if ($result = mysqli_query($conn, $sql)) {
    $row = mysqli_fetch_assoc($result);
    $res['res'] = json_encode($row);
    echo json_encode($res);
    exit();
  }
  else {
    http_response_code(420);
    $res['error'] = "No User Found";
    echo json_encode($res);
    exit();
  }
}
