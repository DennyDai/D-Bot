<?php
PluginSet("Let me google that for you.");
$msg = "Let me google that for you.";
$msg .= "\n\nStep 1. Open the Google.com";
$msg .= "\nStep 2. Type in your question";
$msg .= "\nStep 3. Click the search button";
$msg .= "\nWas that so hard?";
$msg .=  "\n\nhttps://www.google.com/search?q=".rawurlencode($plugin_text);
//$msg .=  "\n\nhttp://lmgtfy.com/?q=".rawurlencode($plugin_text);
$BOT->msg($plugin_sendto, $msg);