<?php
    include $_SERVER['DOCUMENT_ROOT'].'/discussion/header-discussion.php';
    $conn = mysqli_connect('localhost', 'elo_tom', '', 'search_bar');
    
    //include 'header.php';
    //echo $_SERVER['DOCUMENT_ROOT'];
    
    if ($_GET['q'] == 'Search...')
    {
        header('Location: discussion.php');
    }
    
    if ($_GET['q'] !== '') //only connect to the database if there is a search
    {
        $con = mysql_connect('localhost', 'elo_tom', '');
        $db = mysql_select_db('search_bar');
        //$db_user = mysql_select_db('user'); --> For Andrew's Dank Memes; This page will be dealt with later. ***
?>

<head><title>AcaNotes Discussion</title></head>
<link rel="stylesheet"type='text/css' href="discussionStyle.css"/>

<script type="text/javascript">
//Functions currently disabled as real text <-> placeholder changing effect isn't really needed. May be implemented in the future
    function active() 
    {
        //var searchBar = document.getElementById('searchBar');
        
        // if (searchBar.value == 'Search...')
        // {
        //     Dank Memes
        //     searchBar.value = '';
        //     searchBar.placeholder = 'Search...';
        // }
    }
    
    function inactive()
    {
        //var searchBar = document.getElementById('searchBar');
        
        // if (searchBar.value == '')
        // {
        //     searchBar.value = 'Search...';
        //     searchBar.placeholder = '';
        // }
    }
</script>


<body>
    <div id="discussionBar"><!-- style="position: fixed"-->
        <form action="index.php" method="GET">
            <input type="text" name="q" id="searchBar" placeholder="Search..." value="" maxlength="25" autocomplete="off" onMouseDown="active();" onBlur="inactive();"/><input type="submit" id="searchButton" value=" " style="background-image: url(../images/navbutton-search.png)"/>
        </form>
    </div>
    
    <?php
        //$q = getElementById('searchBar')->name;
        $q = $_GET['q'];
        
        /*
        if (!isset($q))
        {
            echo '';
        }
        else
        // ^ Redundant code? --Vince14Genius
        */
        
        if (isset($q))
        {
            $query = mysql_query("SELECT * FROM products WHERE title LIKE '%$q%' OR description LIKE '%$q%'"); 
            //create a new variable that selects values from the "products" table (created in database)
            //$q is the search query -> this limits our results to the stuff that we search for
            $num_rows = mysql_num_rows($query); //create a new variable that returns the records in the "products" table database
        ?>
        
            <strong>
                <?php
                    echo $num_rows; 
                ?>
            </strong>
                results for "<?php echo $q; ?>"
            <br />
        <?php
            //echo $num_rows;
            //echo 'Here I will list down some values in the database:' . '<br />';
        
        while ($row = mysql_fetch_array($query)) //testing data fetching
        {
               //These are example values that would be added to the database
                //We will add discussion search results to here and redirect to webpages
                $id = $row['id'];
                $title = $row['title'];
                $description = $row['description'];
                
                //echo '<a href="../topic/'.$id.'.php">'. $id . '. ' . $title . '</a><br />' . $description . '<br /><br />';
                echo '<a href="../topic/'.$id.'.php">'. $title . '</a><br />' . $description . '<br /><br />';
                //A link is created for every value added to the database. It is our job to create PHP files for each id. Haha now we don't have to anymore! Refer to newTopic.php!
                
        }
    }
    ?>
    
    <div style='margin-left: 50px;'>
    Recent topics:
    <br>
    <?php
        $sql = 'SELECT * FROM products';
        $result = $conn->query($sql);
        $storageTitle = array();
        $storageDescription = array();
        
            while ($row = $result->fetch_assoc())
            {
                    $topicMax = $row['id'];
                    $name = $row['title'];
                    $about = $row['description'];
                    array_push($storageTitle, $name);
                    array_push($storageDescription, $about);
            }
            
        //echo 'Topics in database (testing purposes only; will be removed later): '.$topicMax.'<br>';
        //echo $storage[1];

        for ($i = 1; $i < 6; $i++)
        {
            $url = $topicMax - $i + 1;
            echo "<div id = 'dbutton'>
            <a href = ../topic/$url.php><li>".$storageTitle[$topicMax-$i].'<br>'
            .$storageDescription[$topicMax - $i]
            .'</li></a></div>      ';
        }
    ?>
    <br>
    
    <!-- <div id="dbutton"><a href="../topic/1.php"><li> Topic 1<br>What are position vectors?</li></a></div> -->
    <!-- <div id="dbutton"><a href="../topic/2.php"><li> Topic 2<br> What are position vectors?</li></a></div> -->
    <a href="newTopic.php">Create a new topic</a>
    
    </div>
</body>

<?php
    } //close the bracket from the if statement at the top
    
    else
    {
        /*
        header('Location: index.php'); //prevent spamming and stuff
        // ^ triggers header error, use JS redirect instead. Also, try clarifying the term "prevent spamming". --Vince14Genius
        */
        echo "<script>location.href='../discussion/';</script>"; #got it -Tom21487
    }
    //include $_SERVER['DOCUMENT_ROOT'].'/footer.php';
    #footer is disabled for now; problems will be fixed in the future
?>