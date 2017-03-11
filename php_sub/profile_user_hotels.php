<?php

    include("../connection/connection.php");
    include("../module/module.php");

    $u_id            = $_GET['id'];
    $hotel_info      = "SELECT Ho.hotel_id, Ho.hotel_name, Ho.hotel_images, Ho.hotel_star,hotel_address, Ho.hotel_description";
    $request_hotels  = "";


    if($_GET['type'] == "reviewed"){
        $uh_table        = "tbl_write_review";
        $uh_user_id      = "user_id";
        $uh_hotel_id     = "hotel_id";
    }
    else{
        $uh_table        = "tbl_user_hotels";
        $uh_user_id      = "user_id";
        $uh_hotel_id     = "hotel_id";
    }

    $q_uh            = "
					 FROM tbl_hotels AS Ho
					 INNER JOIN " . $uh_table . " AS Uh ON Ho.hotel_id= Uh." . $uh_hotel_id . "
					 WHERE Uh." . $uh_user_id . " = " . $u_id . " GROUP BY Uh.hotel_id";

    $request_hotels  = $hotel_info.$q_uh;
    display_list_hotel($request_hotels);


function display_list_hotel($sql)//$sql
{

    $hotel_rs = getResultSet($sql);
    $total_record = mysql_num_rows($hotel_rs);
	if($total_record==0){echo "No hotels!";}

    while($row=mysql_fetch_array($hotel_rs))
    {
        $desc = $row[5];
        if(strlen($desc) > 200){
          $desc = substr($desc, 0, 200) . "...";
        }
        echo '<table style="margin:10px 10px 20px 50px;"><tr>';
        echo '<td style="width:100px;height:100px;display:inline;"><a href="?mangoparam=detail&id=' . $row[0] . '"><img src="' . $row[2] . '" width="100" height="100"/></a></td>';
        echo '
            <td style="padding-left:20px;width:400px;text-align:justify;" valign="top">
            <span style="font-size:15px;font-weight:bold;color:dark-blue;margin-left:0px;">' . $row[1] . '
            </span><br />';
            display_rate($row[3], $row[0]);
        echo '<br /><br />
            <span style="font-size:12px;color:#888;">' . $desc . '</span></td>';
        echo '</tr></table>';
    }
}
?>
