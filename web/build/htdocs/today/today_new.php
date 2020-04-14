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
  <link rel="stylesheet" href = "../notes-wiki/notes-wiki-styles.css"/>
  <div class='container'>
    <main class='content-wrapper'>
    <div class='fullwidth' id='title-head-wrapper'>
        <div id='title-head'>
          <h1 style='text-align:center;'>Today</h1>
        </div>
      </div>
    
    <div class="todayViewContentRow" boxed>
      <h2 style='margin-bottom:15px;'>Welcome, <?php echo $_SESSION['u_uid']; ?>!</h2>
      <p>Welcome to your daily dashboard. Here, you can view the latest updates from the AcaNotes community! We wish you a pleasant stay.</p>
    </div>
    <div boxed style= 'width: 100%'>
    <h2 class="horizontalMargin">Official Announcements</h2>
    <p>
    <?php
      $sql = "SELECT * FROM announcements WHERE announcement_index = 1";
      $result = mysqli_query($conn, $sql);
        if($row = mysqli_fetch_assoc($result))
        {
        echo $row['announcement'];
        }
     
    ?>
    </p>
    </div>

    <div boxed style= 'width: 100%'>
        <h2 class="horizontalMargin">Prominent Users</h2>
        <br/>
        <?php
        $sql = "SELECT * FROM users ORDER BY user_rating*user_downloads DESC";
        $result = mysqli_query($conn, $sql);
        $queryResults = mysqli_num_rows($result);
        if ($queryResults > 0) {
          $count = 0;
          
            echo "<center>";
            while ($row = mysqli_fetch_assoc($result)) {
              if ($count < 8) {
                echo "
                
                <a href='../user.php?user=".$row['user_uid']."' class='notes-wiki-a'>
                <div style ='width: 250pt; height: 250pt;'>";
                $jpg = '../profilepics/'.$row['user_uid'].'.jpg';
                $png = '../profilepics/'.$row['user_uid'].'.png';
                $jpeg = '../profilepics/'.$row['user_uid'].'.jpeg';
                $gif = '../profilepics/'.$row['user_uid'].'.gif';
    
                $default_path = '../images/profile-default-64x64.png';
    
                if(file_exists($jpg))
                {
                    echo "<img src = '$jpg' style = 'margin-top: 10%; border-radius: 100pt; border-image-width: 5pt; height: 75pt; width: 75pt;'/>";
                }
                elseif(file_exists($png))
                {
                    echo "<img src = '$png' style = 'margin-top: 10%; border-radius: 100pt; border-image-width: 5pt; height: 75pt; width: 75pt;'/>";
                }
                elseif(file_exists($jpeg))
                {
                    echo "<img src = '$jpeg' style = 'margin-top: 10%; border-radius: 100pt; border-image-width: 5pt; height: 75pt; width: 75pt;'/>";
                }
                elseif(file_exists($gif))
                {
                    echo "<img src = '$gif' style = 'margin-top: 10%; border-radius: 100pt; border-image-width: 5pt; height: 75pt; width: 75pt;'/>";
                }
                else
                {
                    echo "<img src = '$default_path' style = 'margin-top: 10%; border-radius: 100pt;  border-image-width: 5pt; height: 75pt; width: 75pt;'/>";
                }

                echo "
                <br/>
                  <strong>".$row['user_uid']."</strong><br>
                  Name: ".$row['user_first'].' '.$row['user_last']."<br>
                  Title: ".$row['user_title']."<br>
                  Downloads: ".$row['user_downloads']."<br>
                  Rating: <p><span class='stars'>";
                  
                  if($row['user_rating'] != NULL){echo $row['user_rating']+1;}else{echo "0";}
                
                  echo"</span></p>
                  </div>
                </a>";
              } else break;
              $count++;
            }
            echo "</center>";
            $count = 0;
          
        }
        ?>


    </div>

    <div boxed style='width:100%;'>
    <h2 class="horizontalMargin">Popular Notes</h2>
    <br/>
    <?php
      /*
        this is just a janky php thingy for example purposes
        actual data-based displaying should be implemented lol
      */
      $sql = "SELECT * FROM notes ORDER BY a_downloads*a_rating DESC";
      $result = mysqli_query($conn, $sql);
      $queryResults = mysqli_num_rows($result);
      //echo "queryResults: " . $queryResults;
      
      if ($queryResults > 0) {
        $count = 0;
        
          echo "<center>";
          while ($row = mysqli_fetch_assoc($result)) {
            if ($count < 8) {
              echo "
              <a href='../notes-wiki/note.php?id=".$row['a_id']."' class='notes-wiki-a'>
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
            } else break;
            $count++;
          }
          echo "</center>";
          $count = 0;
        
      }
      ?>
      <br/>
      <h2 class="horizontalMargin">New notes</h2>
      <br/>
      <?php
      /*
        this is just a janky php thingy for example purposes
        actual data-based displaying should be implemented lol
      */
      $sql = "SELECT * FROM notes ORDER BY a_date DESC";
      $result = mysqli_query($conn, $sql);
      $queryResults = mysqli_num_rows($result);
      //echo "queryResults: " . $queryResults;
      
      if ($queryResults > 0) {
        $count = 0;
        
          echo "<center>";
          while ($row = mysqli_fetch_assoc($result)) {
            if ($count < 8) {
              echo "
              <a href='../notes-wiki/note.php?id=".$row['a_id']."' class='notes-wiki-a'>
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
            } else break;
            $count++;
          }
          echo "</center>";
          $count = 0;
        
      }
      ?>
        </div>
    </main>
  </div>
