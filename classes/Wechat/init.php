<?php
$BOT = new Base;
$GET = $raw = file_get_contents("php://input");

//reply to...
preg_match('/<ToUserName><!\[CDATA\[(.*)\]\]><\/ToUserName>/', $raw, $FromUserName);
$FromUserName = $FromUserName[1];
preg_match('/<FromUserName><!\[CDATA\[(.*)\]\]><\/FromUserName>/', $raw, $ToUserName);
$ToUserName = $ToUserName[1];
preg_match('/<Content><!\[CDATA\[(.*)\]\]><\/Content>/', $raw, $Content);
$Content = $Content[1];

    $from = $ToUserName;
    $text = $Content;