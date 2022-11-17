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
        <main class="container p-0" style="margin: 20px 20px; font-size: 16px; font-family: Arial;">

            <h2>Marmara Öğrenci Yurdu</h2>
            <h3> Galeri </h3>
              <?php

              if (isset($_SESSION["kod"])) {
                echo "<p><a href='galeriform.php'> Resim Yüklemek İçin Buraya Tıklayınız </a></p>";
              }
              // Veri tabanına Bağlan
                include "inc/vt.include.php";

              // sql hazırla
              $sql = "select count(*) as resimsayisi from belge";
              $ifade = $vt->prepare($sql);
              $sonuc = $ifade->execute();
              // Sorgu çalışırken hata olduysa
              if ($sonuc == false) {
                $_SESSION["mesaj"] == "Bir hata oluştu!";
                header("index.php");
                exit;
              }
              // Tabloda öğrenci var mı?
              $resimsayisisonuc = $ifade->fetch(PDO::FETCH_ASSOC);
              if ($resimsayisisonuc["resimsayisi"] == 0) {
                echo "Gösterilecek hiç resim yok!";
                exit;
              }

              // sorguyu çalıştıracağız
              $sql = "SELECT belge.*, uye.ad, uye.soyad FROM belge, uye where belge.yukleyen = uye.kod";
              $ifade = $vt->prepare($sql);
              $sonuc = $ifade->execute();
              // Sorgu çalışırken hata olduysa
              if ($sonuc == false) {
                $_SESSION["mesaj"] == "Bir hata oluştu!";
                header("index.php");
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
                while ($sonuclistesi = $ifade->fetch(PDO::FETCH_ASSOC)) {
                    echo "Başlık: ".$sonuclistesi['baslik'];
                    echo "<br/>";
                    echo "<img src='";
                    echo $sonuclistesi["adres"];
                    echo "' style='max-width: 424px;'>";
                    echo "<br/>";
                    echo "Yükleyen: ".$sonuclistesi["ad"];
                    echo " ".$sonuclistesi["soyad"];
                    echo "<br/>";
                    echo "Zaman: ".$sonuclistesi["yuklemeTarihi"];
                    echo "<br/>";
                    $adres = "yorumform.php?kod=".$sonuclistesi['kod'];
                    echo "<a href='$adres'>Yorum Ekle/Oku</a>";
                    echo "<hr>";

                    /*
                        echo "<form method='POST' action='ogrencisil.php'>";
                        echo "<input type='hidden' name='kod' value='";
                        echo $sonuclistesi["kod"];
                        echo "'>";
                        echo "<input type='submit' value='Sil' style='display: inline; width: 60px;'>";
                        echo "</form>".PHP_EOL;
                      echo "</td>";
                      $adres = "ogrencigor.php?kod=";
                      $adres = $adres.$sonuclistesi["kod"];
                      echo "<td>";
                      echo "<a href='$adres'>Gör</a>";
                    */
                  }
              // gelen verileri göstereceğiz

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
