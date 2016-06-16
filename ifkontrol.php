<?php require_once('Connections/baglan.php'); ?>


<?php

$sql = mysql_query("SELECT * FROM pvplist");
 
while($dondur = mysql_fetch_array($sql))
  {
  echo $dondur['servertipi'];
  echo "<br />";
  
  }
  
  
  	$metin = $dondur['servertipi'];
	$bul = array('Kasılmalık');
	$degistir = array('Kas');
	$degistirilmis = str_replace( $bul, $degistir, $metin );
	echo ($degistirilmis);

$sayi = 95;
if($sayi > 42) //Eger sayi 42'den buyukse, hemen alt satirdaki islemleri gerceklestir.
{
echo "$sayi, 42'den büyüktür.";
}
else //Eger kosul saglanamiyorsa, hemen alt satirdaki islemleri gerceklestir.
{
echo "$sayi, belirtilen koşuldaki sayıdan büyük değildir.";
}
?>