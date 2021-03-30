<?php
$url = 'https://www.vodafone.com.tr';
$content = file_get_contents($url);
$first_step = explode( ' <!-- 3 | start ================================================================== -->' , $content );
$second_step = explode('<!-- 3 | end ================================================================== -->' , $first_step[1] );
//print_r($second_step);
echo $second_step[0];
?>