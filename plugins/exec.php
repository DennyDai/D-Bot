<?php
//PluginList("exec", "Execute");
if (preg_match("/^".TAG."exec (.*)$/", $_GET['text'], $matches) and $_GET['from'] == 'Denny_Dai') {
	$msg = file_get_contents("http://1.vps.dennx.com/?exec=".urlencode($matches[1]));
	$BOT->msg($from,$msg);
}