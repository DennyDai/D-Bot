<?php
define('TYPE', $Pre_Type);
define('PATH', dirname(__FILE__).DIRECTORY_SEPARATOR);
define('OWNER_NAME', 'YOUR_NAME');
define('BOT_NAME', 'D_bot'); //Now For Telegram-Bot Only
define('HELP_BEGIN', "The_Sentence_Before_Help_Command");
define('HELP_END', "The_Sentence_After_Help_Command");
define('ROOT_URL', "THE_URL_TO_THIS_PATH");
$TAGs = array('\'','#','/','!'); //array for commands


//For Telegram-Bot
define('TB_TOKEN', 'YOUR_TELEGRAM_BOT_TOKEN_HERE');
define('TB_API_URL', 'https://api.telegram.org/bot'.TB_TOKEN.'/'); //DO NOT CHANGE THIS

//For Wechat-MP
define('WC_UserName', 'YOUR_WECHAT_USERNAME_HERE');

//For WebQQ
define('WQ_Cookie', 'YOUR_WEBQQ_COOKIE_HERE');

//For plugins
define('PLUGIN_GITHUB_TOKEN', 'YOUR_GITHUB_TOKEN_HERE');
define('PLUGIN_STEAM_KEY', 'YOUR_STEAM_KEY_HERE');