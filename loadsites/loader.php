<!DOCTYPE html>
<html>
<body>

<?php
$url = $_GET['url'];
$headers_response = get_headers($url,1);
if ( array_pop($headers_response["Location"]) == null ) {
  $resulting_url = parse_url($url)['host'];
} else {
  $resulting_url = parse_url(array_pop($headers_response["Location"]))['host'];
}

if ( $headers_response[0] == "HTTP/1.1 401 Unauthorized") {
  //this site is password protected, so we're not going to bother and just iframe to the custom 401 page
  echo '<div class="dashboard"><font color=orange>basic auth protected</font><br>resulting domain: '.$resulting_url.'</div>';
  echo '<iframe frameborder=0 src="401.html"></iframe></div>';
} else {
  echo '<div class="dashboard">requested url: '.$url.'<br>resulting domain: '.$resulting_url.'</div>';
  echo "<iframe frameBorder='0' data-iframely-url='". $url . "' width='100%' height='100%'></iframe>";
}

?>
<script async src="js/iframely_embed.js" charset="utf-8">//thanks to https://iframely.com/</script>
</body>
</html>
