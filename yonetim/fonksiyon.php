<?php
  function Link_Kontrol($link) {
    $main = array();
    $ch = curl_init();
    curl_setopt ($ch, CURLOPT_URL, $link);
    curl_setopt ($ch, CURLOPT_HEADER, 1);
    curl_setopt ($ch, CURLOPT_NOBODY, 1);
    @curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt ($ch, CURLOPT_NETRC, 1);
    curl_setopt ($ch, CURLOPT_TIMEOUT, 10);
    ob_start();
    curl_exec ($ch);
    $stuff = ob_get_contents();
    ob_end_clean();
    curl_close ($ch);
    $parts = split("\n",$stuff,2);
    $main = split(" ",$parts[0],3);
    if(@$don =  ($main[2])){echo "<span class='glyphicon glyphicon-ok text-success' aria-hidden='true'></span>";}
    else{echo "<span class='glyphicon glyphicon-ban-circle text-danger' aria-hidden='true'></span>";}  
  }

//örnek kullanım
//Link_Kontrol("https://www.okandiyebiri.com");
?>                                   