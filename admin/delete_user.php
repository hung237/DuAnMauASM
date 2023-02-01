<?php
    include "database.php";
    $this_user = $_GET['this_user'];
    deleteUser($this_user);
    $url = $_GET['url'];
    unlink($url);
    echo $this_user;
    echo $url;
    header('location: admin.php?act=user');
?>