<?php

ob_start("callback");
ob_start();
header("Content-Type: application/octet-stream");
$ch = curl_init($_REQUEST['url']);

curl_setopt($ch, CURLOPT_HEADER, 0);
//curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//curl_setopt($ch, CURLOPT_FILE, STDOUT);

$data = curl_exec($ch);

curl_close($ch);
//ob_end_flush();
$filename = $_REQUEST['artist'] . " - " . $_REQUEST['song'] . ".mp3";

if(!file_exists($filename)){
	$fp = fopen($filename, "w");
	fwrite($fp, ob_get_contents());
	fclose($fp);	
	chmod($filename, 0666);
}

?>