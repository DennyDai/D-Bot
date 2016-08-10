<?php
PluginSet("Search Emoji");

$plugin_emoji_json = json_decode(file_get_contents("http://emoji.getdango.com/api/emoji?q=".rawurlencode($plugin_text)),true);
$msg = '';
foreach ($plugin_emoji_json['results'] as $plugin_emoji_json_result) {
    $msg .= $plugin_emoji_json_result['text']." Score: ".$plugin_emoji_json_result['score']."\n";
}
$BOT->msg($plugin_sendto, substr($msg,0,strlen($msg)-1));