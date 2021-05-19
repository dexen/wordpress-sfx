
foreach ($files as list($pn, $content)) {
	$dir = dirname($pn);
	if (!is_dir($dir))
		mkdir($dir, 0777, $recursive=true);
	file_put_contents($pn, $content); }

# end of self-extracting archicve created with wp-sfx
