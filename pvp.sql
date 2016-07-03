-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 03 Tem 2016, 20:23:42
-- Sunucu sürümü: 5.6.24
-- PHP Sürümü: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Veritabanı: `pvp`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ayar`
--

CREATE TABLE IF NOT EXISTS `ayar` (
  `id` int(11) NOT NULL,
  `kullaniciadi` varchar(150) COLLATE utf8_bin NOT NULL,
  `sifre` varchar(32) COLLATE utf8_bin NOT NULL,
  `footersol` varchar(200) COLLATE utf8_bin NOT NULL,
  `footersag` varchar(200) COLLATE utf8_bin NOT NULL,
  `footerlink` varchar(250) COLLATE utf8_bin NOT NULL,
  `sitebasligi` varchar(250) COLLATE utf8_bin NOT NULL,
  `siteadi` varchar(11) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Tablo döküm verisi `ayar`
--

INSERT INTO `ayar` (`id`, `kullaniciadi`, `sifre`, `footersol`, `footersag`, `footerlink`, `sitebasligi`, `siteadi`) VALUES
(1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'Okan IŞIK', '', '#', 'Pvp Sitesi - Bedava Siteler', 'Pvp Server ');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pvplist`
--

CREATE TABLE IF NOT EXISTS `pvplist` (
  `id` int(11) NOT NULL,
  `baslik` varchar(150) COLLATE utf8_bin NOT NULL,
  `durum` varchar(100) COLLATE utf8_bin NOT NULL,
  `link` varchar(150) COLLATE utf8_bin NOT NULL,
  `servertipi` varchar(150) COLLATE utf8_bin NOT NULL,
  `uridium` varchar(100) COLLATE utf8_bin NOT NULL,
  `yayinlanmadurumu` varchar(250) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Tablo döküm verisi `pvplist`
--

INSERT INTO `pvplist` (`id`, `baslik`, `durum`, `link`, `servertipi`, `uridium`, `yayinlanmadurumu`) VALUES
(35, 'Okan IŞIK', 'Açık', 'https://okandiyebiri.com', 'Kasılmalık', '5757', 'Yayınlanmış'),
(36, 'Rüzgâr IŞIK''ın Web Sitesi', 'Açık', 'http://ruzgar.kim', 'Kasılmalık', '5757', 'Yayınlanmış'),
(37, 'Rüzgâr IŞIK''ın Web Sitesi', 'Açık', 'http://www.pvpserverlar.biz/', 'Kasılmalık', '25655', 'Yayınlanmış'),
(38, 'Okan Diye Biri', 'Açık', 'http://www.pvpserverlar.biz/', 'Kasılmalık', '5757', 'Yayınlanmış'),
(39, 'Sizden Gelenlers', 'Açık', 'http://www.pvpserverlar.biz/', 'Kasılmalık', '25655', 'Yayınlanmış'),
(40, 'Rüzgâr IŞIK''ın Web Sitesi', 'Açık', 'https://okandiyebiri.com/', 'Kasılmalık', '5757', 'Yayınlanmış'),
(41, 'Okan Diye Biri', 'Açık', 'http://ruzgar.kim', 'Kasılmalık', '25655', 'Yayınlanmış'),
(42, 'Sizden Gelenler', 'Açık', 'https://okandiyebiri.com', 'kasılmalık', '5757', 'Yayınlanmış'),
(43, 'bok', 'Açık', 'http://ruzgar.kim', 'kasılmalık', '25655', 'Yayınlanmış');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yorumlar`
--

CREATE TABLE IF NOT EXISTS `yorumlar` (
  `id` int(11) NOT NULL,
  `isim` varchar(120) COLLATE utf8_bin NOT NULL,
  `email` varchar(120) COLLATE utf8_bin NOT NULL,
  `yorum` varchar(250) COLLATE utf8_bin NOT NULL,
  `tarih` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `durum` varchar(11) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Tablo döküm verisi `yorumlar`
--

INSERT INTO `yorumlar` (`id`, `isim`, `email`, `yorum`, `tarih`, `durum`) VALUES
(27, 'Rüzgar IŞIK', 'okansibut@gmail.com', 'Ne Kadar da güzel bir site olmuş', '2016-04-30 11:26:54', 'Yayında'),
(28, 'Okan IŞIK', 'okansibut@gmail.com', 'Aaaaa yorum da yapılabiliyormuş ama onaylanmadan yayınlanamıyormuş :)', '2016-04-30 11:27:38', 'Yayında');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `ayar`
--
ALTER TABLE `ayar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `pvplist`
--
ALTER TABLE `pvplist`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `yorumlar`
--
ALTER TABLE `yorumlar`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `ayar`
--
ALTER TABLE `ayar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- Tablo için AUTO_INCREMENT değeri `pvplist`
--
ALTER TABLE `pvplist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=44;
--
-- Tablo için AUTO_INCREMENT değeri `yorumlar`
--
ALTER TABLE `yorumlar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
