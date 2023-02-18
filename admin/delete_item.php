<?php
    include "../database/database.php";
    $this_id = $_GET['this_id'];
    deleteItem($this_id);
    $url = $_GET['url'];
    unlink($url);
    echo $url;
    header('location: admin.php?act=items');
?>