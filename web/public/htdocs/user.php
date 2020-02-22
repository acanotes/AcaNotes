<?php
include 'head.php';
?>

<?php 
include 'includes/dbh.inc.php';

//How to figure out which user?

$uid = mysqli_real_escape_string($conn, $_GET['user']);
$sql = "SELECT * FROM users WHERE user_uid = '$uid'";
$result = mysqli_query($conn, $sql);
$queryResults = mysqli_num_rows($result);
if ($queryResults > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
      $current_profile_uid = $row['user_uid'];
  }
}
else
{
    header("Location: index.php");
}



//Update composite user rating upon visiting the page:
$sql = "SELECT AVG(a_rating) AS average_rating FROM notes WHERE a_author = '$current_profile_uid'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result); 
$this_rating = $row['average_rating'];



$sql = "SELECT * FROM users WHERE user_uid = '$current_profile_uid';";
        $result = mysqli_query($conn, $sql);
            if($row = mysqli_fetch_assoc($result))
            {
                $first_name = $row['user_first'];
                $last_name = $row['user_last'];
                $this_description = $row['user_description'];
                $this_popularity = $row['user_downloads']; //Number of downloads is updated in notes.php (whenever someone clicks download)

                $product = $this_rating*$this_popularity;

                if($product >= 0 && $product < 100)
                {
                    $title = "Freshie";
                }
                elseif($product >= 100 && $product < 500)
                {
                    $title = "Sophomore";
                }
                elseif($product >= 500 && $product < 2500)
                {
                    $title = "Merchant";
                }
                elseif($product >= 2500 && $product < 7500)
                {
                    $title = "Intellectual";
                }
                elseif($product >= 7500 && $product < 25000)
                {
                    $title = "Scholar";
                }
                elseif($product >= 25000 && $product < 50000)
                {
                    $title = "Grand Master";
                }
                elseif($product >= 50000 && $product < 250000)
                {
                    $title = "Elite";
                }
                elseif($product >= 250000 && $product < 500000)
                {
                    $title = "Honorary Member";
                }
                elseif($product >= 500000)
                {
                    $title = "Prophet";
                }

                $sql = "UPDATE users SET user_rating = $this_rating, user_title = '$title' WHERE user_uid = '$current_profile_uid';"; //Update user rating
                $updateRating = mysqli_query($conn, $sql);

            }


?>

<style>
    .container {
  width: 400px;
  background: #449DF5;
  margin: 0 auto;
  padding: 40px;
  color: white;
  font-family: "Open Sans";
}

.top-star {
  width: 100px;
  height: 100px;
  margin: 0 auto;
  display: block;
}

span.stars, span.stars span {
  display: block;
  background: url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/747/star-o-white.svg) 0 0 repeat-x;
  width: 200px; /* width of a star multiplied by 5 */
  height: 40px; /* the height of the star */
  background-size: 40px 40px;
}

span.stars span {
  background-position: 0 0;
  background-image: url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/747/star.svg);
}

</style>
<link rel='stylesheet' href='/notes-wiki/notes-wiki-styles.css'>

<script>
    // Set this to the width of one star.
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
<body>
<?php
    include 'header.php';
?>
    <br/>
    <br/>
    <br/>
        <center>

        <?php

            $jpg = 'profilepics/'.$current_profile_uid.'.jpg';
            $png = 'profilepics/'.$current_profile_uid.'.png';
            $jpeg = 'profilepics/'.$current_profile_uid.'.jpeg';
            $gif = 'profilepics/'.$current_profile_uid.'.gif';

            $default_path = 'images/profile-default-64x64.png';

            if(file_exists($jpg))
            {
                echo "<img src = '$jpg' style = 'border-radius: 100pt; border-image-width: 5pt; height: 150pt; width: 150pt;'/>";
            }
            elseif(file_exists($png))
            {
                echo "<img src = '$png' style = 'border-radius: 100pt; border-image-width: 5pt; height: 150pt; width: 150pt;'/>";
            }
            elseif(file_exists($jpeg))
            {
                echo "<img src = '$jpeg' style = 'border-radius: 100pt; border-image-width: 5pt; height: 150pt; width: 150pt;'/>";
            }
            elseif(file_exists($gif))
            {
                echo "<img src = '$gif' style = 'border-radius: 100pt; border-image-width: 5pt; height: 150pt; width: 150pt;'/>";
            }
            else
            {
                echo "<img src = '$default_path' style = 'border-radius: 100pt;  border-image-width: 5pt; height: 150pt; width: 150pt;'/>";
            }

        ?>

            <br/>
            <b>
            <?php echo $current_profile_uid;?>
            </b>
            <br/>
            <?php echo $first_name.' '.$last_name?>
        </center>

        <br/>


        <div style = "width: 70%; margin-left: 25%;">

            <h3>Honorary title: <?php echo $title; ?></h3>
            <br/>

            <h3>Composite Rating: (<?php if($this_rating != NULL){echo round($this_rating+1, 2);}else{echo "--";}  ?>/5)</h3>
            <p><span class="stars"><?php if($this_rating != NULL){echo $this_rating+1;}else{echo "0";} ?></span></p>

            <br/>

            <h3>User downloads: <?php echo $this_popularity; ?></h3>

            <br/>
            <br/>

            <h3>Description: </h3>
            <p>
                <?php echo $this_description;?>
            </p>


            <br/>
            <br/>

            <h3>Popular uploads: </h3>
            <br>
            <?php
            $sql = "SELECT * FROM notes WHERE a_author = '$current_profile_uid' ORDER BY a_downloads*a_rating DESC";
            $result = mysqli_query($conn, $sql);
            $queryResults = mysqli_num_rows($result);
            //echo "queryResults: " . $queryResults;
            $count = 0;
            if ($queryResults > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                if ($count < 10) {
                    echo "
                    <a href='/notes-wiki/note.php?id=".$row['a_id']."' class='notes-wiki-a'>
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


        </div>
        <br/>
        <br/>
        
        <?php
        if(isset($_SESSION['u_uid'])){
                if ($_SESSION['u_uid'] == $current_profile_uid) //If the current logged-in user is the owner of the profile page, enable editting account details.
                {
                    echo "
                    <center>
                        <a href = 'edit.php?user=$current_profile_uid' clear><button>Edit account details</button></a>
                    </center>
                    ";
                }
            }
        ?>




<?php include $_SERVER['DOCUMENT_ROOT'].'/footer.php';
?>