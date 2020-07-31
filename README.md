# web-tools
Description: Series of web tools used for efficiency

## [contenteditable_code_block](https://github.com/philipjewell/contenteditable_code_block)
A Google Chrome extension that turns `<pre>` tags that are often used as code blocks into editable blocks.
The extension is written for the following sites:

* github.com
* app.getguru.com 
* trello.com
* stackoverflow.com
* unix.stackexchange.com
* *.atlassian.net (both confluence and JIRA)
* zendesk.com

## [loadsites](https://github.com/philipjewell/web-tools/tree/master/loadsites)
PHP based tool that iframes any number of domains you populate into the form.
Allows you to quickly view several sites for monitoring or audit like purposes.

Comes with lazy load for the iframes so you don't kill your browser and or server when calling out to large amounts of sites.

![Screenshot](http://i.imgur.com/wmybDRK.png)

## [geohub](https://github.com/philipjewell/web-tools/tree/master/geohub)
PHP based scripts. Think of it like a 'Make your own GeoPeeker.com'.

The **index.php** with be hosted at the central location you will be visiting and using the tool at.
You will then create 6 (or more) proxy locations using subdomains that you create using your own custom domain - IE. `proxy-1.MY-CUSTOM-DOMAIN.COM`. You will want to update this value within the **index.php** file.
These different subdomains should be pointed to and mapped to servers hosted in different geographical locations like Singapore or Brazil and host the **proxy.php** file. These proxy files retrieve the contents of the website using a PHP curl.

![Screenshot](http://i.imgur.com/WTVIXSJ.png)

## [ssl_api](https://github.com/philipjewell/web-tools/tree/master/ssl_api)
PHP based script that allows you to make your own SSL JSON API. The script has built in PHP HTTP based authentication so the script isn't easily targeted and abused by those who don't have credentials. 
The API provides basic information including the SANs associated with the certificate and the valid date range for the certificate. 

Pull the full API:

```
$ curl -s --user admin:admin http://www.domain.tld/v1/ssl/philipjewell.com | jq
{
  "domain": "philipjewell.com",
  "sans": "sni81826.cloudflaressl.com, *.androkit.ml, *.automatizzazionicasa.xyz, *.carpentryarchive.org, *.fsalecaheab.cf, *.g1hslbps.tk, *.hfcepriceihe.cf, *.inmoproyecciones.com, *.ktukits.ml, *.laurennakaowinn.com, *.muahangtangoc.pro, *.nhathuocyhoccotruyen.com, *.philipjewell.com, *.praywithoutceasing.info, *.secure-z.pw, *.skachat-drajvera-dlja-amelia.cf, *.skachat-drajvera-dlja-molly.gq, *.telecamereip.xyz, *.termish.info, *.the-gate.co.il, *.thebatplayer.fm, androkit.ml, automatizzazionicasa.xyz, carpentryarchive.org, fsalecaheab.cf, g1hslbps.tk, hfcepriceihe.cf, inmoproyecciones.com, ktukits.ml, laurennakaowinn.com, muahangtangoc.pro, nhathuocyhoccotruyen.com, philipjewell.com, praywithoutceasing.info, secure-z.pw, skachat-drajvera-dlja-amelia.cf, skachat-drajvera-dlja-molly.gq, telecamereip.xyz, termish.info, the-gate.co.il, thebatplayer.fm",
  "valid_from": "Aug 18, 2017",
  "valid_to": "Feb 24, 2018"
}
```

Pull just the `sans`, `valid_from` or `valid_to` from the array:
```
$ curl -s --user admin:admin http://www.domain.tld/v1/ssl/philipjewell.com/sans | jq
$ curl -s --user admin:admin http://www.domain.tld/v1/ssl/philipjewell.com/valid_from | jq
$ curl -s --user admin:admin http://www.domain.tld/v1/ssl/philipjewell.com/valid_to | jq
```

As anyone can use [sslshopper.com](https://www.sslshopper.com/ssl-checker.html) or any browser can find the status of the SSL on any domain, this can easily be added into other tools or scripts where PHP or other methods of SSL verification are not accessible. 
