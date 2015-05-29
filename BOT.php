<?php
//init
require('classes/Telegram/Base.php');
$BOT = new DBot\Telegram\Client('unix:///tmp/tg.sck');
require_once('init.php');
?>