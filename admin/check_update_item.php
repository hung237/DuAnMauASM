<?php
    session_start();
    include '../database/database.php';
    if(isset($_POST['updateItem'])){
        $id =  $_SESSION['this_id'];
        $kind = $_POST['kind'];
        $name = $_POST['name'];
        $describtion = $_POST['describtion'];
        $price = $_POST['price'];
        updateItem($kind,$name,$describtion,$price,$id);
        header('location: admin.php?act=items');
    }
?>