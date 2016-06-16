<?php
//init
$Pre_Type = $_SERVER['QUERY_STRING'];
require_once('config.php');

require(PATH.'classes'.DIRECTORY_SEPARATOR.TYPE.DIRECTORY_SEPARATOR.'Base.php');
require_once(PATH.'classes'.DIRECTORY_SEPARATOR.TYPE.DIRECTORY_SEPARATOR.'init.php');

//load plugins
$load_plugins = glob(PATH.'plugins'.DIRECTORY_SEPARATOR.'*.php');

foreach ($TAGs as $TAG) {
    foreach ($load_plugins as $value) {
        $plugin_name = substr($value, strlen(PATH.'plugins'.DIRECTORY_SEPARATOR), -4);
        eval(file($value)[1]);
        $plugin_sendto = $from;
        if (preg_match("/^(".preg_quote($TAG, '/').$plugin_name."|".preg_quote($TAG, '/').$plugin_name.preg_quote('@').BOT_NAME.") (.*)$/", $text, $matches)) {
            $plugin_text = $matches[2];
            require_once $value;
            break;
        }elseif (($TAG.$plugin_name == $text or $TAG.$plugin_name.'@'.BOT_NAME == $text) and ($plugins[$plugin_name]["needArgu"] == false)) {
            require_once $value;
            break;
        }elseif ($TAG.$plugin_name == $text or $TAG.$plugin_name.'@'.BOT_NAME == $text) {
            if ($plugins[$plugin_name]["usage"]!=null) {
                $BOT->msg($plugin_sendto, "Usage:\n".$plugins[$plugin_name]["usage"]);  
            }else{
                $BOT->msg($plugin_sendto, "Missing argument(s)");  
            }
            break;
        }
    }
}

//function
function PluginSet($desc,$usage=null,$needArgu=True,$visible=True){
        global $plugins,$plugin_name,$TAG;
        $plugins[$plugin_name]["desc"] = '/'.$plugin_name." ".$desc;
        $plugins[$plugin_name]["usage"] = $usage;
        $plugins[$plugin_name]["needArgu"] = $needArgu;
        $plugins[$plugin_name]["visible"] = $visible;
}

?>