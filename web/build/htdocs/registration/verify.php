<?php
include '../head.php';
include '../header.php';
include '../includes/dbh.inc.php';

?>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<center>
<?php
if(isset($_GET['vkey']))
{
    $vkey = $_GET['vkey'];
    $resultSet = mysqli_query($conn, "SELECT * FROM users WHERE verified = 0 AND vkey = '$vkey'");
    $num_rows = mysqli_num_rows($resultSet);

    if($num_rows != 0){
        while($row = mysqli_fetch_assoc($resultSet))
        {
            $uid = $row['user_uid'];
        }
        //Validate email
        $update = mysqli_query($conn, "UPDATE users SET verified = 1 WHERE vkey = '$vkey'");

        if($update){
                echo "Welcome aboard! Your account has been successfully verified. You may now log in.";
        }
        else{
            echo "An error occured with your verification. Please try again.";
        }

    }
    else
    {
        echo "This account is invalid or already verified.";
    }

}
else
{
    die("An error occured.");
}

?>
</center>

