# web-tools
Description: Series of web tools used for efficiency

## loadsites
PHP based tool that iframes any number of domains you populate into the form.
Allows you to quickly view several sites for monitoring or audit like purposes.

Comes with lazy load for the iframes so you don't kill your browser and or server when calling out to large amounts of sites.

![Screenshot](http://i.imgur.com/wmybDRK.png)

## geohub
PHP based scripts. Think of it like a 'Make your own GeoPeeker.com'.

The **index.php** with be hosted at the central location you will be visiting and using the tool at.
You will then create 6 (or more) proxy locations using subdomains that you create using your own custom domain - IE. `proxy-1.MY-CUSTOM-DOMAIN.COM`. You will want to update this value within the **index.php** file.
These different subdomains should be pointed to and mapped to servers hosted in different geographical locations like Singapore or Brazil and host the **proxy.php** file. These proxy files retrieve the contents of the website using a PHP curl.

![Screenshot](http://i.imgur.com/WTVIXSJ.png)
