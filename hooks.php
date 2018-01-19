<?php

echo 'OK!';

$lala = file_get_contents('php://input');


$enable_log = 1;
/***************************** logging for debug *****************************/
if ($enable_log)
{
	$log_file = 'qwe_'.date("Ymd").'.txt';
	$seskey = md5(microtime());
	$text = $lala.'+K:'.$seskey.' at: '.date('r').' from: '.$_SERVER['REMOTE_ADDR'].'; '.
		'GET='.json_encode($_GET).'; '.
		'POST='.json_encode($_POST).";\n";
	$fp = @fopen($log_file,'a');
	fwrite($fp, $text);
	fclose($fp);
	unset($text);
}
/***************************** logging for debug *****************************/
