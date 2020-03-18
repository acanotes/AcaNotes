<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");

$data = json_decode(file_get_contents('php://input'), true);
require_once($_SERVER["DOCUMENT_ROOT"] . '/../vendor/autoload.php');
$dotenv = Dotenv\Dotenv::createImmutable($_SERVER['DOCUMENT_ROOT'] . '/../');
$dotenv->load();

include '../../inc/connect.php';
include '../auth/auth.php';

$token_data = Auth::authenticateRoute();

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['count'])) {
  $res = array('error' => '');
  $count = 5;
  $count = mysqli_real_escape_string($conn, $_GET['count']);
  $sql = "SELECT * FROM users ORDER BY user_rating*user_downloads DESC LIMIT " . $count;

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
