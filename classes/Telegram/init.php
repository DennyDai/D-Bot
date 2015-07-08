<?php
$BOT = new Base('unix:///tmp/tg.sck');
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

	$text = $_GET['text'];
}