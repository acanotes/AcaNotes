<?php

  $url = getenv('DB_URL');
  if (empty($url)) {
    $url = getenv('JAWSDB_MARIA_URL');
  }
  $dbparts = parse_url($url);
  $hostname = $dbparts['host'];
  $username = $dbparts['user'];
  $password = $dbparts['pass'];
  $database = ltrim($dbparts['path'],'/');


  // $hostname = '127.0.0.1';
  // $username = 'root';
  // $password = '123456';
  // $database = 'acanotes';
  //
  // $hostname = getenv("DB_SERVER");
  // $username = getenv("DB_USER");
  // $password = getenv("DB_PASSWORD");
  // $database = getenv("DB_NAME");

  try {
    $conn = mysqli_connect($hostname, $username, $password, $database);
    if(! $conn ) {
      http_response_code(500);
      echo json_encode(array("error" => "Server Database is Down "));
      exit();
    }
  }
  catch(Exception $error) {
    http_response_code(500);
    echo json_encode(array("error" => "Server Database is Down"));
    exit();
  }
?>
