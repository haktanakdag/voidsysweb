 <?php 
            if($masaid){
                $masastr ="&masaid=".$masaid;
            }
            ?>
         <?php
        echo "<a href='adminpanel.php?lx=./adisyon/index.php' class='btn'>Ana Menü</a>";
        echo "<a href='adminpanel.php?lx=./adisyon/index.php&blx=masadegistir.php' class='btn'>Masa Değiştir</a>";
        echo "<a href='adminpanel.php?lx=./adisyon/index.php&blx=masaaktar.php' class='btn'>Masa Aktar</a>";
        echo "<a href='adminpanel.php?lx=./adisyon/index.php&blx=adisyonduzenle.php' class='btn'>Adisyon Düzenle</a>";
        echo "<hr>";
        ?>
        <?php
        if($blx){
            include $blx;
        }else{
            include 'adisyonmasalar.php';
      
            include 'adisyonpaketservisler.php';
        }
        ?>
    <?php if ($masaid){ ?>
    <?php include 'adisyon.php'; ?>
    <?php } ?>
