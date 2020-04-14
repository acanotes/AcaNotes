<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");

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

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['note_id'])) {

  $id = mysqli_real_escape_string($conn, $_GET['note_id']);
  $sql = "SELECT * FROM notes WHERE a_id = " . $id;
  
  $user = $token_data['username'];
  $sql2 = "SELECT * FROM users WHERE user_uid = '$user'";

  $note_row;
  $user_row;
  if ($result = mysqli_query($conn, $sql)) {
    $resultCheck = mysqli_num_rows($result);
    if($resultCheck < 1) {
        http_response_code(420);
        $res['error'] = "No resource found";
        echo json_encode($res);
        exit();
    }
    $note_row = mysqli_fetch_assoc($result);
  }
  if ($result = mysqli_query($conn, $sql2)) {
    $resultCheck = mysqli_num_rows($result);
    if($resultCheck < 1) {
        http_response_code(420);
        $res['error'] = "No user found";
        echo json_encode($res);
        exit();
    }
    $user_row = mysqli_fetch_assoc($result);
  }

  $new_downloads = $note_row['a_downloads'] + 1;
  $new_user_downloads = $user_row['user_downloads'] + 1;
  $sql = "UPDATE notes SET a_downloads = '$new_downloads' WHERE a_id = $id; UPDATE users SET user_downloads = '$new_user_downloads' WHERE user_uid = '$user';";

  if(mysqli_multi_query($conn, $sql)) {
    $res['msg'] = "success";
    echo json_encode($res);
    exit();
  }
  else {
    http_response_code(420);
    $res['error'] = "Error with sql query";
    $res['q'] =$sql;
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
