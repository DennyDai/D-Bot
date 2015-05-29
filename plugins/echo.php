<?php
PluginList("echo", "输出");
if (preg_match("/^".TAG."echo (.*)$/", $_GET['text'], $matches)) {
	$BOT->exec("msg ".$from." ".$matches[1]);
}