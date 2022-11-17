<?php
session_start();
if (isset($_GET["kod"]) == false) {
    header("Location: galeri.php");
}

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
            <h3> Galeri Resim ve Yorum Sayfası </h3>
              <?php

              // Veri tabanına Bağlan
                include "inc/vt.include.php";

              // Böyle bir resim var mı?
              $sql = "select count(*) as kayitsayisi from belge where kod = :kod";
              $ifade = $vt->prepare($sql);
              $sonuc = $ifade->execute(Array(":kod"=>$_GET["kod"]));
              // Sorgu çalışırken hata olduysa
              if ($sonuc == false) {
                $_SESSION["mesaj"] == "Bir hata oluştu!";
                header("galeri.php");
                exit;
              }
              // Tabloda öğrenci var mı?
              $sonuc = $ifade->fetch(PDO::FETCH_ASSOC);
              if ($sonuc["kayitsayisi"] == 0) {
                echo "Bu resme ulaşılamadı!";
                exit;
              }

              // sorguyu çalıştıracağız
              $sql = "SELECT belge.*, uye.ad, uye.soyad FROM belge, uye where belge.yukleyen = uye.kod and belge.kod = :kod";
              $ifade = $vt->prepare($sql);
              $sonuc = $ifade->execute(Array(":kod"=>$_GET["kod"]));
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
                $sonuclistesi = $ifade->fetch(PDO::FETCH_ASSOC);
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
                echo "<hr>";
                if (isset($_SESSION["kod"]) == true) { // Giriş yaptıysa formu göster
                  ?>
                  <form action="yorumkayit.php" method="POST">
                    <textarea name="yorum" rows="5" placeholder="Yorumunuz buraya!!!" style =" resize:none;"></textarea>
                    <input type="hidden" name="belgekod" value="<?php echo $_GET["kod"]; ?>">
                    <input type="submit" value="Kaydet">
                  </form>
                  <?php
                } else {
                  echo "<p> Yorum yapmak için lütfen <a href='girisform.php'>giriş yapınız! </a> </p>";
                }

                // sql hazırla
                $sql = "select count(*) as yorumsayisi from yorum where yapilan = :belgekod";
                $ifade = $vt->prepare($sql);
                $sonuc = $ifade->execute(Array(":belgekod"=>$_GET["kod"]));
                // Sorgu çalışırken hata olduysa
                if ($sonuc == false) {
                  $_SESSION["mesaj"] == "Bir hata oluştu!";
                  header("index.php");
                  exit;
                }
                // Tabloda öğrenci var mı?
                $yorumsonuc = $ifade->fetch(PDO::FETCH_ASSOC);
                if ($yorumsonuc["yorumsayisi"] == 0) {
                  echo "Gösterilecek hiç yorum yok!";
                  exit;
                }

                // sorguyu çalıştıracağız
                $sql = "SELECT yorum.*, uye.ad, uye.soyad FROM yorum, uye where yorum.yapan = uye.kod and yorum.yapilan = :belgekod order by tarihsaat desc";
                $ifade = $vt->prepare($sql);
                $sonuc = $ifade->execute(Array(":belgekod"=>$_GET["kod"]));
                // Sorgu çalışırken hata olduysa
                if ($sonuc == false) {
                  $_SESSION["mesaj"] == "Bir hata oluştu!";
                  header("index.php");
                  exit;
                }

                while ($sonuclistesi = $ifade->fetch(PDO::FETCH_ASSOC)) {
                      echo "Yorum Yapan : ".$sonuclistesi['ad'];
                      echo " ";
                      echo $sonuclistesi['soyad'];
                      echo "<br/>";
                      echo "Yorum: ".htmlentities($sonuclistesi["metin"]);
                      echo "<br/>";
                      echo "Zaman: ".$sonuclistesi["tarihsaat"];
                      echo "<br/>";
                      echo "<hr>";

                    }



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
