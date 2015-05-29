<?php
PluginList("help", "查看帮助");
if (preg_match("/^".TAG."help$/", $_GET['text'])) {
	$plugin_list = "欢迎使用来自Dennx.com的TG-BOT";
	foreach ($plugins as $value) {
		$plugin_list .= "\n".$value;
	}
	$BOT->exec("msg ".$from." ".escapeString($plugin_list));
}