<?php
include '../classes_include.php';
$dba= new dbClass();
$dba->connect();
s_start();

require_once('vendor/excel_reader2.php');
require_once('vendor/SpreadsheetReader.php');

if (isset($_POST["import"]))
{
  $allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
  
  if(in_array($_FILES["file"]["type"],$allowedFileType)){

        $targetPath = 'uploads/'.$_FILES['file']['name'];
        move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);
        
        $Reader = new SpreadsheetReader($targetPath);
        
        $sheetCount = count($Reader->sheets());
		
        for($i=0;$i<$sheetCount;$i++)
        {
            
            $Reader->ChangeSheet($i);
            //print_r($Reader);
	    $satir =0;
            foreach ($Reader as $Row)
            {
                
                $stokkod = "";
                if(isset($Row[0])) {
                    $stokkod = $Row[0];
                }
                $stokad = "";
                if(isset($Row[1])) {
                    $stokad = $Row[1];
                }
				
		$grupkod = "";
                if(isset($Row[2])) {
                    $grupkod = $Row[2];
                }
		$ekgrupkod = "";
                if(isset($Row[3])) {
                    $ekgrupkod = $Row[3];
                }
                $birim = "";
                if(isset($Row[4])) {
                    $birim = $Row[4];
                }
		$kdvoran = "";
                if(isset($Row[5])) {
                    $kdvoran = $Row[5];
                }
		$aciklama = "";
                if(isset($Row[6])) {
                    $aciklama = $Row[6];
                }
		$alisfiyat = "";
                if(isset($Row[7])) {
                    $alisfiyat = $Row[7];
                }
		$satisfiyat = "";
                if(isset($Row[8])) {
                    $satisfiyat = $Row[8];
                }		
                if ((!empty($stokkod) || !empty($stokad)) and $satir>0) {
			
				
                $kontrolquery = $dba->query("SELECT count(id) as sayi from stok where stokkod='".$stokkod."'");
                //echo "SELECT count(id) as sayi from stok where stokkod='".$stokkod."'";
		$sonuc = $dba->fetch_object($kontrolquery);
                if ($sonuc->sayi >0){
                    $message = $message.$stokkod ." Kodlu ürün sistemde zaten var! Bu yüzden eklenemedi.<br>";
                  
                }else{
                    $sql = $dba->query("insert into stok(stokkod,stokad,grupkod,ekgrupkod,birim,kdvoran,aciklama,alisfiyat,satisfiyat) values('".$stokkod."','".$stokad."','".$grupkod."','".$ekgrupkod."','".$birim."','".$kdvoran."','".$aciklama."','".$alisfiyat."','".$satisfiyat."')");
                    $result = $dba->insert_id($sql);
                }
                if (! empty($result)) {
                   $type = "success";
                   $message =$message."Excel Datası Veri Tabanındaki ".$stokkod." koduyla -> stok tablosuna kaydedildi.<br>";
                } else {
                   $type = "error";
                   $message = $message."Problem in Importing Excel Data<br>";
                }
                }
		$satir ++;
               
             }
        
         }
  }
  else
  { 
        $type = "error";
        $message = "Invalid File Type. Upload Excel File.<br>";
  }
}
?>

<!DOCTYPE html>
<html>    
<head>
<style>    
body {
	font-family: Arial;
	width: 550px;
}

.outer-container {
	background: #F0F0F0;
	border: #e0dfdf 1px solid;
	padding: 40px 20px;
	border-radius: 2px;
}

.btn-submit {
	background: #333;
	border: #1d1d1d 1px solid;
    border-radius: 2px;
	color: #f0f0f0;
	cursor: pointer;
    padding: 5px 20px;
    font-size:0.9em;
}

.tutorial-table {
    margin-top: 40px;
    font-size: 0.8em;
	border-collapse: collapse;
	width: 100%;
}

.tutorial-table th {
    background: #f0f0f0;
    border-bottom: 1px solid #dddddd;
	padding: 8px;
	text-align: left;
}

.tutorial-table td {
    background: #FFF;
	border-bottom: 1px solid #dddddd;
	padding: 8px;
	text-align: left;
}

#response {
    padding: 10px;
    margin-top: 10px;
    border-radius: 2px;
    display:none;
}

.success {
    background: #c7efd9;
    border: #bbe2cd 1px solid;
}

.error {
    background: #fbcfcf;
    border: #f3c6c7 1px solid;
}

div#response.display-block {
    display: block;
}
</style>
</head>

<body>
    <h2>Stok Aktarım </h2>( Stokları aktarmak için örnek excel kullanabilirsiniz.) Örnek excel indirmek için <a href='stoklar.xlsx'> Tıklayın</a><br>
    
    <div class="outer-container">
        <form action="" method="post"
            name="frmExcelImport" id="frmExcelImport" enctype="multipart/form-data">
            <div>
                <label>Choose Excel
                    File</label> <input type="file" name="file"
                    id="file" accept=".xls,.xlsx">
                <button type="submit" id="submit" name="import"
                    class="btn-submit">Import</button>
        
            </div>
        
        </form>
        
    </div>
    <div id="response" class="<?php if(!empty($type)) { echo $type . " display-block"; } ?>"><?php if(!empty($message)) { echo $message; } ?></div>
    
         
<?php
$sqlSelect = $dba->query("SELECT * from stok");
$sonuc = $dba->num_rows($sqlSelect);

if ($sonuc > 0)
{
?>
        
    <table class='tutorial-table'>
        <thead>
            <tr>
                <th>stokkod</th>
                <th>stokad</th>
		<th>grupkod</th>
                <th>ekgrupkod</th>
		<th>birim</th>
                <th>kdvoran</th>
		<th>aciklama</th>
                <th>alisfiyat</th>
		<th>satisfiyat</th>
            </tr>
        </thead>
<?php
   while(@$sonuc =$dba->fetch_object($sqlSelect)){
?>                  
<tbody>
    <tr>
        <td><?php  echo $sonuc->stokkod; ?></td>
        <td><?php  echo $sonuc->stokad; ?></td>
        <td><?php  echo $sonuc->grupkod; ?></td>
        <td><?php  echo $sonuc->ekgrupkod; ?></td>
        <td><?php  echo $sonuc->birim; ?></td>
        <td><?php  echo $sonuc->kdvoran; ?></td>
        <td><?php  echo $sonuc->aciklama; ?></td>
        <td><?php  echo $sonuc->alisfiyat; ?></td>
        <td><?php  echo $sonuc->satisfiyat; ?></td>
    </tr>
<?php
    }
?>
</tbody>
</table>
<?php 
} 
?>

</body>
</html>