<?php
class Base
{
    public function exec($raw)
    {
    	echo $raw;
        return true;
    }
    public function msg($id, $msg)
    {
        return $this->exec("<xml>
<ToUserName><![CDATA[".$id."]]></ToUserName>
<FromUserName><![CDATA[".WC_UserName."]]></FromUserName>
<CreateTime>".time()."</CreateTime>
<MsgType><![CDATA[text]]></MsgType>
<Content><![CDATA[".$msg."]]></Content>
<MsgId>".rand(1,9999999999999)."</MsgId>
</xml>");
    }
}