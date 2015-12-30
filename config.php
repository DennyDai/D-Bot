<?php
define('TYPE', $Pre_Type);
define('PATH', dirname(__FILE__).DIRECTORY_SEPARATOR);
define('OWNER_NAME', 'Denny Dai');
define('BOT_NAME', 'D_bot');
define('HELP_BEGIN', "Welcome to use D-BOT");
define('HELP_END', "GitHub: https://github.com/dennydai/D-bot\nAuthor: @DennyDai");
$TAGs = array('#','/','!');


//For Telegram-Bot
define('TB_TOKEN', 'YOUR_TELEGRAM_BOT_TOKEN_HERE');
define('TB_API_URL', 'https://api.telegram.org/bot'.TB_TOKEN.'/');

//For plugins
define('PLUGIN_GITHUB_TOKEN', 'YOUR_GITHUB_TOKEN_HERE');

//For Wechat-MP
define('WC_UserName', 'YOUR_WECHAT_USERNAME_HERE');
