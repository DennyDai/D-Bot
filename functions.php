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