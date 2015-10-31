<?php
define('TYPE', 'Telegram-Bot');
define('PATH', dirname(__FILE__).DIRECTORY_SEPARATOR);
define('OWNER_NAME', 'Denny Dai');
define('BOT_NAME', 'D_bot');
define('HELP_BEGIN', "Welcome to use TG-BOT");
define('HELP_END', "GitHub: https://github.com/dennydai/D-bot\nAuthor: @DennyDai");
$TAGs = array('#','/','!');


//For Telegram-Bot
define('TB_TOKEN', 'YOU_TELEGRAM_BOT_TOKEN_HERE');
define('TB_API_URL', 'https://api.telegram.org/bot'.TB_TOKEN.'/');

//For plugins
define('PLUGIN_GITHUB_TOKEN', 'YOU_GITHUB_TOKEN_HERE');

//For Wechat
define('WC_UserName', 'YOU_WECHAT_USERNAME_HERE');
