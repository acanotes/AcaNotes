<?php
  include $_SERVER['DOCUMENT_ROOT'].'/head.php';
    //if(isset($_SESSION['u_id'])){} else {}
?>
<link rel='stylesheet' href='notes-wiki-styles.css'>
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
          <h1>Notes Wiki</h1>
        </div>
      </div>
      <br>

      <form action="search.php" method="POST" class="search-wrapper">
        <input type="text" name="search" placeholder="search all notes or users..." class="search-term">
        <button type="submit" name="submit-search" class="search-button mdc-button mdc-button--unelevated">Go!</button>
      </form>
      
      <br>
      <div>
        <a class="button-topic" href = "core" clear>
          <img src="/images/topics/topic-0.png">
        </a>
        <a class="button-topic" href="language-and-literature" clear>
          <img src="/images/topics/topic-1.png">
        </a>
        <a class="button-topic" href = "language-acquisition" clear>
          <img src="/images/topics/topic-2.png">
        </a>
        <a class="button-topic" href = "individuals-and-societies" clear>
          <img src="/images/topics/topic-3.png">
        </a>
      </div>
      <div>
        <a class="button-topic" href = "sciences" clear>
          <img src="/images/topics/topic-4.png">
        </a>
        <a class="button-topic" href = "mathematics" clear>
          <img src="/images/topics/topic-5.png">
        </a>
        <a class="button-topic" href = "arts" clear>
          <img src="/images/topics/topic-6.png">
        </a>
        <a class="button-topic" href = "other" clear>
          <img src="/images/topics/topic-7.png">
        </a>
      </div>
    </center>
    <br>
    
    <center>
      <h2>Trending notes </h2>
      <br>
      <?php
      $sql = "SELECT * FROM notes ORDER BY a_downloads*a_rating DESC";
      $result = mysqli_query($conn, $sql);
      $queryResults = mysqli_num_rows($result);
      //echo "queryResults: " . $queryResults;
      $count = 0;
      if ($queryResults > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          if ($count < 12) {
            echo "
            <a href='note.php?id=".$row['a_id']."' class='notes-wiki-a'>
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
    
  </main>
</div>
</body>
<?php
    include $_SERVER['DOCUMENT_ROOT'].'/footer.php';
?>