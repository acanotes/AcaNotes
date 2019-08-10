<?php
session_start();
?>

<!--DOCTYPE HTML-->
<html>
<head>
    <title>AcaNotes</title>
    <meta charset="UTF-8">
    <link rel='stylesheet' type='text/css' href='../main.css'/>
    <style type="text/css">
    
        #menubar
        {
            width:100%;
            height: 48px;
            background-color: #0597FF;
            
            position: fixed;
            z-index: 8;
            filter: drop-shadow(0 0 4px rgba(0,0,0,0.5));
            
            top: 0px;
            left: 0px;
            
            /*
            opacity: 0.8;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            */
        }
        
        #navbar-left
        {
            position: absolute;
            display: inline-block;
            left: 12px;
            
            -webkit-touch-callout: none;
            -webkit-user-select: none;
            -khtml-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            -o-user-select: none;
        }
        
        #navbar-right
        {
            position: absolute;
            display: inline-block;
            margin-top: -6px;
            right: 22px;
        }
        
        .MenuItem
        {
            list-style: none;
            display: inline-block;
            
            margin-top: 12px;
        }
        
        .MenuItem a
        {
            text-decoration: none;
            color: white;
        }

        .nav-login form, input
        {
            -webkit-touch-callout: text;
            -webkit-user-select: text;
            -khtml-user-select: text;
            -moz-user-select: text;
            -ms-user-select: text;
            user-select: text;
            -o-user-select: text;
            
            color: white;
        }
    
        .navbutton 
        {
            height: 24px;
        }
        
        /*
        body
        {
            background-color: #0597FF;
        }
        */
        
        #container 
        {
            margin-top: 48px;
            background-color: white;
        }
        
        #nav-logo
        {
            margin-left: 0px;
            margin-right: 32px;
        }
        
        #nav-logo img
        {
            width: 24px;
            height: 24px;
        }
        
        .MenuButton
        {
            opacity: 0.9;
            margin-right: 24px;
            
            -webkit-transition: all 0.35s ease-out;
            -khtml-transition: all 0.35s ease-out; 
            -moz-transition: all 0.35s ease-out;
            -ms-transition: all 0.35s ease-out;
            transition: all 0.35s ease-out;
            -o-transition: all 0.35s ease-out;
        }
        
        .MenuButton:hover
        {
            opacity: 0.5;
        }
        
        .MenuButton img
        {
            height: 24px;
        }
        
        .nav-login
        {
            right: 12px;
        }
        
        #debug-signup
        {
            right: 12px;
        }
        
        #nav-today
        {
            width: 67px;
        }
        
        #nav-wiki
        {
            width: 103px;
        }
        
        #nav-discuss
        {
            width: 101px;
        }
    </style>
</head>

<body>
    <nav id='menubar'>
        
            <ul id="navbar-left">
                <li class="MenuItem"><a id="nav-logo" href="/"><img class="navbutton" src="../images/navbutton-logo.png"></a></li>
                <li class="MenuItem"><a class="MenuButton" id="nav-today" href="../today/"><img class="navbutton" src="../images/navbutton-today.png"></a></li>
                <li class="MenuItem"><a class="MenuButton" id="nav-wiki" href="../notes-wiki/"><img class="navbutton" src="../images/navbutton-notes-wiki.png"></a></li>
                <li class="MenuItem"><a class="MenuButton" id="nav-discuss" href="../discussion/"><img class="navbutton" src="../images/navbutton-discussion.png"></a></li>
                <li class="MenuItem">
            </ul>
            <div id="navbar-right">
                <div class='MenuItem nav-login'>
                    <?php
                    if(isset($_SESSION['u_id']))
                    {
                        include $_SERVER['DOCUMENT_ROOT'].'/userbutton.php';
                        
                        /*
                        $conn = mysqli_connect(localhost, admin, 'mKm7aC4A', 'accounts');
                        
                        $sql1 = "SELECT * FROM users WHERE user_id = $_SESSION[u_id]";
                        $result1 = $conn->query($sql1);
            
                        
                        while ($row = $result1->fetch_assoc()) #loop through results until there is no more left
                        {
                            echo '<form action="../includes/logout.inc.php" method="POST">';
                            echo "$row[user_uid]   ";
                            echo '<button type="submit" name="submit">Logout</button></form></div>';
                        } 
                        
                        */
                        
                        
                    }
                    else
                    {
                        echo('
                        <form method="POST" action="../includes/login.inc.php">
                        <input id="username" type="text" name="uid" placeholder="Username/email">
                        <input id="password" type="password" name="pwd" placeholder="Password">
                        <button id="submit" type="submit" name="submit">Login</button>
                        </form>
                        </div>
                        <div class="MenuItem" id="debug-signup">
                        <a href="../registration"><img class="navbutton" src="../images/button-signup.png"></a> 
                        </div>');
                        //Signup graphic looks kind of awkward on header
                        
                    }
                    ?>
            </div>
    </nav>
    
    <?php
    include $_SERVER['DOCUMENT_ROOT'].'/userpanel.php';
    ?>
    
    <div id="container">