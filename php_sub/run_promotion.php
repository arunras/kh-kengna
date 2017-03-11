<?php
	$hotel_id = $_GET['id'];
	$q_promotion = getValue("SELECT hotel_promotion_text FROM tbl_hotels WHERE hotel_id=".$hotel_id);
	echo '<div id="promotion_title" style="margin-bottom: 3px;">';
    	echo '<img src="app_images/cat_promotion.png" />';
        echo '<p> Special Promotion </p>';    
	echo '</div>';			
	
    echo '<p id="description">';    
		echo $q_promotion;	
	echo '</p>';        	
?>