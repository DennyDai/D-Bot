<?php
function escapeString($var){
        return '"' . addslashes($var) . '"';
}

function escapePeer($peer){
        return str_replace(' ', '_', $peer);
}

function PluginSet($desc){
        global $plugins,$plugin_name;
        $plugins[] .= TAG.$plugin_name." ".$desc;
}