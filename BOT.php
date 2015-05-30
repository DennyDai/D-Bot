<?php
//init
require('classes/Telegram/Base.php');
$BOT = new DBot\Telegram\Base('unix:///tmp/tg.sck');
require_once('init.php');
?>