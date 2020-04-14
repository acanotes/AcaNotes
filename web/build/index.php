<?php
header("Access-Control-Allow-Origin: *");

header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");

require '../vendor/autoload.php';

$request = $_SERVER['REQUEST_URI'];

switch ($request) {
    case '/' :
        require __DIR__ . '/index.html';
        break;
    case '' :
        require __DIR__ . '/index.html';
        break;
    case (preg_match("/api/i", $request) === 1):
        require __DIR__ . $request;
        break;
    default:
        require __DIR__ . '/index.html';
        break;
}

?>
