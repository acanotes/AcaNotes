<?php

session_start();

if (isset($_POST['submit']))
{
    
    include 'dbh.inc.php';
    
    $uid = mysqli_real_escape_string($conn, $_POST['uid']);
    $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
    $intendedLocation = "";
  if (isset($_POST['redirect'])) {
    $intendedLocation = $_POST['redirect'];
  }
    //Error handlers
    
    if(empty($uid) || empty($pwd))
    {
        header("Location: ../index.php?login=empty");
        exit();
    }
    else
    {
        $sql = "SELECT * FROM users WHERE user_uid = '$uid' OR user_email = '$uid'";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        if($resultCheck < 1)
        {
            header("Location: ../index.php?login=error");
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
                    header("Location: ../index.php?login=error");
                    exit();
                }
                elseif($hashedPwdCheck == true)
                {
                  if ($verified == 1){
                              //Log in
                              $_SESSION['u_id'] = $row['user_id'];
                              $_SESSION['u_first'] = $row['user_first'];
                              $_SESSION['u_last'] = $row['user_last'];
                              $_SESSION['u_email'] = $row['user_email'];
                              $_SESSION['u_uid'] = $row['user_uid'];
                              $_SESSION['u_description'] = $row['user_description'];
                              $_SESSION['u_points'] = $row['user_points'];
                              $_SESSION['u_popularity'] = $row['user_downloads'];
                              $_SESSION['u_rating'] = $row['user_rating'];
                              
                            if (empty($intendedLocation)){
                              header("Location: ../index.php?login=success");
                            }
                            else {
                              header("Location: " . $intendedLocation);
                            }
                              exit();
                  
                  }
                  else
                  {
                    header("Location: ../index.php?login=notverified");
                    exit();
                  }
                   
                }
            }
        }
    }
    
}
else
{
    header("Location: ../index.php?login=error");
    exit();
}

?>