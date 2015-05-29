<?php
PluginList("tts", "Text To Speech");
if (preg_match("/^".TAG."tts (.*)$/", $_GET['text'], $matches)) {
	$mp3 = file_get_contents("http://tts.baidu.com/text2audio?lan=zh&ie=UTF-8&text=".$matches[1]);
	$file = fopen($_GET['from'].".mp3","w");
	echo fwrite($file,$mp3);
	fclose($file);
	$BOT->exec("send_audio ".$from." /home/wwwroot/1.vps.dennx.com/".$_GET['from'].".mp3");
	//unlink($matches[1].".mp3");
}