<?php
PluginSet("Find Somebody on WoW");

$plugin_wow_init = explode(' ',$plugin_text,2);
$plugin_wow_api_url_prefix = "http://www.battlenet.com.cn/api/wow/character/";
$plugin_wow_realm = $plugin_wow_init[0];
$plugin_wow_characterName  = $plugin_wow_init[1];
$plugin_wow_api_url_root = $plugin_wow_api_url_prefix.$plugin_wow_realm."/".$plugin_wow_characterName;

$plugin_wow_profile = json_decode(file_get_contents($plugin_wow_api_url_root."?fields="), true);

if(isset($plugin_wow_profile['lastModified'])){
    $plugin_wow_thumbnail = str_replace("avatar","profilemain","http://render-api-cn.worldofwarcraft.com/static-render/cn/".$plugin_wow_profile['thumbnail']);
    $msg = "Realm: ".$plugin_wow_profile["realm"]."\n".
           "Name: ".$plugin_wow_profile["name"]."\n".
           "Level: ".$plugin_wow_profile["level"]."\n".
           "Pic: ".$plugin_wow_thumbnail."\n";
           "Achievement Points ".$plugin_wow_profile["achievementPoints"]."\n";
    $BOT->msg($plugin_sendto, $msg);
}else{
    $BOT->msg($plugin_sendto, 'Somthing happened.');
}
