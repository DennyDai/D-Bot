<?php
PluginSet("Find Somebody on Steam");

if (strpos($plugin_text,"@") === 0) {$plugin_text = substr($plugin_text,1);}
$plugin_steam_steamid = json_decode(file_get_contents('http://api.steampowered.com/ISteamUser/ResolveVanityURL/v0001/?key='.PLUGIN_STEAM_KEY.'&vanityurl='.$plugin_text),true);
if ($plugin_steam_steamid['response']['success'] == 1){
    $plugin_steam_steamid =  $plugin_steam_steamid['response']['steamid'];
    $plugin_steam_PlayerSummaries = json_decode(file_get_contents('http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key='.PLUGIN_STEAM_KEY.'&steamids='.$plugin_steam_steamid),true);
    $plugin_steam_RecentlyPlayedGames = json_decode(file_get_contents('http://api.steampowered.com/IPlayerService/GetRecentlyPlayedGames/v1?key='.PLUGIN_STEAM_KEY.'&steamid='.$plugin_steam_steamid."&count=1"),true);
    $personastate = $plugin_steam_PlayerSummaries['response']['players'][0]['personastate'];
    if ($personastate == 0){$personastate = 'Offline (or Private) ';}elseif($personastate == 1){$personastate = 'Online';}elseif($personastate == 2){$personastate = 'Busy';}elseif($personastate == 3){$personastate = 'Away';}elseif($personastate == 4){$personastate = 'Snooze';}elseif($personastate == 5){$personastate = 'Looking to trade';}elseif($personastate == 6){$personastate = 'Looking to play';}
    if (array_key_exists('gameextrainfo', $plugin_steam_PlayerSummaries['response']['players'][0])){$plugin_steam_playing = "Is Playing: ".$plugin_steam_PlayerSummaries['response']['players'][0]['gameextrainfo']."\n";}
//personastate
    $msg =  "Personal Name: ".$plugin_steam_PlayerSummaries['response']['players'][0]['personaname']."\n".
            "State: ".$personastate."\n".
            $plugin_steam_playing.
            //"Recently Played: ".$plugin_steam_RecentlyPlayedGames['response']['games'][0]['name']."\n".
            "Last Log Off (UTC +0): ".date("Y-m-d H:i:s", $plugin_steam_PlayerSummaries['response']['players'][0]['lastlogoff'])."\n".
            "Profile URL: ".$plugin_steam_PlayerSummaries['response']['players'][0]['profileurl']."\n".
            "";
}else{
    $msg = "User Not Found :(";
}

$BOT->msg($plugin_sendto, $msg);