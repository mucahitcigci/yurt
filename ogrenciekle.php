<?php /*TAMAM*/
session_start();
if (isset($_SESSION["kod"]) == false) {
  header("Location: girisform.php");
  exit;
}

// Veri Tabanına Bağlan
include "inc/vt.include.php";

// Veri Temizleme
if (isset($_POST["numara"])) { $numara = null; } else { $numara = trim($_POST["numara"]);}
if (isset($_POST["dogumTarihi"])) { $dogumTarihi = null; } else { $dogumTarihi = trim($_POST["dogumTarihi"]);}
if (isset($_POST["eposta"])) { $eposta = null; } else { $eposta = trim($_POST["eposta"]);}
if (isset($_POST["sehir"])) { $sehir = null; } else { $sehir = trim($_POST["sehir"]);}

//Ad, soyad, telefon boş mu?

// ePosta tekrar ediyor mu?


// Telefon tekrar ediyor mu?


// SQL oluşturacağız
$sql = "INSERT INTO ogrenci (kod, numara, ad, soyad, dogumTarihi, eposta, sehir, telefon, kayitTarihi) VALUES (NULL, :numara, :ad, :soyad, :dogumTarihi, :eposta, :sehir, :telefon, CURRENT_TIMESTAMP)";
$ifade = $vt->prepare($sql);
$sonuc = $ifade->execute(Array(":numara"=>$numara, ":ad"=>$_POST["ad"], ":soyad"=>$_POST["soyad"], ":dogumTarihi"=>$dogumTarihi, ":eposta"=>$eposta, ":sehir"=>$sehir, ":telefon"=>$_POST["telefon"]));

if ($sonuc == true) {
  $_SESSION["mesaj"] = "Öğrenci başarı ile kayıt edildi!";
  header("refresh:2; url=ogrenci.php");
  //header("Location: ogrenci.php");
      //echo "<SCRIPT>         alert('Öğrenci başarıyla eklendi!')         window.location.replace('ogrenci.php');     </SCRIPT>";
}
exit;
/*
if (isset($_SESSION["kod"])) {
    echo "bu sayfayı görebilirsiniz";
    echo "kayıt formu";
}
else
{
    echo "bu sayfada işlem yapma yetkiniz yok<br>";
    echo "<a href='girisform.php'> Giriş yapmak için</a> ";
}
*/
?>
