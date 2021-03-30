<script>
function masaPopUp(masaid) {
    window.open("adisyon/adisyon.php?masaid="+masaid, "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=800, left=600, width=1000, height=600");
    window.onunload = refreshParent;
    function refreshParent() {
        window.opener.location.reload();
    }
}
</script>
<?php
$masalar = new Masa();
$dmasalar =$masalar->MasalariGetir();
foreach ($dmasalar as $masa){
    $masaacikkapali =$masalar->MasaAcikKapaliKontrol($masa->id);
    
    if($masaacikkapali->acikkapali==1){
        $masafoto ="./adisyon/img/masaacik.png";
    }else{
         $masafoto ="./adisyon/img/masakapali.png";
    }
    //adminpanel.php?lx=./adisyon/index.php&masaid=<?=$masa->id
?>
<!--<a href="adminpanel.php?lx=./adisyon/index.phpmasaid=<?=$masa->id?>"><div class="masalar"><?=$masa->masaad;?><img src="<?=$masafoto?>" name="<?=$masa->masaad?>"></div></a>-->
<a href="#" onclick='masaPopUp(<?=$masa->id;?>)'><div class="masalar"><?=$masa->masaad;?><img src="<?=$masafoto?>" name="<?=$masa->masaad?>"></div></a>
<?php }?> 