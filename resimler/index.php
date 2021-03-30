﻿<?php 
error_reporting(E_ALL ^ E_NOTICE); 
ob_start();
session_start();
//echo session_id();
extract($_GET);
extract($_POST);
ob_flush();
if($sil){
    $silana =explode("/",$sil);
    $silana= $silana[0]."/".$silana[1]."/".$silana[3];
    @unlink($sil);
    @unlink($silana);
}
?>
<!DOCTYPE html>
<html>
<head>
<title>VoidevSYSWeb Resim Yükleme Sistemi</title>
<link href="style.css" rel="stylesheet" type="text/css">
<link href="../css/buttonlink.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="form-wrap">
<h3>Resim Yükle</h3>
<form action="process.php?refid=<?=$refid?>" method="post" enctype="multipart/form-data" id="upload_form">
    <input name="__files[]" type="file" class="btn" multiple  />
    <input name="__submit__" type="submit" value="Yükle" class="btn"/>
</form>
<?php
$klasor =$_SESSION['resgrup']."/".$refid;
$klasorthumb =$_SESSION['resgrup']."/".$refid."/thumb/";
if(count(glob("/$klasorthumb/*"))==0){
@rmdir($klasorthumb);
@rmdir($klasor);
}
echo "<div id='dvresimler'>";
if(is_dir($klasor)==false){
$klasor="./resimyok/";
$resimad ="resimyok.png";
echo "<img src='$klasor$resimad'>";
}else{
$dizin = @opendir($klasorthumb);
echo "<table><tr>";
$c = 0; 
$n = 3;
while($dosya = @readdir($dizin)) {
if(!($dosya=='.' OR $dosya=='..')){
        if($c % $n == 0 && $c != 0)
        {
        echo '</tr><tr>';
        } 
        $c++;
        echo "<td>";
        echo "<img src='$klasorthumb$dosya'>&nbsp";
        echo "<br><a href='index.php?refid=$refid&sil=$klasorthumb$dosya' class='btn'>Sil</a>";
        echo "</td>";

}
}
}
echo "</tr></table>";
echo "</div>";
    ?>
    <div id="output"><!-- error or success results --></div>
    
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">    
//configuration
var max_file_size 		= 10048576; //allowed file size. (1 MB = 1048576)
var allowed_file_types 		= ['image/png', 'image/gif', 'image/jpeg', 'image/pjpeg']; //allowed file types
var result_output 		= '#output'; //ID of an element for response output
var my_form_id 			= '#upload_form'; //ID of an element for response output
var total_files_allowed 	= 15; //Number files allowed to upload

//on form submit
$(my_form_id).on( "submit", function(event) { 
	event.preventDefault();
	var proceed = true; //set proceed flag
	var error = [];	//errors
	var total_files_size = 0;
	
	if(!window.File && window.FileReader && window.FileList && window.Blob){ //if browser doesn't supports File API
		error.push("Your browser does not support new File API! Please upgrade."); //push error text
	}else{
		var total_selected_files = this.elements['__files[]'].files.length; //number of files
		
		//limit number of files allowed
		if(total_selected_files > total_files_allowed){
			error.push( "You have selected "+total_selected_files+" file(s), " + total_files_allowed +" is maximum!"); //push error text
			proceed = false; //set proceed flag to false
		}
		 //iterate files in file input field
		$(this.elements['__files[]'].files).each(function(i, ifile){
			if(ifile.value !== ""){ //continue only if file(s) are selected
				if(allowed_file_types.indexOf(ifile.type) === -1){ //check unsupported file
					error.push( "<b>"+ ifile.name + "</b> is unsupported file type!"); //push error text
					proceed = false; //set proceed flag to false
				}

				total_files_size = total_files_size + ifile.size; //add file size to total size
			}
		});
		
		//if total file size is greater than max file size
		if(total_files_size > max_file_size){ 
			error.push( "You have "+total_selected_files+" file(s) with total size "+total_files_size+", Allowed size is " + max_file_size +", Try smaller file!"); //push error text
			proceed = false; //set proceed flag to false
		}
		
		var submit_btn  = $(this).find("input[type=submit]"); //form submit button	
		
		//if everything looks good, proceed with jQuery Ajax
		if(proceed){
			submit_btn.val("Please Wait...").prop( "disabled", true); //disable submit button
			var form_data = new FormData(this); //Creates new FormData object
			var post_url = $(this).attr("action"); //get action URL of form
			
			//jQuery Ajax to Post form data
			$.ajax({
				url : post_url,
				type: "POST",
				data : form_data,
				contentType: false,
				cache: false,
				processData:false,
				mimeType:"multipart/form-data"
			}).done(function(res){ //
				$(my_form_id)[0].reset(); //reset form
				$(result_output).html(res); //output response from server
				submit_btn.val("Upload").prop( "disabled", false); //enable submit button once ajax is done
			});
		}
	}
	
	$(result_output).html(""); //reset output 
	$(error).each(function(i){ //output any error to output element
		$(result_output).append('<div class="error">'+error[i]+"</div>");
	});
		
});
</script>
</body>
</html>
