<?php
PluginSet("find someone on Github");

$opts = array ('http' => array ('header' => "User-Agent: Mozilla/5.0 (Windows NT 6.3; WOW64; rv:38.0) Gecko/20100101 Firefox/38.0",));
if (!strpos($plugin_text,'/')) {
	$user = file_get_contents("https://api.github.com/users/".urlencode($plugin_text).'?access_token='.PLUGIN_GITHUB_TOKEN, false, stream_context_create($opts));
	$starred = file_get_contents("https://api.github.com/users/".urlencode($plugin_text)."/starred".'?access_token='.PLUGIN_GITHUB_TOKEN, false, stream_context_create($opts));
	$user = json_decode($user,true);
	$msg = "ID:  @".$user['login'];
	plugin_github_check("Type", $user['type']);
	plugin_github_check("Name", $user['name']);
	plugin_github_check("Email", $user['email']);
	plugin_github_check("Company", $user['company']);
	plugin_github_check("Starred", count(json_decode($starred,true)));
	plugin_github_check("Repos", $user['public_repos']);
	plugin_github_check("Followers", $user['followers']);
	plugin_github_check("Following", $user['following']);
	@$msg .= "\nUrl: https://github.com/".$user['login'];
}else{
	$repo = file_get_contents("https://api.github.com/repos/".$plugin_text.'?access_token='.PLUGIN_GITHUB_TOKEN, false, stream_context_create($opts));
	$repo = json_decode($repo,true);
	$msg = "Name:  ".$repo['name'];
	plugin_github_check("Description", $repo['description']);
	plugin_github_check("Is Fork", $repo['fork']);
	plugin_github_check("Stars", $repo['stargazers_count']);
	plugin_github_check("Forks", $repo['forks_count']);
	plugin_github_check("Language", $repo['language']);
	@$msg .= "\nUrl: https://github.com/".$plugin_text;
}


function plugin_github_check($title, $check)
{
	global $msg;
	if (!empty($check)) {
		return @$msg .= "\n".$title.": ".$check;
	}elseif ($check == true){
		return @$msg .= "\n".$title.": True";
	}elseif ($check == false){
		return @$msg .= "\n".$title.": False";
	}
}


$BOT->msg($plugin_sendto, $msg);