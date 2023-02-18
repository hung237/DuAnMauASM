<?php
session_start();
include '../database/database.php';
echo "<br><br<br><br><br><br><br><br><br>";
$id = $_POST['id'];
echo $id;
echo "<br><br>";
    if(isset($_POST["id"])){
        echo "<br><br<br><br><br><br><br><br><br>";
        $id = $_POST['id'];
        echo $id;
        echo "oke <br><br>";
    }
?>