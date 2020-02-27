<?php
  $dbServername = 'spvunyfm598dw67v.cbetxkdyhwsb.us-east-1.rds.amazonaws.com'; // localhost
  //echo getenv("JAWSDB_MARIA_URL");

  $dbUsername = 'jkxyx78jy5ggulvw'; // root
  $dbPassword = 'quwwf5br6nbc2giz'; // 123456
  $dbName = 'thw42gj9sxaws9w7'; // acanotes
  $conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);
  if(! $conn ) {
    echo json_encode(array("error" => "Server Database is Down"));
    exit();
  }
?>
