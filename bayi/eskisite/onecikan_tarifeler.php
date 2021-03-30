<?php
$url = 'https://www.vodafone.com.tr';
$content = file_get_contents($url);
$first_step = explode( ' <!-- 4 | start ================================================================== -->' , $content );
$second_step = explode('<!-- 4 | end ================================================================== -->' , $first_step[1] );
//print_r($second_step);
$str = $second_step[0];
$str= str_replace("icon-arrow-forward","fas fa-chevron-right",$str);
echo str_replace("data-src","srcset",$str);
?>