<?php
	if(isset($_GET['city_id'])){
		
		include ("../module/module.php");
		include ("../connection/connection.php");
		$city_id = $_GET['city_id'];

        if($city_id != "0")
            $where = " WHERE city_id = " . $city_id;
        else $where = "";
		
		echo "<option value='0'>-- District --</option>";
		/* ----------- get value of city --------*/
		$rs = getResultSet("SELECT * FROM tbl_khan" . $where);
		while($r = mysql_fetch_array($rs)){
			echo "<option value=" . $r['khan_id'] . ">" . $r['khan_name'] . "</option>";
		}
	}
?>