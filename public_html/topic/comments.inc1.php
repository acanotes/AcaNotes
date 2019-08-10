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
            
                $sql = "INSERT INTO comments1(uid, creator, date, message) VALUES ('$uid', '$creatorid','$date', '$message')";
                $result = $conn->query($sql);
            }
            }
            
            function getComments($conn)
            {
                #different scopes allow for same variable names
                $sql = "SELECT * FROM comments1";
                $result = $conn->query($sql);
                
                $storageMessage = array();
                $storageCreator = array();
                $storageUid = array();
                $storageDate = array();
        
                while ($row = $result->fetch_assoc())
                {
                    $topicMax = $row['id'];
                    $message = $row['message'];
                    $uid = $row['uid'];
                    $date = $row['date'];
                    $creator = $row['creator'];
                    array_push($storageMessage, $message);
                    array_push($storageCreator, $creator);
                    array_push($storageUid, $uid);
                    array_push($storageDate, $date);
                }

                for ($i = 1; $i < $topicMax; $i++)
                { 
                    echo "<div class='comment-box' id='black'><p>";
                    #row is an array
                    echo '"'.$storageUid[$topicMax-$i].'"'." said on: "; #because arrays start on 0
                    echo $storageDate[$topicMax-$i]."<br>";
                    echo nl2br($storageMessage[$topicMax-$i]); #nl2br converts new lines (nl) to br tags
                    
                    if ($storageCreator[$topicMax-$i] == $_SESSION['u_id'])
                    {
                    
                    $cid = $topicMax - $i + 1;

                    echo #cid is not stored in an array so you need to add 1 to cancel out the starting 0 of the array
                        "</p>
                        <form class='deleteForm' method='POST' action='".deleteComments($conn)."'>
                        <input type='hidden' name='cid' value='".$cid."'>
                        <button type='submit' name='commentDelete'>Delete</button>
                        </form>";
                    
                    echo 
                        "<form class='editForm' method='POST' action='editComment.php'>
                        <input type='hidden' name='cid' value='".$cid."'>
                        <input type='hidden' name='uid' value='".$storageUid[$topicMax-$i]."'>
                        <input type='hidden' name='date' value='".$storageDate[$topicMax-$i]."'>
                        <input type='hidden' name='message' value='".$storageMessage[$topicMax-$i]."'>
                        <button name='commentEdit'>Edit</button>
                        </form>";
                    }
                    echo "</div><br>";
                }
        
                /*
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
                */
            }

            function getCommentsGuest($conn)
            {
                #different scopes allow for same variable names
                $sql = "SELECT * FROM comments1
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
            
                    $sql = "UPDATE comments1 SET message='$message' WHERE cid='$cid'";

                    $result = $conn->query($sql);
                    echo "<script>location.href='../topic/1.php';</script>"; #got it -Tom214w87
            }
        }

        function deleteComments($conn)
        {
            if (isset($_POST['commentDelete']))
            {
                $cid = $_POST['cid'];
                $sql = "DELETE FROM comments1 WHERE cid='$cid'";
                $result = $conn->query($sql);
                echo "<script>location.href='../topic/1.php';</script>";
            }
        }
        ?>