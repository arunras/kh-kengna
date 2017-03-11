<?php
// ***** Page Method ********

function build_page_number($my_total_page, $my_pagesize, $my_cur_page, $my_page_link)
{
	echo "Page: ";
	$o_num_page = $my_total_page;

	if (($my_cur_page == 1) || ($my_total_page==0)){
		echo "";}
	else {
		echo '<a title="First" href="' . $my_page_link . '1" style="text-decoration:none;">
				<img align="absmiddle" src="app_images/first.png"></img>
			 </a>'; //[First]</a>'; 
		echo '<a title="Previous" href="' . $my_page_link . ($my_cur_page - 1) . '" style="text-decoration:none;">
				<img align="absmiddle" src="app_images/previous.png"></img>
			   </a>';//[Previous]</a> '; 
	}
	// End of First Previous
	
	// Page Number
	for ($j=1; $j <= $o_num_page; $j++) {
		if ($j == $my_cur_page)
			echo " " . $j . " ";
		else
			echo ' <a href="' . $my_page_link . $j . '">' . $j . '</a> ' ;
	}
	// End of Page Number
	
	// Next Last	
	if (($my_cur_page == $o_num_page) || ($my_total_page==0) )
		//echo " [Next] [Last] ";
		echo " ";
	else {					 
		echo '  <a title="Next" href="' . $my_page_link . ($my_cur_page + 1) . '" style="text-decoration:none;">
					<img align="absmiddle" src="app_images/next.png" onmouseover="src=images/next_pressed.png"></img>
				</a>';//[Next]</a> '; 
		echo '<a title="Last" href="' . $my_page_link . $o_num_page . '" style="text-decoration:none;">
					<img align="absmiddle" src="app_images/last.png" onmouseover="src=images/last_pressed.png"></img>
			  </a>';//[Last]</a>';
	}
	// End of Next Last
}
// ***** End of Page Method *********

?>