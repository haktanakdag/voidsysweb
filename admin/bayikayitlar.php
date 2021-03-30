<?php
$kayit = new Kayit();
$dkayit = $kayit->KayitlariGetir();
$form = new clsForms();
$form->doForm(array('basla'));
?>
<fieldset>
    <legend>Bayi Kayit Form</legend>
    <table width='100%' cellpadding='2' cellspacing='2'>
        <tr><td>
<?php
if ($dkayit)
foreach ($dkayit as $d){
    echo $form->doCheckGroup(array($d->id,$d->id,"",$d->kayitad));
    echo "<br>";
}
?>
   </td></tr> </table>
</fieldset>
<?php
$form->doButton(array('bayikayitislem','Gönder'));
$form->doForm(array('bitir'));
?>