<div class="list-group">
<?php
$danahtarlar = $anahtarlar->AnahtarlariGetirGrubaGore(41 ," and ozel<>1");
foreach($danahtarlar as $a){
    echo "<a href='index.php?secilianahtar=$a->id' class='list-group-item'>" . $a->anahtarad ."</a>";
}
?>
</div>