<?php
$AUTH_USER = 'admin';
$AUTH_PASS = 'admin';
header('Cache-Control: no-cache, must-revalidate, max-age=0');
$has_supplied_credentials = !(empty($_SERVER['PHP_AUTH_USER']) && empty($_SERVER['PHP_AUTH_PW']));
$is_not_authenticated = (
        !$has_supplied_credentials ||
        $_SERVER['PHP_AUTH_USER'] != $AUTH_USER ||
        $_SERVER['PHP_AUTH_PW']   != $AUTH_PASS
);
if ($is_not_authenticated) {
        header('HTTP/1.1 401 Authorization Required');
        header('WWW-Authenticate: Basic realm="Access denied"');
        exit;
} else {

        //pull domain using ?name= in the url string
        $a = strip_tags($_GET['name']);
        $a = preg_replace('/\/.*/','',$a);
        $sslurl = "https://".$a;
        $orignal_parse = parse_url($sslurl, PHP_URL_HOST);
        $get = stream_context_create(array("ssl" => array("capture_peer_cert" => TRUE)));
        $read = stream_socket_client("ssl://".$orignal_parse.":443", $errno, $errstr, 30,   STREAM_CLIENT_CONNECT, $get);
        $cert = stream_context_get_params($read);
        $certinfo = openssl_x509_parse($cert['options']['ssl']['peer_certificate']);
        $validFrom = date('M d, Y', $certinfo['validFrom_time_t']);
        $validTo = date('M d, Y', $certinfo['validTo_time_t']);

        //isolate just the SANs that are associated with the SSL
        foreach($certinfo as $key=>$value){
                $SANs = $value['subjectAltName'];
        }
        $SANs = preg_replace('/DNS:/','',$SANs);
        if ( strip_tags($_GET['valid_from']) ) {
                $array = array('valid_from' => $validFrom);
        } else if ( strip_tags($_GET['valid_to']) ) {
                $array = array('valid_to' => $validTo);
        } else if ( strip_tags($_GET['sans']) ) {
                $array = array('sans' => $SANs);
        } else {
                $array = array('domain' => $a, 'sans' => $SANs, 'valid_from' => $validFrom, 'valid_to' => $validTo);
        }
        echo json_encode($array);
}
?>
