<?php
  include $_SERVER['DOCUMENT_ROOT'].'/head.php';
?>
</head>
<body>
<?php
  include $_SERVER['DOCUMENT_ROOT'].'/header.php';
?>
<div class='container'>
  <main class='content-wrapper'>
    <h1>Upload confirmation</h1>
    <?php
    if (isset($_SESSION['u_id'])) {

      if (isset($_POST['submit-add'])) {
              $title = mysqli_real_escape_string($conn, $_POST['title']);
              $subject = mysqli_real_escape_string($conn, $_POST['subject']);
              $description = mysqli_real_escape_string($conn, $_POST['description']);

              if(!empty($title) && $subject != "select" && !empty($description))
              {
                      $downloads = 0;
                      $date = date("Y-m-d");
                      $sql1 = "SELECT * FROM users WHERE user_id = $_SESSION[u_id]";
                      $result1 = $conn->query($sql1);
                  
                      while ($row = $result1->fetch_assoc()) {
                        $user = $row['user_uid'];
                        $name = $row['user_first'] . " " . $row['user_last'];
                    
                      }


                      echo "Title: " . $title . "<br>";
                      echo "Subject: " . $subject . "<br>";
                      echo "Username: " . $user . "<br>";
                      echo "Name: ". $name . "<br>";
                      echo "Description: " . $description . "<br>";
                      echo "Date: " . $date . "<br>";

                      $DBset = False;


                      $sql2 = "INSERT INTO notes (a_title, a_subject, a_author, a_date, a_description, a_downloads) VALUES ('$title', '$subject', '$user', '$date', '$description', $downloads)";
                      if (mysqli_query($conn, $sql2)) {
                        $DBset = True;
                      } else {
                        echo "ERROR: Could not able to execute $sql2. " . mysqli_error($conn);
                      }

                      $sql3 = "SELECT * FROM notes WHERE a_title = '$title' AND a_subject = '$subject' AND a_author = '$user' AND a_description = '$description'";
                      $result3 = mysqli_query($conn, $sql3);
                
                      if($row = mysqli_fetch_assoc($result3))
                      {
                        $note_id = $row['a_id'];
                      }
                      
                      //fileUpload

                      $fileset = False;

                      if($_FILES["noteUpload"]["error"] !== 4) { //if a file is uploaded
                
                        $target_dir = '../notes/';
                        $target_file = $target_dir . basename($_FILES["noteUpload"]["name"]);
                        $uploadOk = 1;
                        $FileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

                        // Check file size
                        if ($_FILES["noteUpload"]["size"] > 8000000) { //File size capped at 8 MB
                            echo "<br/><br/><br/><p>Sorry, your file is too large. </p>";
                            $uploadOk = 0;
                        }
                        // Allow certain file formats
                        if($FileType != "pdf") {
                            echo "<br/><br/><br/><p>Sorry, only PDF files are allowed. </p>";
                            $uploadOk = 0;
                        }
                        // Check if $uploadOk is set to 0 by an error
                        if ($uploadOk == 0) {
                            echo "<p>Your file was not uploaded. </p>";
                        // if everything is ok, try to upload file
                        } else {
                            if (move_uploaded_file($_FILES["noteUpload"]["tmp_name"], $target_file)) { //if successfully uploaded file

                                $pathparts = pathinfo($target_file);
                                $extension = $pathparts['extension'];
                                rename($target_file, $_SERVER['DOCUMENT_ROOT'].'/notes/'.$note_id.'_'.$user.'_'.$subject.'_'.$title.'.'.$extension); //Rename file to <noteID>_<usrname>_<subject>_<topic>.pdf
                                $fileset = True;
                            } else {
                                echo "<br/><br/><br/><p>Sorry, there was an error uploading your file. Please try again.</p>";
                            }
                        }
                    }
                    else
                    {
                        $fileset = False;
                    }

                    if ($fileset)
                    {
                      echo "<br/><br/><br/><p>File uploaded into directory. </p>";
                    }
                    else{
                      $sql_delete = "DELETE FROM notes WHERE a_id = '$note_id';";
                      mysqli_query($conn, $sql_delete); //Remove from DB notes
                    }

                    if ($fileset && $DBset)
                    {
                      $noteName = $note_id.'_'.$user.'_'.$subject.'_'.$title;
                      $sql4 = "UPDATE notes SET a_directory = '$noteName' WHERE a_id = $note_id";
                      if(mysqli_query($conn, $sql4)){
                        $link_to_note = '../notes-wiki/note.php?id='.$note_id;
                        echo " Link to your note: <a href = '$link_to_note'>click here</a>";
                        $createTxt = fopen($_SERVER['DOCUMENT_ROOT']."/notes/ratings/".$note_id.'_'.$user.'_'.$subject.'_'.$title.'.txt',"wb");
                      }
                      else
                      {
                        echo "<p>Something went wrong. Please try again or contact our tech team.</p>";
                      }
                    }
                    else
                    {
                      echo "<br/><p>File was not uploaded. Please try again. </p>";
                    }
          }
          else
          {
            echo "<br/><br/><p>You left a field empty. Upload failed.</p>";
          }
      }
    }
  ?>
  </main>
</div>
<?php 
  include $_SERVER['DOCUMENT_ROOT'].'/footer.php';
?>