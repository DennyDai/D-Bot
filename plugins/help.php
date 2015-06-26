<?php
PluginList("help", "Ask for help");
if (preg_match("/^".TAG."help$/", $text)) {
	$plugin_list = HELP_BEGIN."\n";
	foreach ($plugins as $value) {
		$plugin_list .= "\n".$value;
	}
	$plugin_list .= "\n\n".HELP_END;
	$BOT->msg($from, $plugin_list);
}