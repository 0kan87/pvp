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
include "ust.php";
?>
    <div class="container">

	<div class="row">
		<div class="col-md-6 col-md-offset-3">
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

			<div class="form-group">
				<textarea type="text" id="editor1" name="uridium" class="ckeditor form-control" id="textarea" placeholder="<?php echo $dil["rakamsaldeger"];?>" rows="8" required>
				</textarea>
            <script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'editor1' );
                config.extraPlugins = 'uploadimage';
            </script>				
			</div>
				<input type="submit" value="<?php echo $dil["gonder"];?>" class="form-control btn btn-primary">
				<input type="hidden" name="yayinlanmadurumu" value="Taslak" />
				<input type="hidden" name="MM_insert" value="form1" />
			</form></br></br></br>
		</div>
    </div>

<?php
include "alt.php";
mysql_free_result($ayar);
mysql_free_result($linkekle);
?>
