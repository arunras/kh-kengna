<?php
    include("../connection/connection.php");
    include("../module/module.php");
    $hotel_id = $_GET['hotel_id'];
    if(isset($_GET['data'])){
        $arr = array();
        $info = explode(";", $_GET['data']);
        for($i = 1, $j = 0; $i < count($info); $i+=2, $j++){
          $arr[$j] = array("info_id"=>$info[$i-1],"info_value"=>$info[$i]);
        }
        for($i = 0; $i < count($arr); $i++){
          if(getValue("SELECT count(*) FROM tbl_hotel_information WHERE hotel_id = " . $hotel_id . " AND info_id = " . $arr[$i]['info_id']) != 0)
          {
               $sql_ = "UPDATE tbl_hotel_information SET info_value = '" . $arr[$i]['info_value'] . "' WHERE hotel_id = " . $hotel_id . " AND info_id = " . $arr[$i]['info_id'];
               runSQL($sql_);
          }
          else{
               $sql_ = "INSERT INTO tbl_hotel_information(hotel_id, info_id, info_value) VALUES(" . $hotel_id . "," . $arr[$i]['info_id'] . ",'" . $arr[$i]['info_value'] . "')";
               runSQL($sql_);
               runSQL("INSERT INTO tbl_service(service_id,service_type) VALUES(" . mysql_insert_id() . ",'basic_info')");
          }
          //echo $sql_ . "\n";

        }
    }
    else{
        $view = $_GET['view'];
        if($view=="true"){
            basic_info_view($hotel_id);
        }
        else{
            basic_info_view_edit($hotel_id);
        }
    }
?>