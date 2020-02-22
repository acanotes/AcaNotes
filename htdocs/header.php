<header>
  <link rel="icon" href="favicon.ico">
  <ul class='headerLinks'>
    <a href="http://<?php echo $_SERVER['HTTP_HOST'];?>" clear>
      <li>Home</li>
    </a>
    <a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/today/" clear>
      <li>What's New</li>
    </a>
    <a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/create/" clear>
      <li>Create Note</li>
    </a>
    <a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/notes-wiki/" clear>
      <li>Notes Wiki</li>
    </a>

  </ul>
  <ul style='position:fixed;right:24px;' class='user-panels'>
    <?php 
      if(isset($_SESSION['u_id'])) {  
        //$conn = mysqli_connect('localhost', 'u707460616_aca', 'mKm7aC4A', 'u707460616_accounts');
        $sql1 = "SELECT * FROM users WHERE user_id = $_SESSION[u_id]";
        $result1 = $conn->query($sql1);

        $username = $_SESSION['u_uid'];
        $check_previous_jpg = $_SERVER['DOCUMENT_ROOT'].'/profilepics/'.$_SESSION['u_uid'].'.jpg';
        $check_previous_png = $_SERVER['DOCUMENT_ROOT'].'/profilepics/'.$_SESSION['u_uid'].'.png';
        $check_previous_jpeg = $_SERVER['DOCUMENT_ROOT'].'/profilepics/'.$_SESSION['u_uid'].'.jpeg';
        $check_previous_gif = $_SERVER['DOCUMENT_ROOT'].'/profilepics/'.$_SESSION['u_uid'].'.gif';

        $jpg = 'http://'.$_SERVER['HTTP_HOST'].'/profilepics/'.$_SESSION['u_uid'].'.jpg';
        $jpeg = 'http://'.$_SERVER['HTTP_HOST'].'/profilepics/'.$_SESSION['u_uid'].'.jpeg';
        $png = 'http://'.$_SERVER['HTTP_HOST'].'/profilepics/'.$_SESSION['u_uid'].'.png';
        $gif = 'http://'.$_SERVER['HTTP_HOST'].'/profilepics/'.$_SESSION['u_uid'].'.gif';




        while ($row = $result1->fetch_assoc()) {
          $link_to_account = 'http://'.$_SERVER['HTTP_HOST'].'/user.php?user='.$username;
          $link_to_logout = 'http://'.$_SERVER['HTTP_HOST'].'/includes/logout.inc.php';
          if(file_exists($check_previous_jpg))
            {
              #echo '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="40px" height="40px" class="header-bell"><path d="M257 120.471c7.083 0 23.911 4.479 23.911 4.479 45.589 10.447 77.678 52.439 77.678 99.85V352.412l9.321 9.364 7.788 7.823H136.302l7.788-7.823 9.321-9.364V224.8c0-47.41 32.089-89.403 77.678-99.85 0 0 18.043-4.479 23.911-4.479M256 48c-17.602 0-31.059 13.518-31.059 31.2v14.559c-59.015 13.523-103.53 67.601-103.53 131.041v114.4L80 380.8v20.8h352v-20.8l-41.411-41.6V224.8c0-63.44-44.516-117.518-103.53-131.041V79.2c0-17.682-13.457-31.2-31.059-31.2zm41.411 374.4h-82.823c0 22.881 18.633 41.6 41.412 41.6s41.411-18.719 41.411-41.6z"/></svg>';

                echo "<div class='header-profile-pic-wrapper'><img src = '$jpg' class='header-profile-pic'/></div>";
            }
          elseif(file_exists($check_previous_jpeg))
          {
            #echo '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="40px" height="40px" class="header-bell"><path d="M257 120.471c7.083 0 23.911 4.479 23.911 4.479 45.589 10.447 77.678 52.439 77.678 99.85V352.412l9.321 9.364 7.788 7.823H136.302l7.788-7.823 9.321-9.364V224.8c0-47.41 32.089-89.403 77.678-99.85 0 0 18.043-4.479 23.911-4.479M256 48c-17.602 0-31.059 13.518-31.059 31.2v14.559c-59.015 13.523-103.53 67.601-103.53 131.041v114.4L80 380.8v20.8h352v-20.8l-41.411-41.6V224.8c0-63.44-44.516-117.518-103.53-131.041V79.2c0-17.682-13.457-31.2-31.059-31.2zm41.411 374.4h-82.823c0 22.881 18.633 41.6 41.412 41.6s41.411-18.719 41.411-41.6z"/></svg>';

                echo "<div class='header-profile-pic-wrapper'><img src = '$jpeg' class='header-profile-pic'/></div>";
          }
          elseif(file_exists($check_previous_png))
          {
            #echo '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="40px" height="40px" class="header-bell"><path d="M257 120.471c7.083 0 23.911 4.479 23.911 4.479 45.589 10.447 77.678 52.439 77.678 99.85V352.412l9.321 9.364 7.788 7.823H136.302l7.788-7.823 9.321-9.364V224.8c0-47.41 32.089-89.403 77.678-99.85 0 0 18.043-4.479 23.911-4.479M256 48c-17.602 0-31.059 13.518-31.059 31.2v14.559c-59.015 13.523-103.53 67.601-103.53 131.041v114.4L80 380.8v20.8h352v-20.8l-41.411-41.6V224.8c0-63.44-44.516-117.518-103.53-131.041V79.2c0-17.682-13.457-31.2-31.059-31.2zm41.411 374.4h-82.823c0 22.881 18.633 41.6 41.412 41.6s41.411-18.719 41.411-41.6z"/></svg>';

                echo "<div class='header-profile-pic-wrapper'><img src = '$png' class='header-profile-pic'/></div>";
          }
          elseif(file_exists($check_previous_gif))
          {
                #echo '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="40px" height="40px" class="header-bell"><path d="M257 120.471c7.083 0 23.911 4.479 23.911 4.479 45.589 10.447 77.678 52.439 77.678 99.85V352.412l9.321 9.364 7.788 7.823H136.302l7.788-7.823 9.321-9.364V224.8c0-47.41 32.089-89.403 77.678-99.85 0 0 18.043-4.479 23.911-4.479M256 48c-17.602 0-31.059 13.518-31.059 31.2v14.559c-59.015 13.523-103.53 67.601-103.53 131.041v114.4L80 380.8v20.8h352v-20.8l-41.411-41.6V224.8c0-63.44-44.516-117.518-103.53-131.041V79.2c0-17.682-13.457-31.2-31.059-31.2zm41.411 374.4h-82.823c0 22.881 18.633 41.6 41.412 41.6s41.411-18.719 41.411-41.6z"/></svg>';
                echo "<div class='header-profile-pic-wrapper'><img src = '$gif' class='header-profile-pic'/></div>";
          }
          else {
            #echo '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="40px" height="40px" class="header-bell"><path d="M257 120.471c7.083 0 23.911 4.479 23.911 4.479 45.589 10.447 77.678 52.439 77.678 99.85V352.412l9.321 9.364 7.788 7.823H136.302l7.788-7.823 9.321-9.364V224.8c0-47.41 32.089-89.403 77.678-99.85 0 0 18.043-4.479 23.911-4.479M256 48c-17.602 0-31.059 13.518-31.059 31.2v14.559c-59.015 13.523-103.53 67.601-103.53 131.041v114.4L80 380.8v20.8h352v-20.8l-41.411-41.6V224.8c0-63.44-44.516-117.518-103.53-131.041V79.2c0-17.682-13.457-31.2-31.059-31.2zm41.411 374.4h-82.823c0 22.881 18.633 41.6 41.412 41.6s41.411-18.719 41.411-41.6z"/></svg>';
             echo "<div class='header-profile-pic-wrapper'><img src ='/images/profile-default-64x64.png' class='header-profile-pic'/></div>";
          }
          //echo "<a href = '$link_to_account'><h2>$row[user_uid]</h2></a>";
          //echo "<form action='$link_to_logout' method='POST' style='display:inline-block'><button type='submit' name='submit'>Logout</button></form></div>";
        }

        
      ?>
    <?php } else { ?>
    <form method="POST" action='/includes/login.inc.php' style='display:inline-block;margin-right:10px;'>
      <span><input id="username" type="text" name="uid" placeholder="Username/email" type2></span>
      <input id="password" type="password" name="pwd" placeholder="Password" type2>
      <button id="submit" type="submit" name="submit" class='login-btn mdc-button'>Login</button>
    </form>
    <a href='/registration/' clear><button class='mdc-button'>Sign up</button></a>
    <?php } ?>
    <div class='user-dropdown-wrapper'>
      <div class='user-dropdown'>
        <div class='user-top'>
          <div class='username'><?php echo $_SESSION['u_uid'];?></div>
        </div>
        <div class='user-bottom'>
        <a href = "<?php echo $link_to_account; ?>" clear><button class='mdc-button'>My Profile</button></a>
        <br>
        <form action='/includes/logout.inc.php' method='POST' style='display:inline-block'><button type='submit' name='submit' class='mdc-button'>Log Out</button></form>
        </div>
      </div>
    </div>

  </ul>
</header>