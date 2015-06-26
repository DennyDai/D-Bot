<?php

require_once('config.inc.php');
require_once('functions.php');
$plugins = [];

if($_GET['from'] != escapePeer(BOT_NAME)){
//is group?
	if ($_GET['to'] == escapePeer(BOT_NAME)) {
		$isgroup = false;
	}else{
		$isgroup = true;
	}

//reply to...
	if ($isgroup) {
		$from = $_GET['to'];
	}else{
		$from = $_GET['from'];
		$BOT->exec("msg ".escapePeer(OWNER_NAME)." ".json_encode($_GET));
	}

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
}