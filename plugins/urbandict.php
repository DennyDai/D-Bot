<?php
PluginSet("Urban Dictionary");

$msg = $plugin_text;
$plugin_urbandict_raw = json_decode(file_get_contents("http://api.urbandictionary.com/v0/define?term=".$plugin_text),true);
foreach ($plugin_urbandict_raw['list'] as $plugin_urbandict_sublist) {
    $msg .= "\n------------------\n".$plugin_urbandict_sublist['definition']."\n\n".$plugin_urbandict_sublist['permalink'];
}
$BOT->msg($plugin_sendto, $msg);
