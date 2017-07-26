<html>
<head>
<meta name="referrer" content="no-referrer" />
<style type="text/css">
body {
	margin-top: 80px !important;
}
.mycustom-geoproxy-header {
	background: #fff !important;
	width: 100% !important;
	text-indent: 10px !important;
	text-align: center !important;
	float: left !important;
	display: block !important;
	position: fixed !important;
	padding: 10px 0px 0px !important;
	height: 80px !important;
	font-family: "Open Sans" !important;
	font-size: 15px !important;
	line-height: 20px !important;
	font-weight: 500 !important;
	font-style: normal !important;
	margin-top: -80px !important;
	border-bottom: 1px solid #000 !important;
    z-index: 9999 !important;
}
.mycustom-geoproxy-header h2 {
	color: #162a33 !important;
	text-align: center !important;
	text-transform: uppercase !important;
	font-size: 1em !important;
	font-family: "Open Sans" !important;
	line-height: 21.4286px !important;
	font-weight: 500 !important;
	font-style: normal !important;
	margin: 0px !important;
	padding: 7.5px 0px !important;
}
</style>
</head>
<body>

<?php
$proxy_sub = explode('.', $_SERVER['HTTP_HOST'])[0]; //get the proxy subdomain
$hash = hash('sha256',$proxy_sub); //get hash 
$secret_key = strip_tags($_POST['secret-key']); //grab the key so only those who know the key can use this script so others don't abuse these
if ($hash == $secret_key) { 
	//SUCCESS, the right key was used!
	$request_url = 'http://' . strip_tags($_POST['url']);
	$host_url = parse_url($request_url, PHP_URL_HOST);

	if ($DNSresult = dns_get_record($host_url, DNS_AAAA)) { //GET DNS
    	foreach ($DNSresult as $key=>$value) {
        	$ip = '<a target=_blank href=http://whatismyipaddress.com/ip/'.$value['ipv6'].'>'.$value['ipv6'].'</a>'; //Pull the AAAA Records ipv6 from the array
    	}
	} elseif ($DNSresult = dns_get_record($host_url, DNS_A)) {
    	foreach ($DNSresult as $key=>$value) {
        	$ip = '<a target=_blank href=http://whatismyipaddress.com/ip/'.$value['ip'].'>'.$value['ip'].'</a>'; //Pull the A Records ipv4 addresses from the array
    	}
	} else {
    	$ip = "Failed to lookup A and AAAA Records"; //failure to look up both records
	};

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $request_url);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	$site_content = curl_exec($ch); //get the contents of the site from this server by curling it
	$site_content = preg_replace('/src=(\'|\")\//', 'src=\1http://'.$host_url.'/', $site_content); //bug fix for sites using relative paths
	$total_time = curl_getinfo($ch)['total_time'];
	$total_time = number_format($total_time, 2, '.', ','); //round up to the the thousands
	echo '<div class="mycustom-geoproxy-header" title="This is the IP address and time of the site queried, as seen from this location.">
	<h2>Location '.$proxy_sub.' ⓘ</h2>DNS: '.$ip.' / ⏱: '.$total_time.'</div>';
	echo $site_content;
} else {
	//FAILURE
	header("Location: http://".$_SERVER['HTTP_HOST']); //redirect to proxy subdomain home page
	exit();
}
?>

</body>
</html>
