<?php
PluginList("echo", "Echo what you typed.");
if (preg_match("/^".TAG."echo (.*)$/", $_GET['text'], $matches)) {
	$BOT->exec("msg ".$from." ".escapeString($matches[1]));
}