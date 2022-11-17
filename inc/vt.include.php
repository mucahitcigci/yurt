<?php
// Veri Tabanına Bağlan
error_reporting(-1);
try {
  $vt = new PDO("mysql:dbname=yurtson;host=localhost;charset=utf8","root", "");
  $vt->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Sorgu hatalarını yakalıyıp veriyor
} catch (PDOException $e) { // Bağlantı hatalarını yakalıyordu
  echo $e->getMessage();
  //error_log("Veri tabanına bağlanamadı!".$e->getMessage(), 0);
}
?>
