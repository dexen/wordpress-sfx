<?php

# self-extracting archive created with wp-sfx

ini_set('error_reporting', E_ALL); ini_set('display_errors', true);

register_shutdown_function(function() { unlink(__FILE__); });

if (ob_get_level()) {
	function http_flush() { ob_flush(); flush(); } }
else {
	function http_flush() { flush(); } }

function PRO(string $str) { echo $str; http_flush(); }

PRO("Starting extraction\n");
