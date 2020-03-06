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

  $conn = mysqli_connect($hostname, $username, $password, $database);
  $sql = file_get_contents('file.sql');
  echo $sql;
  // $qr = $db->exec($sql);
?>
