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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  if (empty($data['rating']) || empty($data['note_id'])) {
    http_response_code(400);
    $res['error'] = "Missing data";
    echo json_encode($res);
    exit();
  }

  $rating_value = mysqli_real_escape_string($conn, $data['rating']);
  $note_id = mysqli_real_escape_string($conn, $data['note_id']);
  $sql = "SELECT * FROM notes WHERE a_id = $note_id";


  // check if this note exists
  $result = mysqli_query($conn, $sql);
  if ($result) {
    if (mysqli_num_rows($result) == 0) {
      http_response_code(400);
      $res['error'] = "No notes found";
      echo json_encode($res);
      exit();
    }
  }
  else {
    http_response_code(400);
    $res['error'] = "Error with sql query";
    echo json_encode($res);
    exit();
  }
  $note_info = mysqli_fetch_assoc($result);

  // FIXME: make sure we insert/update rating, update notes together (ensure both happen or neither happen)
  // Insert rating and update if rating pair (note_id, note_rater) exists
  $a_author = $note_info['a_author'];
  $username = $token_data['username'];
  $sql = "INSERT into ratings (rating_value, note_id, note_author, note_rater) VALUES ($rating_value, '$note_id', '$a_author', '$username')
          ON DUPLICATE KEY UPDATE rating_value=$rating_value";

  if ($result = mysqli_query($conn, $sql)) {
   
  }
  else {
    http_response_code(400);
    $res['error'] = "Error with sql query 2";
    echo json_encode($res);
    exit();
  }
  // FIXME: Definite problem with updating the average rating through this route. Its slow probably
  // MAKE SURE TO INDEX note_id

  // get all ratings and aggregate them
  $sql = "SELECT rating_value FROM ratings WHERE note_id = $note_id";

  if ($result = mysqli_query($conn, $sql)) {
    $avg_rating = 0;
    while($r = mysqli_fetch_assoc($result)) {
      $avg_rating += $r['rating_value'];
    }
    $avg_rating /= mysqli_num_rows($result);
  }
  else {
    http_response_code(400);
    $res['error'] = "Error with sql query 3";
    echo json_encode($res);
    exit();
  }

  $sql = "UPDATE notes SET a_rating = '$avg_rating' WHERE a_id = $note_id";
  // UPDATE Note average rating
  if ($result = mysqli_query($conn, $sql)) {
    // update user's average rating
    $sql = "SELECT AVG(a_rating) AS average_rating FROM notes WHERE a_author = '$a_author'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result); 
    $this_rating = $row['average_rating'];
    $sql = "UPDATE users SET user_rating = '$this_rating' WHERE user_uid = '$a_author'";
    if ($result = mysqli_query($conn, $sql)) {
      $res['res'] = "success";
      echo json_encode($res);
      exit();
    }
    else {
      http_response_code(400);
      $res['error'] = "Error with sql query 4.1";
      echo json_encode($res);
      exit();
    }
    
  }
  else {
    http_response_code(400);
    $res['error'] = "Error with sql query 4";
    echo json_encode($res);
    exit();
  }
}
// get the user's rating for a note
else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  if (empty($_GET['note_id'])) {
    http_response_code(400);
    $res['error'] = "Missing data";
    echo json_encode($res);
    exit();
  }
  $username = $token_data['username'];
  $note_id = mysqli_real_escape_string($conn, $_GET['note_id']);
  $sql = "SELECT * FROM ratings WHERE note_id = $note_id AND note_rater = '$username'";

  if ($result = mysqli_query($conn, $sql)) {
    $res['res'] = "Success";
    $r = mysqli_fetch_assoc($result);
    $res['rating'] = json_encode($r);
    echo json_encode($res);
    exit();
  }
  else {
    http_response_code(400);
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
