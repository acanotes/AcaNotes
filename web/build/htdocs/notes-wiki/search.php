<?php
  include $_SERVER['DOCUMENT_ROOT'] . '/head.php';
?>
<link rel='stylesheet' href='notes-wiki-styles.css'>
</head>

<body>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/header.php'; ?>
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

  <div class='container'>
    <main class='content-wrapper'>
    
    <?php
      if (isset($_POST['submit-search'])) {
        $search = mysqli_real_escape_string($conn, $_POST['search']);
        $sql = "SELECT * FROM notes WHERE a_title LIKE '%$search%' OR a_subject LIKE '%$search%' OR a_author LIKE '%$search%' OR a_date LIKE '%$search%'";
        $result = mysqli_query($conn, $sql);
        $queryResult = mysqli_num_rows($result);
        echo "<h1>Search results: </h1> <br/>";
        echo "<h2>Notes</h2>";
        if ($queryResult > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
            echo "
            <a href='note.php?id=".$row['a_id']."' class='search-result-a'>
            <div class='search-result-block'>
              
                <strong>".$row['a_title']."</strong><br>
                Subject: ".$row['a_subject']."<br>
                Date: ".$row['a_date']."<br>
                Author: ".$row['a_author']."<br>
                Description: ".$row['a_description']."<br>
                Downloads: ".$row['a_downloads']."<br>

                <span class='stars'>";
                
                if($row['a_rating'] != NULL){echo $row['a_rating']+1;}else{echo "0";}
                
                echo"</span>
              
            </div>
            </a>
            ";
          }
        } else {
          echo "<p>No notes found matching your search.</p>";
        }

        $sqlusers = "SELECT * FROM users WHERE user_uid LIKE '%$search%' OR user_first LIKE '%$search%' OR user_last LIKE '%$search%'";
        $resultusers = mysqli_query($conn, $sqlusers);
        $queryResultUsers = mysqli_num_rows($resultusers);
        echo "<br/><br/><hr><br/><br/><h2>Users</h2><br/>";
        if ($queryResultUsers > 0)
        {
          while($row = mysqli_fetch_assoc($resultusers)){
            echo "
            <a href='../user.php?user=".$row['user_uid']."' class='search-result-a'>
            <div class='search-result-block'>
              
                <strong>".$row['user_uid']."</strong><br>
                Name: ".$row['user_first'].' '.$row['user_last']."<br>
                Title: ".$row['user_title']."<br>
                Description: ".$row['user_description']."<br>
                Downloads: ".$row['user_downloads']."<br>

                <span class='stars'>";
                
                if($row['user_rating'] != NULL){echo $row['user_rating']+1;}else{echo "0";}
                
                echo"</span>
              
            </div>
            </a>
            ";
          }
        }
        else
        {
          echo "<p>No users found matching your search.</p>";
        }

      }
    ?>
    </main>
  </div>
  <?php 
    include $_SERVER['DOCUMENT_ROOT'].'/footer.php';
  ?>