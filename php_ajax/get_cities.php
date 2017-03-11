<?php
	if(isset($_GET['country_id'])){
		
		include ("../module/module.php");
		include ("../connection/connection.php");
		$country_id = $_GET['country_id'];
        if($country_id != "0")
            $where = " WHERE country_id = " . $country_id;
        else $where = "";
		
		echo "<option value='0'>-- City --</option>";
		/* ----------- get value of city --------*/
		$rs = getResultSet("SELECT * FROM tbl_cities" . $where);
		while($r = mysql_fetch_array($rs)){
			echo "<option value=" . $r['city_id'] . ">" . $r['city_name'] . "</option>";
		}
	}
?>