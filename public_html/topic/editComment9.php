
            
                <!-- Template for all discussion topic pages -->
                <?php
                include $_SERVER['DOCUMENT_ROOT'].'/header.php';
                date_default_timezone_set('Asia/Beijing');
                include 'dbh.inc.php';
                include 'comments.inc9.php';
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
                $cid = $_POST['cid'];
                $uid = $_POST['uid'];
                $date = $_POST['date'];
                $message = $_POST['message'];
        
                echo "
                <form method='POST' action='".editComments($conn)."'>
                <input type='hidden' name='cid' value='".$cid."'>
                <input type='hidden' name='uid' value='".$uid."'>
                <input type='hidden' name='date' value='".$date."'>
                <textarea id='commentArea' name='message'>".$message."</textarea><br>
                <button type ='submit' name='commentSubmit'>Edit</button>
                </form>
                ";
        
                ?>
                </body>
                </html>

                <?php
                    include $_SERVER['DOCUMENT_ROOT'].'/footer.php';
                ?>
                