<?php
        session_start();
        session_unset();
        session_destroy();
        $homepath = $_SERVER['HTTP_HOST'];
        header("Location: http://$homepath");
        exit();
?>