<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");

require_once($_SERVER["DOCUMENT_ROOT"] . '/../vendor/autoload.php');
$dotenv = Dotenv\Dotenv::createImmutable($_SERVER['DOCUMENT_ROOT'] . '/../');
$dotenv->load();

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['username']))
{

    include '../../inc/connect.php';

    $first = mysqli_real_escape_string($conn, $data['first']);
    $last = mysqli_real_escape_string($conn, $data['last']);
    $uid = mysqli_real_escape_string($conn, $data['username']);
    $email = mysqli_real_escape_string($conn, $data['email']);
    $pwd = mysqli_real_escape_string($conn, $data['password']);

    $res = array('error' => '');

    if (empty($uid) || empty($pwd) || empty($first) || empty($email)) {
      $res['error'] = "Missing required parameters";
      echo json_encode($res);
      http_response_code(400);
      exit();
    }


    $sql = "SELECT * FROM users WHERE user_uid = '$uid'";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);

    if ($resultCheck > 0)
    {

      http_response_code(420);
      $res['error'] = "User exists";
      echo json_encode($res);
      exit();
    }
    else
    {
      //Password hashing
      $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

      $vkey = md5(time().$uid); //generate verification key

      //Insert user into database
      $insertsql = "INSERT INTO users (user_first, user_last, user_email, user_uid, user_pwd, verified, vkey, user_title, user_rating) VALUES ('$first', '$last', '$email', '$uid', '$hashedPwd', 1, '$vkey' , 'Freshie', NULL);";
      if($conn -> query($insertsql))
      {
        // $to = $email;
        // $subject = "AcaNotes Email Verification";
        // $message = "Greetings $first,
        //
        // Welcome to AcaNotes, the ultimate online database for sharing notes on your IB subjects. You are receiving this email so you can verify your account.
        //
        // We can't wait for you to get started.
        //
        // Paste this URL and you're good to go: https://acanotes.com/registration/verify.php?vkey=$vkey";
        //
        // $headers = "From: service@acanotes.com";
        //
        //
        // if(mail($to, $subject, $message, $headers))
        // {
          $res['res'] = "Registered successfully";
          echo json_encode($res);
          exit();
        // }
        // else
        // {
        //   $res['error'] = "Failed to register completely";
        //   echo json_encode($res);
        //   exit();
        // }

      }
      else {

        http_response_code(420);
        $res['error'] = "Registration failed - Reason: " . $conn -> error;
        echo json_encode($res);
        exit();
      }
    }

}
else {
  echo "npfailed\n";
  exit();
}
