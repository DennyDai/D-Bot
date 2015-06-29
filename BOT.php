<?php
//init
require_once('config.php');
require_once('functions.php');
$plugins = [];

require(PATH.'classes'.DIRECTORY_SEPARATOR.TYPE.DIRECTORY_SEPARATOR.'Base.php');
require_once(PATH.'classes'.DIRECTORY_SEPARATOR.TYPE.DIRECTORY_SEPARATOR.'init.php');

//load plugins
	$load_plugins = glob(PATH.'plugins'.DIRECTORY_SEPARATOR.'*.php');
	foreach ($load_plugins as $key => $value) {
		if ($value == PATH.'plugins'.DIRECTORY_SEPARATOR.'help.php') {
			unset($load_plugins[$key]);
		}
	}
	foreach ($load_plugins as $value) {
		require_once $value;
	}
	require_once PATH.'plugins'.DIRECTORY_SEPARATOR.'help.php';

?>