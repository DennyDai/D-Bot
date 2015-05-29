<?php
PluginList("dzdown", "Discuz! 免积分下载");
if (preg_match("/^".TAG."dzdown (.*)$/", $_GET['text'], $matches)) {
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
	$BOT->exec("msg ".$from." ".escapeString($msg));
}