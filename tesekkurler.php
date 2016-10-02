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
    <br/><br/><br/><br/><br/>
    <div class="alert alert-warning alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      Teşekkürler..! Eklemiş olduğunuz link yönetici tarafından en kısa sürede onaylanacaktır. <a href="index.html"><strong>Anasayfaya</strong></a> dönebilirsiniz...
    </div>
  </div></br></br>
<?php
include "alt.php";
mysql_free_result($ayar);
mysql_free_result($linkekle);
?>