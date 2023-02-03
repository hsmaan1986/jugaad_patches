CONTENTS OF THIS FILE
---------------------

 * Introduction
 * Requirements
 * Installation
 * Configuration
 * Functionality
 * Maintainers

INTRODUCTION
------------

This module shows a popup to redirect specific site based on users Geographical region.

As a anoymous user when we are visiting to global site on specific region.
Then this popup will come once to a user whether you want to redirect to site based on your geographical location or stay on same site.

REQUIREMENTS
------------

This module doesn't have any contrib module dependency.


INSTALLATION
------------

* Install as you would normally install a contributed Drupal module. Visit
   https://www.drupal.org/node/1897420 for further information.


CONFIGURATION
-------------

* Go to `Overview` page ( admin >> config >> Lightnest >> Geolocation Redirection >> Overview ) setting.
* You will find all IP locator list here.
* Click on `add configuration` button to create new IP locator.
* For each each IP locator, you will find popup block configuration under `Popup block config`.
* Then there are one more tab for `CDN service` attribute.
* Lets say if you are using Cloudflare CDN, then set `HTTP_CF_IPCOUNT` for country code based on geolocation.


FUNCTIONALITY
-------------

* As a anonymous user when you visit home page you will see popup.
* If your country code is added is gelocation redirection list, then only you will see popup.
* It will be shown only once per user.
* We are setting cookie lifetime.
* Based on your last response: If you have clicked yes,
* then you will be always redirected to redirect URL.
* If no, then you won't see popup box untill your cookie will expire.
* On both yes and no, response event will be sent to datalayer.


MAINTAINERS
-----------

* Nestle Webcms team.
