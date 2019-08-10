<!-- PROBLEMS DETECTED! NEW TABLES ARE NOT BEING MADE IN THE COMMENTS DATABASE! tom21487 is working on the isssue -->

<?php
    include $_SERVER['DOCUMENT_ROOT'].'/discussion/header-discussion.php';
    include 'dbh.inc.php';
                    
        function submitTopic($conn, $conn2, $conn3)
        {
                
                
                if (isset($_POST['topicSubmit']))
                {
                    define('ROOT',dirname(__FILE__).'/');  
                    
                    if($_FILES["file"]["size"] < 5000000) //Checking size
                {
                    //I still think we should restrict file types.
                    if($_FILES["file"]["error"] > 0) //Checking errors
                    {
                        echo "Error: ".$_FILES["file"]["error"]."<br/>";
                    }
                    else
                    {
                        echo "Upload: " . $_FILES["file"]["name"] . "<br />";
                        echo "Type: " . $_FILES["file"]["type"] . "<br />";
                        echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
                        echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";
                        
                        if(file_exists(ROOT."topic/files/".$_FILES["file"]["name"])) //Checking duplicates
                        {
                            echo "File ".$_FILES["file"]["name"]." already exists.";
                        }
                        else
                        {
                            if(is_uploaded_file($_FILES['file']['tmp_name'])){  
                                $stored_path = ROOT.'/topic/files/'.basename($_FILES['file']['name']);  
                                  
                                if(move_uploaded_file($_FILES['file']['tmp_name'],$stored_path)){  
                                    echo "Stored in: " . $stored_path;  
                                }else{  
                                    echo 'Stored failed:file save error';  
                                }  
                            }
                        }
                    }
                }
                else
                {
                    echo "File is too large.";
                }
                
                    $title = $_POST['title'];
                    $description = $_POST['description'];
                    $id = $_POST['id'] + 1;
                    $category = $_POST['category'];
                    $file = $_POST['file'];
                    

                    
                    $sql5 = "SELECT * FROM users WHERE user_id = $_SESSION[u_id]";
                    $result5 = $conn3->query($sql5);
            
                    while ($row = $result5->fetch_assoc()) #loop through results until there is no more left
                    {
                        $name = $row['user_uid'];
                    }
                    
                    
                    //$name = $_SESSION['u_id'];
                    //$url = $id + 1;
                    $sql1 = "INSERT INTO products (title, description, category) VALUES ('$title', '$description', '$category')";
                    $result1 = $conn->query($sql1);
                    
                    $sql2 = "CREATE TABLE comments$id LIKE comments";
                    $result2 = $conn2->query($sql2);
                    
                    $myfile2 = "../topic/comments.inc$id.php";
                    $handle2 = fopen($myfile2, 'w') or die('Cannot open file:  '.$myfile2); //implicitly creates file
            
                    file_put_contents($myfile2, '<?php

            function setComments($conn, $conn3)
            {
            if (isset($_POST[\'commentSubmit\']))
            {
                //$uid = $_POST[\'uid\'];
                
                 $sql5 = "SELECT * FROM users WHERE user_id = $_SESSION[u_id]";
                        $result5 = $conn3->query($sql5);
            
                    while ($row = $result5->fetch_assoc()) #loop through results until there is no more left
                    {
                        $uid = "$row[user_uid]";
                        $creatorid = "$row[user_id]";
                    }
                        
                $date = $_POST[\'date\'];
                $message = $_POST[\'message\'];
            
                $sql = "INSERT INTO comments');
                
                    file_put_contents($myfile2, "$id", FILE_APPEND);
                    
                    file_put_contents($myfile2, '(uid, creator, date, message) VALUES (\'$uid\', \'$creatorid\',\'$date\', \'$message\')";
                $result = $conn->query($sql);
            }
            }
            
            function getComments($conn)
            {
                #different scopes allow for same variable names
                $sql = "SELECT * FROM comments', FILE_APPEND);
                
                file_put_contents($myfile2, "$id", FILE_APPEND);

                file_put_contents($myfile2,
                '";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) #loop through results until there is no more left
                {
                    echo "<div class=\'comment-box\' id=\'black\'><p>";
                    #row is an array
                    echo \'"\'.$row[\'uid\'].\'"\'." said on: ";
                    echo $row[\'date\']."<br>";
                    echo nl2br($row[\'message\']); #nl2br converts new lines (nl) to br tags
                    
                    if ($row[\'creator\'] == $_SESSION[\'u_id\'])
                    {
                    echo
                        "</p>
                        <form class=\'deleteForm\' method=\'POST\' action=\'".deleteComments($conn)."\'>
                        <input type=\'hidden\' name=\'cid\' value=\'".$row[\'cid\']."\'>
                        <button type=\'submit\' name=\'commentDelete\'>Delete</button>
                        </form>";
                    
                    echo 
                        "<form class=\'editForm\' method=\'POST\' action=\'editComment', FILE_APPEND);
                        
                file_put_contents($myfile2, "$id", FILE_APPEND);

                file_put_contents($myfile2, '.php\'>
                        <input type=\'hidden\' name=\'cid\' value=\'".$row[\'cid\']."\'>
                        <input type=\'hidden\' name=\'uid\' value=\'".$row[\'uid\']."\'>
                        <input type=\'hidden\' name=\'date\' value=\'".$row[\'date\']."\'>
                        <input type=\'hidden\' name=\'message\' value=\'".$row[\'message\']."\'>
                        <button name=\'commentEdit\'>Edit</button>
                        </form>";
                    }
                    echo "</div><br>";
                }
            }

            function getCommentsGuest($conn)
            {
                #different scopes allow for same variable names
                $sql = "SELECT * FROM comments', FILE_APPEND);
                
            file_put_contents($myfile2, "$id", FILE_APPEND);

            file_put_contents($myfile2, '
                ";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) #loop through results until there is no more left
                {
                    echo "<div class=\'comment-box\' id=\'black\'><p>";
                    #row is an array
                    echo \'"\'.$row[\'uid\'].\'"\'." said on: ";
                    echo $row[\'date\']."<br>";
                    echo nl2br($row[\'message\']); #nl2br converts new lines (nl) to br tags
                    echo "</p></div><br>";
                }
            }

            function editComments($conn)
            {
                if (isset($_POST[\'commentSubmit\']))
                {
                    $cid = $_POST[\'cid\'];
                    $uid = $_POST[\'uid\'];
                    $date = $_POST[\'date\'];
                    $message = $_POST[\'message\'];
            
                    $sql = "UPDATE comments', FILE_APPEND);
                    
        file_put_contents($myfile2, "$id", FILE_APPEND);
            
        file_put_contents($myfile2, ' SET message=\'$message\' WHERE cid=\'$cid\'";

                    $result = $conn->query($sql);
                    echo "<script>location.href=\'../topic/', FILE_APPEND);
                    
        file_put_contents($myfile2, "$id", FILE_APPEND);
        
        file_put_contents($myfile2, '.php\';</script>"; #got it -Tom214w87
            }
        }

        function deleteComments($conn)
        {
            if (isset($_POST[\'commentDelete\']))
            {
                $cid = $_POST[\'cid\'];
                $sql = "DELETE FROM comments', FILE_APPEND);
                
                
                file_put_contents($myfile2, "$id", FILE_APPEND);
                
                file_put_contents($myfile2, ' WHERE cid=\'$cid\'";
                $result = $conn->query($sql);
                echo "<script>location.href=\'../topic/', FILE_APPEND);
            
        file_put_contents($myfile2, "$id", FILE_APPEND);
        
        file_put_contents($myfile2, '.php\';</script>"; #got it -Tom21487
                }
            }
        ?>', FILE_APPEND);
        
                    $myfile = "../topic/$id.php";
                    $handle = fopen($myfile, 'w') or die('Cannot open file:  '.$myfile); //implicitly creates file

                    file_put_contents($myfile, '
            
                    <?php
                    include $_SERVER[\'DOCUMENT_ROOT\'].\'/header.php\';
                    date_default_timezone_set(\'Asia/Beijing\');
                    include \'dbh.inc.php\';
                    include \'comments.inc');
                    
                    file_put_contents($myfile, "$id", FILE_APPEND);
                    
                    file_put_contents($myfile, '.php\';?>
            
                    <!DOCTYPE html>
                    <html>
                    <head>
                    <meta charset=\'UTF 8\'>
                    <title>', FILE_APPEND);
            
                    file_put_contents($myfile, $title, FILE_APPEND);
            
                    file_put_contents($myfile, '</title>
                    <link rel=\'stylesheet\' type=\'text/css\' href=\'topicStyle.css\'>
                    </head><body><center><h1>Title: ', FILE_APPEND);
            
                    file_put_contents($myfile, $title, FILE_APPEND);
            
                    file_put_contents($myfile, 
                    '
            
                    </center></h1>
                    <center>Description: ', FILE_APPEND);
            
                    file_put_contents($myfile, $description, FILE_APPEND);
                    
                    file_put_contents($myfile, '<br>Posted by: ', FILE_APPEND);
                    
                    file_put_contents($myfile, $name, FILE_APPEND);
                    
                    file_put_contents($myfile, '<br>Category: ', FILE_APPEND);
                    
                    file_put_contents($myfile, $category, FILE_APPEND);
                    
                    if($category == 'Note')
                    {
                        file_put_contents($myfile, '<br>Link to file: ',FILE_APPEND);
                        file_put_contents($myfile, $_SERVER['DOCUMENT_ROOT']. '/topic/files/'.$_FILES["file"]["name"], FILE_APPEND);
                    }
                    
                    file_put_contents($myfile,
                    '
                    </center>
                    <br>
                    <div style=\'margin-left: 100px\'>Comments:</div>
            
                    <!-- GUI for comments section -->
            
                    <?php
                    if(isset($_SESSION[\'u_id\']))
                    {
                    echo "
                
                    <form method=\'POST\' action=\'".setComments($conn, $conn3)."\'>
                    <!-- <input type=\'hidden\' name=\'uid\' value=\'Anonymous\'> -->
                    <input type=\'hidden\' name=\'date\' value=\'".date(\'Y-m-d H:i:s\')."\'>
                    <div style=\'margin-left: 100px\'>
                    <!-- Name: <br>
                    <textarea id=\'nameArea\' name=\'uid\'></textarea><br> -->
                    Message: <br>
                    <textarea id=\'commentArea\' name=\'message\'></textarea><br>
                    <button type =\'submit\' name=\'commentSubmit\'>Submit</button>
                    </div>
                    </form>
                    ";
                    getComments($conn);
                }
        
                else
                {
                    echo "<div style=\'margin-left: 100px\'>Hey stranger, you are currently in read-only mode. Please login to post and edit comments!
                    Alternatively, view <a href=\'2.php\'>2.php</a> to see what a logged-in page would look like.</div>";
                    getCommentsGuest($conn);
                }
                ?>
                </body>
                </html>', FILE_APPEND);
                
                //Need to redefine location FeelsBadMan
                echo "<script>location.href='../topic/$id.php';</script>";
                
                $myfile3 = "../topic/editComment$id.php";
                 
                $handle3 = fopen($myfile3, 'w') or die('Cannot open file:  '.$myfile3); //implicitly creates file

                file_put_contents($myfile3, '
            
                <!-- Template for all discussion topic pages -->
                <?php
                include $_SERVER[\'DOCUMENT_ROOT\'].\'/header.php\';
                date_default_timezone_set(\'Asia/Beijing\');
                include \'dbh.inc.php\';
                include \'comments.inc');
                
                file_put_contents($myfile3, "$id", FILE_APPEND);

                file_put_contents($myfile3, '.php\';
                ?>

                <!DOCTYPE html>
                <html>
                <head>
                <meta charset="UTF 8">
                <title>Edit Comment</title>
                <link rel="stylesheet" type="text/css" href="topicStyle.css">
                </head>
                <body>
                <center>Edit your comment
                </center>
                <br>
                <?php
                $cid = $_POST[\'cid\'];
                $uid = $_POST[\'uid\'];
                $date = $_POST[\'date\'];
                $message = $_POST[\'message\'];
        
                echo "
                <form method=\'POST\' action=\'".editComments($conn)."\'>
                <input type=\'hidden\' name=\'cid\' value=\'".$cid."\'>
                <input type=\'hidden\' name=\'uid\' value=\'".$uid."\'>
                <input type=\'hidden\' name=\'date\' value=\'".$date."\'>
                <textarea id=\'commentArea\' name=\'message\'>".$message."</textarea><br>
                <button type =\'submit\' name=\'commentSubmit\'>Edit</button>
                </form>
                ";
        
                ?>
                </body>
                </html>

                <?php
                    include $_SERVER[\'DOCUMENT_ROOT\'].\'/footer.php\';
                ?>
                ', FILE_APPEND);
                
                } //End of topic submit scope (very important bracket)
        }


/********************************************************************************************************************************/
        
        if(isset($_SESSION['u_id']))
        {
                echo "
                <form method='POST' action='".submitTopic($conn, $conn2, $conn3)."'>
                <div style='margin-left: 100px'>
                    Title: <br>
                        <textarea name='title'></textarea><br>
                    Description: <br>
                        <textarea name='description'></textarea><br>
                    Category: <br>
                        <select name='category'>
                        <option>Question</option>
                        <option>Note</option>
                        </select>
                        <br>
                    Upload File:
                        <br>
                        <input type='file' name='file' id='file'>
                        <br><br>
                ";
                    
                    $sql2 = "SELECT * FROM products";
                    $result2 = $conn->query($sql2);
                    
                    while ($row = $result2->fetch_assoc()) #loop through results until there is no more left
                    {
                        echo "
                        <input type='hidden' name='id' value='".$row['id']."'></input>
                        ";
                    }
                    
                echo '
                    <button name=\'topicSubmit\'>Submit</button>
                    </div>
                    </form>
                ';
        }
        
        // Remember to include the sign up link in the session page if the user isn't logged in
        else
        {
            echo '
            <div style=\'margin-left: 100px\'>Hello guest, you are currently in read-only mode. Log in to post topics!</div>
            ';
        }
        
        //Test content writing (incomplete and probably fucked up)
        $sql2 = "SELECT * FROM products";
        $result2 = $conn->query($sql2);
        
        /* Working file copying
        $testfile = '../index.php';
        $destfile = '../topic/1.php';
        copy($testfile, $destfile);
        */
        
    include $_SERVER['DOCUMENT_ROOT'].'/footer.php';
?>