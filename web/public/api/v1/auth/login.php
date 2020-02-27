<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");

$data = json_decode(file_get_contents('php://input'), true);

require($_SERVER["DOCUMENT_ROOT"] . '/../vendor/autoload.php');
include '../../inc/connect.php';
use \Firebase\JWT\JWT;
echo getenv("JWT_KEY");
if (isset($data['username']))
{

    $uid = mysqli_real_escape_string($conn, $data['username']);
    $pwd = mysqli_real_escape_string($conn, $data['password']);
    //Error handlers
    $res = array('error' => '');
    $sql = "SELECT * FROM users WHERE user_uid = '$uid' OR user_email = '$uid'";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    if($resultCheck < 1)
    {
        $res['error'] = "Incorrect Username or Password";
        echo json_encode($res);
        exit();
    }
    else
    {
        if($row = mysqli_fetch_assoc($result))
        {
            $verified = $row['verified'];

            $hashedPwdCheck = password_verify($pwd, $row['user_pwd']);
            if($hashedPwdCheck == false)
            {
                $res['error'] = "Incorrect Username or Password - 2";
                echo json_encode($res);
                exit();
            }
            elseif($hashedPwdCheck == true)
            {
              if ($verified == 1) {
                $key = getenv("JWT_KEY");
                $payload = array(
                    "username" => $row['uid'],
                    "firstName" => $row['user_first'],
                    "lastName" => $row['user_last'],
                    "email" => $row['user_email'],
                    "title" => $row['user_title']
                );
                $res['error'] = "";

                $jwt = JWT::encode($payload, $key);
                $res['token'] = $jwt;

                echo json_encode($res);
              }
              else
              {
                $res['error'] = "Incorrect Username or Password";
                echo json_encode($res);
                exit();
              }

            }
        }
    }

}
else {
  echo "npfailed\n";
  exit();
}
