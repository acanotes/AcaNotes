<br>
  <hr>
<br>

<footer><!-- id='footer' -->
  <center>
    <!--<font color="white">-->
        Copyright © 2020 AcaNotes.com | <a href = "<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/contributors/';?>">Contributors</a> | <a href = "https://www.facebook.com/acanotes/">Facebook</a> | <a href = "https://www.instagram.com/acanotes/">Instagram</a> <?php if(isset($_SESSION['u_uid'])){if($_SESSION['u_uid'] == 'admin'){echo " | <a href = '/admin.php'>Admin Panel</a>";}}?><!--</font>--> 
    <!--<div id=footer-container>
      <ul>
        <li id ="footer-button"><a href="../discussion/">Discussion</a></li>
        <li id ="footer-button"><a href="../notes-wiki/">Notes</a></li>
      </ul>
      <div id=footer-copyright></div>
    </div>-->
  </center>
</footer>

<br>
<!--
  <script src="https://unpkg.com/react@16/umd/react.production.min.js" crossorigin></script>
  <script src="https://unpkg.com/react-dom@16/umd/react-dom.production.min.js" crossorigin></script>
  -->
</html>
