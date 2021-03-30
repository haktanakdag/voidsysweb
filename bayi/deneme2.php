<?php
include('simple_html_dom.php');
 /*
//$url = 'https://www.dia.com.tr';/*
$url = 'https://www.vodafone.com.tr';
$html = file_get_html($url);
$links = array();
$sonuc ="";

foreach($html->find('link') as $a) {
     $sonuc =$sonuc.$a."br>";    
}
echo $sonuc;
foreach($html->find('script') as $a) {
     $sonuc =$sonuc.$a."br>";
}
echo $sonuc;
foreach($html->find('div.product') as $a) {
     $sonuc =$sonuc.$a."br>";
}
echo $sonuc;
*/
$url = 'https://www.dia.com.tr';

$html = file_get_html($url);
/*
$links = array();
foreach($html->find('a') as $a) {
 $links[] = $a->href;
 
}
 

foreach($html->find('img') as $a) {
 $links[] = $a->src;
}
print_r($links);
*/
$links[] = array();
foreach($html->find('div[class="wpb_wrapper"]') as $a) {
 echo $a;
}
print_r($links);
//
?>