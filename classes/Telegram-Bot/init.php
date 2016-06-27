<?php
$BOT = new Base;
$GET = json_decode(file_get_contents("php://input"),true);

//is group?
if ($GET['message']['chat']['id'] > 0) {
	$isgroup = false;
}else{
	$isgroup = true;
}

//reply to...
    $msgid = $GET['message']['message_id'];
	$from = $GET['message']['chat']['id'];
	$date = $GET['message']['date'];
	if ((time() - $date) > 10) {
		$text = 'unset';
	}else {
		$text = $GET['message']['text'];
	}
    
define('MSGID',$msgid);