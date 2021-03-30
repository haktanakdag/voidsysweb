<?=$anahtaragore?>
<div class="wrap">
<?php
    
    $dersler = new Dersler();
    $ddersler =$dersler->DersleriGetir();
    $quizler = new Quiz();
    echo "<dl>";
    foreach ($ddersler as $dd){
        echo "<dt><b>".$dd->dersad."</b>";
        $dquizler = $quizler->QuizleriGetirDerseGore($dd->id);
        if($dquizler)
        foreach ($dquizler as $dq) {
        echo "<dd>".$dq->quizad."</dd>";            
        }    
        echo "</dt>";
    }
    echo "</dl>";
    ?>

</div>
<?php
    $sayfaad="adminpanel.php?lx=dersler.php";
    $sayfaadEkle="adminpanel.php?lx=derslerform.php&islem=ekle";
    $sayfaadDuzenle="adminpanel.php?lx=derslerform.php&islem=duzenle";
    $dersler = new Dersler();
    $forms = new clsForms();
    $derssayi =$dersler->DersSayiBul();
    if($sil){$dersler-> DersSil($sil);}
    $sayfala =10;
    $search = $forms->doSearch(array("id","dersad"),$txtara);
    $pagerString=$forms->doPager($sayfala ,$sayfano,$derssayi->sayi,$sayfaad);
    $data = $dersler->DersleriGetir($pagerString,$search);
    $forms->doform(array('basla','arama',$sayfaad));
    $forms->doInput(array('txtara',$txtara));
    $forms->doButton(array('ara','Ara'));
    $forms->doBaglanti(array('yeniekle','Yeni Ekle',$sayfaadEkle));
    $forms->doform(array('bitir'));
    $forms->doGrid(
    array(array("No",'10%'),array("Ders Ad",'70%'))
    ,array("id","dersad")
    ,$data
    ,array(array("sil",$sayfaad,"Sil"),array("duzenle",$sayfaadDuzenle,"Düzenle"))
    ,"gridTable"
    );
    $pagerString=$forms->doPager($sayfala ,$sayfano,$derssayi->sayi,$sayfaad);
?>