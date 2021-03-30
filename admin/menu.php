<?php
$menuler = new clsMenu();
$menubasliklar = $menuler->menuleriGetir(1,0,$anasayfa);
$menustr="";
$menustr.="<ul id='nav'>";
foreach ($menubasliklar as $baslik){
	$menustr.= "<li><a href='#'>$baslik->menuad</a>";
	$menustr.= "<ul>";
	$menu = $menuler->menuleriGetir(0,$baslik->id,$anasayfa);
	foreach ($menu as $m){
		$baglanti ="";
		if ($m->baglanti==""){$baglanti ="#";}else {$baglanti=$m->baglanti;}
		$menustr.=  "<li><a href='$baglanti'>$m->menuad</a></li>";
	}
	$menustr.="</ul>";
}
$menustr.="</li>";
$menustr.="</ul>";
$menustr =str_replace("'",'"',$menustr);
echo $menustr;
?>
 