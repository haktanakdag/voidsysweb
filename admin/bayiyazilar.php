<?php
$olay = new Yazi();
$dolay = $olay->YazilariGetir();
$form = new clsForms();
$form->doForm(array('basla'));
?>
<fieldset>
    <legend>Bayi Yazı Form</legend>
    <table width='100%' cellpadding='2' cellspacing='2'>
        <tr><td>
<?php
foreach ($dolay as $d){
    echo $form->doCheckGroup(array($d->id,$d->id,"",$d->yaziad));
    echo "<br>";
}
?>
   </td></tr> </table>
</fieldset>
<?php
$form->doButton(array('bayiyaziislem','Gönder'));
$form->doForm(array('bitir'));
?>