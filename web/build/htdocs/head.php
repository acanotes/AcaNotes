<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'].'/includes/dbh.inc.php';
if(isset($_SESSION['u_id'])) {  
  $username = $_SESSION['u_uid'];
  $link_to_account = 'https://'.$_SERVER['HTTP_HOST'].'/user/'.$username;
}
?>

<!--DOCTYPE HTML-->
<html>

<head>
  <title>AcaNotes</title>
  <meta charset="UTF-8">
  <link href="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.css" rel="stylesheet">
  <script src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>
   <link rel='stylesheet' type='text/css' href="/main.css">
  <link rel='stylesheet' href="/styles/base.css">
  <script type="text/javascript">function loadScript(e,t){var a=document.createElement("script");a.type="text/javascript",a.readyState?a.onreadystatechange=function(){"loaded"!=a.readyState&&"complete"!=a.readyState||(a.onreadystatechange=null,t())}:a.onload=function(){t()},a.src=e,document.getElementsByTagName("head")[0].appendChild(a)}</script>
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="/scripts/base.js?v=3"></script>
  <script>
    var username = "<?php echo $username ?>";
  </script>
  <!--
Add google analytics
Use jsloader
Bootstrap?

-->