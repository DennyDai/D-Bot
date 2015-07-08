<?php
PluginSet("ipv4 Calculator.");
$var = explode('/',$plugin_text);
if(filter_var($var[0], FILTER_VALIDATE_IP)){
	$arr = explode('.',$var[0]);
	$msg = 'Address: '.$var[0];
	$Netmask_bin = str_repeat('1', $var[1]).str_repeat('0', 32-$var[1]);
	$Wildcard_bin = strtr($Netmask_bin,"10","01");
	$msg .= "\nNetmask: ".bindec(substr($Netmask_bin, 0, 8)).'.'.bindec(substr($Netmask_bin, 8, 8)).'.'.bindec(substr($Netmask_bin, 16, 8)).'.'.bindec(substr($Netmask_bin, 24, 8)).' or /'.$var[1];
	//$msg .= "\nWildcard: ".bindec(substr($Wildcard_bin, 0, 8)).'.'.bindec(substr($Wildcard_bin, 8, 8)).'.'.bindec(substr($Wildcard_bin, 16, 8)).'.'.bindec(substr($Wildcard_bin, 24, 8));

	$plugin_ipcalc_address_long = ip2long($var[0]);
	$plugin_ipcalc_nmask_long = ip2long(bindec(substr($Netmask_bin, 0, 8)).'.'.bindec(substr($Netmask_bin, 8, 8)).'.'.bindec(substr($Netmask_bin, 16, 8)).'.'.bindec(substr($Netmask_bin, 24, 8)));

	$plugin_ipcalc_net = long2ip($plugin_ipcalc_address_long & $plugin_ipcalc_nmask_long);

	$plugin_ipcalc_host_first = ((~$plugin_ipcalc_nmask_long) & $plugin_ipcalc_address_long);
	$plugin_ipcalc_first = ($plugin_ipcalc_address_long ^ $plugin_ipcalc_host_first) + 1;

	$plugin_ipcalc_broadcast_invert = ~$plugin_ipcalc_nmask_long;
	$plugin_ipcalc_last = ($plugin_ipcalc_address_long | $plugin_ipcalc_broadcast_invert) - 1;

	$plugin_ipcalc_broadcast = long2ip($plugin_ipcalc_address_long | $plugin_ipcalc_broadcast_invert);

	if($plugin_ipcalc_last < 0) $plugin_ipcalc_last += 4294967296;
	if($plugin_ipcalc_first < 0) $plugin_ipcalc_first += 4294967296;
	$plugin_ipcalc_hosts = $plugin_ipcalc_last - $plugin_ipcalc_first;



	$msg .= "\nNetwork: ".$plugin_ipcalc_net;
	$msg .= "\nBroadcast: ".$plugin_ipcalc_broadcast;
	$msg .= "\nHostMin: ".long2ip($plugin_ipcalc_first);
	$msg .= "\nHostMax: ".long2ip($plugin_ipcalc_last);
	$msg .= "\nTotal num: ".($plugin_ipcalc_hosts + 3);

	$BOT->msg($plugin_sendto, $msg);
}else{
	$BOT->msg($plugin_sendto, "Bad IP Address.");
}