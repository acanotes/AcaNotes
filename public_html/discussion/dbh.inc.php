<?php
    
    $dbServername = 'localhost';
    $dbUsername = 'elo_tom';
    $dbPassword = '';
    
    $conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, 'search_bar');
    $conn2 = mysqli_connect($dbServername, $dbUsername, $dbPassword, 'comments_section');
    $conn3 = mysqli_connect($dbServername, $dbUsername, $dbPassword, 'accounts');
?>