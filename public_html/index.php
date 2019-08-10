<?php
    include 'header.php'; //Includes universal header.
?>

    <center>
        <?php
        if(isset($_SESSION['u_id']))
        {
            echo "<script>location.href='../today/';</script>";
        }else{
            echo "
            
            <div style='width: 800px; height: 150px; background-color: #E0E0E0; margin-top: 80px; border-radius: 6px;'>
            <br/>
            <p class='margin-paragraph' style='font-size: 30pt;'>
            AcaNotes
            </p>
            <p class='margin-paragraph'>
            The ultimate online database designed specifically for IB students.
            </p>
            </div>
            
            <div style='width: 800px; height: 200px; background-color: #E0E0E0; margin-top: 10px; border-radius: 6px;'>
            <br/>
            <p class='margin-paragraph' style='font-size: 30pt;'>
                Students for students.
            </p>
            <p class='margin-paragraph'>
                AcaNotes is a resource that provides IB students with course notes from credible sources and a platform that allows students to hold discussions regarding to their subjects. Dedicated to help you achieve optimal results, we value your success over anything else. Here at AcaNotes, every student is a priority.
            </p>
            </div>
            
            <div style='width: 800px; height: 200px; background-color: #0597FF; margin-top: 10px; border-radius: 6px;' id = 'white'>
            
            <br/>
            
            <p class='margin-paragraph' style='font-size: 30pt;'>
                Limited Time Offer
            </p>
            <p class='margin-paragraph'>
                For a limited time only, AcaNotes is offering 5 RMB for newcomers and an additional 10 RMB for each referral. As a pre-alpha work in progress, AcaNotes appreciates your aid in the development of our community.
            </p>
            </div>
            
            <br>
        
            <div>
                <a href='../registration'><img width='200px' height='50px' src='../images/button-signup.png'></a>
            </div>
            
            ";
        }
        ?>
        
        
    </center>
    
    </br>
    </br>
    </br>
    </br>
    
    <?php 
    include 'footer.php'; //Includes universal footer.
?>


<!-- DB -->
<?php
    session_start();
  // $connect = mysql_connect("","","");  
?>