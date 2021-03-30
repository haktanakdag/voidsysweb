<!--<div id="fontSizeWrapper">
  <label for="fontSize">Font size</label>
  <input type="range" value="1" id="fontSize" step="0.5" min="0.5" max="5" />
</div>
<ul class="tree">
  <li>
    <input type="checkbox" checked="checked" id="c1" />
    <label class="tree_label" for="c1">Level 0</label>
    <ul>
      
          <li><span class="tree_label">Level 2</span></li>
          <li><span class="tree_label">Level 2</span></li>

    </ul>
  </li>
   <li>
    <input type="checkbox" id="c2" />
    <label class="tree_label" for="c2">Level 0</label>
    <ul>
      
          <li><span class="tree_label">Level 2</span></li>
          <li><span class="tree_label">Level 2</span></li>

    </ul>
  </li>
</ul>-->
<?php
$anahtarlar = new Anahtarlar();
$anahtargruplar = new Listeler();
$anahtargrup = $anahtargruplar->ListeBaslikGetirAciklamayaGore("Anahtar_Gruplari");
$danahtargrup = $anahtargruplar->ListeDetayGetirAciklamayaGore($anahtargrup->id,"Ürünler");
$danahtarlar = $anahtarlar->AnahtarlariGetirGrubaGore($danahtargrup->id);
$urunler = new Urun();
$urunfoto ="urun.png";
$forms = new clsForms();
?>
 <?php
if($masaid){
   $masalar = new Masa(); 
   $dmasa=$masalar->MasaAcikKapaliKontrol($masaid);
   $acikkapali =$dmasa->acikkapali;
}
if($kuryeid){
   $kuryeler = new Kurye(); 
   $dkurye=$kuryeler->KuryeAcikKapaliKontrol($kuryeid);
   $acikkapali =$dkurye->acikkapali;
}


$checked="";
if ($acikkapali=='1'){
    foreach($danahtarlar as $da){
    if($secilianahtar ==$da->id){
        $checked ="checked='checked'";
    }else{
        $checked="";
    }
        echo "<ul class='tree'><li><input type='checkbox' $checked id='$da->id' />";
        echo "<label class='tree_label' for='$da->id'>$da->anahtarad</label>";
        echo "<ul>";
        //echo "<h3>$da->anahtarad</h3>";  
        //echo "<hr>";
        $durunler = $urunler->UrunleriGetirAnahtaraGore($da->id);
            if($durunler){
                foreach($durunler as $urun){
                if($masaid){
                    echo "<li><span class='tree_label'><a href='adisyon.php?masaid=$masaid&urunid=$urun->id&secilianahtar=$da->id'><div class='urunler'>$urun->urunad</div></a></span></li>";
                }
                if($kuryeid){
                    echo "<li><span class='tree_label'><a href='paketservis.php?kuryeid=$kuryeid&urunid=$urun->id&secilianahtar=$da->id'><div class='urunler'>$urun->urunad</div></a></span></li>";
                }   
                }
            }
        echo "</ul></li></ul>";
        }
}else{
    echo "Önce adisyonu açınız.";
}
?>
	