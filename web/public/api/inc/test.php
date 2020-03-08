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

  $db = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
  $sql = file_get_contents('../../../../populate_db/populate_data.sql');
  $stmt = $db->prepare($sql);
  if ($stmt->execute())
     echo "Successfully populated database with default data";
  else
     echo "Failed to populate database";

?>
