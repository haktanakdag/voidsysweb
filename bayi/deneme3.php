<?php
include('simple_html_dom.php');
$html = new simple_html_dom();
$html->load("<html><body><p>Hello World!</p><p>We're here</p></body></html>");
 
# get an element representing the second paragraph
$element = $html->find("p");
 
# modify it
//$element[1]->innertext;
$element[1]->plaintext;
# output it!
echo $html->save();

?>