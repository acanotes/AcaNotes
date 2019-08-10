<?php
    include $_SERVER['DOCUMENT_ROOT'].'/header.php';
?>

<style type="text/css">
    /*Change nav button to selected mode*/
    #nav-today
    {
        filter: brightness(0.3);
    }
</style>

<?php
    if(isset($_SESSION['u_id']))
    {
        include $_SERVER['DOCUMENT_ROOT'].'/today/today.php';
    } else {
        include $_SERVER['DOCUMENT_ROOT'].'/restricted.php';
    }
?>

<?php
    include $_SERVER['DOCUMENT_ROOT'].'/footer.php';
?>