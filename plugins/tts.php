<?php
PluginList("tts", "Text To Speech");
if (preg_match("/^".preg_quote(TAG, '/')."tts (.*)$/", $text, $matches)) {
	$mp3 = file_get_contents("http://tts.baidu.com/text2audio?lan=zh&ie=UTF-8&text=".urlencode($matches[1]));
	$file = fopen($from.".mp3","w");
	echo fwrite($file,$mp3);
	fclose($file);
	$BOT->send_audio($from, "/home/wwwroot/1.vps.dennx.com/".$from.".mp3");
	//unlink($matches[1].".mp3");
}