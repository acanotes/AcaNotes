<!-- Template for all discussion topic pages -->
<?php
    include $_SERVER['DOCUMENT_ROOT'].'/header.php';
    date_default_timezone_set('Asia/Beijing');
    include 'dbh.inc.php';
    include 'comments.inc.php';
?>
<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF 8">
    <title>Topic: 2</title>
    <link rel="stylesheet" type="text/css" href="topicStyle.css">
    </head>
    <body>
        <center>This is an example of a discussion page. The topic will be
        shown here while the comments/discussion is shown below. It
        is currently unfinished in terms of login system and styling. Visit
        <a href='1.php'>1.php</a> to see this page with login restrictions.
        </center>
        <br>
        <div style='margin-left: 100px'>Comments:</div>
        <!-- GUI for comments section -->
        <?php
        echo "
        <form method='POST' action='".setComments($conn)."'>
            <!-- <input type='hidden' name='uid' value='Anonymous'> -->
            <input type='hidden' name='date' value='".date('Y-m-d H:i:s')."'>
            <div style='margin-left: 100px'>
            Name: <br>
            <textarea id='nameArea' name='uid'></textarea><br>
            Message: <br>
            <textarea id='commentArea' name='message'></textarea><br>
            <button type ='submit' name='commentSubmit'>Submit</button>
            </div>
        </form>
        ";
        
        getComments($conn);
        ?>
    </body>
</html>

<?php
    include $_SERVER['DOCUMENT_ROOT'].'/footer.php';
?>