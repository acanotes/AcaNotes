<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");

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


    $sql = "SELECT * FROM users WHERE user_uid = '$uid'";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);

    if ($resultCheck > 0)
    {
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
      $insertsql = "INSERT INTO users (user_first, user_last, user_email, user_uid, user_pwd, verified, vkey, user_title, user_rating) VALUES ('Stone', 'Tao', '$email', 'stonet2000', '$hashedPwd', 1, '$vkey' , 'Freshie', NULL);";
      if(mysqli_query($conn, $insertsql))
      {
        $res['res'] = "Registered successfully";
        echo json_encode($res);
        exit();
      }
      else {
        $res['error'] = "Registration failed";
        echo json_encode($res);
        exit();
      }
    }

}
else {
  echo "npfailed\n";
  exit();
}
