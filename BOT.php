<?php
//init
require('classes/Telegram/Base.php');
require('classes/Telegram/Client.php');
$BOT = new DBot\Telegram\Client('unix:///tmp/tg.sck');
require_once('init.php');
?>