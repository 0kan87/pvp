<?php require_once('../Connections/baglan.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}

$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "../index.html";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  $isValid = False; 

  if (!empty($UserName)) { 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "giris.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE vpvplist SET baslik=%s, durum=%s, link=%s, servertipi=%s, uridium=%s, yayinlanmadurumu=%s WHERE id=%s",
   GetSQLValueString($_POST['baslik'], "text"),
   GetSQLValueString($_POST['durum'], "text"),
   GetSQLValueString($_POST['link'], "text"),
   GetSQLValueString($_POST['servertipi'], "text"),
   GetSQLValueString($_POST['uridium'], "text"),
   GetSQLValueString($_POST['yayinlanmadurumu'], "text"),
   GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_baglan, $baglan);
  $Result1 = mysql_query($updateSQL, $baglan) or die(mysql_error());

  $updateGoTo = "vip-liste.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

mysql_select_db($database_baglan, $baglan);
$query_ayar = "SELECT * FROM ayar";
$ayar = mysql_query($query_ayar, $baglan) or die(mysql_error());
$row_ayar = mysql_fetch_assoc($ayar);
$totalRows_ayar = mysql_num_rows($ayar);

$colname_pvpliste = "-1";
if (isset($_GET['id'])) {
  $colname_pvpliste = $_GET['id'];
}
mysql_select_db($database_baglan, $baglan);
$query_pvpliste = sprintf("SELECT * FROM vpvplist WHERE id = %s", GetSQLValueString($colname_pvpliste, "int"));
$pvpliste = mysql_query($query_pvpliste, $baglan) or die(mysql_error());
$row_pvpliste = mysql_fetch_assoc($pvpliste);
$totalRows_pvpliste = mysql_num_rows($pvpliste);
include "ust.php";
?>
  <div class="container">
  <div class="row">
  	<div class="col-md-6 col-md-offset-3">
    	<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
      	<div class="input-group">
        	<span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span></span>
        	<input type="text" name="baslik" value="<?php echo htmlentities($row_pvpliste['baslik'], ENT_COMPAT, 'utf-8'); ?>" class="form-control" placeholder="Site başlığını yazın..." aria-describedby="sizing-addon2" required>
      	</div></br>

      	<div class="input-group">
        	<span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span> Server Durumu</span>
        	<select name="durum" class="form-control" aria-describedby="sizing-addon2">
        	<option value="Açık" <?php if (!(strcmp("Açık", htmlentities($row_pvpliste['durum'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Açık</option>
        	<option value="Kapalı" <?php if (!(strcmp("Kapalı", htmlentities($row_pvpliste['durum'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Kapalı</option>
        	</select>
      	</div></br>

      	<div class="input-group">
        	<span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-link" aria-hidden="true"></span></span>
        	<input type="text" name="link" value="<?php echo htmlentities($row_pvpliste['link'], ENT_COMPAT, 'utf-8'); ?>" class="form-control" placeholder="http://" required>
      	</div></br>

      	<div class="input-group">
        	<span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span> Server Tipi</span>
        	<select name="servertipi" class="form-control" aria-describedby="sizing-addon2">
        	<option value="Kasılmalık" <?php if (!(strcmp("Kasılmalık", htmlentities($row_pvpliste['servertipi'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Kasılmalık</option>
        	<option value="VSlik" <?php if (!(strcmp("Vslik", htmlentities($row_pvpliste['servertipi'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>VSlik</option>
        	<option value="Bilinmiyor" <?php if (!(strcmp("Bilinmiyor", htmlentities($row_pvpliste['servertipi'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Bilinmiyor</option>
        	</select>
      	</div></br>

      <div class="form-group">
        <textarea type="text" id="editor1" name="uridium" class="ckeditor form-control" id="textarea" placeholder="<?php echo $dil["rakamsaldeger"];?>" rows="8"><?php echo htmlentities($row_pvpliste['uridium']); ?></textarea>
            <script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'editor1' );
                config.extraPlugins = 'uploadimage';
            </script>       
      </div>

      	<div class="input-group">
        	<span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Yayınlanma Durumu</span>
        	<select name="yayinlanmadurumu" class="form-control" aria-describedby="sizing-addon2">
        	<option value="Yayınlanmış" <?php if (!(strcmp("Yayınlanmış", htmlentities($row_pvpliste['yayinlanmadurumu'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Yayınla</option>
        	<option value="Taslak" <?php if (!(strcmp("Taslak", htmlentities($row_pvpliste['yayinlanmadurumu'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Taslak</option>
        	</select>
      	</div></br>

      	<div class="input-group">
        	<input type="submit" value="Kaydı Güncelleştir" class="btn btn-info"/>
          <input type="hidden" name="MM_update" value="form1" />
          <input type="hidden" name="id" value="<?php echo $row_pvpliste['id']; ?>" />
        </div>
      </form>
    </div>
  </div></br></br>
<?php
include "alt.php";
mysql_free_result($ayar);
mysql_free_result($pvpliste);
?>