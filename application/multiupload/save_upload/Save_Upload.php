<?php
    require_once("../Configuration.php");
    require_once("../" . MODULE_PATH . "MultiUpload.php");

    $number_of_files  = $_GET['number_of_files'];
    $prefix           = $_GET['prefix'];

    $destination_path = "../Upload_Test/";

    for($i = 0; $i < $number_of_files; $i++){
        upload($prefix . $i, $destination_path);
    }

?>