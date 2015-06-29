<?php
$BOT = new DBot\Base;
$GET = json_decode(file_get_contents("php://input"),true);

//is group?
if ($GET['message']['chat']['id'] > 0) {
	$isgroup = false;
}else{
	$isgroup = true;
}
//reply to...

	$from = $GET['message']['chat']['id'];
	$text = $GET['message']['text'];