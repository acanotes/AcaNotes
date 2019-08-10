<?php

            function setComments($conn, $conn3)
            {
            if (isset($_POST['commentSubmit']))
            {
                //$uid = $_POST['uid'];
                
                 $sql5 = "SELECT * FROM users WHERE user_id = $_SESSION[u_id]";
                        $result5 = $conn3->query($sql5);
            
                    while ($row = $result5->fetch_assoc()) #loop through results until there is no more left
                    {
                        $uid = "$row[user_uid]";
                        $creatorid = "$row[user_id]";
                    }
                        
                $date = $_POST['date'];
                $message = $_POST['message'];
            
                $sql = "INSERT INTO comments4(uid, creator, date, message) VALUES ('$uid', '$creatorid','$date', '$message')";
                $result = $conn->query($sql);
            }
            }
            
            function getComments($conn)
            {
                #different scopes allow for same variable names
                $sql = "SELECT * FROM comments4";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) #loop through results until there is no more left
                {
                    echo "<div class='comment-box' id='black'><p>";
                    #row is an array
                    echo '"'.$row['uid'].'"'." said on: ";
                    echo $row['date']."<br>";
                    echo nl2br($row['message']); #nl2br converts new lines (nl) to br tags
                    
                    if ($row['creator'] == $_SESSION['u_id'])
                    {
                    echo
                        "</p>
                        <form class='deleteForm' method='POST' action='".deleteComments($conn)."'>
                        <input type='hidden' name='cid' value='".$row['cid']."'>
                        <button type='submit' name='commentDelete'>Delete</button>
                        </form>";
                    
                    echo 
                        "<form class='editForm' method='POST' action='editComment.php'>
                        <input type='hidden' name='cid' value='".$row['cid']."'>
                        <input type='hidden' name='uid' value='".$row['uid']."'>
                        <input type='hidden' name='date' value='".$row['date']."'>
                        <input type='hidden' name='message' value='".$row['message']."'>
                        <button name='commentEdit'>Edit</button>
                        </form>";
                    }
                    echo "</div><br>";
                }
            }

            function getCommentsGuest($conn)
            {
                #different scopes allow for same variable names
                $sql = "SELECT * FROM comments4
                ";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) #loop through results until there is no more left
                {
                    echo "<div class='comment-box' id='black'><p>";
                    #row is an array
                    echo '"'.$row['uid'].'"'." said on: ";
                    echo $row['date']."<br>";
                    echo nl2br($row['message']); #nl2br converts new lines (nl) to br tags
                    echo "</p></div><br>";
                }
            }

            function editComments($conn)
            {
                if (isset($_POST['commentSubmit']))
                {
                    $cid = $_POST['cid'];
                    $uid = $_POST['uid'];
                    $date = $_POST['date'];
                    $message = $_POST['message'];
            
                    $sql = "UPDATE comments SET message='$message' WHERE cid='$cid'";

                    $result = $conn->query($sql);
                    echo "<script>location.href='../topic/4
                .php';</script>"; #got it -Tom214w87
            }
        }

        function deleteComments($conn)
        {
            if (isset($_POST['commentDelete']))
            {
                $cid = $_POST['cid'];
                $sql = "DELETE FROM comments4 WHERE cid='$cid'";
                $result = $conn->query($sql);
                echo "<script>location.href='../topic/4