<?php
error_reporting(E_ALL ^ E_NOTICE); 
ob_start();
session_start();
//echo session_id();
extract($_GET);
extract($_POST);
ob_flush();
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<?php include_once('../classes_include.php'); ?>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.js"></script>
<script src="../js/eylemler.js"></script>
<link href="../css/zerogrid.css" rel="stylesheet" />
<link rel="stylesheet" href="../css/loginformstyle.css">
<link rel="stylesheet" href="../css/accordion.css" type="text/css" />
<script src="../js/simple-tabs.js"></script>
<link rel="stylesheet" type="text/css" href="../css/tab.css">
<link rel="stylesheet" href="../css/pure.css" type="text/css" />
<!-- DateTime Picker İçin !-->
<link rel="stylesheet" href="../css/datepicker.css" type="text/css" />
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<!-- DateTime Picker İçin !-->
<!-- Masalar Kutu Style !-->
<style type="text/css">
.urunlerdiv{
	overflow: hidden;
	margin-bottom: 5px;
	-webkit-transition: all 1s;
}

.masalar{
	float:left;
	width:100px;
	height:100px;
	border:#CCC solid 1px;
	margin-right: 10px;
	margin-left: 4px;
        margin-top: 4px;
        display: block;
}
a:link {
    color: #FFF;
}

/* visited link */
a:visited {
    color: #FFF;
}

/* mouse over link */
a:hover {
    color: #FFF;
}

/* selected link */
a:active {
    color: #FFF;
}
.urunler{
	float:left;
	width:80px;
	height:50px;
	border:#CCC solid 1px;
	margin-right: 10px;
	margin-left: 4px;
        margin-top: 4px;
        display: block;
}

.btn {
  background: #69737a;
  background-image: -webkit-linear-gradient(top, #69737a, #586973);
  background-image: -moz-linear-gradient(top, #69737a, #586973);
  background-image: -ms-linear-gradient(top, #69737a, #586973);
  background-image: -o-linear-gradient(top, #69737a, #586973);
  background-image: linear-gradient(to bottom, #69737a, #586973);
  -webkit-border-radius: 20;
  -moz-border-radius: 20;
  border-radius: 20px;
  font-family: Arial;
  color: #ffffff;
  font-size: 10px;
  padding: 5px 14px 6px 14px;
  text-decoration: none;
}

.btn:hover {
  background: #3cb0fd;
  background-image: -webkit-linear-gradient(top, #3cb0fd, #3498db);
  background-image: -moz-linear-gradient(top, #3cb0fd, #3498db);
  background-image: -ms-linear-gradient(top, #3cb0fd, #3498db);
  background-image: -o-linear-gradient(top, #3cb0fd, #3498db);
  background-image: linear-gradient(to bottom, #3cb0fd, #3498db);
  text-decoration: none;
}
</style>
</head>
