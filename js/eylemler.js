// JavaScript Document

/*Anahtar Ekle Form Validation Başladı*/
$(document.anahtarislem).ready(function(){
$('#anahtarislem').click(function(){
var valid = '';
var isr = ' gerekli.';
var anahtarid=$('#anahtarid').val();
var anahtarad=$('#anahtarad').val();
if(anahtarad=="")
{
valid += 'Anahtar Ad'+isr;
}

var ozel='';
$("input:checkbox:checked").map(function()
{
ozel= this.id;
}).get();

if (valid!='') {	
    $("#anahtarislemdis").fadeIn("slow");
    $("#anahtarislemdis").html("Hata : "+valid);
}else {
    var kayitformdatastr ='anahtarad=' + anahtarad + '&ozel=' +ozel;
    $("#anahtarislemdis").css("display", "block");
    $("#anahtarislemdis").html("Kaydınız Yapılıyor .... ");
    $("#anahtarislemdis").fadeIn("slow");
    var islem =''
    if(anahtarid==0){
    islem  ='0';
    }else{
    islem  ='1';
    kayitformdatastr = kayitformdatastr + '&anahtarid=' + anahtarid;
    }
    kayitformdatastr = kayitformdatastr.replace(/\n/g, "<br />")
    setTimeout("anahtarjqislem('"+kayitformdatastr+"','"+islem+"')",2000);
}
return false;
});
});
/*Anahtar Ekle Form Validation Bitti*/


/*Anahtar Ekle JQuery Başladı*/
function anahtarjqislem(kayitformdatastr,islem){
	if (islem=='0'){var islemurl='../islemler/islemler.php?islem=anahtarekle'}
	else{var islemurl='../islemler/islemler.php?islem=anahtarduzenle'}
	$.ajax({	
		type: "POST",
		url: islemurl,
		data: kayitformdatastr,
		cache: false,
		success: function(html){
		$("#anahtarislemdis").fadeIn("slow");
		$("#anahtarislemdis").html(html);
		setTimeout('$("#anahtarislemdis").fadeOut("slow")',2000);
	}
	});
}
/*Anahtar Ekle JQuery Bitti*/


/*Parametre Form Validation Başladı*/
$(document.parametreislem).ready(function(){
$('#parametreislem').click(function(){
var valid = '';
var isr = ' gerekli.';
var parId=$('#parId').val();
var pdeger=$('#deger').val();
if(pdeger=="")
{
valid += 'Değer'+isr;
}
if (valid!='') {	
			$("#parametreislemdis").fadeIn("slow");
			$("#parametreislemdis").html("Hata : "+valid);
}else {
			var kayitformdatastr ='deger=' + pdeger + '&paciklama=' + $('#paciklama').val();
			$("#parametreislemdis").css("display", "block");
			$("#parametreislemdis").html("Kaydınız Yapılıyor .... ");
			$("#parametreislemdis").fadeIn("slow");
			var islem =''
			if(parId==0){
			islem  ='0';
			}else{
			islem  ='1';
			kayitformdatastr = kayitformdatastr + '&parId=' + parId;
			}
			kayitformdatastr = kayitformdatastr.replace(/\n/g, "<br />")
			setTimeout("parametrejqislem('"+kayitformdatastr+"','"+islem+"')",2000);
}
return false;
});
});
/*Parametre Form Validation Bitti*/


/*parametre JQuery Başladı*/
function parametrejqislem(kayitformdatastr,islem){
	if (islem=='0'){var islemurl='../islemler/islemler.php?islem=parametreekle'}
	else{var islemurl='../islemler/islemler.php?islem=parametreduzenle'}
	$.ajax({	
		type: "POST",
		url: islemurl,
		data: kayitformdatastr,
		cache: false,
		success: function(html){
		$("#parametreislemdis").fadeIn("slow");
		$("#parametreislemdis").html(html);
		setTimeout('$("#parametreislemdis").fadeOut("slow")',2000);
	}
	});
}
/*unvan JQuery Bitti*/

/*Listebaslik Form Validation Başladı*/
$(document.listebaslikislem).ready(function(){
$('#listebaslikislem').click(function(){
var valid = '';
var isr = ' gerekli.';
var listebaslikId=$('#listebaslikId').val();
var lbaciklama=$('#lbaciklama').val();
if(lbaciklama=="")
{
valid += 'Liste Başlık Açıklama'+isr;
}
if (valid!='') {	
			$("#listebaslikislemdis").fadeIn("slow");
			$("#listebaslikislemdis").html("Hata : "+valid);
}else {
			var kayitformdatastr ='lbaciklama=' + lbaciklama;
			$("#listebaslikislemdis").css("display", "block");
			$("#listebaslikislemdis").html("Kaydınız Yapılıyor .... ");
			$("#listebaslikislemdis").fadeIn("slow");
			var islem =''
			if(listebaslikId==0){
			islem  ='0';
			}else{
			islem  ='1';
			kayitformdatastr = kayitformdatastr + '&listebaslikId=' + listebaslikId;
			}
			kayitformdatastr = kayitformdatastr.replace(/\n/g, "<br />")
			setTimeout("listebaslikjqislem('"+kayitformdatastr+"','"+islem+"')",2000);
}
return false;
});
});
/*Listebaslik Form Validation Bitti*/


/*Listebaslik JQuery Başladı*/
function listebaslikjqislem(kayitformdatastr,islem){
	if (islem=='0'){var islemurl='../islemler/islemler.php?islem=listebaslikekle'}
	else{var islemurl='../islemler/islemler.php?islem=listebaslikduzenle'}
	$.ajax({	
		type: "POST",
		url: islemurl,
		data: kayitformdatastr,
		cache: false,
		success: function(html){
		$("#listebaslikislemdis").fadeIn("slow");
		$("#listebaslikislemdis").html(html);
		setTimeout('$("#listebaslikislemdis").fadeOut("slow")',2000);
	}
	});
}
/*Listebaslik JQuery Bitti*/


/*Liste Detay Form Validation Başladı*/
$(document.listedetayislem).ready(function(){
$('#listedetayislem').click(function(){
var valid = '';
var isr = ' gerekli.';
var listedetayId=$('#listedetayId').val();
var ldaciklama=$('#ldaciklama').val();
if(ldaciklama=="")
{
valid += 'Liste Detay Açıklama'+isr;
}
if (valid!='') {	
			$("#listedetayislemdis").fadeIn("slow");
			$("#listedetayislemdis").html("Hata : "+valid);
}else {
			var kayitformdatastr ='ldaciklama=' + ldaciklama + '&listebaslikId=' +$('#listebaslikId').val();
			$("#listedetayislemdis").css("display", "block");
			$("#listedetayislemdis").html("Kaydınız Yapılıyor .... ");
			$("#listedetayislemdis").fadeIn("slow");
			var islem =''
			if(listedetayId==0){
			islem  ='0';
			}else{
			islem  ='1';
			kayitformdatastr = kayitformdatastr + '&listedetayId=' + listedetayId;
			}
			kayitformdatastr = kayitformdatastr.replace(/\n/g, "<br />")
			setTimeout("listedetayjqislem('"+kayitformdatastr+"','"+islem+"')",2000);
}
return false;
});
});
/*Liste Detay  Form Validation Bitti*/


/*Liste Detay  JQuery Başladı*/
function listedetayjqislem(kayitformdatastr,islem){
	if (islem=='0'){var islemurl='../islemler/islemler.php?islem=listedetayekle'}
	else{var islemurl='../islemler/islemler.php?islem=listedetayduzenle'}
	$.ajax({	
		type: "POST",
		url: islemurl,
		data: kayitformdatastr,
		cache: false,
		success: function(html){
		$("#listedetayislemdis").fadeIn("slow");
		$("#listedetayislemdis").html(html);
		setTimeout('$("#listedetayislemdis").fadeOut("slow")',2000);
	}
	});
}
/*Liste Detay  JQuery Bitti*/


/*Olay Form Validation Başladı*/
$(document.olayislem).ready(function(){
$('#olayislem').click(function(){
var valid = '';
var isr = ' gerekli.';
var olayid=$('#olayid').val();

var olay=$('#olay').val();
if(olay=="")
{
valid += 'Olay'+isr;
}
var bastarih=$('#bastarih').val();
if(bastarih=="")
{
valid += 'Başlangıç Tarihi '+isr;
}
var bittarih=$('#bittarih').val();
if(bittarih=="")
{
valid += 'Bitiş Tarihi'+isr;
}

if (valid!='') {	
			$("#olayislemdis").fadeIn("slow");
			$("#olayislemdis").html("Hata : "+valid);
}else {
			var kayitformdatastr ='olay=' + olay + '&bastarih=' + bastarih + '&bittarih=' + bittarih;
			$("#olayislemdis").css("display", "block");
			$("#olayislemdis").html("Kaydınız Yapılıyor .... ");
			$("#olayislemdis").fadeIn("slow");
			var islem =''
			if(olayid==0){
			islem  ='0';
			}else{
			islem  ='1';
			kayitformdatastr = kayitformdatastr + '&olayid=' + olayid;
			}
			kayitformdatastr = kayitformdatastr.replace(/\n/g, "<br />")
			setTimeout("olayjqislem('"+kayitformdatastr+"','"+islem+"')",2000);
}
return false;
});
});
/*Olay Form Validation Bitti*/


/*Olay JQuery Başladı*/
function olayjqislem(kayitformdatastr,islem){
	if (islem=='0'){var islemurl='../islemler/islemler.php?islem=olayekle'}
	else{var islemurl='../islemler/islemler.php?islem=olayduzenle'}
	$.ajax({	
		type: "POST",
		url: islemurl,
		data: kayitformdatastr,
		cache: false,
		success: function(html){
		$("#olayislemdis").fadeIn("slow");
		$("#olayislemdis").html(html);
		setTimeout('$("#olayislemdis").fadeOut("slow")',2000);
	}
	});
}
/*Olay JQuery Bitti*/

/*Kullanıcı Form Validation Başladı*/
$(document.kullanicitanimislem).ready(function(){
$('#kullanicitanimislem').click(function(){
var valid = '';
var isr = ' gerekli.';
var kullaniciid=$('#kullaniciid').val();
var adsoyad=$('#adsoyad').val();
if(adsoyad=="")
{
valid += 'Ad Soyad'+isr;
}

if (valid!='') {	
			$("#kullanicitanimislemdis").fadeIn("slow");
			$("#kullanicitanimislemdis").html("Hata : "+valid);
}else {
			var kayitformdatastr ='adsoyad=' + adsoyad + '&birimid=' + $('#birimid').val() + '&unvanid=' + $('#unvanid').val() + '&email=' + $('#email').val()+ '&sifre=' + $('#sifre').val() + '&telefon=' + $('#telefon').val() + '&gorevid=' + $('#gorevid').val();
			$("#kullanicitanimislemdis").css("display", "block");
			$("#kullanicitanimislemdis").html("Kaydınız Yapılıyor .... ");
			$("#kullanicitanimislemdis").fadeIn("slow");
			var islem =''
			if(kullaniciid==0){
			islem  ='0';
			}else{
			islem  ='1';
			kayitformdatastr = kayitformdatastr + '&kullaniciid=' + kullaniciid;
			}
			kayitformdatastr = kayitformdatastr.replace(/\n/g, "<br />")
			setTimeout("KullaniciTanimjqislem('"+kayitformdatastr+"','"+islem+"')",2000);
}
return false;
});
});
/*Kullanıcı tanım Form Validation Bitti*/

/*Kullanıcı tanım JQuery Başladı*/
function KullaniciTanimjqislem(kayitformdatastr,islem){
	if (islem=='0'){var islemurl='../islemler/islemler.php?islem=kullaniciekle'}
	else{var islemurl='../islemler/islemler.php?islem=kullaniciduzenle'}
	$.ajax({	
		type: "POST",
		url: islemurl,
		data: kayitformdatastr,
		cache: false,
		success: function(html){
		$("#kullanicitanimislemdis").fadeIn("slow");
		$("#kullanicitanimislemdis").html(html);
		setTimeout('$("#kullanicitanimislemdis").fadeOut("slow")',2000);
	}
	});
}
/*Kullanıcı tanım JQuery Bitti*/
