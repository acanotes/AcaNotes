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
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['count'])) {

  $count = 5;
  $count = mysqli_real_escape_string($conn, $_GET['count']);
  $sql = "SELECT * FROM notes ORDER BY a_date DESC LIMIT " . $count;

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
