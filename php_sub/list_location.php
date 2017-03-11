<!--=========================================================================================================================================================-->
<div class="child">
	<ul>
	<?php //Address//
	$q_city=getResultSet("SELECT DISTINCT city_id,city_name FROM tbl_cities LIMIT 0,10");

	while($rc = mysql_fetch_array($q_city))
	{
		$id = $rc['city_id'];
		$city = $rc['city_name'];
		echo '<li>';
			echo "<a href='http://".DOMAIN.ROOT."/?mangoparam=run_display&city=$id&where=$city&curP=1'>";
				echo "» ".$city;
			echo '</a>';
		echo '</li>';
	}					
	?>
	</ul>
</div>
<!--=========================================================================================================================================================-->