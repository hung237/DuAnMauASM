<?php
    ob_start();
    session_start();
    include_once("../database/database.php");
    if(isset($_POST["id"]) && isset($_POST["id"])){
        $id = $_POST["id"];
        $_SESSION['cart'][$id]["quantity"]++;
    }
?>