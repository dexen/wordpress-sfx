<?php

# self-extracting archive created with wp-sfx

ini_set('error_reporting', E_ALL); ini_set('display_errors', true);

register_shutdown_function(function() { unlink(__FILE__); });
