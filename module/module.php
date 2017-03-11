<?php
/* -------------- Redirecting  ------------------------------------- */
define("HomeURL","http://localhost/mangosteen/?mangoparam=home");
define("HomeAddress","http://localhost/mangosteen/");

define("ADMINISTRATOR", 1);
define("REGISTERER", 2);
define("REVIEWER", 3);
define("USER", 4);

/* -------------- parameter for calling pages ---------------------- */
	$home_page = "index";
	$search_page = "search";
	$detail_page = "detail";
	$profile_page = "profile";
	$add_hotel_page = "add_hotel";
	$login_page = "login";
	$logout_page = "util_logout";
	$register_page = "register";
    $admin_page = "admin_main";
    $write_review = "run_write_review";

    /*==RUN Parameter For Page===========================================================================*/
	$run_display_page="run_display";
    /*==end RUN Parameter For Page===========================================================================*/

/* -------------------- verify that the page request is available for loading ----------------- */

function get_loadable_page($page_param){
	global $home_page;
	global $search_page;
	global $detail_page;
	global $profile_page;
	global $add_hotel_page;
	global $login_page;
	global $logout_page;
	global $register_page;
    global $admin_page;

    global $run_display_page;
    global $write_review;


	if(strcmp($page_param , $home_page) !=0 &&
	strcmp($page_param , $search_page) !=0 &&
	strcmp($page_param , $detail_page) !=0 &&
	strcmp($page_param , $profile_page) !=0 &&
	strcmp($page_param , $login_page) !=0 &&
	strcmp($page_param , $logout_page) !=0 &&
	strcmp($page_param , $register_page) !=0 &&
	strcmp($page_param , $add_hotel_page) !=0 &&
    strcmp($page_param , $admin_page) !=0 &&
    strcmp($page_param , $write_review) !=0 &&
	strcmp($page_param , $run_display_page) !=0)
	{
			$page_param = $home_page;
	}
	return $page_param;
}


/**
 * Getting the others id of facilities
 */

function Other_facilities(){
    return getValue("SELECT facility_id FROM tbl_facilities WHERE facility_name = 'Other'");
}

/**
 * Getting the others id of sports and recreation
 */

function Other_sports(){
    return getValue("SELECT sport_id FROM tbl_sports_recreation WHERE sport_name = 'Other'");
}

function connectDB(){
	$cn=mysql_connect(HOST_NAME,USER_NAME,USER_PASSWORD) or die("Cannot connect to DB");
	$cn=mysql_select_db(DB_NAME) or die("cannot select database");
}

function runSQL($str){
	connectDB();
	mysql_query($str) or die("cannot execute statement: $str<br/>".mysql_error());
}
function getResultSet($str){
	connectDB();
	$rs=mysql_query($str) or die("cannot select: $str ".mysql_error());
	return $rs;
}
function getValue($str){
	$rs=getResultSet($str);
	while ($row = mysql_fetch_array($rs,MYSQL_NUM)) {
		return $row[0];
	}
}

function getDateTime(){
	return date("Y-m-d H:i:s");
}
function getToday(){
	return date("Y-m-d");
}
function getTime(){
	return date("H:i:s");
}

function randomID($tbname,$fname){
	$val=random(0,1999999999);
	while(getValue("select $fname from $tbname where $fname=$val")!=""){
		$val=random(0,1999999999);
	}
	return $val;
}
function random($min,$max){
	return rand($min,$max);
}
function getHeader($s){
	return substr($s,0,5);
}
function getPassword($s){
	return substr($s,5,strlen($s)-5);
}
function sqlStr($s){
	$rev="'".$s."'";
	return $rev;
}


function RandomString($length=20) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ_';
    $string = "";

    for ($p = 0; $p < $length; $p++) {
        $string .= $characters[mt_rand(0, strlen($characters)-1)];
    }

    return $string;
}

function display_star($hotel_id, $edit){
    $star = getValue("SELECT hotel_star FROM tbl_hotels WHERE hotel_id = " . $hotel_id);
    for($i = 1; $i <= 5; $i++){
      echo '<input class="hotel-star" type="radio" name="rate" value="' . $i . '" ';
      if($star == ($i)) echo " checked ";
      if(!$edit) echo " disabled ";
      echo '/>';
    }
}

function display_rate($value, $name){
    //echo $value;
    for($i = 1; $i <= 5; $i++){
      echo '<input class="hotel-rate" type="radio" name="' . $name . '" value="' . $i . '"';
      if($value == $i) echo " checked ";
      echo ' disabled />';
    }
}


/* ----------------- Check Duplicate value in Database ------------------- */
function isDuplicate($table_name, $field_name, $value, $type){
	if($type == "string"){
		$value = "'" . $value . "'";
	}
	$isduplicate = false;
	if(getValue("SELECT * FROM " . $table_name . " WHERE " . $field_name . " = " . $value) != "")$isduplicate = true;
	return $isduplicate;
}

function getUploadSize($id){
    $filesize=$_FILES[$id]['size'];
    return $filesize;
}

function upload($id, $path, $name = ""){
    $result=0;
	//$allowtype=array("jpg","jpeg","gif","png");

	$filename=$_FILES[$id]['name'];
	$filename=str_replace("#","_",$filename);
	$filename=str_replace("$","_",$filename);
	$filename=str_replace("%","_",$filename);
	$filename=str_replace("^","_",$filename);
	$filename=str_replace("&","_",$filename);
	$filename=str_replace("*","_",$filename);
	$filename=str_replace("?","_",$filename);
	$filename=str_replace(" ","_",$filename);
	$filename=str_replace("!","_",$filename);
	$filename=str_replace("@","_",$filename);
	$filename=str_replace("(","_",$filename);
	$filename=str_replace(")","_",$filename);
	$filename=str_replace("/","_",$filename);
	$filename=str_replace(";","_",$filename);
	$filename=str_replace(":","_",$filename);
	$filename=str_replace("'","_",$filename);
	$filename=str_replace("\\","_",$filename);
	$filename=str_replace(",","_",$filename);
	$filename=str_replace("+","_",$filename);
	$filename=str_replace("-","_",$filename);
	$filesize=$_FILES[$id]['size'];
	$filetype=end(explode(".",strtolower($filename)));
    if($name != "")$filename = $name . "." . $filetype;
	/*if(!in_array($filetype,$allowtype)){
		$result="2;";
	}*/
	if($filesize>$_POST['MAX_FILE_SIZE'] || $filesize==0){
		$result="1;";
	}
	if($result==0){
		//$subfolder=date("Y_m_d_H_i_s");
		$path=$path . "/";
		if(mkdir($path,0777,true));

        /*
        if(file_exists($path.$filename)){
          unlink($path.$filename);
        }
        */

		if(move_uploaded_file($_FILES[$id]['tmp_name'],$path.$filename)){
			$result=$result.";".$path.$filename;
		}
		else{
			$result="3;";
		}
	}
	return $result;
}


/* for hotel detail page */
    function view_price($hotel_id){
        $price = getValue("SELECT hotel_lowest_price FROM tbl_hotels WHERE hotel_id = " . $hotel_id);
        echo '
            <div class="hotel_price"><span>';
        if($price != "" && $price != "0") echo '   From <span>' . $price . '</span> USD';
        echo '</span><span style="display:inline;font-size:10px;"><a href="#" id="edit_price"  class="edit hide"><span>[Change Price]</span></a></span>
            </div>
        ';
    }

    function view_contact($hotel_id){
        $sql = "SELECT contact_label, contact_value, contact_type FROM tbl_hotel_contacts WHERE hotel_id = " . $hotel_id;
        $contact_rs = getResultSet($sql);
        if(mysql_num_rows($contact_rs) != 0){
            echo '<span class="contact_header">Contact us</span><br /><br />';
            while($contact_info = mysql_fetch_array($contact_rs)){
                $contact_type = $contact_info[2];
                $value = "";
                if($contact_type == "link"){
                    $value = "<a href='" . $contact_info[1] . "'>" . $contact_info[1] . "</a>";
                }
                else{
                    $value = $contact_info[1];
                }
                echo '<div class="contact_row"><span class="contact_label">' . $contact_info[0] . '</span><span class="contact_info">' . $value . '</span></div>';
            }
        }
    }

    function view_contact_edit($hotel_id){
        $sql = "SELECT contact_id, contact_label, contact_value FROM tbl_hotel_contacts WHERE hotel_id = " . $hotel_id;
        $contact_rs = getResultSet($sql);
        if(mysql_num_rows($contact_rs) != 0){
            echo '<span class="contact_header">Contact us</span><br /><br />';
            while($contact_info = mysql_fetch_array($contact_rs)){
                echo '<div class="contact_row"><span class="contact_label">' . $contact_info[1] . '</span><span class="admin_edit contact_info" id="info_' . $contact_info[0] . '">' . $contact_info[2] . '<span class="func">[Edit]</span><span class="func">[Delete]</span></span></div>';
            }
        }
    }

    function basic_info_view($hotel_id)
	{
        $sql = "SELECT
        bi.info_label,
        hi.info_value,
        bi.info_value_type,
        bi.info_id
        FROM
        tbl_basic_info AS bi
        Left Join tbl_hotel_information AS hi on bi.info_id = hi.info_id
        and hotel_id = " . $hotel_id . " ORDER BY bi.info_id ASC";
        $info_rs = getResultSet($sql);
        $val = "";
		if($info_rs != ""){
		  $alt = 0;
			if(mysql_num_rows($info_rs) != 0){
				echo '<table id="row_view">';
				while($info = mysql_fetch_array($info_rs)){
          			    if($alt % 2 == 0)
                            echo '<tr><td width="180" align="left">';
                        else echo '<td width="180" align="left">';
						echo $info[0];
                        echo '</td><td>';
                        if($info[2] == "YES;NO"){
                            if(strtoupper($info[1]) == 'YES')
                                $check = " checked ";
                            else if(strtoupper($info[1]) == 'NO' || $info[1] == "")
                                 $check = "";
                            $val = '<label for="info-checkbox-' . $info[3] . '"></label><input type="checkbox" name="checkbox" id="info-checkbox-' . $info[3] . '" value="' . $info[1] . '" ' . $check . ' disabled />';
                        }
                        else ($info[1] != "")? ($val = $info[1]) : ($val = "N/A");
                        echo $val . '</td>';

                        if($alt % 2 == 0){
                            echo '</td>';
                        }
                        else echo '</td></tr>';

                        $alt++;
					}
				echo '</table>';
			}
		}
	}// end of basic info view function

    function basic_info_view_edit($hotel_id)
	{
		$sql = "SELECT
        bi.info_label,
        hi.info_value,
        bi.info_value_type,
        bi.info_id
        FROM
        tbl_basic_info AS bi
        Left Join tbl_hotel_information AS hi on bi.info_id = hi.info_id
        and hotel_id = " . $hotel_id . " ORDER BY bi.info_id ASC";
        $info_rs = getResultSet($sql);
        $val = "";
		if($info_rs != ""){
		  $alt = 0;
			if(mysql_num_rows($info_rs) != 0){
				echo '<table id="row_view">';
				while($info = mysql_fetch_array($info_rs)){
          			    if($alt % 2 == 0)
                            echo '<tr><td width="180" align="left">';
                        else echo '<td width="180" align="left">';
						echo $info[0];
                        echo '</td><td>';
                        if($info[2] == "YES;NO"){
                            if(strtoupper($info[1]) == 'YES')
                                $check = " checked ";
                            else if(strtoupper($info[1]) == 'NO' || $info[1] == "")
                                $check = "";
                            $val = '<label for="info-checkbox-' . $info[3] . '"></label><input type="checkbox" name="info-checkbox-' . $info[3] . '" id="info-checkbox-' . $info[3] . '" value="' . $info[1] . '" ' . $check . '/>';
                        }
                        else if($info[2] != ""){
                            $option = explode(";", $info[2]);
                            $val    = '<select name="info-select-' . $info[3] . '">';
                            for($i = 0; $i < count($option); $i++){
                                  $val .= '<option value="' . $option[$i] . '"';
                                  if($option[$i] == $info[1]) $val .= ' selected ';
                                  $val .= '>' . $option[$i] . '</option>';
                            }
                            $val   .= '</select>';
                        }
                        else {
                            ($info[1] != "")? ($tmp = $info[1]) : ($tmp = "N/A");
                             $val = '<input type="text" name="info-text-' . $info[3] . '" value="' . $tmp . '" />';
                        }
                        echo $val . '</td>';

                        if($alt % 2 == 0){
                            echo '</td>';
                        }
                        else echo '</td></tr>';

                        $alt++;
					}
				echo '</table>';
			}
		}
	}// end of basic info view-backend function


	function facilities_view($hotel_id){
		$sql = "SELECT
		tbl_facilities.facility_id,
		tbl_facilities.facility_name,
		tbl_hotel_facilities.hotel_id
		FROM
		tbl_facilities LEFT JOIN
		tbl_hotel_facilities
		ON tbl_facilities.facility_id = tbl_hotel_facilities.facility_id AND tbl_hotel_facilities.hotel_id = " . $hotel_id
		. " ORDER BY tbl_facilities.facility_id ";

		$alt = 0;

		$facilities_rs = getResultSet($sql);
                $other_id = Other_facilities();
		echo '<table border="0">';
		while($facilities_info = mysql_fetch_array($facilities_rs)){
                    if($facilities_info[0] == $other_id){
                        continue;
                    }

                    $check = "";
                    $check = $facilities_info[2];
                    if($check != '')$check = ' checked ';

                    if($alt % 2 == 0){
                            echo '<tr><td width="400">';
                    }
                    else echo '<td width="400">';

                    echo '
                            <label for="facility-checkbox-' . $facilities_info[0] . '">' . $facilities_info[1] . '</label>
                            <input type="checkbox" name="checkbox" id="facility-checkbox-' . $facilities_info[0] . '" value="' . $facilities_info[0] . '"' . $check . ' disabled />
                    ';

                    if($alt % 2 == 0){
                            echo '</td>';
                    }
                    else echo '</td></tr>';

                    $alt++;
		}
		echo '</table>';
                /*
                 * view other facilities
                 */
                $alt = 0;
                $others_rs = getResultSet("SELECT facility_description FROM tbl_hotel_facilities WHERE hotel_id = " . $hotel_id . " AND facility_id = " . $other_id);
                if(mysql_num_rows($others_rs) != 0 )
                    echo '<br /><h4>Others Facilities</h4>';
                echo '<table id="other_facilities"><tbody>';
                while($others_info = mysql_fetch_array($others_rs)){

                    if($alt % 2 == 0){
                            echo '<tr id=' . $alt . '><td width="400">';
                    }
                    else echo '<td width="400">';

                    echo '
                            <label for="other-facility-checkbox-' . $alt . '">' . $others_info[0] . '</label>
                            <input type="checkbox" name="checkbox" id="other-facility-checkbox-' . $alt . '" value="' . $others_info[0] . '" checked disabled />
                    ';

                    if($alt % 2 == 0){
                            echo '</td>';
                    }
                    else echo '</td></tr>';

                    $alt++;
                }
                echo '</table>';


	}//end of facilities function



	function sports_recreation_view($hotel_id){
		$sql = "SELECT
		tbl_sports_recreation.sport_id,
		tbl_sports_recreation.sport_name,
		tbl_hotel_sports.hotel_id
		FROM
		tbl_sports_recreation LEFT JOIN
		tbl_hotel_sports
		ON tbl_sports_recreation.sport_id = tbl_hotel_sports.sport_id AND tbl_hotel_sports.hotel_id = " . $hotel_id
		. " ORDER BY tbl_sports_recreation.sport_id";
		$alt = 0;

		$sports_rs = getResultSet($sql);
                $others_id = Other_sports();
		echo '<table border="0">';
		while($sports_info = mysql_fetch_array($sports_rs)){
                    if($sports_info[0] == $others_id){
                        continue;
                    }


                    $check = "";
                    $check = $sports_info[2];
                    if($check != '')$check = ' checked ';

                    if($alt % 2 == 0){
                            echo '<tr><td width="400">';
                    }
                    else echo '<td width="400">';

                    echo '
                            <label for="sport-checkbox-' . $sports_info[0] . '">' . $sports_info[1] . '</label>
                            <input type="checkbox" name="checkbox" id="sport-checkbox-' . $sports_info[0] . '" value="' . $sports_info[0] . '"' . $check . ' disabled />
                    ';

                    if($alt % 2 == 0){
                            echo '</td>';
                    }
                    else echo '</td></tr>';

                    $alt++;
		}
		echo '</table>';
                /*
                 * view other sports recreation
                 */
                $alt = 0;
                $others_rs = getResultSet("SELECT sport_description FROM tbl_hotel_sports WHERE hotel_id = " . $hotel_id . " AND sport_id = " . $others_id);
                if(mysql_num_rows($others_rs) == 0 ) return;
                echo '<br /><h4>Others Sports and Recreations</h4>';
                echo '<table>';
                while($others_info = mysql_fetch_array($others_rs)){

                    if($alt % 2 == 0){
                            echo '<tr><td width="400">';
                    }
                    else echo '<td width="400">';

                    echo '
                            <label for="other-sport-checkbox-' . $alt . '">' . $others_info[0] . '</label>
                            <input type="checkbox" name="checkbox" id="other-sport-checkbox-' . $alt . '" value="' . $others_info[0] . '" checked disabled />
                    ';

                    if($alt % 2 == 0){
                            echo '</td>';
                    }
                    else echo '</td></tr>';

                    $alt++;
                }
                echo '</table>';
	}//end of sports function

    function accessibility_view($hotel_id){
            $alt = 0;
            echo '<table>';
            $access_rs = getResultSet("SELECT hotel_accessibility_name FROM tbl_hotel_accessibilities WHERE hotel_id = " . $hotel_id);
            while($access_info = mysql_fetch_array($access_rs)){
                if($alt % 2 == 0){
                        echo '<tr id=' . $alt . '><td width="400">';
                }
                else echo '<td width="400">';

                echo '<label for="access-checkbox-' . $alt . '">' . $access_info[0] . '</label>
                      <input type="checkbox" name="checkbox" id="access-checkbox-' . $alt . '" value="' . $access_info[0] . '" checked disabled />
                   ';

                if($alt % 2 == 0){
                        echo '</td>';
                }
                else echo '</td></tr>';
                $alt++;
            }
            echo '</table>';

        }//end of accessibility_view


		function view_write_review($hotel_id){
			echo $hotel_id;
		}
/* end of detail page function*/

/* admin */
function admin_view_facilities(){
    $facilities_rs = getResultSet("SELECT facility_id, facility_name FROM tbl_facilities WHERE facility_id <> 0");
    $alt = 0;
    echo '<table border="0">';
		while($facility_info = mysql_fetch_array($facilities_rs)){

                    if($alt % 2 == 0){
                            echo '<tr>';
                    }

                    echo '<td width=50 align="right">';
                    draw_icon_service("facility", $facility_info[0]);
                    echo '</td>';

                    echo '<td width="400">';

                    $checked = getValue("SELECT service_available FROM tbl_service WHERE service_id = " . $facility_info[0] . " AND service_type = 'facility'");
                    if($checked == "1") $checked = " checked ";
                    else $checked = "";

                    echo '<span class="admin_edit" id="faci_' . $facility_info[0] . '">
                        <label for="fac_' . $facility_info[0] . '">' . $facility_info[1] . '</label>';
                    echo '
                    <input type="checkbox" name="checkbox" id="fac_' . $facility_info[0] . '" value="fac_' . $facility_info[0] . '" ' . $checked . ' />
                    <span class="func">[Icon]</span><span class="func">[Edit]</span><span class="func">[Delete]</span>
                    </span>';


                    echo '</td>';

                    if($alt % 2 != 0){
                            echo '</tr>';
                    }

                    $alt++;
		}
		echo '</table>';
}//facilities


function admin_view_sports(){
    $sports_rs = getResultSet("SELECT sport_id, sport_name FROM tbl_sports_recreation WHERE sport_id <> 0");
    $alt = 0;
    echo '<table border="0">';
		while($sport_info = mysql_fetch_array($sports_rs)){

                    if($alt % 2 == 0){
                            echo '<tr>';
                    }

                    echo '<td width=50 align="right">';
                    draw_icon_service("sport", $sport_info[0]);
                    echo '</td>';

                    echo '<td width="400">';

                    $checked = getValue("SELECT service_available FROM tbl_service WHERE service_id = " . $sport_info[0] . " AND service_type = 'sport'");
                    if($checked == "1") $checked = " checked ";
                    else $checked = "";

                    //draw_icon_service("sport", $sport_info[0]);

                    echo '<span class="admin_edit" id="sports_' . $sport_info[0] . '">

                    <label for="sport_' . $sport_info[0] . '">' . $sport_info[1] . '</label>
                    <input type="checkbox" name="checkbox" id="sport_' . $sport_info[0] . '" value="sport_' . $sport_info[0] . '" ' . $checked . ' />

                    <span class="func">[Icon]</span><span class="func">[Edit]</span><span class="func">[Delete]</span>
                    </span>';


                    echo '</td>';

                    if($alt % 2 != 0){
                            echo '</tr>';
                    }

                    $alt++;
		}
		echo '</table>';
}//sports

function draw_icon_service($type, $id){
    $img_src = getValue("SELECT service_icon FROM tbl_service WHERE service_type='" . $type . "' AND service_id = " . $id);
    echo '<img style="display:block;margin-right:5px;" src="' . $img_src . '" />';
}

function admin_view_basic_info(){
    $info_rs = getResultSet("SELECT info_id, info_label FROM tbl_basic_info");
    $alt = 0;
    echo '<table border="0">';
		while($info = mysql_fetch_array($info_rs)){

                    if($alt % 2 == 0){
                            echo '<tr>';
                    }

                    echo '<td width=50 align="right">';
                    draw_icon_service("basic_info", $info[0]);
                    echo '</td>';

                    echo '<td width="400">';

                    $checked = getValue("SELECT service_available FROM tbl_service WHERE service_id = " . $info[0] . " AND service_type = 'basic_info'");
                    if($checked == "1") $checked = " checked ";
                    else $checked = "";

                    echo '<span class="admin_edit" id="info_' . $info[0] . '">

                    <label for="basic_' . $info[0] . '">' . $info[1] . '</label>
                    <input type="checkbox" name="checkbox" id="basic_' . $info[0] . '" value="basic_' . $info[0] . '" ' . $checked .  ' />

                    <span class="func">[Icon]</span><span class="func">[Edit]</span><span class="func">[Delete]</span></span>';

                    echo '</td>';

                    if($alt % 2 != 0){
                            echo '</tr>';
                    }

                    $alt++;
		}
		echo '</table>';
}//basic info

function admin_view_addresses($type,$upid = 1){
    $type = strtolower($type);
    $table_name  = "";
    $field_up    = "";
    $field_value = "";
    $field_id    = "";
    switch($type){
      case "city":
        $table_name = "tbl_cities";
        $field_up   = "country_id";
        $field_value = "city_name";
        $field_id    = "city_id";
        break;
      case "khan":
        $table_name = "tbl_khan";
        $field_up   = "city_id";
        $field_value = "khan_name";
        $field_id    = "khan_id";
        break;
      case "sangkat":
        $table_name = "tbl_sangkat";
        $field_up   = "khan_id";
        $field_value = "sangkat_name";
        $field_id    = "sangkat_id";
        break;
      default:
        $table_name = "tbl_cities";
        $field_up   = "country_id";
        $field_value = "city_name";
        $field_id    = "city_id";
        break;
    }
    $addr_rs = getResultSet("SELECT " . $field_id . "," . $field_value . " FROM " . $table_name . " WHERE " . $field_up . " = " . $upid);
    echo '<table>';
    while($addr_info = mysql_fetch_array($addr_rs)){
      echo '<tr><td><span id="addr_' . $type . '_' . $addr_info[0] . '" class="address admin_edit">' . $addr_info[1] . '<span class="func">[Edit]</span><span class="func">[Delete]</span></span></td></tr>';
    }
    echo '</table>';
}

// view users
function admin_view_users(){
  $user_rs = getResultSet("SELECT u.user_id, u.user_name, u.user_profile_name, u.user_email, ul.level_name FROM tbl_users AS u INNER JOIN tbl_user_level AS ul ON ul.level_id = u.level_id AND user_id <> 1");
        echo '<table id="lst_users" class="lst">';
        echo '<thead><tr>
            <th>Username</th>
            <th>Profile Name</th>
            <th>Email</th>
            <th>User Authority</th>
            <th>Action</th>
        </tr></thead><tbody>';
        while($user_info = mysql_fetch_array($user_rs)){
          echo '<tr>
            <td><a href="?mangoparam=profile&id=' . $user_info[0] . '">' . $user_info[1] . '</a></td>
            <td>' . $user_info[2] . '</td>
            <td><a href="mailto:' . $user_info[3] . '">' . $user_info[3] . '</a></td>
            <td>' . $user_info[4] . '</td>
            <td><span style="display:none;">' . $user_info[0] . '</span><span>[Edit]</span><span>[Delete]</span></td>
          </tr>';
        }
        echo '</tbody></table>';
}
//end of view users

//add/remove top hotels
function admin_top_hotels(){
  $hotel_rs = getResultSet("SELECT hotel_id, hotel_name, hotel_city, hotel_khan, hotel_sangkat, hotel_star, hotel_top_slide, hotel_enabled FROM tbl_hotels");
  echo '<table id="lst_hotels" class="lst">
  <thead>
    <tr>
        <th style="width:500px;">Name</th>
        <th style="width:200px;">Star</th>
        <th style="width:300px;">City</th>
        <th>Khan</th>
        <th>Sangkat</th>
        <th style="width:10px;">Top Slide</th>
        <th style="width:10px;">Activate</th>
    </tr>
  </thead>
  <tbody>
  ';
  while($hotel_info = mysql_fetch_array($hotel_rs)){
    $check_activated = "";
    $check_top_slide = "";

    if($hotel_info[6] == 1)$check_top_slide = " checked ";
    if($hotel_info[7] == 1)$check_activated = " checked ";

    echo '<tr>';
    echo '<td><a href="?mangoparam=detail&id=' . $hotel_info[0] . '">' . $hotel_info[1] . '</a></td>';
    echo '<td>' . $hotel_info[5] . '</td>';
    echo '<td>' . getValue("SELECT city_name FROM tbl_cities WHERE city_id = " . $hotel_info[2]) . '</td>';
    echo '<td>' . getValue("SELECT khan_name FROM tbl_khan WHERE khan_id = " . $hotel_info[3]) . '</td>';
    echo '<td>' . getValue("SELECT sangkat_name FROM tbl_sangkat WHERE sangkat_id = " . $hotel_info[4]) . '</td>';
    echo '<td align="center">
            <label style=";margin-bottom:0;margin-left:50px;" for="top-checkbox-' . $hotel_info[0] . '"></label>
            <input type="checkbox" name="checkbox" id="top-checkbox-' . $hotel_info[0] . '" value="' . $hotel_info[0] . '" ' . $check_top_slide . ' />
         </td>';
    echo '<td align="center">
            <label style="margin-bottom:0;margin-left:50px;" for="enable-checkbox-' . $hotel_info[0] . '"></label>
            <input type="checkbox" name="checkbox" id="enable-checkbox-' . $hotel_info[0] . '" value="' . $hotel_info[0] . '" ' . $check_activated . ' />
         </td>';
    echo '</tr>';
  }
  echo '</tbody>';

  echo '<tfoot>
            <tr>
                <th style="border-right:none;border-top:1px solid #CCC;"></th>
                <th style="border-left:none;border-right:none;border-top:1px solid #CCC;"></th>
                <th style="border-left:none;border-right:none;border-top:1px solid #CCC;"></th>
                <th style="border-left:none;border-right:none;border-top:1px solid #CCC;"></th>
                <th style="border-left:none;border-right:none;border-top:1px solid #CCC;padding-right:10px;" align="right">Summary</th>
                <th style="border-top:1px solid #CCC;padding-right:10px;" align="right"><span id="sum_top_slide">0/0</span></th>
                <th style="border-top:1px solid #CCC;padding-right:10px;" align="right"><span id="sum_activate">0/0</span></th>
            </tr>
        </tfoot>';

  echo '</table>';
}


/* end of admin */

/* functions for user profile */
function view_profile_info($id){
  $username        = "";
  $profile_name    = "";
  $password        = "**********";
  $user_type       = "";
  $user_email      = "";
  $registered_date = "";
  $profile_picture = "";

  $user_rs = getResultSet("SELECT user_name, level_id, user_profile_name, user_email, user_registered_date, user_profile_picture FROM tbl_users WHERE user_id = " . $id);
  if(mysql_num_rows($user_rs) != 0){
    while($user_info = mysql_fetch_array($user_rs)){
        $username        = $user_info[0];
        $user_type       = getValue("SELECT level_name FROM tbl_user_level WHERE level_id = " . $user_info[1]);
        $profile_name    = $user_info[2];
        $user_email      = $user_info[3];
        $registered_date = $user_info[4];
        $profile_picture = $user_info[5];
    }
  }
  $img_style = "";
  if($profile_picture == ""){
    $profile_picture = "app_images/image_not_found.jpg";
    $img_style = "style='border:1px solid #e3e3e3;' ";
  }
  echo '<table class="user_profile">
  <tr><td class="profile_left" valign="top">
    <img class="user_profile_picture" src ="' . $profile_picture . '" ' . $img_style . '/>
  </td>';//end of first left side-start second side


  echo '<td valign="top">';
  echo '<span class="profile_name">' . $profile_name . '</span><br />';

  echo '<table>';
  echo '<tr><td width="100"><span class="profile_label">Username</span></td><td><span class="profile_info">' . $username . '</span></td></tr>';
  echo '<tr><td><span class="profile_label">User Type</span></td><td><span class="profile_info">' . $user_type . '</span></td></tr>';
  echo '<tr><td><span class="profile_label">Email</span></td><td><span class="profile_info"><a href="mailto:' . $user_email . '">' . $user_email . '</a></span></td></tr>';
  echo '<tr><td><span class="profile_label">Registered On</span></td><td><span class="profile_info">' . $registered_date . '</span></td></tr>';
  echo '</table>';

  echo '</td>
  </tr></table>';
}

function view_edit_profile_info($id){
  $username        = "";
  $profile_name    = "";
  $password        = "";
  $user_type       = "";
  $user_email      = "";
  $registered_date = "";
  $profile_picture = "";

  $user_rs = getResultSet("SELECT user_name, level_id, user_profile_name, user_email, user_registered_date, user_profile_picture FROM tbl_users WHERE user_id = " . $id);
  if(mysql_num_rows($user_rs) != 0){
    while($user_info = mysql_fetch_array($user_rs)){
        $username        = $user_info[0];
        $user_type       = getValue("SELECT level_name FROM tbl_user_level WHERE level_id = " . $user_info[1]);
        $profile_name    = $user_info[2];
        $user_email      = $user_info[3];
        $registered_date = $user_info[4];
        $profile_picture = $user_info[5];
    }
  }
  $img_style = "";
  if($profile_picture == ""){
    $profile_picture = "app_images/image_not_found.jpg";
    $img_style = "style='border:1px solid #e3e3e3;' ";
  }
  echo '<table class="user_profile">
  <tr><td class="profile_left" valign="top" align="left">
    <img id="user_profile_pic" class="user_profile_picture" src ="' . $profile_picture . '" ' . $img_style . '/>
    <span id="select_profile_picture" class="profile_link" style="margin-right:50px;">[Choose]</span><br />
    <div class="upload">
        <div style="margin-left:20px;">
        <form id="form_user_profile_picture" action="php_ajax/db_upload_profile_pic.php?user_id=' . $id . '" method="post" enctype="multipart/form-data" onsubmit="return check_image_upload(\'form_user_profile_picture\')" target="upload_target" >
          <input type="file" name="fl_profile_picture" id="fl_profile_picture" style="position:absolute; left:-9999px;" />
          <input type="hidden" value="2000000" name="MAX_FILE_SIZE" />
          <input type="submit" name="submit" value="Save" id="save_user_profile" class="hide" />
          <input type="button" name="cancel" value="Cancel" class="hide" onclick="hide_siblings(this)" /><br />
          <span id="select_status"></span>
          <div id="loading_ajax"><!--<p align="center"><img src="app_images/loader.gif" /><br />Uploading.....</p>--></div>
          <!--<span class="error_text" id="sms"></span>-->
       </form>
  </div>
  </td>';//end of first left side-start second side


  echo '<td valign="top">';

  echo '<form action="php_sub/profile_information.php?id=' . $id . '" method="post" onsubmit="return check_submit_profile()" target="upload_target">';
  echo '<input type="text" class="own_profile profile_name" name="txt_profilename" id="txt_profilename" value = "' . $profile_name . '" /><br />';

  echo '<table>';
  echo '<tr><td width="150"><span class="profile_label">Username</span></td><td><input type="text" class="own_profile" name="txt_username" id="txt_username" value="' . $username . '" /></td></tr>';
  echo '<tr><td><span class="profile_label">Password</span></td><td><input type="password" class="own_profile" name="txt_password" id="txt_password" value="' . $password . '" /></td></tr>';
  echo '<tr><td><span class="profile_label">New Password</span></td><td><input type="password" class="own_profile" name="txt_new_password" id="txt_new_password" value="" /></td></tr>';
  echo '<tr><td><span class="profile_label">Confirm Password</span></td><td><input type="password" class="own_profile" name="txt_con_password" id="txt_con_password" value="" /></td></tr>';
  echo '<tr><td><span class="profile_label">User Type</span></td><td><span class="profile_info">' . $user_type . '</span></td></tr>';
  echo '<tr><td><span class="profile_label">Email</span></td><td><input type="text" class="own_profile" name="txt_email" id="txt_email" value="' . $user_email . '" /></td></tr>';
  echo '<tr><td><span class="profile_label">Registered On</span></td><td><span class="profile_info">' . $registered_date . '</span></td></tr>';
  echo '<tr><td></td><td align="right"><input type="submit" name="profile_data" value="Save" /></td></tr>';
  echo '</table></form>';

  echo '</td>
  </tr>
  </table>';
  echo '<iframe id="upload_target" name="upload_target" style="display:none"></iframe>';
}
/* end of profile */

function is_valid_url ( $url )
{
		$url = @parse_url($url);

		if ( ! $url) {
			return false;
		}

		$url = array_map('trim', $url);
		$url['port'] = (!isset($url['port'])) ? 80 : (int)$url['port'];
		$path = (isset($url['path'])) ? $url['path'] : '';

		if ($path == '')
		{
			$path = '/';
		}

		$path .= ( isset ( $url['query'] ) ) ? "?$url[query]" : '';

		if ( isset ( $url['host'] ) AND $url['host'] != gethostbyname ( $url['host'] ) )
		{
			if ( PHP_VERSION >= 5 )
			{
				$headers = get_headers("$url[scheme]://$url[host]:$url[port]$path");
			}
			else
			{
				$fp = fsockopen($url['host'], $url['port'], $errno, $errstr, 30);

				if ( ! $fp )
				{
					return false;
				}
				fputs($fp, "HEAD $path HTTP/1.1\r\nHost: $url[host]\r\n\r\n");
				$headers = fread ( $fp, 128 );
				fclose ( $fp );
			}
			$headers = ( is_array ( $headers ) ) ? implode ( "\n", $headers ) : $headers;
			return ( bool ) preg_match ( '#^HTTP/.*\s+[(200|301|302)]+\s#i', $headers );
		}
		return false;
}

/***RUN Function**************************************************************************/////////////
function autoID($tbname,$fname){
	$q_id = getResultSet("SELECT $fname FROM $tbname");
	$id=0;
	while($ri = mysql_fetch_array($q_id))
	{
		$id=$ri[$fname];	
	}
	return $id+1;
}

function getUrl($id){
	//$sub=ROOT;
    global $detail_page;
	$name=getValue("SELECT hotel_name FROM tbl_hotels where hotel_id=$id");
	if($name!=""){
		return "?mangoparam=".$detail_page."&id=".$id;
	}
	else{
		//return $sub."/".$name;
	}
}

function get_file_extension($file_name)
{
  return substr(strrchr($file_name,'.'),1);
}

function f_extension($fn){
$str=explode('/',$fn);
$len=count($str);
$str2=explode('.',$str[($len-1)]);
$len2=count($str2);
$ext=$str2[($len2-1)];
return $ext;
}

function Field($s){
	$rev="'".$s."'";
	return $rev;
}

/***End RUN Function**************************************************************************/////////////


?>