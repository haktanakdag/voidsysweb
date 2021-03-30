<?php
class dbClass {
//private $host ="www.haktanakdag.com";
//private $user ="haktanak_kul";
//private $pass="deuhakdeu";
//private $db="haktanak_db";
/*
private $host ="www.haktanakdag.com";
private $user ="haktanak_cafekul";
private $pass="K@0SCAFE";
private $db="haktanak_cafedb";
*/
private $host ="localhost";
private $user ="root";
private $pass="";
public $db="voidb";

 /*   
private $host ="www.haktanakdag.com";
private $user ="haktanak_hadbkul";
private $pass="deuhak87deu";
private $db="haktanak_hadb";
 */   
function connect(){
$this->conn = @mysql_connect($this->host, $this->user, $this->pass)
or die("Veritabanımızda meydana gelen bir sorun yüzünden geçici bir süreliğine hizmet verememekteyiz");

@mysql_query("SET NAMES 'utf8'");
@mysql_query("SET CHARACTER SET 'utf8'"); //dil secenekleri
@mysql_query("SET COLLATION_CONNECTION = 'utf8_turkish_ci'");

$select_db = @mysql_select_db($this->db) or die("Veritabanı seçilemedi");

}

function query($a) {//standart sorguların calistirildigi fonksiyon
return @mysql_query($a,mysql_connect($this->host, $this->user, $this->pass));
}
function fetch_array($result)
{
return @mysql_fetch_array($result);
}

function fetch_assoc($result)
{
return @mysql_fetch_assoc($result);
}
function fetch_object($result)
{
return @mysql_fetch_object($result);
}

function num_rows($result)
{
return @mysql_num_rows($result);
}

function affected_rows()
{
return @mysql_affected_rows();
}

function free_result($result)
{
return @mysql_free_result($result);
}

function insert_id()
{
return @mysql_insert_id();
}

function result($result){
return @mysql_result($result,0);
}
function close(){
return @mysql_close($this->conn);
}
}

//$dba = new DatabaseClass; // dba isimli Veritabani nesnesi olusuyor.
//$dba->connect(); //mysql.php include edildigi anda veritabani baglantisi acilir.

?>