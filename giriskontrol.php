<?php
session_start();
// Formdan gelen bilgileri al - eposta ve şifre
if (isset($_POST["eposta"])) {
    $eposta = $_POST["eposta"];
}
if (isset($_POST["sifre"])) {
    $sifre = $_POST["sifre"];
}

// Veri Tabanına Bağlan
  include "inc/vt.include.php";

// Bu bilgilere ait birisi var mı onu sorgulayalım

$sql ="select * from uye where eposta like :eposta";
$ifade = $vt->prepare($sql);
$ifade->execute(Array(":eposta"=>$eposta));

$kayit = $ifade->fetch(PDO::FETCH_ASSOC);

// Bilgiler uyuşuyorsa yetki verelim

if (password_verify($sifre, $kayit["sifre"])) {
   $_SESSION["ad"] = $kayit["ad"];
   $_SESSION["soyad"] = $kayit["soyad"];
   $_SESSION["eposta"] = $kayit["eposta"];
   $_SESSION["kod"] = $kayit["kod"];
}

//Bağlantıyı yok edelim...
$vt = null;

header("Location: index.php");
?>
