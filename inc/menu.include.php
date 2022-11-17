<?php if (isset($_SESSION["kod"])) {  // Giriş yapmışsa ismi yazsın ?>
<p style="color: white;">
  <?php
    echo htmlentities($_SESSION["ad"]);
    echo " ";
    echo htmlentities($_SESSION["soyad"]);
  ?>
</P>
<?php } ?>
<div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php">Ana Sayfa</a></li>
        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="ogrenci.php">Öğrenciler</a></li>
        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#education">Odalar</a></li>
        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#skills">Ödeme</a></li>
        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="galeri.php">Galeri</a></li>
<?php if (isset($_SESSION["kod"]) == false) { // Giriş yapmamışsa görsün ?>
        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="kayitform.php">Kayıt Sayfası</a></li>
        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="girisform.php">Giriş</a></li>
<?php } else  { ?>
      <li class="nav-item"><a class="nav-link js-scroll-trigger" href="cikis.php">Çıkış Yap!</a></li>
<?php
}
?>
    <li>

      <form action="ara.php" method="GET"  style="display: flex; flex-direction: row;">
         <input name="ifade" type="text" style="flex: 1; font-size: 0.8rem;" placeholder="Kişi adı veya soyadı">
         <input type="submit" style="flex: 0.5" value="Ara">
      </form>
    </li>
  </ul>
</div>
