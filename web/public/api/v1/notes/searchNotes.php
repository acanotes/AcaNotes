<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");


require_once($_SERVER["DOCUMENT_ROOT"] . '/api/inc/base.php');

include '../../inc/connect.php';
include '../auth/auth.php';

$token_data = Auth::authenticateRoute();
$res = array('error' => '');


$data = json_decode(file_get_contents('php://input'), true);

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
  http_response_code(200);
  exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['search_query'])) {

  $search = mysqli_real_escape_string($conn, $_GET['search_query']);
  $sql = "SELECT * FROM notes WHERE a_title LIKE '%$search%' OR a_subject LIKE '%$search%' OR a_author LIKE '%$search%' OR a_date LIKE '%$search%'";

  if ($result = mysqli_query($conn, $sql)) {
    $rows = array();
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
