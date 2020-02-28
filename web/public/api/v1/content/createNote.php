<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");

$data = json_decode(file_get_contents('php://input'), true);
require($_SERVER["DOCUMENT_ROOT"] . '/../vendor/autoload.php');
include '../../inc/connect.php';
include '../auth/auth.php';

$token_data = Auth::authenticateRoute();

if (isset($data['title'])) {
  $res = array('error' => '');
  if (empty($data['title']) || empty($data['class']) || empty($data['description'])) {
    http_response_code(400);
    $res['error'] = "Missing data";
    echo json_encode($res);
    exit();
  }
  $date = date("Y-m-d");
  $downloads = 0;
  $title = mysqli_real_escape_string($conn, $data['title']);
  $subject = mysqli_real_escape_string($conn, $data['class']);
  $description = mysqli_real_escape_string($conn, $data['description']);
  $user = $token_data['username'];
  $sql = "INSERT INTO notes (a_title, a_subject, a_author, a_date, a_description, a_downloads, a_directory) VALUES ('$title', '$subject', '$user', '$date', '$description', $downloads, '')";

  if (mysqli_query($conn, $sql)) {
    $res['res'] = "Success!";
    echo json_encode($res);
  } else {
    http_response_code(400);
    $res['error'] = "Couldn't update database";
    $res['sql_error'] = "ERROR: Could not able to execute $sql2. " . mysqli_error($conn);
    echo json_encode($res);
    exit();
  }

  // if($_FILES["noteUpload"]["error"] !== 4) { //if a file is uploaded
  //
  //   $target_dir = '../notes/';
  //   $target_file = $target_dir . basename($_FILES["noteUpload"]["name"]);
  //   $uploadOk = 1;
  //   $FileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  //
  //   // Check file size
  //   if ($_FILES["noteUpload"]["size"] > 8000000) { //File size capped at 8 MB
  //       echo "<br/><br/><br/><p>Sorry, your file is too large. </p>";
  //       $uploadOk = 0;
  //   }
  //   // Allow certain file formats
  //   if($FileType != "pdf") {
  //       echo "<br/><br/><br/><p>Sorry, only PDF files are allowed. </p>";
  //       $uploadOk = 0;
  //   }
  //   // Check if $uploadOk is set to 0 by an error
  //   if ($uploadOk == 0) {
  //       echo "<p>Your file was not uploaded. </p>";
  //   // if everything is ok, try to upload file
  //   } else {
  //       if (move_uploaded_file($_FILES["noteUpload"]["tmp_name"], $target_file)) { //if successfully uploaded file
  //
  //           $pathparts = pathinfo($target_file);
  //           $extension = $pathparts['extension'];
  //           rename($target_file, $_SERVER['DOCUMENT_ROOT'].'/notes/'.$note_id.'_'.$user.'_'.$subject.'_'.$title.'.'.$extension); //Rename file to <noteID>_<usrname>_<subject>_<topic>.pdf
  //           $fileset = True;
  //       } else {
  //           echo "<br/><br/><br/><p>Sorry, there was an error uploading your file. Please try again.</p>";
  //       }
  //   }
  // }
  // else
  // {
  //     $fileset = False;
  // }
  //
  // if ($fileset)
  // {
  //   echo "<br/><br/><br/><p>File uploaded into directory. </p>";
  // }
  // else{
  //   $sql_delete = "DELETE FROM notes WHERE a_id = '$note_id';";
  //   mysqli_query($conn, $sql_delete); //Remove from DB notes
  // }
  //
  // if ($fileset && $DBset)
  // {
  //   $noteName = $note_id.'_'.$user.'_'.$subject.'_'.$title;
  //   $sql4 = "UPDATE notes SET a_directory = '$noteName' WHERE a_id = $note_id";
  //   if(mysqli_query($conn, $sql4)){
  //     $link_to_note = '../notes-wiki/note.php?id='.$note_id;
  //     echo " Link to your note: <a href = '$link_to_note'>click here</a>";
  //     $createTxt = fopen($_SERVER['DOCUMENT_ROOT']."/notes/ratings/".$note_id.'_'.$user.'_'.$subject.'_'.$title.'.txt',"wb");
  //   }
  //   else
  //   {
  //     echo "<p>Something went wrong. Please try again or contact our tech team.</p>";
  //   }
  // }
  // else
  // {
  //   echo "<br/><p>File was not uploaded. Please try again. </p>";
  // }
  // }
}
