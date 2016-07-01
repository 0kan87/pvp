<?php require_once('Connections/baglan.php');
	session_start();
	if (!@$_SESSION["dil"]){
		require("dil/tr.php");
	}else {
		require("dil/".$_SESSION["dil"].".php");
	}
?>
<?php
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO pvplist (id, baslik, durum, link, servertipi, uridium, yayinlanmadurumu) VALUES (%s, %s, %s, %s, %s, %s, %s)",
       GetSQLValueString($_POST['id'], "int"),
       GetSQLValueString($_POST['baslik'], "text"),
       GetSQLValueString($_POST['durum'], "text"),
       GetSQLValueString($_POST['link'], "text"),
       GetSQLValueString($_POST['servertipi'], "text"),
       GetSQLValueString($_POST['uridium'], "text"),
       GetSQLValueString($_POST['yayinlanmadurumu'], "text"));

  mysql_select_db($database_baglan, $baglan);
  $Result1 = mysql_query($insertSQL, $baglan) or die(mysql_error());

  $insertGoTo = "tesekkurler.html";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_baglan, $baglan);
$query_ayar = "SELECT * FROM ayar";
$ayar = mysql_query($query_ayar, $baglan) or die(mysql_error());
$row_ayar = mysql_fetch_assoc($ayar);
$totalRows_ayar = mysql_num_rows($ayar);

$colname_linkekle = "-1";
if (isset($_GET['id'])) {
  $colname_linkekle = $_GET['id'];
}
mysql_select_db($database_baglan, $baglan);
$query_linkekle = sprintf("SELECT * FROM pvplist WHERE id = %s", GetSQLValueString($colname_linkekle, "int"));
$linkekle = mysql_query($query_linkekle, $baglan) or die(mysql_error());
$row_linkekle = mysql_fetch_assoc($linkekle);
$totalRows_linkekle = mysql_num_rows($linkekle);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $row_ayar['siteadi']; ?></title>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link href="css/sosyal.css" rel="stylesheet">
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
	<div class="navbar navbar-inverse navbar-static-top">
		<div class="container">
			<a href="#" class="navbar-brand"><?php echo $row_ayar['siteadi']; ?></a>
			<button class="navbar-toggle" data-toggle="collapse" data-target=".navbarSec">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<div class="collapse navbar-collapse navbarSec">
				<ul class="nav navbar-nav navbar-right">
					<li class="active"><a href="index.html"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> <?php echo $dil["anasayfa"];?></a></li>
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
			</div>
		</div>
	</div>
    <div class="container">

	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
			<div class="input-group">
				<span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span></span>
				<input type="text" name="baslik" class="form-control" placeholder="<?php echo $dil["sitebasligi"];?>" aria-describedby="sizing-addon2" required>
			</div></br>

			<div class="input-group">
				<span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span> <?php echo $dil["durum"];?></span>
				<select name="durum" class="form-control" aria-describedby="sizing-addon2">
				<option value="Açık" <?php if (!(strcmp("Açık", ""))) {echo "SELECTED";} ?>><?php echo $dil["acik"];?></option>
				<option value="Kapalı" <?php if (!(strcmp("Kapalı", ""))) {echo "SELECTED";} ?>><?php echo $dil["kapali"];?></option>
				</select>
			</div></br>

			<div class="input-group">
				<span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-link" aria-hidden="true"></span></span>
				<input type="url" name="link" class="form-control" placeholder="http://" required>
			</div></br>

			<div class="input-group">
				<span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span> <?php echo $dil["servertipi"];?></span>
				<select name="servertipi" class="form-control" aria-describedby="sizing-addon2">
				<option value="Kasılmalık" <?php if (!(strcmp("Kasılmalık", ""))) {echo "SELECTED";} ?>><?php echo $dil["kasilmalik"];?></option>
				<option value="VSlik" <?php if (!(strcmp("VSlik", ""))) {echo "SELECTED";} ?>><?php echo $dil["vslik"];?></option>
				<option value="Bilinmiyor" <?php if (!(strcmp("Bilinmiyor", ""))) {echo "SELECTED";} ?>><?php echo $dil["bilinmiyor"];?></option>
				</select>
			</div></br>

			<div class="input-group">
				<span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-transfer" aria-hidden="true"></span> Kapasite</span>
				<input type="number" name="uridium" class="form-control" placeholder="<?php echo $dil["rakamsaldeger"];?>" required>
			</div></br>
				<input type="submit" value="<?php echo $dil["gonder"];?>" class="form-control btn btn-primary">
				<input type="hidden" name="yayinlanmadurumu" value="Taslak" />
				<input type="hidden" name="MM_insert" value="form1" />
			</form></br></br>
		</div>
    </div>

  <div class="navbar navbar-default navbar-fixed-bottom">
    <div class="container">
      <p class="navbar-text pull-left">© 2014 - <?php echo date("o"); ?> Okan IŞIK
           <a href="//okandiyebiri.com" target="_blank" >Pvp Listesi Scripti</a>
      </p>
      <a href="<?php echo $row_ayar['footerlink']; ?>" class="hidden-xs navbar-btn btn-default btn pull-right">
      <span class="glyphicon glyphicon-bookmark"></span>  <?php echo $row_ayar['footersol']; ?></a>
    </div>
  </div>


	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
	<script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
	<script src="js/bootstrap.js"></script>
	<script src="js/aramayap.js"></script>
</body>
</html>
<?php
mysql_free_result($ayar);
mysql_free_result($linkekle);
?>
