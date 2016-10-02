<!DOCTYPE html>
<html lang="tr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Okan IŞIK">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="icon" href="../../favicon.ico">
    <base href="<?php echo $siteadresi; ?>" />
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/arkaplan.css">
	<script src="ckeditor/ckeditor.js"></script>
	<script id="dsq-count-scr" src="//pvp-list.disqus.com/count.js" async></script>
	<!-- DİNAMİK TABLO -->
    <link rel="stylesheet" type="text/css" href="css/dataTables.bootstrap.min.css">
	<script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-1.12.3.min.js"></script>
	<script type="text/javascript" language="javascript" src="js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" language="javascript" src="js/dataTables.bootstrap.min.js"></script>
	<script type="text/javascript">
	$(document).ready(function() {
	    $('#pvpliste').DataTable( {
	        "language": {
	            "lengthMenu": "_MENU_ <?php echo $dil["kacadet"];?>",
	            "zeroRecords": "Bişey Bulamadım",
	            "info": "Şuan _PAGE_. sayfadasınız. Toplam _PAGES_ adet sayfa var.",
	            "infoEmpty": "No records available",
	            "infoFiltered": "(filtered from _MAX_ total records)",
	            "search": "<?php echo $dil["ara"];?>",
	            "paginate": { "next": "<?php echo $dil["sonraki"];?>", "previous": "<?php echo $dil["onceki"];?>"}
	        }
	    } );
	} );
	</script>
	<title><?php echo $row_ayar['siteadi']; ?></title>
</head>
<body class="full">
	<nav class="navbar navbar-inverse navbar-static-top">
		<div class="container">
			<div class="navbar-header">
			<button class="navbar-toggle" data-toggle="collapse" data-target=".navbarSec">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#"><img width="150" height="50" src="img/logo.png" alt="<?php echo $row_ayar['siteadi']; ?>"></a>
			</div>

			<div class="collapse navbar-collapse navbarSec">
				<ul class="nav navbar-nav navbar-right">
					<li class="active"><a href="index.html"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>  <?php echo $dil["anasayfa"];?></a></li>
					<li><a href="link-ekle.html"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> <?php echo $dil["pvplinkekle"];?></a></li>
					<li class="dropdown">
					  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-flag" aria-hidden="true"></span> <?php echo $dil["dilseciniz"];?> <span class="caret"></span></a>
					  <ul class="dropdown-menu" role="menu">
						<li><a href="dil.php?dil=tr"><img src="dil/img/tr.png" alt="<?php echo $dil["trdil"];?>"> <?php echo $dil["trdil"];?></a></li>
						<li><a href="dil.php?dil=en"><img src="dil/img/en.png" alt="<?php echo $dil["ingdil"];?>"> <?php echo $dil["ingdil"];?></a></li>
						<li><a href="dil.php?dil=de"><img src="dil/img/de.png" alt="<?php echo $dil["dedil"];?>"> <?php echo $dil["dedil"];?></a></li>
						<li><a href="dil.php?dil=ru"><img src="dil/img/ru.png" alt="<?php echo $dil["rudil"];?>"> <?php echo $dil["rudil"];?></a></li>
					  </ul>
					</li>
				</ul>
			</div><div></div>
		</div>
	</nav>