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

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
  http_response_code(200);
  exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $rating = 3;
  $rating = mysqli_real_escape_string($conn, $data['rating']);
  $note_id = mysqli_real_escape_string($conn, $data['note_id']);
  $sql = "SELECT a_rating FROM notes WHERE a_id = $note_id";
  if ($result = mysqli_query($conn, $sql)) {
    $row = mysqli_fetch_assoc($result)
    $row['a_rating'];
    exit();
  }
  $sql = "UPDATE notes SET a_rating = '$avg_rating' WHERE a_id = $note_id";
  // $sql2 = "UPDATE users SET a_rating = '$avg_rating' WHERE a_id = $note_id";

  if ($result = mysqli_query($conn, $sql)) {
    while($r = mysqli_fetch_assoc($result)) {
        $rows[] = $r;
    }
    $res['res'] = json_encode($rows);
    echo json_encode($res);
    exit();
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
