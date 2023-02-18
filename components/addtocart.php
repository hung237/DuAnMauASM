<?php
    ob_start();
    session_start();
    $qty = 0;
    include_once("../database/database.php");
    if(!isset($_SESSION["cart"])){
        $_SESSION['cart'] =  array();
    }
    if(isset($_POST["id"]) && isset($_POST["id"])){
        $id = $_POST["id"];
        if(array_key_exists($id, $_SESSION['cart'])){
            $_SESSION['cart'][$id]["quantity"]++;
        }
        else{
            $_SESSION['cart'][$id] = array(
                'product_id' => $id,
                'quantity' => 1
            );
        }
        
        $qty = count($_SESSION['cart']);
    }
    echo $qty;
?>