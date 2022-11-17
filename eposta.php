<?php
// İleti
$ileti = "Merhaba \r\n Bu mail php ile gönderildi \r\n Ahmet Satıcı";

// Satırlarımızın 70 karakterden uzun olanlarını katlamamız lazım
$ileti = wordwrap($ileti, 70, "\r\n");

// Epostayı gönderelim
mail('ahmetfeyzisatici@gmail.com', 'PHPden merhaba', $ileti);
?>
