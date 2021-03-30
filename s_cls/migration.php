<?php
error_reporting(E_ALL ^ E_NOTICE);
include 'dbclass_mysqli.php';
$dba = new dbClass();
$dba->connect();
$sql = $dba->query("SHOW TABLES  FROM voidb");

while(@$tablolar =$dba->fetch_object($sql)){
		$r[] =@$tablolar;
                
}
foreach ($r as $d){
    $sql = $dba->query("SELECT  COLUMN_NAME AS kolonadi FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '$d->Tables_in_voidb' and TABLE_SCHEMA='voidb'");
    while(@$kolonlar =$dba->fetch_object($sql)){
		$rk[] =@$kolonlar;
}

    
}

?>
