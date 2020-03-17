<?php
include 'head.php';
include 'header.php';

if($_SESSION['u_uid'] != 'admin')
{
    header("Location: index.php");
}
?>
<br/>
<br/>
<br/>
<br/>


<center>

<h1>Admin Panel</h1>

</center>
<div style="margin-left: 25pt;">
<br/>
<p>Welcome, admin. Here, you can manage users and post announcements to the AcaNotes community. This page serves as a safer way for you to make database changes, so that you do not have to access our phpMyAdmin server directly.</p>
<br/>

<center>
    <h2>Make Announcements</h2>

<form method="POST">
    <textarea style = "width: 25%; height: 200pt; resize:none;" maxlength = "500" placeholder="Enter your announcement" id = 'textarea' name = 'announcement'></textarea>
    <br/>
    <br/>
    <button name = "submit-announcement">Post</button>
</form>

</center>
<br/>
<br/>

<center>
    <h2>Monitor Users</h2>

<br/>

    <table border = "1" style = "width: 70%">
        <tr>

            <th>First name: </th>
            <th>Last name: </th>
            <th>Username: </th>
            <th>Email: </th>
            <th>Title: </th>
            <th>Rating: </th>
            <th>Downloads: </th>
            <th>Points: </th>
        </tr>
        
            <?php
                $sql = "SELECT * FROM users";
                $result = mysqli_query($conn, $sql);
                $queryResults = mysqli_num_rows($result);
                if ($queryResults > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        if($row['user_uid'] != "admin") //admin cannot delete him/herself.
                        {
                            $displayRating = $row['user_rating']+1;
                            echo "
                            <tr>
                            <td>".$row['user_first']."</td>
                            <td>".$row['user_last']."</td>
                            <td>".$row['user_uid']."</td>
                            <td>".$row['user_email']."</td>
                            <td>".$row['user_title']."</td>
                            <td>".$displayRating."</td>
                            <td>".$row['user_downloads']."</td>
                            <td>".$row['user_points']."</td>
                            </tr>
                            ";
                        }
                    }
                }

            ?>
        
    </table>
</center>
<br/>
<br/>



</div>

<?php
    if(isset($_POST['submit-announcement']))
    {
        $announcement = mysqli_real_escape_string($conn, $_POST['announcement']);
        $sql = "UPDATE announcements SET announcement = '$announcement' WHERE announcement_index = 1";
        if(mysqli_query($conn, $sql))
        {
            echo "<center>Successfully uploaded announcement!</center>";
        }
        else
        {
            echo "<center>Upload failed. Please try again.</center>";
        }
    }

?>


<?php 
include 'includes/dbh.inc.php';

?>


<?php include $_SERVER['DOCUMENT_ROOT'].'/footer.php';
?>