<?php
PluginSet("Punycode Encode & Decode.");
if (idn_to_ascii($plugin_text)) {
    $msg = "UTF-8: ".idn_to_ascii($plugin_text);
}else {
    $msg = "Punnycode: ".idn_to_utf8($plugin_text);
}
$BOT->msg($plugin_sendto, $msg);
?>