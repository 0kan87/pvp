<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/wordpress.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title><?php echo $row_ayar['siteadi']; ?></title>
<!-- InstanceEndEditable -->
<link rel="stylesheet" href="css/bootstrap.min.css">
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
</head>
<body>
	<div class="navbar navbar-inverse navbar-static-top">
		<div class="container">
			<a href="#" class="navbar-brand">Güncelleme</a>
			<button class="navbar-toggle" data-toggle="collapse" data-target=".navbarSec">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<div class="collapse navbar-collapse navbarSec">
				<ul class="nav navbar-nav navbar-right">
					<li class="active"><a href="index.php">Güncelleme</a></li>
				</ul>
			</div>
		</div>
	</div>
    <div class="container">
	<!-- InstanceBeginEditable name="icerik alanı" -->
	<div class="col-xs-12 col-sm-12 col-md-12">
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Güncelleme ve Duyurular <span class="badge">V 2.4</span></h3>
  </div>
  <div class="panel-body">
	<b>Yayın Tarihi:</b><span class="label label-info">30.04.2015 v2.4</span></br>
	
	-Admin Şifresi md5 ile şifrelenerek bir güvenlik açığı kapatıldı.</br>
	
	-Linkler SEO uyumlu oldu</br>
	
	<b>Değişen ve eklenen dosyalar</b></br>
	
	-yonetim klasörünün tamamını yeniden yükleyin, kök dizinde bulunan dosyaların(klasörler hariç) tamanını yeniden yükleyin. sql yeniden import edin veya ayarlar tablosunda bulunan şifre kısmına varsayılan şifreniz <b>12345</b> olması için <b>827ccb0eea8a706c4c34a16891f84e7b</b> olarak değiştirin.</br>
	
	-.htaccess dosyası eklendi.</br>
	
	<hr><b>Yayın Tarihi:</b><span class="label label-info">22.03.2015 v2.3</span></br>
	
	-Git Sütununda ki linkler yeni bir sayfada açılabilir olarak ayarlandı. Böylece ziyaretçinin sayfada kalma süresi uzatıldı.</br>
	
	-Online Ziyaretçi Sayısı Eklendi</br>
	
	-Anasayfaya filtre özellikli tablo eklendi</br>
	
	-Durum hatası giderildi</br>
	
	-Yönetici giriş sayfası yenilendi</br>
	
	-Link ekleme sayfası dil dosyasına dahil edildi</br>
	
	-Sosyal linkler eklendi</br>
	
	-Üst menü ve footer kısmına gölge eklendi</br>
	
	-"Git" Sütununun yeri değişti.</br>
	
	-/css, /js, dil/img klasörlerinde ki tüm dosyalar optimize edildi.</br></br>
	
	<b>Eklenen ve değişen dosyalar</b></br>
	
	-index.php, link-ekle.php,  yonetim/ayarlar.php dosyası değiştirldi. basarili.php dosyası silindi.</br>
	
	-css/aramayap.css, css/sosyal.css, css/giris.css css/kaydet.css dosyaları eklendi.</br>
	
	-js/aramayap.js, js/bekleyin.js, js/giris.js, js/malsup.js dosyaları eklendi.</br>
	
	<hr><b>Yayın Tarihi:</b><span class="label label-info">14.03.2015 v2.2</span></br>
	
	-Rusça, İngilizce, Almanca dil seçenekleri eklendi</br>
	
	-Anasayfada bulunan liste tablosu mobilde scrool bar ile gösteriliyor.</br>
	
	-Menü linklerine iconlar eklendi.(Anasayfa, Pvp Link Ekle, Dil Seçiniz)</br></br>
	
	<b>Eklenen ve değişen dosyalar</b></br>
	
	- index.php, link-ekle.php dosyalarında değişiklik oldu</br>
	
	- dil klsörü ve dil.php dosyası eklendi.</br><hr>

	<b>Yayın Tarihi:</b><span class="label label-info">13.03.2015 v2.1</span></br>
	
	-Mobilde esneklik sorunu çözüldü.</br><hr>
	
	<b>Yayın Tarihi:</b><span class="label label-info">11.03.2015 v2.0</span></br>

	-Onaylanan yorumlar panelden kayboluyordu, onaylanan yorumlar taslak şeklinde görünebilir hale getirildi.</br>

	-Faviconu olmayan sitelere google faviconunun gelmesi sağlandı.(Enes Alperen Hürüm)</br>

	-Anasayfa iki sütuna bölündü, yorum kutusu sağa alındı, yorumlar ise onun hemen altına alındı.</br>

	-Link ekleme ve yorum ekleme kısımlarında görsel değişiklik yapıldı.</br>

	-Yorumlar belirli zaman aralığında kendi kendine değişip gösterilmekte.</br><hr>

	<strong>Değişen ve eklenen dosyalar</strong></br>

	-Veri tabanında yorumlar tablosundaki durum kısmının türü Varchar olarak değiştirildi.</br>

	-index.php dosyası tamamen değişti diyebilirim. js klasörüne kayanyazi.js dosyası eklendi, link-ekle.php değişti.</br>

	-yonetim klasöründe bulunan; ayarlar.php, index.php, liste.php, yorumlar.php, yorumonay.php, pvp-ekle.php ve liste-duzenle.php dosyalarında değişiklik yapıldı.</br></br>
	<div class="alert alert-warning alert-dismissible" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<strong>Yeni Bir Sürüm Var</strong> <a href="http://okandiyebiri.com/pvp-listesi-scripti/"><strong>V2.4 Sürümünü </strong></a> indirmediyseniz tıklayın.
	</div>
  </div>
</div>
</div>
	<!-- InstanceEndEditable -->
    </div>
    <div class="container">
          <div class="alert alert-warning alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          Oluşabilecek her hata için <a href="http://okandiyebiri.com/pvp-listesi-scripti/"><strong>destek</strong></a> sitesini ziyaret edin.
          </div>
          </br></br>
</div>
     <div class="navbar navbar-default navbar-fixed-bottom">
         <div class="container">
             <p class="navbar-text pull-left">Pvp Listesi Scripti</p>
             <a href="http://okandiyebiri.com" class="navbar-btn btn-info btn pull-right">Okan IŞIK</a>
         </div>
     </div>
<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="js/bootstrap.js"></script>
</body>
<!-- InstanceEnd --></html>

