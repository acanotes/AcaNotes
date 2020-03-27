<?php
  // should be required in every file in api
  require_once($_SERVER["DOCUMENT_ROOT"] . '/../vendor/autoload.php');
  if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/../.env')) {
    $dotenv = Dotenv\Dotenv::createImmutable($_SERVER['DOCUMENT_ROOT'] . '/../');
    $dotenv->load();
  }

?>
