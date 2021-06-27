<?php
$ip = $_SERVER['REMOTE_ADDR'];
echo $ip;
echo file_get_contents("http://www.geoplugin.net/php.gp?ip=$ip");
?>