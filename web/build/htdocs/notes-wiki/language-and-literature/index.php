<?php
  include $_SERVER['DOCUMENT_ROOT'].'/head.php';
?>
<link rel='stylesheet' href='../notes-wiki-styles.css'>
</head>
<body>
  <?php include $_SERVER['DOCUMENT_ROOT'].'/header.php'; ?>
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
    <center>
      <div class='fullwidth' id='title-head-wrapper'>
        <div id='title-head'>
          <h1>Group 1: Language and Literature</h1>
        </div>
      </div>
      <br>

      <form action="../search.php" method="POST" class="search-wrapper">
        <input type="text" name="search" placeholder="search all notes or users..." class="search-term">
        <button type="submit" name="submit-search" class="search-button mdc-button mdc-button--unelevated">Go!</button>
      </form>
      
      <br>
      <!--
      <div>
        <a class="button-topic" href="english" clear>
        <div class="category-block" style="background-color: var(--green)">English</div>
        </a>
        <a class="button-topic" clear>
          <div class="category-block" style="background-color: var(--red)">Chinese</div>
        </a>
        <a class="button-topic" clear>
          <div class="category-block" style="background-color: var(--blue)">French</div>
        </a>
        <a class="button-topic" clear>
          <div class="category-block" style="background-color: var(--orange)">Spanish</div>
        </a>
      </div>
-->
<br/>
<p>Listing top 12 notes for each class, as determined by rating and number of downloads.</p>
<br/>

    <h2>Chinese A Lang Lit (SL/HL)</h2>
    <br>
      <?php
      $sql = "SELECT * FROM notes WHERE a_subject = 'Chinese Lang Lit' ORDER BY a_downloads*a_rating DESC" ;
      $result = mysqli_query($conn, $sql);
      $queryResults = mysqli_num_rows($result);
      //echo "queryResults: " . $queryResults;
      $count = 0;
      if ($queryResults > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          if ($count < 12) {
            echo "
            <a href='../note.php?id=".$row['a_id']."' class='notes-wiki-a'>
            <div class='recent-notes-block'>
              <strong>".$row['a_title']."</strong><br>
              Subject: ".$row['a_subject']."<br>
              Date: ".$row['a_date']."<br>
              Author: ".$row['a_author']."<br>
              Description: ".$row['a_description']."<br>
              Downloads: ".$row['a_downloads']."<br>
              Rating: <p><span class='stars'>";
              
              if($row['a_rating'] != NULL){echo $row['a_rating']+1;}else{echo "0";}
            
              echo"</span></p>
            </div>
            </a>";
          } else {
            break;
          }
          $count++;
        }
      }
      ?>
      <br/>

    <h2>English A Lang Lit (SL/HL)</h2>
    <br/>
    <?php
      $sql = "SELECT * FROM notes WHERE a_subject = 'English Lang Lit' ORDER BY a_downloads*a_rating DESC" ;
      $result = mysqli_query($conn, $sql);
      $queryResults = mysqli_num_rows($result);
      //echo "queryResults: " . $queryResults;
      $count = 0;
      if ($queryResults > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          if ($count < 12) {
            echo "
            <a href='../note.php?id=".$row['a_id']."' class='notes-wiki-a'>
            <div class='recent-notes-block'>
              <strong>".$row['a_title']."</strong><br>
              Subject: ".$row['a_subject']."<br>
              Date: ".$row['a_date']."<br>
              Author: ".$row['a_author']."<br>
              Description: ".$row['a_description']."<br>
              Downloads: ".$row['a_downloads']."<br>
              Rating: <p><span class='stars'>";
              
              if($row['a_rating'] != NULL){echo $row['a_rating']+1;}else{echo "0";}
            
              echo"</span></p>
            </div>
            </a>";
          } else {
            break;
          }
          $count++;
        }
      }
      ?>
      <br/>

    <h2>English A Lit (SL/HL)</h2>
    <br/>
    <?php
      $sql = "SELECT * FROM notes WHERE a_subject = 'English Lit' ORDER BY a_downloads*a_rating DESC" ;
      $result = mysqli_query($conn, $sql);
      $queryResults = mysqli_num_rows($result);
      //echo "queryResults: " . $queryResults;
      $count = 0;
      if ($queryResults > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          if ($count < 12) {
            echo "
            <a href='../note.php?id=".$row['a_id']."' class='notes-wiki-a'>
            <div class='recent-notes-block'>
              <strong>".$row['a_title']."</strong><br>
              Subject: ".$row['a_subject']."<br>
              Date: ".$row['a_date']."<br>
              Author: ".$row['a_author']."<br>
              Description: ".$row['a_description']."<br>
              Downloads: ".$row['a_downloads']."<br>
              Rating: <p><span class='stars'>";
              
              if($row['a_rating'] != NULL){echo $row['a_rating']+1;}else{echo "0";}
            
              echo"</span></p>
            </div>
            </a>";
            
          } else {
            break;
          }
          $count++;
        }
      }
      ?>
    
    </center>
    <br>

  </main>
</div>
</body>
<?php
    include $_SERVER['DOCUMENT_ROOT'].'/footer.php';
?>