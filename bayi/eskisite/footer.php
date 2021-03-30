<?php
$url = 'https://www.vodafone.com.tr';
$content = file_get_contents($url);
$first_step = explode( '<!-- 5 | start ================================================================== -->' , $content );
$second_step = explode('<!-- 5 | end ================================================================== -->' , $first_step[1] );
//print_r($second_step);
$str= $second_step[0];
$str= str_replace("icon-facebook","fab fa-facebook-f",$str);
$str= str_replace("icon-twitter","fab fa-twitter",$str);
$str= str_replace("icon-youtube","fab fa-youtube",$str);
$str= str_replace("icon-linkedin2","fab fa-linkedin-in",$str);
$str= str_replace("icon-instagram","fab fa-instagram",$str);
$str= str_replace('<span class="text">instagram</span>',"",$str);
$str= str_replace('<span class="text">linkedin</span>',"",$str);
$str= str_replace('<span class="text">Youtube</span>',"",$str);
$str= str_replace('<span class="text">Twitter</span>',"",$str);
$str= str_replace('<span class="text">Facebook</span>',"",$str);
//$str= str_replace($eskistr,$yenistr,$str);
echo $str;
?>