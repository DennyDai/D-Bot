<?php
PluginSet("Find Somebody on WoW");

$plugin_wow_init = explode(' ',$plugin_text,2);
$plugin_wow_api_url_prefix = "http://www.battlenet.com.cn/api/wow/character/";
$plugin_wow_realm = $plugin_wow_init[0];
$plugin_wow_characterName  = $plugin_wow_init[1];
$plugin_wow_api_url_root = $plugin_wow_api_url_prefix.$plugin_wow_realm."/".$plugin_wow_characterName;

$plugin_wow_profile = json_decode(file_get_contents($plugin_wow_api_url_root."?fields=stats"), true);
$plugin_wow_db_races = json_decode(file_get_contents("http://www.battlenet.com.cn/api/wow/data/character/races"), true);
$plugin_wow_db_classes = json_decode(file_get_contents("http://www.battlenet.com.cn/api/wow/data/character/classes"), true);

if(isset($plugin_wow_profile['lastModified']) and isset($plugin_wow_db_classes['classes']) and isset($plugin_wow_db_races['races'])){
    foreach ($plugin_wow_db_races["races"] as $plugin_wow_db_races_list) {
        if ($plugin_wow_db_races_list["id"] == $plugin_wow_profile["race"]) {
            $plugin_wow_profile_race = $plugin_wow_db_races_list["name"];
        }
    }
    foreach ($plugin_wow_db_classes["classes"] as $plugin_wow_db_classes_list) {
        if ($plugin_wow_db_classes_list["id"] == $plugin_wow_profile["class"]) {
            $plugin_wow_profile_class = $plugin_wow_db_classes_list["name"];
        }
    }
    
    $plugin_wow_thumbnail = str_replace("avatar","profilemain","http://render-api-cn.worldofwarcraft.com/static-render/cn/".$plugin_wow_profile['thumbnail']);
    $msg = "Realm: ".$plugin_wow_profile["realm"]." | ".
           "Name: ".$plugin_wow_profile["name"]."\n".
           "Race: ".$plugin_wow_profile_race." | ".
           "Class: ".$plugin_wow_profile_class."\n".
           "Level: ".$plugin_wow_profile["level"]." | ".
           "Achievement Points :".$plugin_wow_profile["achievementPoints"]."\n". 
           "Pic: ".$plugin_wow_thumbnail."\n\n".
           "Health: ".$plugin_wow_profile["stats"]["health"]." | ".
           "Power[".$plugin_wow_profile["stats"]["powerType"]."]: ".$plugin_wow_profile["stats"]["power"]."\n".
           "Strength: ".$plugin_wow_profile["stats"]["str"]." | ".
           "Agility: ".$plugin_wow_profile["stats"]["agi"]."\n".
           "Intellect: ".$plugin_wow_profile["stats"]["int"]." | ".
           "Stamina: ".$plugin_wow_profile["stats"]["sta"]."\n"
           ;
           
           
           
    $BOT->msg($plugin_sendto, $msg);
}else{
    $BOT->msg($plugin_sendto, 'Somthing happened.');
}
