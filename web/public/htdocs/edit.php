

<?php
include 'head.php';
session_start();
?>
<?php
    include 'header.php';
?>
<?php

    $username = $_SESSION['u_uid'];
    $sql = "SELECT * FROM users WHERE user_uid = '$username'";
    $result = mysqli_query($conn, $sql);
    $queryResults = mysqli_num_rows($result);
    if ($queryResults > 0) 
    while ($row = mysqli_fetch_assoc($result)) {
        $this_username = $row['user_uid'];
    }

    if(!isset($_SESSION['u_id']))
    {    
        header("Location: index.php");   
    }

?>

<body>



    <br/>
    <br/>
    <br/>

    <center>
        <h1>Edit account details</h1>
    </center>

    <br/>

    <center>
        <h2>Public information</h2>
    </center>
    
    <div style = "margin-left:25%">

        <h3>Username: <?php echo $_SESSION['u_uid'] ?></h3>

        <br/>
    
    <form method = "POST" action = "<?php echo $_SERVER['PHP_SELF'];?>" enctype = "multipart/form-data">


        <h3>First name: (required)</h3>
        <input type = 'text' value = "<?php echo $_SESSION['u_first'];?>" style='color:black;' name = 'first'/>


        <br/>
        <br/>


        <h3>Last name: (required)</h3>
        <input type = 'text' value = "<?php echo $_SESSION['u_last'];?>" style = 'color:black;' name = 'last'/>


        <br/>
        <br/>

        <h3>Upload/update your profile picture: (optional)</h3>
        <input type = "file" name = 'pp' id="pp" style='color:black;'/>

        <br/>
        <br/>

        <h3>Upload/update your personal description: (optional, max 500 characters)</h3>
        <textarea style = "width: 300pt; height: 200pt; resize:none;" maxlength = "500" placeholder="Enter your description" id = 'textarea' name = 'description'><?php
        
        if($_SESSION['u_description'] == 'The user has yet to provide a personal description.')
        {
            echo '';
        }
        else
        {
            echo $_SESSION['u_description'];
        }
        
        ?></textarea>

        <br/>
        <br/>

        <div style = 'margin-left:-30%'><center><h2>Private information</h2></center></div>

        <br/>
        <br/>

        <h3>Email: (required)</h3>
        <input type = 'text' value = "<?php echo $_SESSION['u_email'];?>" style = 'color:black;' name = 'email'/>


        <br/>
        <br/>

        <h3>Change password: </h3>
        <p>Please enter your current password: </p><input type = 'password' style = 'color:black;' name = 'pwd'/>
        <p>Please enter your new password: </p><input type = 'password' style = 'color:black;' name = 'new_pwd'/>
        <p>Please confirm your new password: </p><input type = 'password' style = 'color:black;' name = 'confirm_new_pwd'/>

        <br/>
        <br/>
        <br/>

        <button type = 'submit' name = 'submit'>Save changes</button>
    </form>

    <br/>

    <br/>
    <br/>
    <br/>
        
    </div>

    <center>

    <?php

if (isset($_POST['submit'])){



$first = mysqli_real_escape_string($conn, $_POST['first']);
$last = mysqli_real_escape_string($conn, $_POST['last']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$description = mysqli_real_escape_string($conn, $_POST['description']);
$pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
$new_pwd = mysqli_real_escape_string($conn, $_POST['new_pwd']);
$confirm_new_pwd = mysqli_real_escape_string($conn, $_POST['confirm_new_pwd']);


$pwdset = False;
$fieldsset = False;
$fileset = False;

if (!(empty($pwd) && empty($new_pwd) && empty($confirm_new_pwd)))
{
    $sql = "SELECT * FROM users WHERE user_uid = '$username';";
        $result = mysqli_query($conn, $sql);

            if($row = mysqli_fetch_assoc($result))
            {
                $hashedPwdCheck = password_verify($pwd, $row['user_pwd']);
                if($hashedPwdCheck == false)
                {
                    echo "Invalid password. Please try again.";
                }
                elseif($hashedPwdCheck == true)
                {
                    if($new_pwd == $confirm_new_pwd)
                    {
                        $hashedPwd = password_hash($new_pwd, PASSWORD_DEFAULT);
                        $updatesql = "UPDATE users SET user_pwd='$hashedPwd' WHERE user_uid='$username';";
                        mysqli_query($conn, $updatesql);
                        $pwdset = True;
                    }
                    else
                    {
                        echo "Password confirmation does not match new password. Please try again.";
                    }
                }
            }
}
else{
    $pwdset = True;
}


        if (empty($first) || empty ($last) || empty ($email))
            {
                echo "Some required fields are empty. Please try again.";
            }
        else
            {
                //Check if name is valid
                
                if(!preg_match("/^[a-zA-Z]*$/", $first) || !preg_match("/^[a-zA-Z]*$/", $last))
                    {
                        echo "Your name contains invalid characters. Please try again.";
                    }
                else
                    {
                        //Check if email is valid
                        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
                            {
                                echo "Invalid email. Please try again.";
                            }
                        else
                            {
                                $sql = "UPDATE users SET user_first = '$first', user_last = '$last', user_email = '$email' WHERE user_uid = '$username';";
                                mysqli_query($conn, $sql);
                                $fieldsset = True;
                            }
                    }
            }


    if(empty($description))
    {
        $description = 'The user has yet to provide a personal description.';
        $updateDescription = "UPDATE users SET user_description = '$description' WHERE user_uid = '$username';";
        mysqli_query($conn, $updateDescription);
    }
    else
    {
        $updateDescription = "UPDATE users SET user_description = '$description' WHERE user_uid = '$username';";
        mysqli_query($conn, $updateDescription);
    }



    //Profile picture management system.


    if($_FILES["pp"]["error"] !== 4) { //if a file is uploaded

        //check directory to remove previous profile image.
        $check_previous_jpg = $_SERVER['DOCUMENT_ROOT'].'/profilepics/'.$_SESSION['u_uid'].'.jpg';
        $check_previous_png = $_SERVER['DOCUMENT_ROOT'].'/profilepics/'.$_SESSION['u_uid'].'.png';
        $check_previous_jpeg = $_SERVER['DOCUMENT_ROOT'].'/profilepics/'.$_SESSION['u_uid'].'.jpeg';
        $check_previous_gif = $_SERVER['DOCUMENT_ROOT'].'/profilepics/'.$_SESSION['u_uid'].'.gif';

        if(file_exists($check_previous_jpg))
        {
            unlink($check_previous_jpg);
        }
        elseif(file_exists($check_previous_png))
        {
            unlink($check_previous_png);
        }
        elseif(file_exists($check_previous_jpeg))
        {
            unlink($check_previous_jpeg);
        }
        elseif(file_exists($check_previous_gif))
        {
            unlink($check_previous_gif);
        }


        $target_dir = $_SERVER['DOCUMENT_ROOT'].'/profilepics/';
        $target_file = $target_dir . basename($_FILES["pp"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["pp"]["tmp_name"]);
            if($check !== false) {
                $uploadOk = 1;
            } else {
                echo "File is not an image. ";
                $uploadOk = 0;
            }
        }
        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists. ";
            $uploadOk = 0;
        }
        // Check file size
        if ($_FILES["pp"]["size"] > 500000) {
            echo "Sorry, your file is too large. ";
            $uploadOk = 0;
        }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed. ";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Your file was not uploaded. ";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["pp"]["tmp_name"], $target_file)) {
                $pathparts = pathinfo($target_file);
                $extension = $pathparts['extension'];
                rename($target_file, $_SERVER['DOCUMENT_ROOT'].'/profilepics/'.$_SESSION['u_uid'].'.'.$extension);
                $fileset = True;
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
    else
    {
        $fileset = True;
    }


    

    if ($pwdset && $fieldsset && $fileset)
    {
        $phpself = $_SERVER['PHP_SELF'];
        
        
        unset($_SESSION['u_first']);
        unset($_SESSION['u_last']);
        unset($_SESSION['u_description']);
        unset($_SESSION['u_email']);
        $uid = $_SESSION['u_uid'];
        $sql = "SELECT * FROM users WHERE user_uid = '$uid'";
        $result = mysqli_query($conn, $sql);
        
            if($row = mysqli_fetch_assoc($result))
            {
                $_SESSION['u_first'] = $row['user_first'];
                $_SESSION['u_last'] = $row['user_last'];
                $_SESSION['u_email'] = $row['user_email'];
                $_SESSION['u_description'] = $row['user_description'];
            }

            echo "<script>window.location.href = 'user.php?user=$username'</script>";
    }

}
?>

    </center>

    <br/>
    <br/>

    <div style="margin-left:25%;">

    <h3>Delete my account: </h3>
        <p>To delete your account, type in your current password below and type in "delete" in the next box.</p>
        <br/>
        <form method = "POST" action = "<?php echo $_SERVER['PHP_SELF'];?>">

        <p>Enter your password: </p><input type = "password" name = "pwd" style="color:black;"/>
        <br/>
        <p>Enter "delete": </p> <input type = "text" name = "delete_text" style="color:black;"/>
        <br/>
        <br/>
        <button type = "submit" name = "delete">Delete account</button>
        
        </form>

    </div>
    <center>
    <?php


    if(isset($_POST['delete']))
    {
        $pwd_for_delete = mysqli_real_escape_string($conn, $_POST['pwd']);
        $delete_text = mysqli_real_escape_string($conn, $_POST['delete_text']);

        $uid_to_delete = $_SESSION['u_uid'];

        
        //Remove PDF files and txt ratings of associated notes

        $findNotes = "SELECT * FROM notes WHERE a_author = '$uid_to_delete'";
        $findResults = mysqli_query($conn,$findNotes);
        while($row = mysqli_fetch_assoc($findResults))
        {
            $directoryToDelete = $row['a_directory'];
            $unlinkNote = $_SERVER['DOCUMENT_ROOT'].'/notes/'.$directoryToDelete.'.pdf';
            $unlinkRating = $_SERVER['DOCUMENT_ROOT'].'/notes/ratings/'.$directoryToDelete.'.txt';
            unlink($unlinkNote);
            unlink($unlinkRating);
        }


        //Delete user and associated note records from database.
        $sql = "SELECT * FROM users WHERE user_uid = '$uid_to_delete'";
        $result = mysqli_query($conn, $sql);
            if($row = mysqli_fetch_assoc($result))
            {

            $PwdCheck = password_verify($pwd_for_delete, $row['user_pwd']);

            if ($PwdCheck == True)
            {
                if ($delete_text == "delete")
                {                        
                    $sql_del = "DELETE FROM users WHERE user_uid = '$uid_to_delete'; DELETE FROM notes WHERE a_author = '$uid_to_delete'"; 
                    mysqli_multi_query($conn, $sql_del); //Remove from DB users and notes


                    //Remove profile pic
                    $check_previous_jpg = $_SERVER['DOCUMENT_ROOT'].'/profilepics/'.$_SESSION['u_uid'].'.jpg';
                    $check_previous_png = $_SERVER['DOCUMENT_ROOT'].'/profilepics/'.$_SESSION['u_uid'].'.png';
                    $check_previous_jpeg = $_SERVER['DOCUMENT_ROOT'].'/profilepics/'.$_SESSION['u_uid'].'.jpeg';
                    $check_previous_gif = $_SERVER['DOCUMENT_ROOT'].'/profilepics/'.$_SESSION['u_uid'].'.gif';
            
                    if(file_exists($check_previous_jpg))
                    {
                        unlink($check_previous_jpg);
                    }
                    elseif(file_exists($check_previous_png))
                    {
                        unlink($check_previous_png);
                    }
                    elseif(file_exists($check_previous_jpeg))
                    {
                        unlink($check_previous_jpeg);
                    }
                    elseif(file_exists($check_previous_gif))
                    {
                        unlink($check_previous_gif);
                    }
                    
                    

                    //For now, let's keep the pdf copies of their notes even when they unregister...
                    //Log out
                    session_unset();
                    session_destroy();
                    echo "<script>window.location.href = 'index.php'</script>";
                    exit();

                }
                else{
                    echo "You did not type 'delete'. Failed to delete your account.";
                }
            }
            else
            {
                echo "Your password was incorrect. Failed to delete your account.";
            }
    }}
?>

    </center>

<?php include $_SERVER['DOCUMENT_ROOT'].'/footer.php'?>

