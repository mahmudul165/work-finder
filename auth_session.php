<?php
    session_start();
    if(!isset($_SESSION["username"])) {
        header("Location: login-candidate.php");
        exit();
    }
?>