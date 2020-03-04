<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");

$data = json_decode(file_get_contents('php://input'), true);
require($_SERVER["DOCUMENT_ROOT"] . '/../vendor/autoload.php');
include '../../inc/connect.php';
include '../auth/auth.php';

$token_data = Auth::authenticateRoute();

$res = array('error' => '');
if (!isset($_GET['id'])) {
  http_response_code(400);
  $res['error'] = "No ID given";
  echo json_encode($res);
  exit();
}
$id = mysqli_real_escape_string($conn, $_GET['id']);
if (empty($id)) {
  http_response_code(400);
  $res['error'] = "No ID or faulty ID given";
  echo json_encode($res);
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
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
else if ($_SERVER['REQUEST_METHOD'] === 'PATCH') {
  $first = mysqli_real_escape_string($conn, $data['first']);
  $last = mysqli_real_escape_string($conn, $data['last']);
  $email = mysqli_real_escape_string($conn, $data['email']);
  $description = mysqli_real_escape_string($conn, $data['description']);
  Auth::owner($token_data, $id); // check if the requester is the owner of this ID, otherwise exits
  $sql = "UPDATE users SET user_first = '$first', user_last = '$last', user_email = '$email', user_description = '$description' WHERE user_uid = '$id' OR user_email = '$id'";
  if($conn -> query($sql))
  {
    $res['res'] = "Updated successfully";
    echo json_encode($res);
    exit();
  }
  else {
    http_response_code(420);
    $res['error'] = "Update failed - Reason: " . $conn -> error;
    echo json_encode($res);
    exit();
  }
}
