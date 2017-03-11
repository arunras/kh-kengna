<?php
    if(isset($_GET['photo_id'])){
        include("../connection/connection.php");
        include("../module/module.php");

        $photo_id = $_GET['photo_id'];
        $photo_path = "../" . getValue("SELECT photo_path FROM tbl_photos WHERE photo_id = " . $photo_id);

        if(unlink($photo_path)){
            runSQL("DELETE FROM tbl_photos WHERE photo_id = " . $photo_id);
        }
    }
?>