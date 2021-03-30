<?php
function s_start() {
    $dba = new dbClass();
    $dba->connect();
    //echo "CREATE TABLE IF NOT EXISTS `session` (`id` int(12) NOT NULL auto_increment,`session_id` varchar(50) default NULL,`degisken` varchar(50) default NULL,`value` text,`activity` int(12) default NULL, PRIMARY KEY  (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
    $sql = $dba->query("CREATE TABLE IF NOT EXISTS `session` (`id` int(12) NOT NULL auto_increment,`session_id` varchar(50) default NULL,`degisken` varchar(50) default NULL,`value` text,`activity` int(12) default NULL, PRIMARY KEY  (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
s_refresh();
}

function GetIP(){
	if(getenv("HTTP_CLIENT_IP")) {
 		$ip = getenv("HTTP_CLIENT_IP");
 	} elseif(getenv("HTTP_X_FORWARDED_FOR")) {
 		$ip = getenv("HTTP_X_FORWARDED_FOR");
 		if (strstr($ip, ',')) {
 			$tmp = explode (',', $ip);
 			$ip = trim($tmp[0]);
 		}
 	} else {
 	$ip = getenv("REMOTE_ADDR");
 	}
	return $ip;
}

function sifrele ($degisken,$deger){
	$ilkdeger =($deger*998)."_".$degisken."_".GetIP();
	$md5deger = md5($ilkdeger);
	$semd5deger = serialize($md5deger);
	return $semd5deger;
}

function sifrecoz($sifrelideger){
	return unserialize($sifrelideger);
}

function s_set( $degisken, $deger ) {
	s_refresh();
	$sessid = session_id();
	$deger = serialize($deger);
	//$sessid = sifrele($degisken,$deger);
	//echo $sessid;
	$dba = new dbClass();
	$dba->connect();
	//echo "select id from session where session_id='$sessid' and degisken ='$degisken'";
	//echo "<br>";
	$sql = $dba->query("select id from session where session_id='$sessid' and degisken ='$degisken'");
	$sonuc = $dba->fetch_object($sql);
    //echo $sonuc->id;
	if( $sonuc->id> 0) {
            //echo "update session set value ='$deger', activity='".saniye()."' where id=$sonuc->id";
            //echo "<br>";
            $sql = $dba->query("update session set value ='$deger', activity='".saniye()."' where id=$sonuc->id");
                
	} else {
			//echo "<br>";
			//echo "insert into session(session_id,degisken,value,activity) values('$sessid','$degisken','$deger',".saniye().")";
            echo "<br>";
            $sql = $dba->query("insert into session(session_id,degisken,value,activity) values('$sessid','$degisken','$deger',".saniye().")");
	}
       //echo "update session set activity =".saniye()." where session_id=$sessid";
    $sql=$dba->query("update session set activity =".saniye()." where session_id=$sessid");
	return true;
}

function s_get( $degisken ) {
        s_refresh();
        $sessid = session_id();
        $dba = new dbClass();
        $dba->connect();
        //echo "select id,value from session where session_id ='$sessid' and degisken ='$degisken'";
        $sql =$dba->query("select id,value from session where session_id ='$sessid' and degisken ='$degisken'");
        $sonuc = $dba->fetch_object($sql);
	if( $sonuc->value) {
		$value = $sonuc->value;
        //echo "update session set  activity='".saniye()."' where id='$sonuc->id'";
        $sql = $dba->query("update session set  activity='".saniye()."' where id='$sonuc->id'");
        $sql = $dba->query("update session set  activity='".saniye()."' where session_id='$sessid'");
		$rsonuc= unserialize( $value );
	} else {
        //echo "update session set  activity='".saniye()."' where session_id='$sessid'";
        $sql = $dba->query("update session set  activity='".saniye()."' where session_id='$sessid'");
        $rsonuc= false;
	}
	//echo "<br>";
	//echo "s_getsonuc:".$rsonuc;
    return $rsonuc;
}

function s_destroy() {
	$sessid = session_id();
        $dba = new dbClass();
        $dba->query("delete from session where session_id='$sessid'");
	s_refresh();
}

function s_unlink($degisken) {
	$sessid = session_id();
	$dba = new dbClass();
        $dba->query("delete from session where session_id='$sessid' and degisken='$degisken'");
	s_refresh();
}

function s_refresh() {
        $expire_suresi = 30;
        $dba = new dbClass();
        $dba->connect();
        $zaman = saniye() - ( $expire_suresi * 60 );
        $sql = $dba->query("delete from session where activity<'$zaman'");
        return true;
}

function saniye() {
	return time() - 1220291600;
}
?>
