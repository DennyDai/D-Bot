<?php
foreach ($TAGs as $TAG) {
	if (preg_match("/^(".preg_quote($TAG, '/')."help)|(".preg_quote($TAG, '/').$plugin_name.preg_quote('@').BOT_NAME.")$/", $text)) {
		foreach ($load_plugins as $value) {
			$plugin_name = substr($value, strlen(PATH.'plugins'.DIRECTORY_SEPARATOR), -4);
			$lines=file($value);
			eval($lines[1]);
		}
		$plugin_list = HELP_BEGIN."\n";
		foreach ($plugins as $value) {
			$plugin_list .= "\n".$value;
		}
		$plugin_list .= "\n\n".HELP_END;
		$BOT->msg($from, $plugin_list);
	}
}