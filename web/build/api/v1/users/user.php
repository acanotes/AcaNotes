<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE, PATCH");

$data = json_decode(file_get_contents('php://input'), true);
require_once($_SERVER["DOCUMENT_ROOT"] . '/api/inc/base.php');

include '../../inc/connect.php';
include '../auth/auth.php';
use \Firebase\JWT\JWT;

$token_data = Auth::authenticateRoute();
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
  http_response_code(200);
  exit();
}

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
  $firstName = mysqli_real_escape_string($conn, $data['firstName']);
  $lastName = mysqli_real_escape_string($conn, $data['lastName']);
  $email = mysqli_real_escape_string($conn, $data['email']);
  $description = mysqli_real_escape_string($conn, $data['description']);
  Auth::owner($token_data, $id); // check if the requester is the owner of this ID, otherwise exits
  $sql = "UPDATE users SET user_first = '$firstName', user_last = '$lastName', user_email = '$email', user_description = '$description' WHERE user_uid = '$id' OR user_email = '$id'";
  if($conn -> query($sql))
  {
    // get new token to give user
    $key = getenv("JWT_KEY");
    $payload = array(
        "username" => $id,
        "firstName" => $firstName,
        "lastName" => $lastName,
        "email" => $email,
        "description" => $description,
        "title" => $token_data['title']
    );

    $jwt = JWT::encode($payload, $key);
    $res['token'] = $jwt;

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
