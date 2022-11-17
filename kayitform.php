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
            <?php include "inc/menu.include.php"; ?>
        </nav>
        <!-- Page Content-->
        <div class="container p-0">
            <section class="formsayfasi">
            <h3> Üyelik Sayfası</h3>

            <form action="formkayit.php" method="POST">
              <label for="isim">Ad:</label><br>
              <input type="text" id="isim" name="ad"><br><br>
              <label for="soyisim">Soyad:</label><br>
              <input type="text" id="soyisim" name="soyad"><br><br>
              <label for="email">eposta:</label><br>
              <input type="text" id="email" name="eposta"><br><br>
              <label for="password">Şifre:</label><br>
              <input type="password" id="password" name="sifre"><br><br>
              <label for="password2">Şifre (tekrar):</label><br>
              <input type="password" id="password2" name="sifre2"><br><br>
              <input type="submit" value="Kaydet">
            </form>
       </div>
        <!-- Bootstrap core JS-->
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Third party plugin JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
