<?php
# see http://stackoverflow.com/questions/12683530/origin-http-localhost-is-not-allowed-by-access-control-allow-origin
# smarter way might be to reconfig nginx, but this require some sysadmin work (same URL as above)

#echo ($_GET['url']);
#echo "<br>";
#echo ($_GET['email']);
#echo "<br>";

// File Name: proxy.php
if (!isset($_GET['url'])) die();
if (!isset($_GET['email'])) die();
$url = urldecode($_GET['url']);
$url = 'https://' . str_replace('https://', '', $url); // Avoid accessing the file system
#echo $url . "?email=" . urlencode($_GET['email']);
echo file_get_contents($url . "?email=" . urlencode($_GET['email']));
?>
