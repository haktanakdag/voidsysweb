<script>
function resPopUp(quizid) {
    window.open("quizuygula.php?quizid="+quizid, "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=800, left=600, width=800, height=600");
}
</script>
<?php
    $sayfaad="adminpanel.php?lx=quizler.php";
    $sayfaadEkle="adminpanel.php?lx=quizform.php&islem=ekle";
    $sayfaadDuzenle="adminpanel.php?lx=quizform.php&islem=duzenle";
    $sayfaadQuizSorular="adminpanel.php?lx=quizsorular.php";
    //s$sayfaadQuizSoruEkle="adminpanel.php?lx=quizsoruform.php&islem=ekle";
    $quizuygula="#";
    $quizsonuc="adminpanel.php?lx=quizsonuc.php";
    $quizler = new Quiz();
    $forms = new clsForms();
    $derssayi =$quizler->QuizSayiBul();
    if($sil){$quizler-> QuizSil($sil);}
    $sayfala =10;
    $search = $forms->doSearch(array("id","quizad","dersad"),$txtara);
    $pagerString=$forms->doPager($sayfala ,$sayfano,$derssayi->sayi,$sayfaad);
    $data = $quizler->QuizleriGetir($pagerString,$search);
    $forms->doform(array('basla','arama',$sayfaad));
    $forms->doInput(array('txtara',$txtara));
    $forms->doButton(array('ara','Ara'));
    $forms->doBaglanti(array('yeniekle','Yeni Ekle',$sayfaadEkle));
    $forms->doform(array('bitir'));
    $forms->doGrid(
    array(array("No",'5%'),array("Quiz Ad",'10%'),array("Ders Ad",'10%'))
    ,array("id","quizad","dersad")
    ,$data
    ,array(array("sil",$sayfaad,"Sil")
          ,array("duzenle",$sayfaadDuzenle,"Düzenle")
          ,array("quizid",$sayfaadQuizSorular,"Sorular")
          //,array("quizid",$sayfaadQuizSoruEkle,"Soru Ekle")
          ,array("quizid",$quizsonuc,"Quiz Sonuç")
          ,array("quizid",$quizuygula,"Quiz Uygula","resPopUp(#)")
          )
    ,"gridTable"
    );
    $pagerString=$forms->doPager($sayfala ,$sayfano,$derssayi->sayi,$sayfaad);
?>