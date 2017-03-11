<?php
    ob_start();
    if(!isset($_SESSION))session_start();
    require_once("../connection/connection.php");
    require_once("../module/module.php");


    $num_photos    = $_GET['number_of_Photos'];
    $photos_prefix = $_GET['Photos-prefix'];


    $num_videos    = $_GET['number_of_Videos'];
    $videos_prefix = $_GET['Videos-prefix'];

    $all_size      = 0;
    $each_error    = 0;
    //get file size before uploading
    for($i = 0; $i < $num_photos; $i++){
        $result    = getUploadSize($photos_prefix . "-" . $i);
        if($result > $_POST['MAX_FILE_SIZE']){
            $each_error = 1;
            break;
        }
        $all_size += $result;
    }

    if($each_error == 1){
        echo "File(s) too big." ;
        exit();
?>
    <script>
        window.top.window.finish_review("File(s) too big.");
    </script>
<?php
    }

    $user_id = 0;
    if(isset( $_SESSION['_user_13_5_2011_id']))
      $user_id = $_SESSION['_user_13_5_2011_id'];


    $user_type = getValue("SELECT level_id FROM tbl_users WHERE user_id = " . $user_id);


    if($user_type == REVIEWER || $user_type == ADMINISTRATOR){
       $can_review = true;
    }
    else{
       $can_review = false;
    }
    if(!$can_review)header("location:?mangoparam=index");
    $hotel_id      = $_SESSION['viewing_hotel_id'];

    $stayed_date   = $_POST['date_stayed'];
    $visit_kind    = $_POST['visit_kind'];

    $title         = $_POST['title'];
    $review        = $_POST['review'];

    $photos_path   = "../data_images/write_review/photos/" . $user_id . "/";
    $videos_path   = "../data_images/write_review/videos/" . $user_id . "/";

    if(isset($_POST['rate']))
             $rate =$_POST['rate'];
    else
             $rate = 0;

    //exit();

    $wr_insert = "INSERT INTO tbl_write_review(user_id, hotel_id, wr_title, wr_comment, wr_date, wr_stayed_date, wr_visit_kind, hotel_rate_value) VALUES(
    ". $user_id .",
    ". $hotel_id .",
    '". $title ."',
    '". $review ."',
    '". date("m-d-Y") ."',
    '". $stayed_date ."',
    '". $visit_kind ."',
    ". $rate ."
    )";

    runSQL($wr_insert);
    $wr_id = mysql_insert_id();
    //$wr_id = 1;

    //upload photos
    $pv_type = "photos";
    for($i = 0; $i < $num_photos; $i++){
        $result=upload($photos_prefix . "-" . $i,$photos_path);
        $tem=explode(";",$result);
        $result=$tem[0];
        $target_path=$tem[1];
        $pv_description = $_POST["description-" . $photos_prefix . "-" . $i];
        if($result=="0"){
            $target_path=substr($target_path,3,strlen($target_path));
            $sql="INSERT INTO tbl_write_review_photovideo(wr_id, pv_type, pv_path, pv_description) VALUES(" . $wr_id . ",'" . $pv_type .  "', '" . $target_path . "', '" . $pv_description . "')";
            runSQL($sql);
            echo $sql. "<br />";
        }
        else{
        }
    }


    //upload Videos
    $pv_type = "videos";
    for($i = 0; $i < $num_videos; $i++){
        $result=upload($videos_prefix . "-" . $i,$videos_path);
        $tem=explode(";",$result);
        $result=$tem[0];
        $target_path=$tem[1];
        $pv_description = $_POST["description-" . $videos_prefix . "-" . $i];
        if($result=="0"){
            $target_path=substr($target_path,3,strlen($target_path));
            $sql="INSERT INTO tbl_write_review_photovideo(wr_id, pv_type, pv_path, pv_description) VALUES(" . $wr_id . ",'" . $pv_type .  "', '" . $target_path . "', '" . $pv_description . "')";
            runSQL($sql);
            echo $sql. "<br />";
        }
        else{
        }
    }

?>
<script>
        window.top.window.finish_review("Thank you for reviewing.");
</script>