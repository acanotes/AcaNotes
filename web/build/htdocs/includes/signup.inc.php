<?php



    if(isset($_POST['submit']))
    {
        include 'dbh.inc.php';
    
        
        
        
        $first = mysqli_real_escape_string($conn, $_POST['first']);
        $last = mysqli_real_escape_string($conn, $_POST['last']);
        $uid = mysqli_real_escape_string($conn, $_POST['uid']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
        $confirm_pwd = mysqli_real_escape_string($conn, $_POST['confirm_pwd']);
        
        if(strlen($pwd)<8) //If password is too short
        {
            header("Location: ../registration/index.php?signup=passwordtooshort");
            exit();
        }
        else
        {

        //Checking for empty fields
        if (empty($first) || empty ($last) || empty ($uid) || empty ($email) || empty ($pwd))
        {
            header("Location: ../registration/index.php?signup=empty");
            exit();
        }
        else
        {
            //Check if input is valid
            
            if(!preg_match("/^[a-zA-Z]*$/", $first) || !preg_match("/^[a-zA-Z]*$/", $last))
            {
                header("Location: ../registration/index.php?signup=invalid");
                exit();
            }
            else
            {
                //Check if email is valid
                if(!filter_var($email, FILTER_VALIDATE_EMAIL))
                {
                    header("Location: ../registration/index.php?signup=email");
                    exit();
                }
                else
                {
                    //Check for username duplicates
                    $sql = "SELECT * FROM users WHERE user_uid = '$uid'";
                    $result = mysqli_query($conn, $sql);
                    $resultCheck = mysqli_num_rows($result);
                    
                    if ($resultCheck > 0)
                    {
                        header("Location: ../registration/index.php?signup=usertaken");
                        exit();
                    }
                    else
                    {
                        
                        if ($confirm_pwd !== $pwd)
                        {
                            header("Location: ../registration/index.php?signup=passwordnotmatching");
                            exit();
                        }
                        else
                        {
                            //Password hashing
                            $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

                            $vkey = md5(time().$uid); //generate verification key

                            //Insert user into database
                            $insertsql = "INSERT INTO users (user_first, user_last, user_email, user_uid, user_pwd, verified, vkey, user_title, user_rating) VALUES ('$first', '$last', '$email', '$uid', '$hashedPwd', 0, '$vkey' , 'Freshie', NULL);";
                            if(mysqli_query($conn, $insertsql))
                            {
                            //Send verification email
                            $to = $email;
                            $subject = "AcaNotes Email Verification";
                            $message = "Greetings $first,
                            
                            Welcome to AcaNotes, the ultimate online database for sharing notes on your IB subjects. You are receiving this email so you can verify your account.
                            
                            We can't wait for you to get started.
                            
                            Paste this URL and you're good to go: https://acanotes.com/registration/verify.php?vkey=$vkey";

                            $headers = "From: service@acanotes.com";


                            if(mail($to, $subject, $message, $headers))
                            {
                                header('location: ../thankyou.php');
                            }
                            else
                            {
                                echo "Failed to send email.";
                            }

                            

                            }
                            else
                            {
                                echo "Fatal error.";
                            }






                        }
                    }
                }
            }
        }
    }
    }
    else
    {
        //Needs caching system to keep valid fields in registration
        /*
        
        */
        header("Location: ../registration");
        exit();
    }
?>