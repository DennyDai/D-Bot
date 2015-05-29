<?php
//PluginList("trans", "翻译");
if (preg_match("/^".TAG."trans (.*)$/", $_GET['text'], $matches)) {
	$matches = explode(" ", $matches[1], 2);
	if (!isset($matches[1])) {
		$to = "zh";
		$text = $matches[0];
	}else{
		$to = $matches[0];
		$text = $matches[1];
	}
	$trans = file_get_contents("http://tool.dennx.com/translate/?text=".$text."&to=".$to);
	$msg = "翻译结果: ".$trans;
	$BOT->exec("msg ".$from." ".escapeString($msg));

}