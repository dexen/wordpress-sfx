#!/usr/bin/env php
<?php

function remotePn(string $local_pn, int $strip_n) : string
{
	$a = explode('/', pathinfo($local_pn)['dirname']);
	if (count($a) < $strip_n)
		throw new \Exception('cannot strip enough segments');

	$a = array_slice($a, $strip_n);
	array_push($a, pathinfo($local_pn)['basename']);
	return implode('/', $a);
}

function PRO(string $str) { fputs(STDERR, $str); }

$strip_n = $argv[1];

echo file_get_contents('sfx-head.php');
#echo '# started on ' .date('Y-M-D H-m-s') ."\n\n";

#echo '$files = [' .PHP_EOL;
#echo "\n];\n";

function export_record($pn, $body)
{
	$record_str = serialize([$pn, gzdeflate($body, 9, ZLIB_ENCODING_RAW)]);
	$len = strlen($record_str);

	echo pack('P', $len);
	echo $record_str;
}

while ($line = trim(fgets(STDIN), "\n")) {
	$local_pn = $line;
	$pn = remotePn($local_pn, $strip_n);
#	var_export([$pn, gzdeflate(file_get_contents($local_pn), 9, ZLIB_ENCODING_RAW)]); echo ",\n";
#	echo "place_file(";
#		var_export($pn);
#		echo ', ';
#		var_export(gzdeflate(file_get_contents($local_pn), 9, ZLIB_ENCODING_RAW));
#	echo ");\n";

	export_record($pn, file_get_contents($local_pn));

	PRO(".");
}

echo pack('P', 0);

echo "\n";
echo file_get_contents('sfx-tail.php');
echo '# completed on ' .date('Y-M-D H-m-s') ."\n";

PRO("\nALL DONE.\n");
