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
		$plugin_name = substr($value, strlen(PATH.'plugins'.DIRECTORY_SEPARATOR), -4);
		if (preg_match("/^(".preg_quote(TAG, '/').$plugin_name."|".preg_quote(TAG, '/').$plugin_name.preg_quote('@').BOT_NAME.") (.*)$/", $text, $matches)) {
			$plugin_text = $matches[2];
			$plugin_sendto = $from;
			require_once $value;
			break;
		}
	}

	require_once PATH.'plugins'.DIRECTORY_SEPARATOR.'help.php';



?>