<?php
$BOT = new Base;
$GET = json_decode(file_get_contents("php://input"),true);

//is group?
if ($GET['type'] = 0) {
	$isgroup = false;
}else{
	$isgroup = true;
}

	$from = $GET['uin'];
	$text = $GET['msg'];