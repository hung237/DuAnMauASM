<?php
    session_start();
    $_SESSION['stateUser'] = false;
    header('location: ../index.php');
?>