<?php
session_start();
$dil	=strip_tags($_GET["dil"]);
if ($dil =="tr" || $dil == "en" || $dil == "de" || $dil == "ru"){
	$_SESSION["dil"] = $dil;
	header("location: ".$_SERVER['HTTP_REFERER']."");
}else {
	header("Location:index.html");
}
?>