<?php

function upload($id, $path, $name = ""){
    $result=0;
	$allowtype=array("jpg","jpeg","gif","png");

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
	if(!in_array($filetype,$allowtype)){
		$result="2;";
	}
	if($filesize>$_POST['MAX_FILE_SIZE'] || $filesize==0){
		$result="1;";
	}
	if($result==0){
		//$subfolder=date("Y_m_d_H_i_s");
		$path=$path;
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

?>