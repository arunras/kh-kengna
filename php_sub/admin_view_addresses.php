<?php
    include("../connection/connection.php");
    include("../module/module.php");
    $type = $_GET['type'];
    $up_id = 1;
    if(isset($_GET['up_id']))$up_id = $_GET['up_id'];
    admin_view_addresses($type, $up_id);
?>