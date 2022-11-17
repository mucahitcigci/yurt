<?php
session_start();
?>

<!DOCTYPE html>
<html lang="tr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Marmara Öğrenci Yurdu</title>
        <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Saira+Extra+Condensed:500,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Muli:400,400i,800,800i" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top" id="sideNav">
            <a class="navbar-brand js-scroll-trigger" href="#page-top">
                <span class="d-block d-lg-none">Clarence Taylor</span>
                <span class="d-none d-lg-block"><img class="img-fluid img-profile rounded-circle mx-auto mb-2" src="assets/img/profile.jpg" alt="..." /></span>
            </a>

        <?php
        include "inc/menu.include.php";
         ?>
        </nav>
        <!-- Page Content-->
        <main class="container p-0" style="margin:10px;">

            <h2>Marmara Öğrenci Yurdu</h2>
            <h3> Öğrenci Detay Gör <h3>
              <?php
              //echo $_GET["kod"];
              // Veri tabanına Bağlan
                include "inc/vt.include.php";


                // sql hazırla
                $sql = "select count(*) as ogrencisayisi from ogrenci where kod = :kod";
                $ifade = $vt->prepare($sql);
                $sonuc = $ifade->execute(Array(":kod"=>$_GET["kod"]));
                // Sorgu çalışırken hata olduysa
                if ($sonuc == false) {
                  $_SESSION["mesaj"] == "Bir hata oluştu!";
                  header("ogrenci.php");
                  exit;
                }
                // Tabloda öğrenci var mı?
                $ogrencivarmi = $ifade->fetch(PDO::FETCH_ASSOC);
                if ($ogrencivarmi["ogrencisayisi"] == 0) {
                  $_SESSION["mesaj"] == "Aradığınız öğrenci bulunamadı!";
                  header("Location: ogrencilistele.php");
                  exit;
                }

              // sorguyu çalıştıracağız
              $sql = "select * from ogrenci WHERE kod = :kod";
              $ifade = $vt->prepare($sql);
              $sonuc = $ifade->execute(Array(":kod"=>$_GET["kod"]));
              // Sorgu çalışırken hata olduysa
              if ($sonuc == false) {
                $_SESSION["mesaj"] == "Aradığınız öğrenci bulunamadı!";
                header("ogrenciliste.php");
                exit;
              }
              if (isset($_SESSION["mesaj"])) { ?>
               <div id="mesaj" style="color: green; text-align: center;">
                 <?php
                   echo $_SESSION["mesaj"];
                   unset($_SESSION["mesaj"]);
                 ?>
               </div>
             <?php }
                $ogrenci = $ifade->fetch(PDO::FETCH_ASSOC);
                echo "<p> Numara: ".$ogrenci['numara']."</p>".PHP_EOL;
                echo "<p> Ad: ".$ogrenci['ad']."</p>".PHP_EOL;
                echo "<p> Soyad: ".$ogrenci['soyad']."</p>".PHP_EOL;
                echo "<p> Doğum Tarihi: ".$ogrenci['dogumTarihi']."</p>".PHP_EOL;
                echo "<p> ePosta: ".$ogrenci['eposta']."</p>".PHP_EOL;
                echo "<p> Şehir: ".$ogrenci['sehir']."</p>".PHP_EOL;
                echo "<p> Telefon: ".$ogrenci['telefon']."</p>".PHP_EOL;
                echo "<p> Kayıt Tarihi: ".$ogrenci['kayitTarihi']."</p>".PHP_EOL;
              ?>
       </main>
        <!-- Bootstrap core JS-->
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Third party plugin JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
