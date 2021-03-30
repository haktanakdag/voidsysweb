<?php

        $secenekler= new Secenek();
        if($sil){$secenekler-> SecenekSil($sil);}
	$secenek=$secenekler->SecenekleriGetir();
        
	function objectToArray($d) {
	if (is_object($d)) {
	// Gets the properties of the given object
	// with get_object_vars function
	$d = get_object_vars($d);
	}
	
	if (is_array($d)) {
	/*
	* Return array converted to object
	* Using __FUNCTION__ (Magic constant)
	* for recursive call
	*/
	return array_map(__FUNCTION__, $d);
	}
	else {
	// Return array
	return $d;
	}
	}
	$arrsecenek = objectToArray($secenek);
	
	//print_r($arrsecenek);
	
	function has_children($rows,$id) {
		foreach ($rows as $row) {
			if ($row['secenekbagid'] == $id)
			return true;
		}
		return false;
	}
	
	function build_menu($rows,$parent=0) {  
		$result = "<ul>";
		foreach ($rows as $row) {
			if ($row['secenekbagid'] == $parent) {
			$strong="";
			if($row[id]==$id){$strong="<strong>";}
				$result .= "<li>($row[id]) $row[secenekad]";
			if (has_children($rows,$row['id']))
				$result.= build_menu($rows,$row['id']);
				$result .= "</li>";
			}
		}
		$result.= "</ul>";
		return $result;
	}
	echo build_menu($arrsecenek);
        
        
    $sayfaad="adminpanel.php?lx=secenekler.php";
    $sayfaadEkle="adminpanel.php?lx=secenekform.php&islem=ekle";
    $sayfaadDuzenle="adminpanel.php?lx=secenekform.php&islem=duzenle";
    
    
    $forms = new clsForms();
    $seceneksayi =$secenekler->SecenekSayiBul();
    $sayfala =20;
    $search = $forms->doSearch(array("id","secenekad"),$txtara);
    $pagerString=$forms->doPager($sayfala ,$sayfano,$seceneksayi->sayi,$sayfaad);
    $kullanicilar = $secenekler->SecenekleriGetir($pagerString,$search);
    $forms->doform(array('basla','arama',$sayfaad));
    $forms->doInput(array('txtara',$txtara));
    $forms->doButton(array('ara','Ara'));
    $forms->doBaglanti(array('yeniekle','Yeni Ekle',$sayfaadEkle));
    $forms->doform(array('bitir'));
    $forms->doGrid(
    array(array("No",'10%'),array("Secenek Ad",'40%'))
    ,array("id","secenekad")
    ,$kullanicilar
    ,array(array("sil",$sayfaad,"Sil"),array("duzenle",$sayfaadDuzenle,"Düzenle"))
    ,"gridTable"
    );
    $pagerString=$forms->doPager($sayfala ,$sayfano,$seceneksayi->sayi,$sayfaad);
?>