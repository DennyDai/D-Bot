<?php
PluginSet("Show help",null,false);
$plugin_list = HELP_BEGIN."\n";
foreach ($plugins as $value) {
    if ($value['visible'] == True) {
    	$plugin_list .= "\n".$value['desc'];
    }
}
$plugin_list .= "\n\n".HELP_END;
$BOT->msg($from, $plugin_list);