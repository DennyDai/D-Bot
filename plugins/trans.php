<?php
PluginList("trans", "translate");
if (preg_match("/^".TAG."trans (.*)$/", $_GET['text'], $matches)) {
	$matches = explode(" ", $matches[1], 2);
	if (!isset($matches[1])) {
		$to = "en";
		$text = urlencode($matches[0]);
	}elseif (isset($matches[1]) and strlen($matches[0]) != 2) {
		$to = "en";
		$text = urlencode($matches[0].$matches[1]);
	}else{
		$to = $matches[0];
		$text = urlencode($matches[1]);
	}
	$trans = file_get_contents('http://api.microsofttranslator.com/v2/ajax.svc/TranslateArray2?appId=%22TKT68kjRgkUbVtIKst6Vo0Hxnb6g2f0K3tUMyn1gZ7nc*%22&to="'.$to.'"&options={}&texts=["'.$text.'"]');
	preg_match('/"TranslatedText":"([^"]+)/i', $trans, $trans_result);
	$msg = "Result: ".$trans_result[1];
	$BOT->exec("msg ".$from." ".escapeString($msg));

}