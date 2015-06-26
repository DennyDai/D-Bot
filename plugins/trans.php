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
	$trans = file_get_contents('http://api.microsofttranslator.com/v2/ajax.svc/TranslateArray2?appId=%22TWQET6TO9c7Iw1yXOahFm8zfEzty5DUHuaTHkl5SCrHUPgu3ABP7aflbz8teet6IS%22&to="'.$to.'"&options={}&texts=["'.$text.'"]');
	preg_match("/\[{.*?\}]/is", $trans, $trans_json);
	$msg = "Result: ".json_decode($trans_json[0],true)[0]["TranslatedText"];
	$BOT->msg($from, $msg);

}