<?php

class clsLog {
    
function LoglamaYap($yazilacak){
    $dosya="mylog.txt";
    if(file_exists($dosya)){
        $dosya=fopen($dosya,"w");//Dosya var ve yazmak için aç
    }else{
        $dosya=fopen($dosya,"x");//Dosya yok, oluştur ve yazmak için aç
    }
    fwrite($dosya,"$yazilacak\n");

    fclose($dosya);
}
  
}
?>

