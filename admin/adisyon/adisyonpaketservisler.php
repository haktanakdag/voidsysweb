<script>
function kuryePopUp(kuryeid) {
    window.open("adisyon/paketservis.php?kuryeid="+kuryeid, "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=800, left=600, width=1000, height=600");
    window.onunload = refreshParent;
    function refreshParent() {
        window.opener.location.reload();
    }
}
</script>
<?php
$kuryeler = new Kurye();
$dkuryeler =$kuryeler->KuryeleriGetir();
foreach ($dkuryeler as $kurye){
    $kuryeacikkapali =$kuryeler->KuryeAcikKapaliKontrol($kurye->id);
    if($kuryeacikkapali->acikkapali==1){
        $kuryefoto ="./adisyon/img/kuryeacik.png";
    }else{
         $kuryefoto ="./adisyon/img/kuryekapali.png";
    }
    //adminpanel.php?lx=./adisyon/index.php&kuryeid=<?=$kurye->id
?>
<!--<a href="adminpanel.php?lx=./adisyon/index.phpkuryeid=<?=$kurye->id?>"><div class="kuryeler"><?=$kurye->kuryead;?><img src="<?=$kuryefoto?>" name="<?=$kurye->kuryead?>"></div></a>-->
<a href="#" onclick='kuryePopUp(<?=$kurye->id;?>)'><div class="kuryeler"><?=$kurye->kuryead;?><img src="<?=$kuryefoto?>" name="<?=$kurye->kuryead?>"></div></a>
<?php }?> 