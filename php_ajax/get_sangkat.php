<?php
	if(isset($_GET['khan_id'])){
		
		include ("../module/module.php");
		include ("../connection/connection.php");
		$khan_id = $_GET['khan_id'];
        if($khan_id != "0")
            $where = " WHERE khan_id = " . $khan_id;
        else $where = "";

		echo "<option value='0'>-- Commune --</option>";
		/* ----------- get value of city --------*/
		$rs = getResultSet("SELECT * FROM tbl_sangkat" . $where);
		while($r = mysql_fetch_array($rs)){
			echo "<option value=" . $r['sangkat_id'] . ">" . $r['sangkat_name'] . "</option>";
		}
	}
?>