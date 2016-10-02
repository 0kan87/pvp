<!DOCTYPE html>
<html lang="tr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Okan IŞIK">
    <link rel="icon" href="../../favicon.ico">
	<title><?php echo $row_ayar['siteadi']; ?></title>
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<!-- <link rel="stylesheet" href="../css/kaydet.css"> -->

	<!-- DİNAMİK TABLO -->
    <link rel="stylesheet" type="text/css" href="../css/dataTables.bootstrap.min.css">
    <script src="../ckeditor/ckeditor.js"></script>
	<script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-1.12.3.min.js"></script>
	<script type="text/javascript" language="javascript" src="../js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" language="javascript" src="../js/dataTables.bootstrap.min.js"></script>
	<script type="text/javascript">
	$(document).ready(function() {
	    $('#pvpliste').DataTable( {
	        "language": {
	            "lengthMenu": "_MENU_ Listede kaç adet gözüksün?",
	            "zeroRecords": "Bişey Bulamadım",
	            "info": "Şuan _PAGE_. sayfadasınız. Toplam _PAGES_ adet sayfa var.",
	            "infoEmpty": "No records available",
	            "infoFiltered": "(filtered from _MAX_ total records)",
	            "search": "Arama Yap",
	            "paginate": { "next": "Sonraki", "previous": "Önceki"}
	        }
	    } );
	} );
	</script>
</head>
<body>
	<nav class="navbar navbar-inverse navbar-static-top">
		<div class="container">
			<div class="navbar-header">
			<button class="navbar-toggle" data-toggle="collapse" data-target=".navbarSec">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="./"><?php echo $row_ayar['siteadi']; ?></a>
			</div>

			
			<div class="collapse navbar-collapse navbarSec">
				<ul class="nav navbar-nav navbar-right">
					<li class="active"><a href="index.php">Anasayfa</a></li>
					<li><a href="ayarlar.php">Ayarlar</a></li>
					<li><a href="liste.php">Pvp Liste</a></li>
					<li><a href="pvp-ekle.php">Pvp Ekle</a></li>
					<li><a href="vip-liste.php">VİP Liste</a></li>
					<li><a href="vip-pvp-ekle.php">VİP Ekle</a></li>
					<li><a href="yorumlar.php">Yorumlar</a></li>
					<li><a href="../index.html">Site Anasayfa</a></li>
					<li><a href="<?php echo $logoutAction ?>">Çıkış</a></li>
				</ul>
			</div>
		</div>
	</nav>