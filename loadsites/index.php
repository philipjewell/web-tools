<!DOCTYPE html>
<html>
<head>
<meta name="referrer" content="no-referrer" />
<title>Loading all the sites!</title>
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="js/frame_button.js"></script>
<script>
$('document').ready(function(){
  $('div').each(function(){
    //grab the optional uri from the form
    var uri_query = document.getElementsByName('uri')[0].value;
    if ( $(this)[0].id ) {
        $(this).load('loader.php?url=http://' + $(this).attr('id') + '/' + uri_query);
    }
  });
$('.btn-scroll').click(function(){
//your current y position on the page
var y = $(window).scrollTop();
//scroll your screen height minus the 105px offset from the header +padding
$(window).scrollTop(y+$(window).height() -105, 600);
});
});
</script>
</head>
<body>

<?php
echo "<div class='header'>";
$form = '<form action="" method="GET">
<input type="text" name="sites" placeholder="list of domains seperated by spaces or commas..." value="'.htmlspecialchars($_GET['sites'],ENT_QUOTES | ENT_HTML401, "UTF-8").'">
<input type="text" name="uri" placeholder="optional uri and or query arg, i.e. \'search.php?arg=123\'..." value="'.htmlspecialchars($_GET['uri'],ENT_QUOTES | ENT_HTML401, "UTF-8").'">
<input class="btn-primary" type="submit">
</form>';
$sites = explode(' ', htmlspecialchars($_GET['sites'],ENT_QUOTES | ENT_HTML401, "UTF-8"));
$sites = preg_replace('/https?:\/\//', '', $sites); //remove any defined protocols
if (empty($_GET['sites'])) {
  echo "<div class='status empty'>Please enter a domain or list of domains:</div>" . $form;
} else {
  echo "<div class='status'>Looking at the following domains (".count($sites)."):</div>" . $form . "<button class='btn-primary btn-frame' onclick='frame_resize()'>enlarge frames</button><button class='btn-primary btn-scroll'>scroll down</button>";
}
echo "</div><div class='content'>";
foreach($sites as $site) {
echo "<div id='" . $site . "' class='site'></div>";
}
echo "</div>";
?>

</body>
</html>
