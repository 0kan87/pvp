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
    if(@$don =  ($main[2])){echo '
    <li class="list-group-item" style="background-color:#dff0d8; color:#3c763d"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
        <span class="sr-only">Çok iyi:</span>
        Sistemimiz bu sitenin hala yayında olduğunu tespit etti!
    </li>';}
    else{echo '
    <li class="list-group-item" style="background-color:#f2dede; color:#a94442;"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <span class="sr-only">Dikkat:</span>
        Bu site geçici olarak kullanılamıyor yada artık yayında değil!
    </li>';}  
  }

//örnek kullanım
//Link_Kontrol("https://www.okandiyebiri.com");

function Seo($s) {
    $tr = array('ş','Ş','ı','I','İ','ğ','Ğ','ü','Ü','ö','Ö','Ç','ç','(',')','/',':',',','â');
    $eng = array('s','s','i','i','i','g','g','u','u','o','o','c','c','','','-','-','','a');
    $s = str_replace($tr,$eng,$s);
    $s = strtolower($s);
    $s = preg_replace('/&amp;amp;amp;amp;amp;amp;amp;amp;amp;.+?;/', '', $s);
    $s = preg_replace('/\s+/', '-', $s);
    $s = preg_replace('|-+|', '-', $s);
    $s = preg_replace('/#/', '', $s);
    $s = str_replace('.', '', $s);
    $s = str_replace('\'', '-', $s);
    $s = trim($s, '-');
    return $s;
}

function kisalt($data,$x){ 
    $data    = strip_tags($data); 
    return mb_substr($data,0,$x,"UTF-8").'...'; 
}

//Kullanım yazının verisi, kaç karakter kısalacağı
//echo kisalt($veri,100); 
?>                                   