<div id="stoklist" class="w3-modal">
    <div class="w3-modal-content w3-card-4">
      <header class="w3-container w3-teal"> 
        <span onclick="stoklistekapat()" 
        class="w3-button w3-display-topright">&times;</span>
        <h2>Stok Liste</h2>
        <input type="hidden" name="texuid" id="texuid"></input>
        <input id="stoksearchinput" type="text" placeholder="Search.."></input>
      </header>
<table>
<thead>
  <tr>
    <th>Stok ID</th>
    <th>Stok Kodu</th>
    <th>Stok Adı</th>
  </tr>
</thead>
<tbody id="stoklisttable">
<?php 
$stok = new Stok();
$dstok = $stok->StoklariGetir();
foreach ($dstok as $dm) {
    echo "<tr>";
    echo "<td><a href='#' onclick=stoksecildi(".$dm->id.",'')>".$dm->id."</td>";
    echo "<td><a href='#' onclick=stoksecildi(".$dm->id.",'')>".$dm->stokkod."</td>";
    echo "<td><a href='#' onclick=stoksecildi(".$dm->id.",'')>".$dm->stokad."</td>";
    echo "</tr>";
}
?>
</tbody>
</table>
</div>
</div>
<script>
function stoklisteac(uuid)
{
     document.getElementById('stoklist').style.display='block'
     $("#texuid").val(uuid);
}
function stoklistekapat()
{
    $("#texuid").val('');
     document.getElementById('stoklist').style.display='none'
     
}
$(document).ready(function(){
  $("#stoksearchinput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#stoklisttable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
<script>
function stoksecildi(stokid='',uuid="") {
var uuideger ="";
if(stokid==''){
    stokid=dinamikDegerDondur(uuid,"stokid_");
}
uuideger = $('#texuid').val()
if(uuideger==""){
    uuideger =uuid;
}
var textname = "stokid_"+uuideger;
var divname = "div_"+uuideger;
var birimdivname = "birimdiv_"+uuideger;
var birimkdvdivname = "birimkdv_"+uuideger;
var evalstring = "$('#"+textname+"').val('"+stokid+"')";
eval(evalstring);
$("#texuid").val('');
document.getElementById('stoklist').style.display='none'
stokgetir(divname,birimdivname,birimkdvdivname,stokid);
tutarHesapla(uuid);
}

function stokgetir(divname,birimdivname,birimkdvdivname,stokid){
    
    $.ajax({	
        type: "POST",
        url: "../islemler/islemler.php?jqstokcek=var",
        data: "stokid="+stokid,
        cache: false,
        success: function(data){
        data.replace(/\n/g, "&nbsp;");
        var divtext = "$('#"+divname+"').html('"+data+"');";
        eval(divtext);
        }
        });
        
     $.ajax({	
        type: "POST",
        url: "../islemler/islemler.php?jqstokbirimcek=var",
        data: "stokid="+stokid,
        cache: false,
        success: function(data){
        data.replace(/\n/g, "&nbsp;");
        var divtext = "$('#"+birimdivname+"').html('"+data+"');";
        eval(divtext);
        }
        });
        
      $.ajax({	
        type: "POST",
        url: "../islemler/islemler.php?jqstokkdvcek=var",
        data: "stokid="+stokid,
        cache: false,
        success: function(data){
        data.replace(/\n/g, "&nbsp;");
        var divtext = "$('#"+birimkdvdivname+"').html('"+data+"');";
        eval(divtext);
        }
        });
}

var kdvdahil =true;

$("#kdvdahil").change(function() {
    if($(this).prop('checked')) {
      kdvdahil=true;
    } else {
      kdvdahil =false;
    }
});

function tutarHesapla(uuid,silinme="eklenensatir") {
    var miktardeger= parseFloat(dinamikDegerDondur(uuid,"miktar_"));
    var birimfiyatdeger= parseFloat(dinamikDegerDondur(uuid,"birimfiyat_"));
    var kalemkdv= parseFloat(dinamikTextDondur(uuid,"birimkdv_"));
    var tutar =miktardeger*birimfiyatdeger;
    var kdvcarpan=(100+kalemkdv)/100;
    var nettutar=0;
    var tempdeger =0;
    if(kdvdahil){
      tutar=tutar/kdvcarpan;
      kalemkdv=(miktardeger*birimfiyatdeger)-tutar;
      nettutar = tutar +kalemkdv;
    }else
    {
      tutar=tutar*kdvcarpan;
      kalemkdv=tutar-(miktardeger*birimfiyatdeger);
      nettutar = tutar -kalemkdv;
      tempdeger =tutar;
      tutar=nettutar;
      nettutar=tempdeger;
    }
    //kalemkdv=parseFloat("1"+","+kalemkdv).toFixed(2)
    if(miktardeger>0 && birimfiyatdeger>0 && kalemkdv>0){
        
    kdvKontrolEt(uuid);
   
    
    var mevcutbruttutar = parseFloat(dinamikTextDondur(uuid,"bruttutardiv_"));
    var mevcutnettutar = parseFloat(dinamikTextDondur(uuid,"nettutardiv_"));
    var mevcutkdvtutar = parseFloat(dinamikTextDondur(uuid,"tutarkdvdiv_"));
    if(mevcutbruttutar>0 || mevcutnettutar>0 || mevcutkdvtutar>0 ){
       Toplam(uuid,mevcutbruttutar,mevcutnettutar,mevcutkdvtutar,-1); 
    }
    dinamikDegerSetEt(uuid,"tutarkdvdiv_",(parseFloat(kalemkdv).toFixed(2)));
    dinamikDegerSetEt(uuid,"bruttutardiv_",parseFloat(tutar).toFixed(2));
    dinamikDegerSetEt(uuid,"nettutardiv_",parseFloat(nettutar).toFixed(2));
    if(!(silinme=="silinensatir")){
    Toplam(uuid,parseFloat(tutar).toFixed(2),parseFloat(nettutar).toFixed(2),parseFloat(kalemkdv).toFixed(2),1);
    }
    }else{
        dinamikDegerSetEt(uuid,"miktar_",0);
        dinamikDegerSetEt(uuid,"birimfiyat_",0);
        dinamikDegerSetEt(uuid,"tutarkdvdiv_",0);
        dinamikDegerSetEt(uuid,"bruttutardiv_",0);
        dinamikDegerSetEt(uuid,"nettutardiv_",0);
        Toplam(uuid,0,0,0,-1);
    }
}





function Toplam(uuid,bruttutar,nettutar,kdvtutar,durum){
    var mevcutbruttoplam=0;
    mevcutbruttoplam = parseFloat($('#bruttoplam').text());
    var mevcutkdvtoplam=0;
    mevcutkdvtoplam =parseFloat($('#kdvtoplam').text());
    var mevcutnettoplam =0;
    mevcutnettoplam = parseFloat($('#nettoplam').text());
  
    if(durum<0){
      bruttutar=parseFloat(bruttutar)*durum;
      kdvtutar=parseFloat(kdvtutar)*durum;
      nettutar=parseFloat(nettutar)*durum;
    }

    
    var bruttoplam=parseFloat(bruttutar)+parseFloat(mevcutbruttoplam);
    dinamikDegerSetEt("","bruttoplam",parseFloat(bruttoplam).toFixed(2));
    
   
    var kdvtoplam=parseFloat(kdvtutar)+parseFloat(mevcutkdvtoplam);
    dinamikDegerSetEt("","kdvtoplam",parseFloat(kdvtoplam).toFixed(2));
 
    
    var nettoplam=parseFloat(nettutar)+parseFloat(mevcutnettoplam);
    dinamikDegerSetEt("","nettoplam",parseFloat(nettoplam).toFixed(2));
}

function dinamikDegerDondur(dinamikdeger,degeradi) {
    var textname = "#"+degeradi+dinamikdeger;
    var text="$('"+textname+"').val();"
    var deger =eval(text);
    return deger;
}
function dinamikTextDondur(dinamikdeger,degeradi) {
    var textname = "#"+degeradi+dinamikdeger;
    var text="$('"+textname+"').text();"
    var deger =eval(text);
    return deger;
}

function dinamikDegerSetEt(dinamikdeger,degeradi,sonuc) {
    var textname = "#"+degeradi+dinamikdeger;
    var text="$('"+textname+"').html('"+sonuc+"');"
    eval(text);
    return true;
}
function dinamikValSetEt(dinamikdeger,degeradi,sonuc) {
    var textname = "#"+degeradi+dinamikdeger;
    var text="$('"+textname+"').val('"+sonuc+"');"
    eval(text);
    return true;
}
</script>