<?php
PluginList("help", "Ask for help");
if (preg_match("/^".TAG."help$/", $_GET['text'])) {
	$plugin_list = "Welcome to use TG-BOT From Dennx.com";
	foreach ($plugins as $value) {
		$plugin_list .= "\n".$value;
	}
	$BOT->exec("msg ".$from." ".escapeString($plugin_list));
}