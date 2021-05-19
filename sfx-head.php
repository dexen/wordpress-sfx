<?php

# self-extracting archive created with wp-sfx

ini_set('error_reporting', E_ALL); ini_set('display_errors', true);

register_shutdown_function(function() { unlink(__FILE__); });

header('Content-Type: text/plain');

if (ob_get_level()) {
	function http_flush() { ob_flush(); flush(); } }
else {
	function http_flush() { flush(); } }

function PRO(string $str) { echo $str; http_flush(); }

PRO("Starting extraction\n");

function place_file(string $pn, string $compressed_body) {
	$dir = dirname($pn);
	if (!is_dir($dir))
		mkdir($dir, 0777, $recursive=true);
	file_put_contents($pn, gzinflate($compressed_body));
	PRO('.'); }

$h = fopen(__FILE__, 'r');
fseek($h, __COMPILER_HALT_OFFSET__);

$more = true;
do {
	$len = unpack('P', fread($h, 8))[1];
	if ($len) {
		$record = unserialize(fread($h, $len));
		place_file($record[0], $record[1]);
	}
} while($len);

PRO("\nAll done.\n");

__halt_compiler();