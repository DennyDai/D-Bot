<?php
PluginList("echo", "Echo what you typed.");
if (preg_match("/^".TAG."echo (.*)$/", $text, $matches)) {
	$BOT->msg($from, $matches[1]);
}