<?php
PluginList("echo", "Echo what you typed.");
if (preg_match("/^".TAG."echo (.*)$/", $_GET['text'], $matches)) {
	$BOT->msg($from, $matches[1]);
}