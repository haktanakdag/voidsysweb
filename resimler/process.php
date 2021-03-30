<?php
ob_start( "ob_gzhandler" );
error_reporting(E_ALL ^ E_NOTICE); 
ob_start();
session_start();
//echo session_id();
extract($_GET);
extract($_POST);
ob_flush();
//@include ("../s_cls/cls_resimBoyutlandir.php");

if(!is_dir(dirname(__FILE__)."/".$_SESSION['resgrup']."/$refid")){
    @mkdir(dirname(__FILE__)."/".$_SESSION['resgrup']."/".$refid);
}
if(!is_dir(dirname(__FILE__)."/".$_SESSION['resgrup']."/".$refid."/thumb/")){
    @mkdir(dirname(__FILE__)."/".$_SESSION['resgrup']."/".$refid."/thumb/");
}
$dir =dirname(__FILE__)."/".$_SESSION['resgrup']."/".$refid."/";
$thumb =dirname(__FILE__)."/".$_SESSION['resgrup']."/".$refid."/thumb/";
$resimid=$refid;
$num = 0;
if ($dh = @opendir($dir)) {
	while (($file = readdir($dh)) !== false) {
		if (@eregi("jpg",$file)) {
			list($on,$arka) = explode("_",$file);
			if ($on == $resimid) {
				$num++;
			}
		}
	}
	closedir($dh);
}

//@include ("../s_cls/cls_resimBoyutlandir.php");
############ Configuration ##############
$config["generate_image_file"]			= true;
$config["generate_thumbnails"]			= true;
$config["image_max_size"] 			= 400; //Maximum image size (height and width)
$config["thumbnail_size"]  			= 200; //Thumbnails will be cropped to 200x200 pixels
$config["thumbnail_prefix"]			= ""; //Normal thumb Prefix
$config["destination_folder"]			= "./".$_SESSION['resgrup']."/".$refid."/"; //upload directory ends with / (slash)
$config["thumbnail_destination_folder"]		= "./".$_SESSION['resgrup']."/".$refid."/thumb/"; //upload directory ends with / (slash)
$config["upload_url"] 				= "./".$_SESSION['resgrup']."/".$refid."/"; 
$config["quality"] 				= 90; //jpeg quality
$config["random_file_name"]			= true; //randomize each file name


if(!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
	exit;  //try detect AJAX request, simply exist if no Ajax
}

//specify uploaded file variable
$config["file_data"] = $_FILES["__files"]; 


//include sanwebe impage resize class
include("resize.class.php"); 


//create class instance 
$im = new ImageResize($config); 


try{
	$responses = $im->resize(); //initiate image resize
	
	echo '<h3>Thumbnails</h3>';
	//output thumbnails
	foreach($responses["thumbs"] as $response){
		echo '<img src="'.$config["upload_url"].$response.'" class="thumbnails" title="'.$response.'" />';
	}
	
	echo '<h3>Images</h3>';
	//output images
	foreach($responses["images"] as $response){
		echo '<img src="'.$config["upload_url"].$response.'" class="images" title="'.$response.'" />';
	}
	
}catch(Exception $e){
	echo '<div class="error">';
	echo $e->getMessage();
	echo '</div>';
}
?>