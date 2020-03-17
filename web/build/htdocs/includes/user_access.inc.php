<?php
//$link = $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
if(!isset($_SESSION['u_id'])) {
  // if not logged in, go to to login.php
  header("Location: /login?ref=" . $_SERVER['PHP_SELF'] . "&user=true");
  exit();
}
?>