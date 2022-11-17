<?php
try {
  $vt = new PDO("mysql:dbname=yurtson;host=localhost;charset=utf8","root", "");
  $vt->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo $e->getMessage();
}
// Ekstra boşlukları temizle
$ad = trim($_POST["ad"]);
$soyad = trim($_POST["soyad"]);
$eposta = trim($_POST["eposta"]);
// Aldığım verileri kontrol ettirelim.
if (mb_strlen($ad) >255) { mesajvelinkgostervedur("Ad 255 karakterden uzun olamaz!"); }
if (mb_strlen($soyad) >255) { mesajvelinkgostervedur("Soyad 255 karakterden uzun olamaz!"); }
if (mb_strlen($_POST["sifre"])>255) { mesajvelinkgostervedur("Şifre 255 karakterden uzun olamaz!"); }
if (mb_strlen($eposta)>255) { mesajvelinkgostervedur("eposta 255 karakterden uzun olamaz!"); }

//Minimum uzunluklar
if (mb_strlen($ad) < 3) { mesajvelinkgostervedur("Ad 3 karakterden kısa olamaz!"); }
if (mb_strlen($soyad) <3) { mesajvelinkgostervedur("Soyad 3 karakterden kısa olamaz!"); }
if (mb_strlen($_POST["sifre"])< 3 ) { mesajvelinkgostervedur("Şifre 3 karakterden kısa olamaz!"); }

//epostayı kontrol et
if (filter_var($eposta, FILTER_VALIDATE_EMAIL) == false) { mesajvelinkgostervedur("Eposta düzgün girilmemiş!"); }

// Şifreler aynı mı?
if ($_POST["sifre"] != $_POST["sifre2"]) {
    mesajvelinkgostervedur("Şifreler birbiriyle uyuşmuyor!");
}

//Şifreyi şifreleyelim
$sifre = password_hash($_POST["sifre"], PASSWORD_DEFAULT);

//Daha önce bu eposta kayıtta kullanılmış mı?
$sql ="select count(*) as kayitsayisi from uye where eposta like :eposta";
$ifade = $vt->prepare($sql);
$ifade->execute(Array(":eposta"=>$eposta));

$kayit = $ifade->fetch(PDO::FETCH_ASSOC);
if ($kayit["kayitsayisi"] == true) {
    mesajvelinkgostervedur("Bu eposta daha önce kullanılmış, lütfen başka bir eposta ile üye olmayı deneyiniz!");
}

/* İkinci yöntem
$sql ="select * from uye where eposta like :eposta";
$ifade = $vt->prepare($sql);
$ifade->execute(Array(":eposta"=>$eposta));
if ($ifade->rowCount() == true) {
    mesajvelinkgostervedur("Bu eposta daha önce kullanılmış, lütfen başka bir eposta ile üye olmayı deneyiniz!");
}
*/

// Kayıt İşlemi
$sql = "insert into uye (ad, soyad, eposta, sifre) values (:ad, :soyad, :eposta, :sifre)";
$ifade = $vt->prepare($sql);
$sonuc = $ifade->execute(Array(":ad"=>$ad, ":soyad"=>$soyad, ":eposta"=>$eposta, ":sifre"=>$sifre));
if ($sonuc== true) {
  $_SESSION["ad"] = $kayit["ad"];
  $_SESSION["soyad"] = $kayit["soyad"];
  $_SESSION["eposta"] = $kayit["eposta"];
  $_SESSION["kod"] = $kayit["kod"];
  header("Location: index.php");
  exit;
}
else
{
    mesajvelinkgostervedur("Kayıt işleminde bir problem yaşandı!");
}


//Bağlantıyı yok edelim...
$vt = null;


function mesajvelinkgostervedur($mesaj) {
    echo $mesaj;
    ?>
    <a href="kayitform.php">Kayıt Formu </a>
    <?php
    exit;
}
?>
