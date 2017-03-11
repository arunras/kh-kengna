<?php
    require_once("class/hotel_facebook.class.php");

    $hotel_facebook = new hotel_facebook;
    if(isset($_GET['hotel_id'])){
        $hotel_id = $_GET['hotel_id'];
        $hotel_facebook->set_hotel_id($hotel_id);
    }

    $hotel_facebook->set_php_path("application/hotel_review/hotel_facebook.php");
    if(!isset($_POST['submit_facebook_profile'])){
        $hotel_facebook->draw_popup();
    }
    else{
        $hotel_facebook->save_facebook();
    }
?>