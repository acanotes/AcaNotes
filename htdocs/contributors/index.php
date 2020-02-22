<?php
    include '../head.php'; //Includes universal header.
?>
<link rel="stylesheet" href = "../notes-wiki/notes-wiki-styles.css"/>

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

<link rel='stylesheet' href='styles/index.css'>
</head>
<body>
  <?php include $_SERVER['DOCUMENT_ROOT'].'/header.php'; ?>

    <br/>
    <br/>
    <br/>

    <div  style = "margin-left: 30pt;">
        <h2>Founding Members</h2>
        <p>Andrew Liu</p>
        <p>Vincent Cai</p>
        <p>Stone Tao</p>
        <p>Tom Jiao</p>
        <p>Alex Xu</p>
        <p>Emma Liu</p>
        <p>David Yei</p>
        <br/>
        <h2>Current management team</h2>
        <br/>
        <h2>Project contributors</h2>
        <br/>
        <h2>Honorary Members</h2>
        <br/>
        <?php
        $sql = "SELECT * FROM users WHERE user_title = 'Honorary Member' OR user_title = 'Prophet' ORDER BY user_rating*user_downloads DESC";
        $result = mysqli_query($conn, $sql);
        $queryResults = mysqli_num_rows($result);
        if ($queryResults > 0) {
          
            echo "<center>";
            while ($row = mysqli_fetch_assoc($result)) {
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
            }
            echo "</center>";          
        }
        ?>
    </div>


  <?php 
    include '../footer.php'; //Includes universal footer.
  ?>
