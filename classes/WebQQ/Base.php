<?php
class Base
{
    public function exec($raw)
    {
    	echo $raw;
        return true;
    }
    public function post($url,$postfields)
    {
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch,CURLOPT_ENCODING, 'gzip'); 
        curl_setopt($ch,CURLOPT_POSTFIELDS, $postfields);
        curl_setopt($ch,CURLOPT_COOKIE, WQ_Cookie);
        curl_setopt($ch,CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; rv:38.0) Gecko/20100101 Firefox/38.0');
        curl_setopt($ch,CURLOPT_REFERER, 'http://d1.web2.qq.com/proxy.html');
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }
    public function msg($id, $msg)
    {
        global $isgroup;
        $sp = [];
        if (floor(strlen($msg)/200) > 1) {
            $sp_num = floor(strlen($msg)/300);
            for ($i=0; $i < $sp_num; $i++) {
                $sp[$i] = substr($msg,$i*300,300);
            }
            foreach ($sp as $sps) {
                        if($isgroup){
                            $this->post('http://d1.web2.qq.com/channel/send_qun_msg2','r={"group_uin":'.$id.',"content":"[\"'.$sps.'\",[\"font\",{\"name\":\"\",\"size\":10,\"style\":[0,0,0],\"color\":\"000000\"}]]","face":0,"clientid":53999199,"msg_id":0,"psessionid":""}');
                        }else{
                            $this->post('http://d1.web2.qq.com/channel/send_buddy_msg2','r={"to":'.$id.',"content":"[\"'.$sps.'\",[\"font\",{\"name\":\"\",\"size\":10,\"style\":[0,0,0],\"color\":\"000000\"}]]","face":0,"clientid":53999199,"msg_id":0,"psessionid":""}');
                        }
            }
        }else{
            if($isgroup){
                $this->post('http://d1.web2.qq.com/channel/send_qun_msg2','r={"group_uin":'.$id.',"content":"[\"'.$msg.'\",[\"font\",{\"name\":\"\",\"size\":10,\"style\":[0,0,0],\"color\":\"000000\"}]]","face":0,"clientid":53999199,"msg_id":0,"psessionid":""}');
            }else{
                $this->post('http://d1.web2.qq.com/channel/send_buddy_msg2','r={"to":'.$id.',"content":"[\"'.$msg.'\",[\"font\",{\"name\":\"\",\"size\":10,\"style\":[0,0,0],\"color\":\"000000\"}]]","face":0,"clientid":53999199,"msg_id":0,"psessionid":""}');
            }
        }
        return 1;
    }
}