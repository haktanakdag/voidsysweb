<?php
$olay = new Olaylar();
$dolay = $olay->OlaylariGetir();
$form = new clsForms();
$form->doForm(array('basla'));
?>
<fieldset>
    <legend>Bayi Olay Form</legend>
    <table width='100%' cellpadding='2' cellspacing='2'>
        <tr><td>
<?php
foreach ($dolay as $d){
    echo $form->doCheckGroup(array($d->id,$d->id,"",$d->olay));
    echo "<br>";
}
?>
   </td></tr> </table>
</fieldset>
<?php
$form->doButton(array('bayiolayislem','Gönder'));
$form->doForm(array('bitir'));
?>