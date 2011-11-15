<?php

function lwrite($mess) {
	$lfile = fopen("/var/www/logs/genlog","a+");	
	fwrite($lfile,date('Y-m-d H:i:s')." $mess\n");
	fclose($lfile);
}

?>