<?php require_once('Connections/baglan.php');
$p = $_GET["p"];
	session_start();
	if (!@$_SESSION["dil"]){
		require("dil/tr.php");
	}else {
		require("dil/".$_SESSION["dil"].".php");
	}
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 7) {
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

$maxRows_pvpliste = 300;
$pageNum_pvpliste = 0;
if (isset($_GET['pageNum_pvpliste'])) {
  $pageNum_pvpliste = $_GET['pageNum_pvpliste'];
}
$startRow_pvpliste = $pageNum_pvpliste * $maxRows_pvpliste;

mysql_select_db($database_baglan, $baglan);
$query_pvpliste = "SELECT * FROM pvplist WHERE id='{$p}'";
$pvpliste = mysql_query($query_pvpliste, $baglan) or die(mysql_error());
$row_pvpliste = mysql_fetch_assoc($pvpliste);
$totalRows_pvpliste = mysql_num_rows($pvpliste);

include "yonetim/fonksiyon.php";
include "ust.php";
?>
    <div class="container">
		<div class="col-md-2 hidden-xs hidden-sm"><center><img src="http://placehold.it/160x600"></center></div>
		
			<!-- PVP AÇIKLAMA -->
			<div class="col-md-8">
				<div class="hidden-xs hidden-sm" style="padding-bottom:10px;"><center><img src="http://placehold.it/728x90"></center></div>	
				<div class="panel panel-primary">
				  <!-- Varsayılan panel içeriği -->
				  <div class="panel-heading"><h2><?php echo $row_pvpliste['baslik']; ?></h2></div>
				  <!-- Liste grubu -->
				  <ul class="list-group">
				    <li class="list-group-item"><?php echo $dil["servertipi"];?>:</strong> <?php echo $row_pvpliste['servertipi']; ?><span class="pull-right"><a href="<?php echo $row_pvpliste['link']; ?>"><?php echo $dil['ziyaret']; ?></a></span></li>
				    <?php Link_Kontrol($row_pvpliste['link']);?>
				  </ul>
				  <div class="panel-body">
				    <?php echo $row_pvpliste['uridium']; ?>
				  </div>
				</div>
				<div id="disqus_thread" class="bosluk" style="background-color:white; padding:20px; border-top-left-radius: 3px; border-top-right-radius: 3px;"></div>
				<script>
				(function() { // DON'T EDIT BELOW THIS LINE
		   		var d = document, s = d.createElement('script');
		    		s.src = '//pvp-list.disqus.com/embed.js';
		    		s.setAttribute('data-timestamp', +new Date());
		    		(d.head || d.body).appendChild(s);
				})();
				</script>
			</div>

		<div class="col-md-2 hidden-xs hidden-sm"><center><img src="http://placehold.it/160x600"></center></div>

	</div>
<?php
include "alt.php";
mysql_free_result($ayar);
mysql_free_result($pvpliste);
?>