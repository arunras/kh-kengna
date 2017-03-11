<?php
    include("../connection/connection.php");
    include("../module/module.php");
    if(isset($_GET['id'])){
        $type       = $_GET['type'];
        $id         = $_GET['id'];

        $field_name = "";
        $field_id   = "hotel_id";
        $table_name = "tbl_hotels";
        $checked    = $_GET['checked'];

        switch($type){
          case "enable":
                $field_name = "hotel_enabled";break;
          case "top":
                $field_name = "hotel_top_slide";break;
        }
        $sql = "UPDATE " . $table_name . " SET " . $field_name . " = " . $checked . " WHERE " . $field_id . " = " . $id;
        //echo $sql;
        runSQL($sql);
    }
    else{
        admin_top_hotels();
    }
?>