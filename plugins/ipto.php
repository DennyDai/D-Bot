<?php
PluginList("ipto", "IP变形");
if (preg_match("/^".TAG."ipto (.*)$/", $_GET['text'], $matches)) {
	$arr = explode('.',$matches[1]);
	$msg = '原IP: '.$arr[0].'.'.$arr[1].'.'.$arr[2].'.'.$arr[3];
	$msg .= "\n整数型: ".($arr[0] * pow(256,3) + $arr[1] * pow(256,2) + $arr[2] * 256 + $arr[3]);
	$msg .= "\n八进制: 0".decoct($arr[0]).".0".decoct($arr[1]).".0".decoct($arr[2]).'.0'.decoct($arr[3]);
	$msg .= "\n十六进制: 0x".dechex($arr[0]).".0x".dechex($arr[1]).".0x".dechex($arr[2]).'.0x'.dechex($arr[3]);
	$msg .= "\n变态十六进制: 0x0000000000".dechex($arr[0]).".0x0000000000".dechex($arr[1]).".0x0000000000".dechex($arr[2]).'.0x0000000000'.dechex($arr[3]);
	$msg .= "\n原ip、八进制、十六进制以及变态十六进制ip可以任意组合，如: 0".decoct($arr[0]).'.0x0000000000'.dechex($arr[1]).'.'.$arr[2].'.0x'.dechex($arr[3]);
	$BOT->exec("msg ".$from." ".escapeString($msg));
}