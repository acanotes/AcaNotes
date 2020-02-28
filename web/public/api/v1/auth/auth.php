<?php
require_once($_SERVER["DOCUMENT_ROOT"] . '/../vendor/autoload.php');
use \Firebase\JWT\JWT;

class Auth {
  static $key;
  public static function verifyToken($token) {
    try {
      $verified = JWT::decode($token, self::$key, array('HS256'));
    }
    catch (Exception $error) {
      return false;
    }

    return true;
  }
  public static function authenticateRoute() {
    if ($_SERVER['REQUEST_METHOD'] != 'OPTIONS') {
      $auth_token = getBearerToken();
      if (empty($auth_token) || !self::verifyToken($auth_token)) {
        $res = array('error' => '');
        http_response_code(420);
        $res['error'] = "Route requires authentication, user not authenticated";
        echo json_encode($res);
        exit();
      }
    }
  }
}
Auth::$key = getenv('JWT_KEY');

function getBearerToken() {
  $headers = getAuthorizationHeader();

  // HEADER: Get the access token from the header
  if (!empty($headers)) {
    if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
      return $matches[1];
    }
  }
  return null;
}
function getAuthorizationHeader(){
  $headers = null;
  if (isset($_SERVER['Authorization'])) {
    $headers = trim($_SERVER["Authorization"]);
  }
  else if (isset($_SERVER['HTTP_AUTHORIZATION'])) { //Nginx or fast CGI
    $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
  } elseif (function_exists('apache_request_headers')) {
    $requestHeaders = apache_request_headers();
    // Server-side fix for bug in old Android versions (a nice side-effect of this fix means we don't care about capitalization for Authorization)
    $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
    //print_r($requestHeaders);
    if (isset($requestHeaders['Authorization'])) {
        $headers = trim($requestHeaders['Authorization']);
    }
  }
  return $headers;
}
