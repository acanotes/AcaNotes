<?php
  $dbServername = 'spvunyfm598dw67v.cbetxkdyhwsb.us-east-1.rds.amazonaws.com'; // localhost

  $dbUsername = 'jkxyx78jy5ggulvw'; // root
  $dbPassword = 'quwwf5br6nbc2giz'; // 123456
  $dbName = 'thw42gj9sxaws9w7'; // acanotes
  $conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);
  if(! $conn ) {
    die('Could not connect: ' . mysql_error());
  }
  echo 'Connected successfully\ns';

  if ($result = $conn->query( "SELECT * From thw42gj9sxaws9w7.users")) {
    printf("Select returned %d rows.\n", $result->num_rows);
    $result->close();
  }
  else {
    printf("Failed\n");
  }
?>
