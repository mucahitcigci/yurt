<?php
session_start();
error_reporting(-1); // Yayınlarken 0 yap
if (isset($_SESSION["kod"]) == false) {
  header("Location: girisform.php");
  exit;
}

// Veri Tabanına Bağlan
include "inc/vt.include.php";

// Veri Temizleme
if (isset($_POST["yorum"]) == false) {
  header("Location: galeri.php");
}

// SQL oluşturacağız
$sql = "INSERT INTO yorum (metin, yapan, yapilan) VALUES (:metin, :uyeKod, :belgeKod)";
$ifade = $vt->prepare($sql);
$sonuc = $ifade->execute(Array(":metin"=>$_POST["yorum"], ":uyeKod"=>$_SESSION["kod"], ":belgeKod"=>$_POST["belgekod"]));

if ($sonuc == true) {
  $_SESSION["mesaj"] = "Yorum başarı ile kayıt edildi!";
} else  {
  $_SESSION["mesaj"] = "Yorum eklenirken hata oluştu!";
}

$adres = "yorumform.php?kod=".$_POST["belgekod"];
header("Location: $adres");
exit;
?>
