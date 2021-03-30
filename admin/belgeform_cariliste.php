<div id="carilist" class="w3-modal">
    <div class="w3-modal-content w3-card-4">
      <header class="w3-container w3-teal"> 
        <span onclick="document.getElementById('carilist').style.display='none'" 
        class="w3-button w3-display-topright">&times;</span>
        <h2>Cari Liste</h2>
        <input id="carisearchinput" type="text" placeholder="Search.."></input>
      </header>
<table>
<thead>
  <tr>
    <th>Cari ID</th>
    <th>Cari Kodu</th>
    <th>Cari Unvan</th>
  </tr>
</thead>
<tbody id="carilisttable">
<?php 
$musteri = new Musteriler();
$dmusteri = $musteri->MusterileriGetir();
foreach ($dmusteri as $dm) {
    echo "<tr>";
    echo "<td><a href='#' onclick=musteriSecildi($dm->id,'$dm->musterikod','$dm->musteriunvan')>".$dm->id."</a></td>";
    echo "<td><a href='#' onclick=musteriSecildi($dm->id,'$dm->musterikod','$dm->musteriunvan')>".$dm->musterikod."</td>";
    echo "<td><a href='#' onclick=musteriSecildi($dm->id,'$dm->musterikod','$dm->musteriunvan')>".$dm->musteriunvan."</td>";
    echo "</tr>";
}
?>
</tbody>
</table>
</div>
</div>
<script>
$(document).ready(function(){
  $("#carisearchinput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#carilisttable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
<script>
function musteriSecildi(cariid,carikod,cariunvan) {
 $("#carikod").val(cariid +" - " + carikod + " - " +cariunvan);
 document.getElementById('carilist').style.display='none'
}

</script>