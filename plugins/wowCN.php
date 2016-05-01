<?php
PluginSet("Find Somebody on WoW");

$plugin_wow_init = explode(' ',$plugin_text,2);
$plugin_wow_api_url_prefix = "https://api.battlenet.com.cn/wow/";
$plugin_wow_realm = $plugin_wow_init[0];
$plugin_wow_characterName  = $plugin_wow_init[1];
$plugin_wow_api_url_root = $plugin_wow_api_url_prefix."character/".$plugin_wow_realm."/".$plugin_wow_characterName;

$plugin_wow_profile = json_decode(file_get_contents($plugin_wow_api_url_root."?fields=stats&apikey=".PLUGIN_BATTLENET_KEY), true);
$plugin_wow_db_races = json_decode(file_get_contents($plugin_wow_api_url_prefix."data/character/races?apikey=".PLUGIN_BATTLENET_KEY), true);
$plugin_wow_db_classes = json_decode(file_get_contents($plugin_wow_api_url_prefix."data/character/classes?apikey=".PLUGIN_BATTLENET_KEY), true);

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
    $msg = "所在区服: ".$plugin_wow_profile["realm"]." | ".
           "角色名称: ".$plugin_wow_profile["name"]."\n".
           "种族: ".$plugin_wow_profile_race." | ".
           "职业: ".$plugin_wow_profile_class."\n".
           "等级: ".$plugin_wow_profile["level"]." | ".
           "成就点数: ".$plugin_wow_profile["achievementPoints"]."\n". 
           "预览图片: ".$plugin_wow_thumbnail."\n\n".
           "生命上限: ".$plugin_wow_profile["stats"]["health"]." | ".
           "法力上限[".$plugin_wow_profile["stats"]["powerType"]."]: ".$plugin_wow_profile["stats"]["power"]."\n".
           "力量: ".$plugin_wow_profile["stats"]["str"]." | ".
           "敏捷: ".$plugin_wow_profile["stats"]["agi"]."\n".
           "智力: ".$plugin_wow_profile["stats"]["int"]." | ".
           "耐力: ".$plugin_wow_profile["stats"]["sta"]."\n".
           "\n详细资料: "."http://www.battlenet.com.cn/wow/zh/character/".urlencode($plugin_wow_realm)."/".urlencode($plugin_wow_characterName)."/simple"
           ;
           
           
           
    $BOT->msg($plugin_sendto, $msg);
}else{
    $BOT->msg($plugin_sendto, 'Somthing happened.');
}
