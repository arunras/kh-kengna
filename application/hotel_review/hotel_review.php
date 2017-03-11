<?php

    require_once("class/hotel_review.class.php");

    $hotel_review = new hotel_review();
    $hotel_review->set_hotel_id($_GET['id']);
    $hotel_review->set_css_path("application/hotel_review/css/hotel_review.css");
    $hotel_review->set_js_path("application/hotel_review/js/hotel_review.js");

    $hotel_review->draw_review();

?>