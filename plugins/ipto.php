<?php
PluginList("ipto", "Change the form of IP address");
if (preg_match("/^".TAG."ipto (.*)$/", $text, $matches)) {
	$arr = explode('.',$matches[1]);
	$msg = 'IP: '.$arr[0].'.'.$arr[1].'.'.$arr[2].'.'.$arr[3];
	$msg .= "\nint: ".($arr[0] * pow(256,3) + $arr[1] * pow(256,2) + $arr[2] * 256 + $arr[3]);
	$msg .= "\noct: 0".decoct($arr[0]).".0".decoct($arr[1]).".0".decoct($arr[2]).'.0'.decoct($arr[3]);
	$msg .= "\nhex: 0x".dechex($arr[0]).".0x".dechex($arr[1]).".0x".dechex($arr[2]).'.0x'.dechex($arr[3]);
	$msg .= "\nfucking hex: 0x0000000000".dechex($arr[0]).".0x0000000000".dechex($arr[1]).".0x0000000000".dechex($arr[2]).'.0x0000000000'.dechex($arr[3]);
	$msg .= "\nYou can combine them with any combination. Such as: 0".decoct($arr[0]).'.0x0000000000'.dechex($arr[1]).'.'.$arr[2].'.0x'.dechex($arr[3]);
	$BOT->msg($from, $msg);
}