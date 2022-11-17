-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1:3306
-- Üretim Zamanı: 02 Haz 2021, 19:51:06
-- Sunucu sürümü: 5.7.26
-- PHP Sürümü: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: yurt
--
CREATE DATABASE IF NOT EXISTS yurt DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE yurt;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı belge
--

DROP TABLE IF EXISTS belge;
CREATE TABLE IF NOT EXISTS belge (
  kod int(11) NOT NULL AUTO_INCREMENT,
  baslik varchar(255) NOT NULL,
  adres varchar(255) NOT NULL,
  yukleyen int(11) NOT NULL,
  yuklemeTarihi timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (kod),
  KEY yukleyen (yukleyen)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı oda
--

DROP TABLE IF EXISTS oda;
CREATE TABLE IF NOT EXISTS oda (
  numara varchar(40) NOT NULL,
  tip varchar(255) NOT NULL,
  blok char(1) NOT NULL,
  aylikUcret float NOT NULL,
  kapasite int(11) NOT NULL,
  PRIMARY KEY (numara)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi oda
--

INSERT INTO oda (numara, tip, blok, aylikUcret, kapasite) VALUES
('A1', '1 Kişilik', 'A', 400, 1),
('A10', '4 Kişilik', 'A', 250, 4),
('A2', '2 Kişilik', 'A', 300, 2),
('A3', '2 Kişilik', 'A', 300, 2),
('A4', '4 Kişilik', 'A', 250, 4),
('A5', '4 Kişilik', 'A', 250, 4),
('A6', '1 Kişilik', 'A', 400, 1),
('A7', '2 Kişilik', 'A', 300, 2),
('A8', '2 Kişilik', 'A', 300, 2),
('A9', '4 Kişilik', 'A', 250, 4),
('B1', '1 Kişilik', 'B', 400, 1),
('B10', '4 Kişilik', 'B', 250, 4),
('B2', '2 Kişilik', 'B', 300, 2),
('B3', '2 Kişilik', 'B', 300, 2),
('B4', '4 Kişilik', 'B', 250, 4),
('B5', '4 Kişilik', 'B', 250, 4),
('B6', '1 Kişilik', 'B', 400, 1),
('B7', '2 Kişilik', 'B', 300, 2),
('B8', '2 Kişilik', 'B', 300, 2),
('B9', '4 Kişilik', 'B', 250, 4);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı odadakalanlar
--

DROP TABLE IF EXISTS odadakalanlar;
CREATE TABLE IF NOT EXISTS odadakalanlar (
  kod int(11) NOT NULL AUTO_INCREMENT,
  ogrKod int(11) NOT NULL,
  odaNo varchar(40) NOT NULL,
  basTarihi date NOT NULL,
  bitTarihi date DEFAULT NULL,
  PRIMARY KEY (kod),
  KEY fk_ogrenci_has_oda_oda1_idx (odaNo),
  KEY fk_ogrenci_has_oda_ogrenci_idx (ogrKod)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi odadakalanlar
--

INSERT INTO odadakalanlar (kod, ogrKod, odaNo, basTarihi, bitTarihi) VALUES
(1, 31, 'A1', '2020-07-05', NULL),
(2, 32, 'A2', '2020-06-30', NULL),
(3, 33, 'A2', '2020-07-06', NULL),
(4, 34, 'A6', '2019-07-15', '2020-06-25'),
(5, 35, 'A3', '2020-06-25', NULL),
(6, 34, 'A3', '2020-06-26', NULL),
(7, 36, 'A4', '2019-10-15', '2021-02-15'),
(8, 37, 'A4', '2020-12-02', NULL),
(9, 38, 'A4', '2020-12-08', NULL),
(10, 39, 'A4', '2020-05-10', NULL),
(11, 40, 'A6', '2020-10-05', NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı odemeler
--

DROP TABLE IF EXISTS odemeler;
CREATE TABLE IF NOT EXISTS odemeler (
  odadaKalanKod int(11) NOT NULL,
  tarih datetime NOT NULL,
  miktar float NOT NULL,
  odemeYapan varchar(255) DEFAULT NULL,
  PRIMARY KEY (odadaKalanKod,tarih)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi odemeler
--

INSERT INTO odemeler (odadaKalanKod, tarih, miktar, odemeYapan) VALUES
(1, '2020-07-05 00:00:00', 350, 'Muhammed Kaya'),
(1, '2020-08-01 00:00:00', 400, 'Muhammed Kaya'),
(1, '2020-09-05 00:00:00', 400, 'Salih Kaya');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı ogrenci
--

DROP TABLE IF EXISTS ogrenci;
CREATE TABLE IF NOT EXISTS ogrenci (
  kod int(11) NOT NULL AUTO_INCREMENT,
  numara varchar(45) DEFAULT NULL,
  ad varchar(255) NOT NULL,
  soyad varchar(255) NOT NULL,
  dogumTarihi date DEFAULT NULL,
  eposta varchar(255) DEFAULT NULL,
  sehir varchar(255) DEFAULT NULL,
  telefon char(11) NOT NULL,
  kayitTarihi date DEFAULT NULL,
  PRIMARY KEY (kod),
  UNIQUE KEY telefon_UNIQUE (telefon),
  UNIQUE KEY eposta_UNIQUE (eposta)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi ogrenci
--

INSERT INTO ogrenci (kod, numara, ad, soyad, dogumTarihi, eposta, sehir, telefon, kayitTarihi) VALUES
(31, NULL, 'Muhammed', 'Kaya', '2001-04-05', NULL, 'Adana', '05305550001', '2020-07-05'),
(32, NULL, 'Tuncay', 'Altınsoy', NULL, NULL, NULL, '05315550002', '2020-06-30'),
(33, '56', 'İbrahim', 'Ateş', '2004-10-04', 'ibrahim@mail.com', 'Çankırı', '05325550003', '2020-07-06'),
(34, '99', 'Mehmet Can', 'Sarı', '2003-02-19', 'mehmetcan@mail.com', 'İstanbul', '05335550004', '2019-07-15'),
(35, NULL, 'Bilal', 'Sakarya', '2000-01-17', NULL, 'Yozgat', '05345550005', '2020-06-25'),
(36, '179', 'Ahmet', 'Tunç', '2002-09-02', 'ahmet@mmail.com', NULL, '05355550006', '2019-10-15'),
(37, '220', 'Yasin', 'Yılmaz', NULL, 'yasin@posta.com.tr', 'İstanbul', '05365550007', '2020-12-02'),
(38, '292', 'Hasan', 'Demir', '2004-01-01', 'hasan@mail.com', 'Adana', '05385550009', '2020-12-08'),
(39, '322', 'Alper', 'Havuç', NULL, NULL, NULL, '05395550010', '2020-05-10'),
(40, '365', 'Salih', 'Bulut', '2004-10-20', 'salih@mail.com', 'İstanbul', '05405550001', '2020-10-05'),
(44, '124', 'bbbb', 'bbb', '2021-05-11', 'bb', 'bbb', 'dbbbbddd', NULL),
(45, NULL, 'Salih', 'Tunca', NULL, NULL, NULL, '05301234560', '2021-06-02');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı uye
--

DROP TABLE IF EXISTS uye;
CREATE TABLE IF NOT EXISTS uye (
  kod int(11) NOT NULL AUTO_INCREMENT,
  ad varchar(255) NOT NULL,
  soyad varchar(255) NOT NULL,
  eposta varchar(255) NOT NULL,
  sifre varchar(255) NOT NULL,
  PRIMARY KEY (kod),
  UNIQUE KEY eposta (eposta)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;


ALTER TABLE belge
  ADD CONSTRAINT belge_ibfk_1 FOREIGN KEY (yukleyen) REFERENCES uye (kod);

--
-- Tablo kısıtlamaları odadakalanlar
--
ALTER TABLE odadakalanlar
  ADD CONSTRAINT fk_ogrenci_has_oda_oda1 FOREIGN KEY (odaNo) REFERENCES oda (numara) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT fk_ogrenci_has_oda_ogrenci FOREIGN KEY (ogrKod) REFERENCES ogrenci (kod) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Tablo kısıtlamaları odemeler
--
ALTER TABLE odemeler
  ADD CONSTRAINT odemeler_ibfk_1 FOREIGN KEY (odadaKalanKod) REFERENCES odadakalanlar (kod);
COMMIT;

