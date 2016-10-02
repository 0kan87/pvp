<?php require_once('Connections/baglan.php');
	session_start();
	if (!@$_SESSION["dil"]){
		require("dil/tr.php");
	}else {
		require("dil/".$_SESSION["dil"].".php");
	}
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$currentPage = $_SERVER["PHP_SELF"];

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO yorumlar (id, isim, email, yorum, tarih, durum) VALUES (%s, %s, %s, %s, %s, %s)",
	GetSQLValueString($_POST['id'], "int"),
	GetSQLValueString($_POST['isim'], "text"),
	GetSQLValueString($_POST['email'], "text"),
	GetSQLValueString($_POST['yorum'], "text"),
	GetSQLValueString($_POST['tarih'], "date"),
	GetSQLValueString($_POST['durum'], "text"));

  mysql_select_db($database_baglan, $baglan);
  $Result1 = mysql_query($insertSQL, $baglan) or die(mysql_error());

  $insertGoTo = "index.html";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_baglan, $baglan);
$query_ayar = "SELECT footersol, footersag, footerlink, sitebasligi, siteadi FROM ayar";
$ayar = mysql_query($query_ayar, $baglan) or die(mysql_error());
$row_ayar = mysql_fetch_assoc($ayar);
$totalRows_ayar = mysql_num_rows($ayar);

$maxRows_yorumlar = 1;
$pageNum_yorumlar = 0;
if (isset($_GET['pageNum_yorumlar'])) {
  $pageNum_yorumlar = $_GET['pageNum_yorumlar'];
}
$startRow_yorumlar = $pageNum_yorumlar * $maxRows_yorumlar;

mysql_select_db($database_baglan, $baglan);
$query_yorumlar = "SELECT * FROM yorumlar WHERE durum = 'Yayında' ORDER BY id DESC";
$query_limit_yorumlar = sprintf("%s LIMIT %d, %d", $query_yorumlar, $startRow_yorumlar, $maxRows_yorumlar);
$yorumlar = mysql_query($query_limit_yorumlar, $baglan) or die(mysql_error());
$row_yorumlar = mysql_fetch_assoc($yorumlar);

if (isset($_GET['totalRows_yorumlar'])) {
  $totalRows_yorumlar = $_GET['totalRows_yorumlar'];
} else {
  $all_yorumlar = mysql_query($query_yorumlar);
  $totalRows_yorumlar = mysql_num_rows($all_yorumlar);
}
$totalPages_yorumlar = ceil($totalRows_yorumlar/$maxRows_yorumlar)-1;

$maxRows_pvpliste = 300;
$pageNum_pvpliste = 0;
if (isset($_GET['pageNum_pvpliste'])) {
  $pageNum_pvpliste = $_GET['pageNum_pvpliste'];
}
$startRow_pvpliste = $pageNum_pvpliste * $maxRows_pvpliste;

mysql_select_db($database_baglan, $baglan);
$query_pvpliste = "SELECT * FROM pvplist WHERE yayinlanmadurumu = 'Yayınlanmış' ORDER BY id DESC";
$query_limit_pvpliste = sprintf("%s LIMIT %d, %d", $query_pvpliste, $startRow_pvpliste, $maxRows_pvpliste);
$pvpliste = mysql_query($query_limit_pvpliste, $baglan) or die(mysql_error());
$row_pvpliste = mysql_fetch_assoc($pvpliste);

//////////


$maxRows_pvpliste = 300;
$pageNum_pvpliste = 0;
if (isset($_GET['pageNum_pvpliste'])) {
  $pageNum_pvpliste = $_GET['pageNum_pvpliste'];
}
$startRow_pvpliste = $pageNum_pvpliste * $maxRows_pvpliste;

mysql_select_db($database_baglan, $baglan);
$query_pvpliste = "SELECT * FROM vpvplist WHERE yayinlanmadurumu = 'Yayınlanmış' ORDER BY id DESC";
$query_limit_pvpliste = sprintf("%s LIMIT %d, %d", $query_pvpliste, $startRow_pvpliste, $maxRows_pvpliste);
$vippvpliste = mysql_query($query_limit_pvpliste, $baglan) or die(mysql_error());
$vip_pvpliste = mysql_fetch_assoc($vippvpliste);


include "yonetim/fonksiyon.php";
include "ust.php";
?>
    <div class="container">
		<div class="row">
			<div class="col-xs-12 col-md-8 bosluk-alt">
				<!-- VİP LİSTE BAŞLANGIÇ -->
				<div class="table table-responsive">
					<table class="table table-striped table-bordered" cellspacing="0" width="100%">
						<thead bgcolor="#222222" style="color:white;">
							<tr>
								<th></th>
								<th><?php echo $dil["baslik"];?></th>
								<th><?php echo $dil["git"];?></th>
								<th><?php echo $dil["servertipi"];?></th>
							</tr>
						</thead>
						<tbody>
							<tr><?php do { ?>
								<td>
								<!-- Eğer favicon ekli değilse bizim belirlediğimiz sitenin faviconu gözükür örnekte google -->
								<!-- rtrim kullanarak sitenin sonuna olaı eklenmme durumu olan slash karakterini temizledik favicon düzgün gözüksün diye -->
								<?php $vid = $vip_pvpliste['id']; $vbaslik = $vip_pvpliste['baslik']; ?>
								<img height="16" width="16" src="http://www.google.com/s2/favicons?domain=<?php echo rtrim($vip_pvpliste['link'],"/"); ?>" onError="this.src='../img/pvp.png'" border="0"/></td>
								<td><a href="vip-sayfa.php?p=<?php echo $vid; ?>"><?php echo $vbaslik; ?></a></td>
								<td><span class="glyphicon glyphicon-tower" aria-hidden="true"></span>&nbsp;<strong>VİP</strong>&nbsp;<a target="_blank" href="<?php echo $vip_pvpliste['link']; ?>" rel="nofollow"><?php echo $vip_pvpliste['link'];?></a></td>
								<td><?php echo $vip_pvpliste['servertipi']; ?></td>

							</tr><?php } while ($vip_pvpliste = mysql_fetch_assoc($vippvpliste)); ?>
						</tbody>
					</table>
				</div>
				<!-- VİP LİSTE BİTİŞ -->

				<!-- PVPLİST LİSTE BAŞLANGIÇ -->
				<div class="reklam hidden-xs hidden-sm"><center><img src="http://placehold.it/728x90"></center></div>
				<div class="table table-responsive">
					<table id="pvpliste" class="table table-striped table-bordered" cellspacing="0" width="100%">
						<thead bgcolor="#222222" style="color:white;">
							<tr>
								<th></th>
								<th><?php echo $dil["baslik"];?></th>
								<th><?php echo $dil["git"];?></th>
								<th><?php echo $dil["servertipi"];?></th>
							</tr>
						</thead>
						<tbody>
							<tr><?php do { ?>
								<td>
								<!-- Eğer favicon ekli değilse bizim belirlediğimiz sitenin faviconu gözükür örnekte google -->
								<!-- rtrim kullanarak sitenin sonuna olaı eklenmme durumu olan slash karakterini temizledik favicon düzgün gözüksün diye -->
								<?php $id = $row_pvpliste['id']; $baslik = $row_pvpliste['baslik']; ?>
								<img height="16" width="16" src="http://www.google.com/s2/favicons?domain=<?php echo rtrim($row_pvpliste['link'],"/"); ?>" onError="this.src='../img/pvp.png'" border="0"/></td>
								<td><a href="<?php echo Seo($baslik); ?>/<?php echo $id; ?>.html"><?php echo $baslik; ?></a></td>
								<td><span class="glyphicon glyphicon-link" aria-hidden="true"></span>&nbsp;<a target="_blank" href="<?php echo $row_pvpliste['link']; ?>" rel="nofollow"><?php echo $row_pvpliste['link'];?></a></td>
								<td><?php echo $row_pvpliste['servertipi']; ?></td>

							</tr><?php } while ($row_pvpliste = mysql_fetch_assoc($pvpliste)); ?>
						</tbody>
					</table>
				</div>
				<!-- PVPLİST BİTİŞ -->
			</div>

			<!-- YORUM FORMU BAŞLANGIÇ -->
			<div class="col-xs-12 col-md-4">
			<p><strong><?php echo $dil["yorumbirak"];?></strong></p>
				<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
					<div class="input-group">
						<span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></span>
						<input type="text" name="isim" class="form-control" placeholder="<?php echo $dil["adsoyad"];?>" aria-describedby="sizing-addon2" required>
					</div></br>
					<div class="input-group">
						<span class="input-group-addon" id="sizing-addon2">@</span>
						<input type="text" name="email" class="form-control" placeholder="<?php echo $dil["email"];?>" aria-describedby="sizing-addon2" required>
					</div></br>
					<div class="input-group">
						<span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-import" aria-hidden="true"></span></span>
						<textarea name="yorum" class="form-control" placeholder="<?php echo $dil["yorum"];?>" required></textarea>
					</div></br>
					<div class="input-group">
						<button type="submit" class="btn btn-primary" class="form-control" aria-describedby="sizing-addon2" ><?php echo $dil["gonder"];?></button>
						<input type="hidden" name="id" value="" />
						<input type="hidden" name="tarih" value="" />
						<input type="hidden" name="durum" value="Taslak" />
						<input type="hidden" name="MM_insert" value="form1" />
					</div>
				</form></br>
				<!-- YORUM FORMU BİTİŞ -->
			
				<!-- YORUMLAR BAŞLANGIÇ -->
				<?php do { ?>
				<div class="media input-group form-control pull-right">
					<div class="media-left">
						<a href="#"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></a>
					</div>
					<div class="media-body">
						<h4 class="media-heading"><?php echo $row_yorumlar['isim']; ?></h4>
						<h5 class="media-heading"><?php echo $row_yorumlar['tarih']; ?></h5>
						<?php echo $row_yorumlar['yorum']; ?>
					</div>
				</div>
				<nav>
				<ul class="pager">
				<?php if ($pageNum_yorumlar > 0) { // Show if not first page ?>
					<li><a href="<?php printf("%s?pageNum_yorumlar=%d%s", $currentPage, max(0, $pageNum_yorumlar - 1), $queryString_yorumlar); ?>"><?php echo $dil["onceki"];?></a></li>
					<?php } // Show if not first page ?>
					<?php if ($pageNum_yorumlar < $totalPages_yorumlar) { // Show if not last page ?>
					<li><a href="<?php printf("%s?pageNum_yorumlar=%d%s", $currentPage, min($totalPages_yorumlar, $pageNum_yorumlar + 1), $queryString_yorumlar); ?>"><?php echo $dil["sonraki"];?></a></li>
					<?php } ?>
				</ul>
				</nav>
				<?php } while ($row_yorumlar = mysql_fetch_assoc($yorumlar)); ?>
			</div>
			<!-- YORUMLAR BİTİŞ -->	
		</div>	
	</div>
<?php
include "alt.php";
mysql_free_result($ayar);
mysql_free_result($yorumlar);
mysql_free_result($pvpliste);
?>