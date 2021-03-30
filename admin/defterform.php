<?php
$projeler = new Projeler();
$dprojeler = $projeler->ProjeleriGetir();
?>
<style type="text/css">
#defterislemdis {
	display: none;
	border: 1px solid #ccc;
	background: #FFFFA0;
	padding: 30px;
	width: 450px;
}
</style>
<script type="text/javascript">
$(document.defterislem).ready(function(){
$('#defterislem').click(function(){
var valid = '';
var isr = ' gerekli.';
var defterid=$('#defterid').val();
var islemtip = $('#islemtip').val();
var projeid=$('#projeid').val();
var islemaciklama=$('#islemaciklama').val();
var tutar=$('#tutar').val();
var islemtarih=$('#islemtarih').val();
var detayaciklama=$('#detayaciklama').val();

if(islemtip=="")
{
valid += 'İşlem Tip'+isr;
}

if(islemaciklama=="")
{
valid += 'İşlem Açıklama'+isr;
}

if(tutar=="")
{
valid += 'Tutar'+isr;
}

if (valid!='') {	
    $("#defterislemdis").fadeIn("slow");
    $("#defterislemdis").html("Hata : "+valid);
}else {
    var kayitformdatastr = 'islemtip='+ islemtip + '&projeid=' + projeid + '&islemaciklama=' + islemaciklama + '&tutar='+ tutar + '&islemtarih='+ islemtarih + '&detayaciklama='+ detayaciklama;
    
    $("#defterislemdis").css("display", "block");
    $("#defterislemdis").html("Kaydınız Yapılıyor .... ");
    $("#defterislemdis").fadeIn("slow");
    var islem =''
    if(defterid==0){
    islem  ='0';
    }else{
    islem  ='1';
    kayitformdatastr = kayitformdatastr + '&defterid=' + defterid;
    }
    kayitformdatastr = kayitformdatastr.replace(/\n/g, "<br />")
    setTimeout("defterjqislem('"+kayitformdatastr+"','"+islem+"')",2000);
}
return false;
});
});
/*Form Validation Bitti*/

/*JQuery Başladı*/
function defterjqislem(kayitformdatastr,islem){
	if (islem=='0'){var islemurl='../islemler/islemler.php?islem=defterekle'}
	else{var islemurl='../islemler/islemler.php?islem=defterduzenle'}
	$.ajax({	
		type: "POST",
		url: islemurl,
		data: kayitformdatastr,
		cache: false,
		success: function(html){
		$("#defterislemdis").fadeIn("slow");
		$("#defterislemdis").html(html);
		setTimeout('$("#defterislemdis").fadeOut("slow")',2000);
	}
	});
}
/* jquery bitti */
</script>
<div id="wrap">
<?php 
$form = new clsForms();
if($islem=='duzenle'){
    $data = new Defter();
    $ddata =$data->DefterGetir($duzenleid);
}else{
    $duzenleid=0;
}
if($islem=='duzenle' and !$_GET['islemtip']){
$_GET['islemtip'] =$ddata->islemtip;
}
$form->doForm(array('basla'));
?>
<?php $form->doBaglanti(array('defter','Geri',$_SERVER['HTTP_REFERER']));?>
<fieldset>
    <legend>Yazı İşlem</legend>
<?php
    $secenekler= new Secenek();
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

                            if (!has_children($rows,$row['id'])){
                                $bacik ="";
                                 $bkapali ="";
                                 echo $ddata->islemtip;
                                if($row[id]==$_GET['islemtip'] or $row[id]==$ddata->islemtip){
                                 $bacik ="<b>";
                                 $bkapali ="</b>";   
                                }
                                 $result .= "<li><a href='adminpanel.php?lx=defterform.php&islem=".$_GET['islem']."&duzenleid=".$_GET['duzenleid']."&islemtip=$row[id]' class='button-link'> $bacik($row[id]) $row[secenekad].$bkapali</a>";
//<a href='$_SERVER[\'REQUEST_URI\']&islemtip=$row[id]'>
                            }else{
                                 $result .= "<li>($row[id]) $row[secenekad]";
                            }
                    if (has_children($rows,$row['id']))
                            $result.= build_menu($rows,$row['id']);
                            $result .= "</li>";
                    }
            }
            $result.= "</ul>";
            return $result;
    }
    echo build_menu($arrsecenek);
?>
<table width='100%' cellpadding='2' cellspacing='2'>
<?=$form->doHidden(array('defterid',$duzenleid));?>
<tr>
    <?php
    if($islemtip){
       $dislemtip =$islemtip; 
    }else{
        $dislemtip=$ddata->islemtip;
    }
    ?>
	<td width='20%'>İşlem Tip :</td><td><?=$form->doInput(array('islemtip',$dislemtip));?></td>
</tr>
<tr>
	<td width='10%'>Proje :</td><td><?php $form->doSelect(array('projeid','projead',$ddata->projeid),$dprojeler); ?></td>
</tr>
<tr>
	<td width='20%'>İşlem Açıklama :</td><td><?=$form->doInput(array('islemaciklama',$ddata->islemaciklama));?></td>
</tr>
<tr>
	<td width='20%'>İşlem Tarih :</td><td><?=$form->doDateInput(array('islemtarih',$ddata->islemtarih));?></td>
</tr>
<tr>
    <td width='20%'>Tutar :</td><td><?=$form->doInput(array('tutar',$ddata->tutar));?></td>
</tr>
<tr>
    <td width='20%'>Detay Açıklama:</td><td><?=$form->doTextAreaInput(array('detayaciklama',$ddata->detayaciklama));?></td>
</tr>
<tr>
	<td colspan='2' align='left'><?=$form->doButton(array('defterislem','Gönder'));?></td>
</tr>
<div id="defterislemdis"></div>
</table>
</fieldset>
<?php
$form->doForm(array('bitir'));
 ?>
</div>