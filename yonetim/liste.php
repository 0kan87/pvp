<?php require_once('../Connections/baglan.php');
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
mysql_select_db($database_baglan, $baglan);
$query_ayar = "SELECT * FROM ayar";
$ayar = mysql_query($query_ayar, $baglan) or die(mysql_error());
$row_ayar = mysql_fetch_assoc($ayar);
$totalRows_ayar = mysql_num_rows($ayar);
mysql_select_db($database_baglan, $baglan);
$query_pvpliste = "SELECT * FROM pvplist ORDER BY id DESC";
$pvpliste = mysql_query($query_pvpliste, $baglan) or die(mysql_error());
$row_pvpliste = mysql_fetch_assoc($pvpliste);
$totalRows_pvpliste = mysql_num_rows($pvpliste);
include "ust.php";
include "fonksiyon.php";
?>
    <div class="container">
      <div class="table-responsive">
  		<table class="table table-hover table-bordered table-responsive">
  			<thead bgcolor="#222222" style="color:white;">
  				<tr>
  					<td>#</td>
  					<td class="hidden-xs">Başlık</td>
  					<td class="hidden-xs">Durum</td>
  					<td>Link</td>
  					<td class="hidden-xs">Server Tipi</td>
  					<td class="hidden-xs">Kapasite</td>
  					<td colspan="3">Yayınlanma Durumu</td>
  				</tr>
  			</thead>
  	      	<?php do { ?>
  		        <tr>
  				  <td width="16"><img width="16px;" src="<?php echo $row_pvpliste['link']; ?>/favicon.ico" onError="this.src='https://www.google.com.tr/favicon.ico';" border="0"/></td>
  		          <td class="hidden-xs"><?php echo $row_pvpliste['baslik']; ?></td>
  		          <td class="hidden-xs"><?php Link_Kontrol($row_pvpliste['link']);?></td>
                <!-- Veya <td class="hidden-xs"><?php echo $row_pvpliste['durum']; ?></td> -->
  		          <td ><a href="<?php echo $row_pvpliste['link']; ?>"><?php echo $row_pvpliste['link']; ?></a></td>
  		          <td class="hidden-xs"><?php echo $row_pvpliste['servertipi']; ?></td>
  		          <td class="hidden-xs"><?php echo $row_pvpliste['uridium']; ?></td>
  		          <td><?php echo $row_pvpliste['yayinlanmadurumu']; ?></td>
  		          <td><center><a href="pvp-link-<?php echo $row_pvpliste['id']; ?>-duzenle.html"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></center></td>
  		          <td><center><a href="liste-sil.php?id=<?php echo $row_pvpliste['id']; ?>"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></center></td>
  		        </tr>
  	        <?php } while ($row_pvpliste = mysql_fetch_assoc($pvpliste)); ?>
    		</table>
        </div>
    </div>
<?php
include "alt.php";
mysql_free_result($ayar);
mysql_free_result($pvpliste);
?>