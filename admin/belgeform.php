<?php 
$forms = new clsForms()
?>

<div class="tab">
  <button class="tablinks" onclick="TabBelge(event, 'Baslik')" id="defaultOpen">Başlık</button>
  <button class="tablinks" onclick="TabBelge(event, 'Kalemler')">Kalemler</button>
  <button class="tablinks" onclick="TabBelge(event, 'Iskontolar')">İskontolar</button>
  <button class="tablinks" onclick="TabBelge(event, 'Toplamlar')">Toplamlar</button>
</div>

<!-- Tab content -->

<div id="Baslik" class="tabcontent" >
   <h2>Belge Başlık Bilgileri</h2> 
   <hr>
<?php
//$forms->doForm(array("basla","belgeform"));
?>

   Belge Tipi : <?php
$belgetiplist = array( array("id"=>"0", "belgetip"=>"Satış"),array("id"=>"1", "belgetip"=>"Alış")); 
   $forms->doManuelSelect(array("belgetip","belgetip"),$belgetiplist);?>
   <hr>
Belge Türü : <?php
  $belgeturlist = array( 
   array("id"=>"0", "belgetur"=>"Fatura")
  ,array("id"=>"1", "belgetur"=>"İrsaliye")
  ,array("id"=>"2", "belgetur"=>"Sipariş")
  ,array("id"=>"3", "belgetur"=>"Talep")
  ,array("id"=>"4", "belgetur"=>"Teklif")
  ); 
   $forms->doManuelSelect(array("belgetur","belgetur"),$belgeturlist);?>
   <hr>
   Belge Numarası : <input type ="text" name="belgeno" id="belgeno" ></input>
   <hr>
   Cari : <input type ="listtext" name="carikod" id="carikod" ></input> <button onclick="document.getElementById('carilist').style.display='block'" class="w3-button w3-black">Cari Listesi</button>
   <hr>
   Belge Tarihi : <?=$forms->doDateInput(array("belgetarih"));?>
    <hr>
   Kdv Dahil : <?=$forms->doCheckGroup(array("kdvdahil","kdvdahil","checked"));?>
</div>

<div id="Kalemler" class="tabcontent">
  <h3>Kalem bilgileri</h3>
<input type="button" value="Kalem Ekle" id="satirekle" onclick="FSatirEkle()" href="#" class="btn">
<div class="divTable" id="kalemler" name="kalemler">
<div class="divTableBody">
<div class="divTableRow" >
<div class="divTableCell">&nbsp;Ürün</div>
<div class="divTableCell">&nbsp;Miktar</div>
<div class="divTableCell">&nbsp;Birim Fiyat</div>
<div class="divTableCell">&nbsp;Kdv Oran</div>
<div class="divTableCell">&nbsp;Kdv</div>
<div class="divTableCell">&nbsp;Tutar(Kdv Hariç)</div>
<div class="divTableCell">&nbsp;Tutar(Kdv Dahil)</div>
<div class="divTableCell">&nbsp;Opsiyon</div>
</div>
</div>
</div>
</div>
<div id="Iskontolar" class="tabcontent">
  <h3>İskonto Bilgileri Bilgileri</h3>
  Kdv Farklı :<input type="hidden" id="kdvsayac" name="kdvsayac" value="YOK"></input><span name="iskaciklama" id="iskaciklama"></span><br>
  <input type="hidden" id="kdvsayacoran" name="kdvsayacoran" value="0">
  Fatura Altı İskonto 1 :<select name="isktip1" id="isktip1" ><option value="Tutar">Tutar</option><option value="Oran">Oran</option></select><input type="text" id="iskonto1" name="iskonto1" onblur="IskHesapla()"><br>
  Fatura Altı İskonto 2 :<select name="isktip2" id="isktip2" ><option value="Tutar">Tutar</option><option value="Oran">Oran</option></select><input type="text" id="iskonto2" name="iskonto2" onblur="IskHesapla()"><br>
  Fatura Altı İskonto 3 :<select name="isktip3" id="isktip3" ><option value="Tutar">Tutar</option><option value="Oran">Oran</option></select><input type="text" id="iskonto3" name="iskonto3" onblur="IskHesapla()"><br>
</div>
<div id="Toplamlar" class="tabcontent">
  <h3>Toplam Bilgileri</h3>
  Matrah :<span id="bruttoplam" name="bruttoplam">0</span><span id="parabirim" name="parabirim">₺</span><br>
  İskonto Toplam :<span id="iskontotoplam" name="iskontotoplam">0</span><span id="parabirim" name="parabirim">₺</span><br>
  Ara Toplam :<span id="aratoplam" name="aratoplam">0</span><span id="parabirim" name="parabirim">₺</span><br>
  Kdv Toplam :<span id="kdvtoplam" name="kdvtoplam">0</span><span id="parabirim" name="parabirim">₺</span><br>
  Genel Toplam :<span id="nettoplam" name="nettoplam">0</span><span id="parabirim" name="parabirim">₺</span>
  <hr>
  <input type="submit" name="belgekaydetislem" id="belgekaydetislem" onclick="belgekaydet()" value="Kaydet">
</div>

<?php include "belgeform_cariliste.php"; ?>
<?php include "belgeform_stokliste.php"; ?>
<?php
//$forms->doForm(array("bitir"));
?>
<script>
function guid() {
  function s4() {
    return Math.floor((1 + Math.random()) * 0x10000)
      .toString(16)
      .substring(1);
  }
  return s4() + s4() + '-' + s4() + '-' + s4() + '-' + s4() + '-' + s4() + s4() + s4();
}
function guid2() {
  var date = Date.now();

    // If created at same millisecond as previous
    if (date <= guid2.previous) {
        date = ++guid2.previous;
    } else {
        guid2.previous = date;
    }

    return date;
}
function FSatirEkle() {
    var uuid = guid2();
    var stoklistbtn = "<button onclick=stoklisteac('"+uuid+"') class='w3-button w3-black'>Stok Listesi</button>"
    var stokkodinput="<input type ='kucuktext' name='stokid_"+uuid+"' id='stokid_"+uuid+"' onblur=tutarHesapla('"+uuid+"') onchange=stoksecildi('','"+uuid+"')></input>";
    var stokurundiv = "<span name='div_"+uuid+"' id ='div_"+uuid+"' width='20px'></span>";
    var miktarinput="<input type ='kalemtext' name='miktar_"+uuid+"' id='miktar_"+uuid+"' value='0' onblur=tutarHesapla('"+uuid+"')></input>";
    var stokbirimdiv = "<span name='birimdikalemtextv_"+uuid+"' id ='birimdiv_"+uuid+"' width='20px'></span>";
    var birimfiyatinput="<input type ='kalemtext' name='birimfiyat_"+uuid+"' id='birimfiyat_"+uuid+"' value='0' onblur=tutarHesapla('"+uuid+"')></input>";
    var birimkdv = "<span name='birimkdv_"+uuid+"' id ='birimkdv_"+uuid+"'  width='20px'></span>";
    var tutarkdvdiv = "<span name='tutarkdvdiv_"+uuid+"' id ='tutarkdvdiv_"+uuid+"' width='20px'></span>";
    var tutardiv = "<span name='bruttutardiv_"+uuid+"' id ='bruttutardiv_"+uuid+"' width='20px'></span>";
    var tutarnetdiv = "<span name='nettutardiv_"+uuid+"' id ='nettutardiv_"+uuid+"' width='20px'></span>";
    $("#kalemler").append("<div name='"+uuid+"' id='"+uuid+"' class='divTableRow' >\n\
    <div class='divTableCell'>"+ stoklistbtn +stokkodinput+"-"+ stokurundiv +"</div>\n\
    <div class='divTableCell'>"+miktarinput+"-"+stokbirimdiv+"</div>\n\
    <div class='divTableCell'>"+birimfiyatinput+"</div>\n\
    <div class='divTableCell'>"+birimkdv+"</div>\n\
    <div class='divTableCell'>"+tutarkdvdiv+" ₺</div>\n\
    <div class='divTableCell'>"+tutardiv+" ₺</div>\n\
    <div class='divTableCell'>"+tutarnetdiv+" ₺</div>\n\
    <div class='divTableCell'><button onclick=FSatirSil('"+uuid+"')>Kalem Sil</button></div></div>");
    
}
function FSatirSil(trid) {
 tutarHesapla(trid,"silinensatir");
  $("#"+trid).empty("<div name='"+trid+"' id='"+trid+"' class='divTableRow' ><div class='divTableCell'>"+trid+"</div><div class='divTableCell'>&nbsp;</div><div class='divTableCell'>&nbsp;</div><div class='divTableCell'>&nbsp;</div><div class='divTableCell'><button onclick=FSatirSil('"+trid+"')>Kalem Sil</button></div></div>")
}
</script>
<script>
function iskontokontrol(){
    if($('#iskonto1').val()<0 || $('#iskonto1').val()==0){
        $('#iskonto1').val(0);
    }
    if($('#iskonto2').val()<0 || $('#iskonto2').val()==0 ){
        $('#iskonto2').val(0);
    }
    if($('#iskonto3').val()<0 || $('#iskonto3').val()==0){
        $('#iskonto3').val(0);
    }
}
function IskHesapla() {
 iskontokontrol();
 var mevcutiskontotoplam=0;
 var isk1=0;
 var isk2=0;
 var isk3=0;

 if($('#iskonto1').val()>0 || $('#iskonto2').val()>0 || $('#iskonto3').val()>0 ){
    var bruttoplam=$('#bruttoplam').text();
    if($('#isktip1').val()=="Tutar" && $('#iskonto1').val()>0){
        isk1=parseFloat($('#iskonto1').val());
        mevcutiskontotoplam = parseFloat(mevcutiskontotoplam) + parseFloat(isk1);
        dinamikDegerSetEt("","iskontotoplam",parseFloat(mevcutiskontotoplam));
    }
    if($('#isktip1').val()=="Oran" && $('#iskonto1').val()>0){
        isk1=parseFloat($('#iskonto1').val());
        mevcutiskontotoplam=mevcutiskontotoplam+(bruttoplam*isk1)/100
        dinamikDegerSetEt("","iskontotoplam",parseFloat(mevcutiskontotoplam));
    }
     if($('#isktip2').val()=="Tutar" && $('#iskonto2').val()>0){
        isk2=parseFloat($('#iskonto2').val());
        mevcutiskontotoplam = parseFloat(mevcutiskontotoplam) + parseFloat(isk2);
        dinamikDegerSetEt("","iskontotoplam",parseFloat(mevcutiskontotoplam));
    }
     if($('#isktip2').val()=="Oran" && $('#iskonto2').val()>0){
        isk2=parseFloat($('#iskonto2').val());
        mevcutiskontotoplam=mevcutiskontotoplam+((bruttoplam-mevcutiskontotoplam)*isk2)/100
        dinamikDegerSetEt("","iskontotoplam",parseFloat(mevcutiskontotoplam));
    }
    if($('#isktip3').val()=="Tutar" && $('#iskonto3').val()>0){
        isk3=parseFloat($('#iskonto3').val());
        mevcutiskontotoplam = parseFloat(mevcutiskontotoplam) + parseFloat(isk3);
        dinamikDegerSetEt("","iskontotoplam",parseFloat(mevcutiskontotoplam));
    }
     if($('#isktip3').val()=="Oran" && $('#iskonto3').val()>0){
        isk3=parseFloat($('#iskonto3').val());
        mevcutiskontotoplam=mevcutiskontotoplam+((bruttoplam-mevcutiskontotoplam)*isk3)/100
        dinamikDegerSetEt("","iskontotoplam",parseFloat(mevcutiskontotoplam).toFixed(2));
    }
    var aratoplam =bruttoplam-mevcutiskontotoplam;
    dinamikDegerSetEt("","aratoplam",parseFloat(aratoplam).toFixed(2));
    var kdvoran= parseFloat($('#kdvsayacoran').val());
    var kdvcarpan=(100+kdvoran)/100;
    var kdvtoplam=0;
    var geneltoplam=0;

     kdvtoplam= aratoplam - (aratoplam/kdvcarpan)
     dinamikDegerSetEt("","kdvtoplam",parseFloat(kdvtoplam).toFixed(2));
     geneltoplam=aratoplam + parseFloat(kdvtoplam);
     dinamikDegerSetEt("","nettoplam",parseFloat(geneltoplam).toFixed(2));
 }
}
function kdvKontrolEt(uuid){
     if(dinamikDegerDondur("","kdvsayac")=="YOK"){
     dinamikValSetEt("","kdvsayac",parseFloat(dinamikTextDondur(uuid,"birimkdv_")));
     dinamikValSetEt("","kdvsayacoran",parseFloat(dinamikTextDondur(uuid,"birimkdv_")));
     }else{
         var eskikdv=dinamikDegerDondur("","kdvsayac");
         var yenikdv=dinamikTextDondur(uuid,"birimkdv_");
          if(!(eskikdv==yenikdv)){
             satiraltiiskkapat();
             dinamikDegerSetEt("","iskaciklama","** Faturanın kalemlerinde farklı kdv oranları olduğu için fatura altı iskonto oranı giremezsiniz..!");
          }else{
             dinamikDegerSetEt("","iskaciklama","** Faturanın kalemlerinde farklı kdv oranları olmamasına dikkat ediniz. Aksi durumda bu yazacağınız değerler hesaplamaya dahil olmayacaktır.!");
             satiraltiiskac();
          }
        
     }
}
function satiraltiiskkapat(){
    $('#iskonto1').val("");
    $('#iskonto1').prop('disabled', true);
    $('#iskonto2').val("");
    $('#iskonto2').prop('disabled', true);
    $('#iskonto3').val("");
    $('#iskonto3').prop('disabled', true);
    
    $('#isktip1').prop('disabled', true);
    $('#isktip2').prop('disabled', true);
    $('#isktip3').prop('disabled', true);
}
function satiraltiiskac(){
    $('#iskonto1').prop('disabled', false);
    $('#iskonto2').prop('disabled', false);
    $('#iskonto3').prop('disabled', false);
    $('#isktip1').prop('disabled', false);
    $('#isktip2').prop('disabled', false);
    $('#isktip3').prop('disabled', false);
}
</script>

<script>
function TabBelge(evt, tabname) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(tabname).style.display = "block";
    evt.currentTarget.className += " active";
    //alert($('#belgetip option:selected').text());
    //, select, textarea'
/*$('input').each(
    function(index){  
        var input = $(this);
        alert('Type: ' + input.attr('type') + 'Name: ' + input.attr('name') + 'Value: ' + input.val());
    }
);*/
   
}
 document.getElementById("defaultOpen").click();

</script>
<script>
function belgekaydet(){
    if(formbaslikKontrol()==true){
        alert("Belge Kaydedilebilir");
        CookieKaydet();
    };
    
}
</script>
<script>
function formbaslikKontrol(){
    var durum =true;
    
    if($('#belgeno').val()==""){
        alert("Belge Numarası Boş Olamaz!");
        durum= false;
    }
    if($('#carikod').val()==""){
        alert("Cari Kod Boş Olamaz!");
        durum= false;
    }
    if($('#belgetarih').val()==""){
        alert("Tarih Boş Olamaz!");
        durum= false;
    }
    
    var kalemsayi=0;
    var kalemadi="";
    var indexof=-1;
    $('input').each(
    function(index){  
        var input = $(this);
          kalemadi= input.attr('name');
          if(!kalemadi==""){
          indexof =kalemadi.indexOf("miktar_");
          }
          
        if (indexof >-1){
            if(input.val()>0){
                kalemsayi=kalemsayi+1;
            }
        }
        //alert('Type: ' + input.attr('type') + 'Name: ' + input.attr('name') + 'Value: ' + input.val());
    }
);

if(kalemsayi==0){
        alert("Kalem Sayı 0 Olamaz!");
        durum= false; 
    }
return durum;
}
//setcookie("belgebaslik","", time()-3600);
</script>
<script>
function CookieKaydet(){
    var belgebaslikstr ="";
    belgebaslikstr = "belgetipi="+$('#belgetip option:selected').text();
    belgebaslikstr= belgebaslikstr + "/" +"belgetur="+$('#belgetur option:selected').text();
    belgebaslikstr = belgebaslikstr+ "/" +"belgetur="+$('#belgetur option:selected').text();
    belgebaslikstr = belgebaslikstr+ "/" +"belgeno="+$('#belgeno').val();
    belgebaslikstr = belgebaslikstr+ "/" +"carikod="+$('#carikod').val();
    belgebaslikstr =belgebaslikstr + "/" +"belgetarih="+$('#belgetarih').val();
    alert(belgebaslikstr);
    var belgedetaystr="";
    
   $('input').each(
    function(index){  
        var input = $(this);
       belgedetaystr = belgedetaystr+ + "/" + 'Type: ' + input.attr('type') + 'Name: ' + input.attr('name') + 'Value: ' + input.val();
    }
);
 alert(belgedetaystr);
    //alert(belgebaslikstr);
}
//setcookie("belgebaslik","", time()-3600);
</script>