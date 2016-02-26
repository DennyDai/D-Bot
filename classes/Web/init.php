<?php
$BOT = new Base;

    $from = 'WebClient';
    if (file_get_contents("php://input")) {
        $text = file_get_contents("php://input");
    }elseif (!empty($_SERVER['QUERY_STRING'])){
        $text = $_SERVER['QUERY_STRING'];
    }else{
        exit;
    }