<?php
$hostname_baglan = "localhost";
$database_baglan = "pvp";
$username_baglan = "root";
$password_baglan = "";
@$baglan = mysql_pconnect($hostname_baglan, $username_baglan, $password_baglan) or trigger_error(mysql_error(),E_USER_ERROR);

# Veri tabanına Türkçe Karakter hatası olmadan kayıt yapalım #
mb_internal_encoding('UTF-8');
mysql_query('SET NAMES UTF8');
mysql_query("SET CHARACTER SET utf8");
mysql_query("SET COLLATION_CONNECTION = 'utf8_turkish_ci'");
?>