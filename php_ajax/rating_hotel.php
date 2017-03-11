<?php
    include("../connection/connection.php");
    include("../module/module.php");
    $hotel_id = $_GET['hotel_id'];
    if(isset($_GET['value'])){
        $value = $_GET['value'];
        $sql = "UPDATE tbl_hotels SET hotel_star = " . ($value) . " WHERE hotel_id = " . $hotel_id;
        runSQL($sql);
    }
    else{
        $edit     = $_GET['edit'];
        if($edit  == "yes"){
            display_star($hotel_id, true);
        }
        else {
            display_star($hotel_id, false);
        }
    }

    //function
?>