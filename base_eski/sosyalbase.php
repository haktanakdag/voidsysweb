<?php
$anahtarlar = new Anahtarlar();
$urunler = new SosyalMedya();
if($anahtarlink==""){
    $durunler = $urunler->KayitlariGetirAnasayfayaGore();
}else{
    $danahtarlar =$anahtarlar->AnahtarGetirAdaGore($anahtarlink);
    $hashtag =$danahtarlar->id;
    $durunler = $urunler->KayitlariGetirAnahtaraGore($hashtag);
}


?>
<div id="main-content" class="col-md-9 fix-right">
        <div class="gutter-8px">
            <?php 
            if($durunler)
            foreach ($durunler as $durun)
            {
            ?>
            <div class="col-sm-4">
                    <article>
                   <?php  echo $durun->kayitbaglanti; ?>
                    </article>
            </div>
            <?php   } ?>          
        </div>
</div>