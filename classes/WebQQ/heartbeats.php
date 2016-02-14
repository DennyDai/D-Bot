<?php
ignore_user_abort();
set_time_limit(0);
include "../../config.php";

function post($url,$postfields){
	global $COOKIE;
	$ch = curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($ch,CURLOPT_ENCODING,'gzip'); 
	curl_setopt($ch,CURLOPT_POSTFIELDS,$postfields);
	curl_setopt($ch,CURLOPT_COOKIE, WQ_Cookie);
	curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows NT 6.1; rv:38.0) Gecko/20100101 Firefox/38.0');
	curl_setopt($ch,CURLOPT_REFERER,'http://d1.web2.qq.com/proxy.html');
	$data = curl_exec($ch);
	curl_close($ch);
	return $data;
}

function Heartbeats(){
	$data = post('http://d1.web2.qq.com/channel/poll2','r={"ptwebqq":"","clientid":53999199,"psessionid":"","key":""}');
	if ($data == '{"errmsg":"","retcode":0}'."\n"){
        Heartbeats();
        return;
    }
	$json = json_decode($data,true);
	$poll_type = $json['result'][0]['poll_type'];
	switch ($poll_type){
        case 'message':
            $_content = $json['result'][0]['value']['content'];
            unset($_content[0]);
            $content = convert_multi_array($_content);
            $from_uin=$json['result'][0]['value']['from_uin'];
            post(ROOT_URL.'WebQQ.php',json_encode(array('type' => 0, 'uin' => $from_uin, 'msg' => $content)));
            echo json_encode(array('type' => 0, 'uin' => $from_uin, 'msg' => $content));
            Heartbeats();
            break;
        case 'group_message':
            $_content=$json['result'][0]['value']['content'];
            unset($_content[0]);
            $content=convert_multi_array($_content);
            $from_uin=$json['result'][0]['value']['from_uin'];
            post(ROOT_URL.'WebQQ.php',json_encode(array('type' => 0, 'uin' => $from_uin, 'msg' => $content)));
            echo json_encode(array('type' => 1, 'uin' => $from_uin, 'msg' => $content));
            Heartbeats();
            break;
        default:
            Heartbeats();
            break;
	}
}



function convert_multi_array($array) {
	$out = implode(array_map(function($a) {if (is_array($a)){return '';} return $a;},$array));//ignore old qq emoticon...
	return $out;
}
Heartbeats();
?>