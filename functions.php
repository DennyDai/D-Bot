<?php
function escapeString($var){
        return '"' . addslashes($var) . '"';
}

function escapePeer($peer){
        return str_replace(' ', '_', $peer);
}

function PluginList($commands, $name){
        global $plugins;
        $plugins[] .= TAG.$commands." ".$name;
}

function init_bot($var){
		global $BOT;
        require('classes/'.$var.'/Base.php');
        $classname = 'DBot\\'.$var.'\Base';
		$BOT = new $classname('unix:///tmp/'.$var.'.sck');
}