<?php
session_start();
echo "silinecek eleman";
echo $_POST["kod"];

// Veri Tabanına Bağlan
include "inc/vt.include.php";

// SQL oluşturacağız

$sql = "DELETE FROM  ogrenci WHERE kod= :kod";
$ifade = $vt->prepare($sql);
$sonuc = $ifade->execute(Array(":kod"=>$_POST["kod"]));

if ($sonuc == true) {
  $_SESSION["mesaj"] = "Öğrenci başarı ile silindi!";
  header("refresh:2; url=ogrencilistele.php");
}
exit;

?>
