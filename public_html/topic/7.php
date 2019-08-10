
            
                    <?php
                    include $_SERVER['DOCUMENT_ROOT'].'/header.php';
                    date_default_timezone_set('Asia/Beijing');
                    include 'dbh.inc.php';
                    include 'comments.inc7.php';?>
            
                    <!DOCTYPE html>
                    <html>
                    <head>
                    <meta charset='UTF 8'>
                    <title>Memes are dreams</title>
                    <link rel='stylesheet' type='text/css' href='topicStyle.css'>
                    </head><body><center><h1>Title: Memes are dreams
            
                    </center></h1>
                    <center>Description: <br>Posted by: tom21487<br>Category: Question
                    </center>
                    <br>
                    <div style='margin-left: 100px'>Comments:</div>
            
                    <!-- GUI for comments section -->
            
                    <?php
                    if(isset($_SESSION['u_id']))
                    {
                    echo "
                
                    <form method='POST' action='".setComments($conn, $conn3)."'>
                    <!-- <input type='hidden' name='uid' value='Anonymous'> -->
                    <input type='hidden' name='date' value='".date('Y-m-d H:i:s')."'>
                    <div style='margin-left: 100px'>
                    <!-- Name: <br>
                    <textarea id='nameArea' name='uid'></textarea><br> -->
                    Message: <br>
                    <textarea id='commentArea' name='message'></textarea><br>
                    <button type ='submit' name='commentSubmit'>Submit</button>
                    </div>
                    </form>
                    ";
                    getComments($conn);
                }
        
                else
                {
                    echo "<div style='margin-left: 100px'>Hey stranger, you are currently in read-only mode. Please login to post and edit comments!
                    Alternatively, view <a href='2.php'>2.php</a> to see what a logged-in page would look like.</div>";
                    getCommentsGuest($conn);
                }
                ?>
                </body>
                </html>7