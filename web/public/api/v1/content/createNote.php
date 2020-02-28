<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");

$data = json_decode(file_get_contents('php://input'), true);
require($_SERVER["DOCUMENT_ROOT"] . '/../vendor/autoload.php');
include '../../inc/connect.php';
include '../auth/auth.php';

Auth::authenticateRoute();

if (isset($data['username'])) {

  $sql2 = "INSERT INTO notes (a_title, a_subject, a_author, a_date, a_description, a_downloads) VALUES ('$title', '$subject', '$user', '$date', '$description', $downloads)";
}
