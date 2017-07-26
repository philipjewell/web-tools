<html>
<head>
<title>GeoHub - My Custom GeoPeeker</title>
<style>
body {
  min-width: 1150px; 
  background: #eee !important;
  text-transform: lowercase;
  display: block;
  position: relative;
  text-align: center; 
}
body::after {
  opacity: 0.25 !important;
  background: url(globe.jpg);
  content: "";
  position: absolute;
  background-repeat: no-repeat;
  z-index: -1;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-position: center; 
  background-size: contain;
}
form#header {
  background-color: grey;
  padding: 20px;
  margin-top: 25px;
}
h2 {
  text-shadow: 2px 2px 8px #999; 
  color: #fff !important;
}
iframe {
  width: 100%;
  height: 325px;
}
input[type=text] {
  width: 90%;
}
textarea {
  width: 100%;
  background: #fff;
  border-radius: 10px;
  border: 1px solid rgb(205, 205, 205);
}
.btn-primary {
  background-color: grey !important;
  border: none; padding: 0px;
  width: 9%;
}
.internal-banner {
    height: 25px;
    background-color: yellow;
    position: fixed;
    margin-top: -25px;
    width: 100%;
    z-index: 5000;
}
.site {
  width: 30%;
  margin: 1.66%; 
  float: left;
  background-color: #fff;
  padding: 0px 1% 1% 1%;
  border-radius: 8px;
  box-shadow: 1px 1px 1px #cdcdcd;
}
</style>
<script src="favimoji.js"></script>
<script>FavEmoji('U+1F30F');</script>
</head>
<body>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

<?php
$url = htmlspecialchars($_GET['sites'],ENT_QUOTES | ENT_HTML401, "UTF-8"); //sanitize 
$url = explode(" ", $url)[0]; //only take one single domain
$internal = '<div class="internal-banner"><b>WARNING</b>: This is an internal tool.
Use <a target="_blank" href="https://geopeeker.com/fetch/?url='.$url.'">GeoPeeker</a> when giving to customers.</div>';
$form = '<form id="header" action="" method="GET">
<input type="text" name="sites" placeholder="enter url to lookup..." value="'.$url.'">
<input class="btn-primary" type="submit">
</form>';

if ( false === (isset($_GET['sites'])) ){
  echo $internal . $form . "<h2>Please enter a domain name...</h2>";
  exit;
} else {
  $base_domain = ".MY-CUSTOM-DOMAIN.COM"; //use your custom domain 
  //array of proxys and their associated locations
  //NOTE: these are your custom subdomains you are making and assigning to your own servers and locations
  $proxy_array = array('singapore' => 'proxy-1', 'brazil' => 'proxy-2', 'virginia' => 'proxy-3', 'california' => 'proxy-4', 'ireland' => 'proxy-5', 'australia' => 'proxy-6'); 
  echo $internal . $form;
  $url = preg_replace('/https?:\/\//', '', $url);
  foreach ( $proxy_array as $proxy){
    echo '<form id="proxy-'.$proxy.'" target="'. $proxy.'" method="POST" action="http://'.$proxy . $base_domain.'/proxy.php">
    <input type="hidden" name="secret-key" value="'. hash('sha256',$proxy).'"/>
    <input type="hidden" name="url" value="'.$url.'"/>
    </form>
    <div class="site"><iframe frameborder=0 name="'.$proxy.'"></iframe></div>
    <script>document.getElementById("proxy-'.$proxy.'").submit();</script>';
  }
}
?>

</body>
</html>
