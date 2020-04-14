<?php
  include $_SERVER['DOCUMENT_ROOT'].'/head.php';
  //include(dirname(__FILE__)."/../header.php");
  $id = mysqli_real_escape_string($conn, $_GET['id']);

  $sql = "SELECT * FROM notes WHERE a_id = '$id'";
  $result = mysqli_query($conn, $sql);
  $queryResults = mysqli_num_rows($result);
  $price = 0.0;
  if ($queryResults > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $title = $row['a_title'];
        $subject = $row['a_subject'];
        $user = $row['a_author'];
        $description = $row['a_description'];
        $date = $row['a_date'];
        $note_id = $row['a_id'];
        $extension = 'pdf';
        $price = 0.00;//$row['a_price'];
        $rating = $row['a_rating'];
        $downloads = $row['a_downloads'];
    }
  }
  else
  {
    header("Location: index.php");
  }

  $file = $_SERVER['DOCUMENT_ROOT']."/notes/ratings/".$note_id.'_'.$user.'_'.$subject.'_'.$title.'.txt';

  $lines = file($file);
  $myRating = "--";
  foreach ($lines as $line)
    {
      if ($line != "********\n")
      {
      $checkUser  = explode(" ", $line);
      if ($checkUser[0] == $_SESSION['u_uid'])
      {
        $myRating = (int)$checkUser[1];
        $myRating = $myRating + 1;
      }
      }
    }


?>

<?php
  if (isset($_POST['one']))
  {

    $searchFor = $_SESSION['u_uid'];

    $str = file_get_contents($file);
    $str = preg_replace("/.*\b".$searchFor."\b.*\n/ui", "********\n", $str);
    $fp = fopen($file,'w');
    fwrite($fp,$str);
    fclose($fp);
    $writeFile = fopen($file, 'a');
    fwrite($writeFile, $_SESSION['u_uid']." 0"."\n");

    $lines = file($file);
    $sum = 0;
    $num_lines = 0;
    foreach ($lines as $line)
    {
      if ($line != "********\n")
      {
      $num_lines ++;
      $var = explode(" ", $line);
      $sum = $sum + (int)$var[1];
      }
    }

    $avg_rating = $sum/$num_lines;

    $sql = "UPDATE notes SET a_rating = '$avg_rating' WHERE a_id = $note_id";
    if (mysqli_query($conn, $sql)) {
      echo "Thank you for your rating!";
    }
    fclose($writeFile);

    $lines = file($file);
    $myRating = "--";
    foreach ($lines as $line)
      {
        if ($line != "********\n")
        {
        $checkUser  = explode(" ", $line);
        if ($checkUser[0] == $_SESSION['u_uid'])
        {
          $myRating = (int)$checkUser[1];
          $myRating = $myRating + 1;

        }
        }
      }
  
      $id = mysqli_real_escape_string($conn, $_GET['id']);
  $sql = "SELECT * FROM notes WHERE a_id = '$id'";
  $result = mysqli_query($conn, $sql);
  $queryResults = mysqli_num_rows($result);
  $price = 0.0;
  if ($queryResults > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $title = $row['a_title'];
        $subject = $row['a_subject'];
        $user = $row['a_author'];
        $date = $row['a_date'];
        $note_id = $row['a_id'];
        $extension = 'pdf';
        $price = 0.00;//$row['a_price'];
        $rating = $row['a_rating'];
    }
  }
    }

  if (isset($_POST['two']))
  {
    $searchFor = $_SESSION['u_uid'];

    $str = file_get_contents($file);
    $str = preg_replace("/.*\b".$searchFor."\b.*\n/ui", "********\n", $str);
    $fp = fopen($file,'w');
    fwrite($fp,$str);
    fclose($fp);
    $writeFile = fopen($file, 'a');
    fwrite($writeFile, $_SESSION['u_uid']." 1"."\n");

    $lines = file($file);
    $sum = 0;
    $num_lines = 0;
    foreach ($lines as $line)
    {

      if ($line != "********\n")
      {
      $num_lines ++;
      $var = explode(" ", $line);
      $sum = $sum + (int)$var[1];
      }
    }

    $avg_rating = $sum/$num_lines;

    $sql = "UPDATE notes SET a_rating = '$avg_rating' WHERE a_id = $note_id";
    if (mysqli_query($conn, $sql)) {
      echo "Thank you for your rating!";
    }
    fclose($writeFile);

    $lines = file($file);
    $myRating = "--";
    foreach ($lines as $line)
      {
        if ($line != "********\n")
        {
        $checkUser  = explode(" ", $line);
        if ($checkUser[0] == $_SESSION['u_uid'])
        {
          $myRating = (int)$checkUser[1];
          $myRating = $myRating + 1;
        }
        }
      }
        $id = mysqli_real_escape_string($conn, $_GET['id']);
    $sql = "SELECT * FROM notes WHERE a_id = '$id'";
    $result = mysqli_query($conn, $sql);
    $queryResults = mysqli_num_rows($result);
    $price = 0.0;
    if ($queryResults > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $title = $row['a_title'];
        $subject = $row['a_subject'];
        $user = $row['a_author'];
        $date = $row['a_date'];
        $note_id = $row['a_id'];
        $extension = 'pdf';
        $price = 0.00;//$row['a_price'];
        $rating = $row['a_rating'];
    }
  }

  }

  if (isset($_POST['three']))
  {
    $searchFor = $_SESSION['u_uid'];

    $str = file_get_contents($file);
    $str = preg_replace("/.*\b".$searchFor."\b.*\n/ui", "********\n", $str);
    $fp = fopen($file,'w');
    fwrite($fp,$str);
    fclose($fp);
    $writeFile = fopen($file, 'a');
    fwrite($writeFile, $_SESSION['u_uid']." 2"."\n");

    $lines = file($file);
    $sum = 0;
    $num_lines = 0;
    foreach ($lines as $line)
    {

      if ($line != "********\n")
      {
      $num_lines ++;
      $var = explode(" ", $line);
      $sum = $sum + (int)$var[1];
      }
    }

    $avg_rating = $sum/$num_lines;

    $sql = "UPDATE notes SET a_rating = '$avg_rating' WHERE a_id = $note_id";
    if (mysqli_query($conn, $sql)) {
      echo "Thank you for your rating!";
    }
    fclose($writeFile);

    $lines = file($file);
    $myRating = "--";
    foreach ($lines as $line)
      {
        if ($line != "********\n")
        {
        $checkUser  = explode(" ", $line);
        if ($checkUser[0] == $_SESSION['u_uid'])
        {
          $myRating = (int)$checkUser[1];
          $myRating = $myRating + 1;
        }
        }
      }
  
    $id = mysqli_real_escape_string($conn, $_GET['id']);
  $sql = "SELECT * FROM notes WHERE a_id = '$id'";
  $result = mysqli_query($conn, $sql);
  $queryResults = mysqli_num_rows($result);
  $price = 0.0;
  if ($queryResults > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $title = $row['a_title'];
        $subject = $row['a_subject'];
        $user = $row['a_author'];
        $date = $row['a_date'];
        $note_id = $row['a_id'];
        $extension = 'pdf';
        $price = 0.00;//$row['a_price'];
        $rating = $row['a_rating'];
    }
  }

  }

  if (isset($_POST['four']))
  {
    $searchFor = $_SESSION['u_uid'];

    $str = file_get_contents($file);
    $str = preg_replace("/.*\b".$searchFor."\b.*\n/ui", "********\n", $str);
    $fp = fopen($file,'w');
    fwrite($fp,$str);
    fclose($fp);
    $writeFile = fopen($file, 'a');
    fwrite($writeFile, $_SESSION['u_uid']." 3"."\n");

    $lines = file($file);
    $sum = 0;
    $num_lines = 0;
    foreach ($lines as $line)
    {

      if ($line != "********\n")
      {
      $num_lines ++;
      $var = explode(" ", $line);
      $sum = $sum + (int)$var[1];
      }
    }

    $avg_rating = $sum/$num_lines;

    $sql = "UPDATE notes SET a_rating = '$avg_rating' WHERE a_id = $note_id";
    if (mysqli_query($conn, $sql)) {
      echo "Thank you for your rating!";
    }
    fclose($writeFile);

    $lines = file($file);
    $myRating = "--";
    foreach ($lines as $line)
      {
        if ($line != "********\n")
        {
        $checkUser  = explode(" ", $line);
        if ($checkUser[0] == $_SESSION['u_uid'])
        {
          $myRating = (int)$checkUser[1];
          $myRating = $myRating + 1;

        }
        }
      }
  
      $id = mysqli_real_escape_string($conn, $_GET['id']);
  $sql = "SELECT * FROM notes WHERE a_id = '$id'";
  $result = mysqli_query($conn, $sql);
  $queryResults = mysqli_num_rows($result);
  $price = 0.0;
  if ($queryResults > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $title = $row['a_title'];
        $subject = $row['a_subject'];
        $user = $row['a_author'];
        $date = $row['a_date'];
        $note_id = $row['a_id'];
        $extension = 'pdf';
        $price = 0.00;//$row['a_price'];
        $rating = $row['a_rating'];
    }
  }

  }

  if (isset($_POST['five']))
  {
    $searchFor = $_SESSION['u_uid'];

    $str = file_get_contents($file);
    $str = preg_replace("/.*\b".$searchFor."\b.*\n/ui", "********\n", $str);
    $fp = fopen($file,'w');
    fwrite($fp,$str);
    fclose($fp);
    $writeFile = fopen($file, 'a');
    fwrite($writeFile, $_SESSION['u_uid']." 4"."\n");

    $lines = file($file);
    $sum = 0;
    $num_lines = 0;
    foreach ($lines as $line)
    {

      if ($line != "********\n")
      {
      $num_lines ++;
      $var = explode(" ", $line);
      $sum = $sum + (int)$var[1];
      }
    }

    $avg_rating = $sum/$num_lines;

    $sql = "UPDATE notes SET a_rating = '$avg_rating' WHERE a_id = $note_id";
    if (mysqli_query($conn, $sql)) {
      echo "Thank you for your rating!";
    }
    fclose($writeFile);

    $lines = file($file);
    $myRating = "--";
    foreach ($lines as $line)
      {
        if ($line != "********\n")
        {
        $checkUser  = explode(" ", $line);
        if ($checkUser[0] == $_SESSION['u_uid'])
        {
          $myRating = (int)$checkUser[1];
          $myRating = $myRating + 1;

        }
        }
      }
  
      $id = mysqli_real_escape_string($conn, $_GET['id']);
  $sql = "SELECT * FROM notes WHERE a_id = '$id'";
  $result = mysqli_query($conn, $sql);
  $queryResults = mysqli_num_rows($result);
  $price = 0.0;
  if ($queryResults > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $title = $row['a_title'];
        $subject = $row['a_subject'];
        $user = $row['a_author'];
        $date = $row['a_date'];
        $note_id = $row['a_id'];
        $extension = 'pdf';
        $price = 0.00;//$row['a_price'];
        $rating = $row['a_rating'];
    }
  }
    }
?>

<link rel='stylesheet' href='notes-wiki-styles.css'>
<script src="https://cdn.jsdelivr.net/npm/pdfjs-dist@2.2.228/build/pdf.min.js"></script>


<script>

var starWidth = 40;

$.fn.stars = function() {
  return $(this).each(function() {
    $(this).html($('<span />').width(Math.max(0, (Math.min(5, parseFloat($(this).html())))) * starWidth));
  });
}
$(document).ready(function() {
  $('span.stars').stars();
});


</script>
<script src="/scripts/notes-wiki/index.js"></script>
<body>
<?php
include $_SERVER['DOCUMENT_ROOT'].'/header.php';
$path_to_file = 'notes/'.$note_id.'_'.$user.'_'.$subject.'_'.$title.'.'.$extension;

?>
  <br><br>

  <div class='container'>
    <main class='content-wrapper'>
      <!--<h1>Sample note page, will be updated with the good stuff later</h1>-->
      <div class="article-container">
        <?php  
        echo "<div class='article-box'>
          <h1>".$title."</h1>
          <p>Subject: ".$subject."</p>
          <p>Submission Date: ".$date."</p>
          <p>Submitter: <a href = 'http://".$_SERVER['HTTP_HOST'] ."/user.php?user=$user'>".$user."</a></p>
          <p>Description: ".$description."</p>
          <p>Downloads: ".$downloads."</p>
        
         <!--<p>" . $price . " ¥</p>-->"; 
        ?>
        <p>Average Rating: <?php if($rating != NULL){echo round($rating+1, 2);}else{echo "--";} ?>/5</p>
        <p><span class="stars"><?php if($rating != NULL){echo $rating+1;}else{echo "0";} ?></span></p>
        
        <br/>


        <?php 
        
        if (isset($_SESSION['u_id']))
        {
          if($user != $_SESSION['u_uid']){

            echo"
            
            <form method = 'POST'><button name = 'download'>Download</button></form>
            
            ";
            
            echo "
            
            <br/>
            <br/>
          <p>I rated this a $myRating/5:
            <form method = 'POST'>
                <button name = 'one'>1</button>
                <button name = 'two'>2</button>
                <button name = 'three'>3</button>
                <button name = 'four'>4</button>
                <button name = 'five'>5</button>
            </form>
          </p>";
          }
          else //if the user uploaded this note
          {
            echo "<p>As the creator of this note, you cannot give ratings to yourself or download your own note.</p>
            <br/>
            <p>Delete note?</p>
            <form method = 'POST' ";
            
            echo "onclick='return confirm(\"Are you sure you want to delete this note?\");'";


            echo "><button name = 'delete-note' style = 'color:red;'>Delete note</button></form>";
          }
        }
        else
        {
          echo "<p>Sorry, you must log in to download and rate files.</p>";
        }
        ?>

        <?php
          if(isset($_POST['delete-note']))
          {
            //Deletes pdf file of note and associated txt rating file

            $findNotes = "SELECT * FROM notes WHERE a_id = '$id'";
            
            $findResults = mysqli_query($conn,$findNotes);
            if($row = mysqli_fetch_assoc($findResults))
            {
                $directoryToDelete = $row['a_directory'];
                $unlinkNote = $_SERVER['DOCUMENT_ROOT'].'/notes/'.$directoryToDelete.'.pdf';
                $unlinkRating = $_SERVER['DOCUMENT_ROOT'].'/notes/ratings/'.$directoryToDelete.'.txt';
               
                if(unlink($unlinkNote) && unlink($unlinkRating)){
                      $deleteNote = "DELETE FROM notes WHERE a_id = '$id'";
                      if(mysqli_query($conn, $deleteNote)){
                          header('Location: index.php');
                      }
                      else
                      {
                        echo "Failed to delete from database.";
                      }
                    }
            }
          }


          if(isset($_POST['download']))
          {
            $new_downloads = $downloads + 1;
            $sql = "UPDATE notes SET a_downloads = '$new_downloads' WHERE a_id = $note_id; UPDATE users SET user_downloads = '$new_downloads' WHERE user_uid = '$user';";

            if(mysqli_multi_query($conn, $sql))
            {
              $download_url = 'http://'.$_SERVER['HTTP_HOST'] .'/'. $path_to_file;
              header("Location: $download_url");
            }
            else
            {
              echo"Download failed";
            }
          }
        ?>


        <br/>
        <br/>
        <center>
        <h3>Preview</h3>
        <canvas id="pdf-view"></canvas>
        </center>

        <script>
          pdfjsLib.getDocument("<?php echo '//'.$_SERVER['HTTP_HOST'] .'/'. $path_to_file ?>").then(doc => {
            doc.getPage(1).then(page => {
              var pdfView = document.getElementById("pdf-view");
              var context = pdfView.getContext("2d");

              var viewport = page.getViewport(1.5); //size of canvas
              pdfView.width = viewport.width;
              pdfView.height = viewport.height;

              page.render({
                canvasContext: context,
                viewport: viewport
              })
 
            });
          });
        </script>

        
      </div>
    </main>
  </div>

</body>
<?php
    include $_SERVER['DOCUMENT_ROOT'].'/footer.php';
?>
<script>
  loadScript("/build/scripts/header-react.min.js", function() {});
</script>

</html>