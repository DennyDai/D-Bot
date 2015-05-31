<?php
PluginList("help", "Ask for help");
if (preg_match("/^".TAG."help$/", $_GET['text'])) {
	$plugin_list = HELP_BEGIN."\n";
	foreach ($plugins as $value) {
		$plugin_list .= "\n".$value;
	}
	$plugin_list .= "\n\n".HELP_END;
	$BOT->exec("msg ".$from." ".escapeString($plugin_list));
}