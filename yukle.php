<?php
session_start();
error_reporting(-1);

var_dump($_POST);
var_dump($_FILES);

if (isset($_SESSION["kod"]) == false) {
  header("Location: girisform.php");
  exit;
}

// Yüklerken hata oldu mu
// 1 Hata post max size'i aştımı

//Formdan mı geliyor
if (isset($_GET["yukle"]) == false) {
  echo "Bu sayfaya direkt ulaşamazsınız, lütfen önce formu doldurunuz!";
  header("Location: galeriform.php");
  exit;
}

// Formdan gelmiş ama POST ve FILES değerleri yoksa

if (empty($_POST)) {
  echo "Yüklemeye çalıştığınız dosya boyutu çok fazla, en fazla 1MB yükleyebilirsiniz!";
  header("Location: galeriform.php");
  exit;
}

// 2 max upload filesize
if ($_FILES["dosya"]["error"] == 1) {
  echo "İzin verilen dosya boyutu en fazla 1MB'dır.",
  exit;
}
// 3 Başka bir hata oluştumu
if (($_FILES["dosya"]["error"] != 0) and ($_FILES["dosya"]["error"] != 1)) {
  echo "Dosya yüklerken bir hata oluştu, tekrar deneyin!",
  exit;
}

// Belli türden dosya yüklemesine izin verme
//echo $_FILES["dosya"]["type"];
//echo "<br/>";
$izin[0] = "image/jpeg";
$izin[1] = "image/png";
$izin[2] = "application/pdf";

if (in_array($_FILES["dosya"]["type"], $izin) == false) {
  echo "Bu dosyayı yükleyemezsiniz, sadece resim ve pdf dosyaları yükleyebilirsiniz!";
  exit;
}

// Dosyayı sunucuya kaydediyor
$adres = "depo/".time().basename($_FILES["dosya"]['name']);
if (move_uploaded_file($_FILES["dosya"]['tmp_name'], $adres) == false) {
  echo "Dosyayı kaydetme işlemi başarısız oldu, lütfen tekrar deneyiniz!";
  exit;
}

// Veri Tabanına kaydetme

// Veri Tabanına Bağlan
include "inc/vt.include.php";
if (isset($_POST["baslik"]) == false) {
  echo "Başlık boş olamaz!";
  exit;
}

$sql = "INSERT INTO belge (baslik, adres, yukleyen) VALUES (:baslik, :adres, :yukleyen)";
$ifade = $vt->prepare($sql);
$sonuc = $ifade->execute(Array(":baslik"=>$_POST["baslik"], ":adres"=>$adres, ":yukleyen"=>$_SESSION["kod"]));

if ($sonuc == true) {
  header("Location: galeri.php");
}
exit;

//Resmi göster


?>
