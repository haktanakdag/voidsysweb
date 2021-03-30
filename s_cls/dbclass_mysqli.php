<?php
class dbClass {
private $user ="root";
private $pass="";
private $db="voidb";

function connect(){
header('Content-Type: text/html; charset=utf-8');
//$con = @mysqli_connect($this->host, $this->user, $this->pass,$this->db);
//$con = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db . ';charset=UTF8', $this->user, $this->pass,  array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
$con = new mysqli($this->host, $this->user, $this->pass,  $this->db);
mysqli_set_charset($con, 'utf8'); 

if (!$con) {
    echo "Error: " . mysqli_connect_error();
	exit();
}

mysqli_set_charset($con, 'utf8'); 
print_r(mysqli_get_charset($con));
}

function query($a) {
$query 	= mysqli_query(@mysqli_connect($this->host, $this->user, $this->pass,$this->db), $a);
return $query;
}
function fetch_array($result)
{
return @mysqli_fetch_array($result);
}

function fetch_assoc($result)
{
return @mysqli_fetch_assoc($result);
}
function fetch_object($result)
{
return @mysqli_fetch_object($result);
}
function num_rows($result)
{
return @mysqli_num_rows($result);
}

function affected_rows()
{
return @mysqli_affected_rows();
}

function free_result($result)
{
return @mysqli_free_result($result);
}

function insert_id()
{
return @mysqli_insert_id();
}

function result($result){
return @mysqli_result($result,0);
}
function close(){
return @mysqli_close($this->conn);
}
}


?>