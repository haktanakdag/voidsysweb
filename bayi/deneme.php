<?php
 
include('simple_html_dom.php');
 
$url = 'https://www.dia.com.tr';
//$url = 'https://www.vodafone.com.tr';
 
$html = file_get_html($url);
$links = array();
/*
foreach($html->find('head') as $a) {
//foreach($html->find('div[id="bui$htmllder-column-59493e0519ca9"]') as $a) {
//foreach($html->find('a[class="postlink"]') as $a) {
   $sonuc =$a;
 //$links[] = $a->src;
}
$sonuc = str_replace("href='/wp-content", "href='".$url."/wp-content", $sonuc);
$sonuc = str_replace("src='/wp-content", "src='".$url."/wp-content", $sonuc);
$sonuc = str_replace('<meta name="google-site-verification" content="k8BzjZMD8E9ppSQeuhVG3iK3AlncNAuhaeuof9fUvP0" /><meta name="yandex-verification" content="445423bf01712dfd" />', "", $sonuc);
$sonuc = str_replace("<link rel='dns-prefetch' href='//fonts.googleapis.com' /><link rel='dns-prefetch' href='//s.w.org' />", "", $sonuc);


echo $sonuc;
echo "asdmasd";

 */
/*
echo "<head>";
foreach($html->find('link[id="bootstrap-css"]') as $a) {
     $sonuc =$a;
}
$sonuc = str_replace("href='/wp-content", "href='".$url."/wp-content", $sonuc);
$sonuc = str_replace("src='/wp-content", "src='".$url."/wp-content", $sonuc);
echo $sonuc;

foreach($html->find('link[id="google-fonts-css"]') as $a) {
     $sonuc =$a;
}
$sonuc = str_replace("href='/wp-content", "href='".$url."/wp-content", $sonuc);
$sonuc = str_replace("src='/wp-content", "src='".$url."/wp-content", $sonuc);
echo $sonuc;

foreach($html->find('link[id="font-awesome-css"]') as $a) {
     $sonuc =$a;
}
$sonuc = str_replace("href='/wp-content", "href='".$url."/wp-content", $sonuc);
$sonuc = str_replace("src='/wp-content", "src='".$url."/wp-content", $sonuc);
echo $sonuc;

foreach($html->find('link[id="owl-carousel-css"]') as $a) {
   $sonuc =$a;
}
$sonuc = str_replace("href='/wp-content", "href='".$url."/wp-content", $sonuc);
$sonuc = str_replace("src='/wp-content", "src='".$url."/wp-content", $sonuc);
echo $sonuc;

foreach($html->find('link[id="owl-carousel-theme-css"]') as $a) {
     $sonuc =$a;
}
$sonuc = str_replace("href='/wp-content", "href='".$url."/wp-content", $sonuc);
$sonuc = str_replace("src='/wp-content", "src='".$url."/wp-content", $sonuc);
echo $sonuc;

foreach($html->find('link[id="nivo-theme-css"]') as $a) {
     $sonuc =$a;
}
$sonuc = str_replace("href='/wp-content", "href='".$url."/wp-content", $sonuc);
$sonuc = str_replace("src='/wp-content", "src='".$url."/wp-content", $sonuc);
echo $sonuc;

foreach($html->find('link[id="theme-css"]') as $a) {
     $sonuc =$a;
}
$sonuc = str_replace("href='/wp-content", "href='".$url."/wp-content", $sonuc);
$sonuc = str_replace("src='/wp-content", "src='".$url."/wp-content", $sonuc);
echo $sonuc;

foreach($html->find('link[id="nivo-theme-css"]') as $a) {
     $sonuc =$a;
}
$sonuc = str_replace("href='/wp-content", "href='".$url."/wp-content", $sonuc);
$sonuc = str_replace("src='/wp-content", "src='".$url."/wp-content", $sonuc);
echo $sonuc;

foreach($html->find('link[id="theme-shop-css"]') as $a) {
     $sonuc =$a;
}
$sonuc = str_replace("href='/wp-content", "href='".$url."/wp-content", $sonuc);
$sonuc = str_replace("src='/wp-content", "src='".$url."/wp-content", $sonuc);
echo $sonuc;

foreach($html->find('link[id="theme-spyropress-css"]') as $a) {
     $sonuc =$a;
}
$sonuc = str_replace("href='/wp-content", "href='".$url."/wp-content", $sonuc);
$sonuc = str_replace("src='/wp-content", "src='".$url."/wp-content", $sonuc);
echo $sonuc;

foreach($html->find('link[id="main-css"]') as $a) {
     $sonuc =$a;
}
$sonuc = str_replace("href='/wp-content", "href='".$url."/wp-content", $sonuc);
$sonuc = str_replace("src='/wp-content", "src='".$url."/wp-content", $sonuc);
echo $sonuc;

foreach($html->find('link[id="builder-css"]') as $a) {
    $sonuc =$a;
}
$sonuc = str_replace("href='/wp-content", "href='".$url."/wp-content", $sonuc);
$sonuc = str_replace("src='/wp-content", "src='".$url."/wp-content", $sonuc);
echo $sonuc;

foreach($html->find('link[id="pps_style-css"]') as $a) {
     $sonuc =$a;
}
$sonuc = str_replace("href='/wp-content", "href='".$url."/wp-content", $sonuc);
$sonuc = str_replace("src='/wp-content", "src='".$url."/wp-content", $sonuc);
echo $sonuc;

foreach($html->find('link[id="builder-css"]') as $a) {
    $sonuc =$a;
}
$sonuc = str_replace("href='/wp-content", "href='".$url."/wp-content", $sonuc);
$sonuc = str_replace("src='/wp-content", "src='".$url."/wp-content", $sonuc);
echo $sonuc;

foreach($html->find('link[id="builder-css"]') as $a) {
     $sonuc =$a;
}
$sonuc = str_replace("href='/wp-content", "href='".$url."/wp-content", $sonuc);
$sonuc = str_replace("src='/wp-content", "src='".$url."/wp-content", $sonuc);
echo $sonuc;
echo "</head>";
 */


?>