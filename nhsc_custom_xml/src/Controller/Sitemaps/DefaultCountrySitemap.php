<?php

namespace Drupal\nhsc_custom_xml\Controller\Sitemaps;
use Drupal\Core\Controller\ControllerBase;



class DefaultCountrySitemap extends ControllerBase {

public function global()
{
    return '<?xml version="1.0" encoding="UTF-8"?>
    <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
    <url>
      <loc>https://www.nestlehealthscience.com</loc>
     <xhtml:link rel="alternate" hreflang="en" href="https://www.nestlehealthscience.com"/>
    <xhtml:link rel="alternate" hreflang="en-us" href="https://www.nestlehealthscience.us"/>
    <xhtml:link rel="alternate" hreflang="en-ca" href="https://www.nestlehealthscience.ca/en"/>
    <xhtml:link rel="alternate" hreflang="fr-ca" href="https://www.nestlehealthscience.ca/fr"/>
     <xhtml:link rel="alternate" hreflang="en-gb" href="https://www.nestlehealthscience.co.uk"/>
     <xhtml:link rel="alternate" hreflang="pt-br" href="https://www.nestlehealthscience.com.br"/>
     <xhtml:link rel="alternate" hreflang="fi-fi" href="https://www.nestlehealthscience.fi"/>
     <xhtml:link rel="alternate" hreflang="pt-pt" href="https://www.nestlehealthscience.pt"/>
     <xhtml:link rel="alternate" hreflang="th-th" href="https://www.nestlehealthscience-th.com"/>
     <xhtml:link rel="alternate" hreflang="tr-tr" href="https://www.nestlehealthscience.com.tr"/>
     <xhtml:link rel="alternate" hreflang="en-ae" href="https://www.nestlehealthscience-me.com"/>
     <xhtml:link rel="alternate" hreflang="es-mx" href="https://www.nestlehealthscience.com.mx"/>
     <xhtml:link rel="alternate" hreflang="fr-fr" href="https://www.nestlehealthscience.fr"/>
     <xhtml:link rel="alternate" hreflang="sv-se" href="https://www.nestlehealthscience.se"/>
     <xhtml:link rel="alternate" hreflang="de-at" href="https://www.nestlehealthscience.at"/>
     <xhtml:link rel="alternate" hreflang="en-lk" href="https://www.nestlehealthscience.lk"/>
     <xhtml:link rel="alternate" hreflang="en-au" href="https://www.nestlehealthscience.com.au"/>
     <xhtml:link rel="alternate" hreflang="zh-hans-hk" href="https://www.nestlehealthscience.com.hk"/>
     <xhtml:link rel="alternate" hreflang="ja-jp" href="https://www.nestlehealthscience.jp"/>
     <xhtml:link rel="alternate" hreflang="es-es" href="https://www.nestlehealthscience.es"/>
     <xhtml:link rel="alternate" hreflang="ro-ro" href="https://www.nestlehealthscience.ro"/>
     <xhtml:link rel="alternate" hreflang="de-de" href="https://www.nestlehealthscience.de"/>
     <xhtml:link rel="alternate" hreflang="da-dk" href="https://www.nestlehealthscience.dk"/>
     <xhtml:link rel="alternate" hreflang="en-in" href="https://www.nestlehealthscience.in"/>
     <xhtml:link rel="alternate" hreflang="de-ch" href="https://www.nestlehealthscience.ch/de"/>
     <xhtml:link rel="alternate" hreflang="fr-ch" href="https://www.nestlehealthscience.ch/fr"/>
     <xhtml:link rel="alternate" hreflang="id-id" href="https://www.nestlehealthscience.co.id"/>
     <xhtml:link rel="alternate" hreflang="it-it" href="https://www.nestlehealthscience.it"/>
     <xhtml:link rel="alternate" hreflang="pl-pl" href="https://www.nestlehealthscience.pl"/>
     <xhtml:link rel="alternate" hreflang="en-za" href="https://www.nestlehealthscience.co.za"/>
     <xhtml:link rel="alternate" hreflang="en-my" href="https://www.nestlehealthscience.my"/>
     <xhtml:link rel="alternate" hreflang="vi-vn" href="https://www.nestlehealthscience.vn"/>
     <xhtml:link rel="alternate" hreflang="cs-cz" href="https://www.nestlehealthscience.cz/cz"/>
     <xhtml:link rel="alternate" hreflang="sk-cz" href="https://www.nestlehealthscience.cz/sk"/>
     <xhtml:link rel="alternate" hreflang="en-sg" href="https://www.nestlehealthscience.sg"/>
     <xhtml:link rel="alternate" hreflang="zh-hans-cn" href="https://www.nestlehealthscience.cn/"/>
     <xhtml:link rel="alternate" hreflang="en-ph" href="https://www.nestlehealthscience.ph/"/>
     <xhtml:link rel="alternate" hreflang="ru-ru" href="https://www.nestlehealthscience.ru/"/>
     <xhtml:link rel="alternate" hreflang="nl-nl" href="https://www.nestlehealthscience.nl/nl"/>
     <xhtml:link rel="alternate" hreflang="fr-nl" href="https://www.nestlehealthscience.nl/fr"/>
     <xhtml:link rel="alternate" hreflang="zh-hans-tw" href="https://www.nestlehealthscience.com.tw"/>
      <changefreq>daily</changefreq>
      <priority>1.0</priority>
     </url>
     <url>
     <loc>https://www.nestlehealthscience.com/brands</loc>
     <xhtml:link rel="alternate" hreflang="en" href="https://www.nestlehealthscience.com/brands"/>
    <xhtml:link rel="alternate" hreflang="en-ca" href="https://www.nestlehealthscience.ca/en/brands"/>
    <xhtml:link rel="alternate" hreflang="fr-ca" href="https://www.nestlehealthscience.ca/fr/marques/home"/>
     <xhtml:link rel="alternate" hreflang="en-gb" href="https://www.nestlehealthscience.co.uk/brands"/>
     <xhtml:link rel="alternate" hreflang="pt-br" href="https://www.nestlehealthscience.com.br/marcas"/>
     <xhtml:link rel="alternate" hreflang="fi-fi" href="https://www.nestlehealthscience.fi/tuotteet"/>
     <xhtml:link rel="alternate" hreflang="pt-pt" href="http://nestlehealthscience.pt/marcas"/>
     <xhtml:link rel="alternate" hreflang="th-th" href="https://www.nestlehealthscience-th.com"/>
     <xhtml:link rel="alternate" hreflang="tr-tr" href="https://www.nestlehealthscience.com.tr/brands"/>
     <xhtml:link rel="alternate" hreflang="en-ae" href="https://www.nestlehealthscience-me.com/en/brands"/>
     <xhtml:link rel="alternate" hreflang="es-mx" href="https://www.nestlehealthscience.com.mx/marcas"/>
     <xhtml:link rel="alternate" hreflang="fr-fr" href="https://www.nestlehealthscience.fr/nos-marques"/>
     <xhtml:link rel="alternate" hreflang="sv-se" href="https://www.nestlehealthscience.se/produkter"/>
     <xhtml:link rel="alternate" hreflang="de-at" href="https://www.nestlehealthscience.at/unsereprodukte"/>
     <xhtml:link rel="alternate" hreflang="en-lk" href="https://www.nestlehealthscience.lk/brands"/>
     <xhtml:link rel="alternate" hreflang="en-au" href="https://www.nestlehealthscience.com.au/brands"/>
     <xhtml:link rel="alternate" hreflang="zh-hans-hk" href="https://www.nestlehealthscience.com.hk/zh-hans/brands"/>
     <xhtml:link rel="alternate" hreflang="ja-jp" href="https://www.nestlehealthscience.jp/brands"/>
     <xhtml:link rel="alternate" hreflang="es-es" href="https://www.nestlehealthscience.es/marcas"/>
     <xhtml:link rel="alternate" hreflang="ro-ro" href="https://www.nestlehealthscience.ro/produse"/>
     <xhtml:link rel="alternate" hreflang="de-de" href="https://www.nestlehealthscience.de/marken"/>
     <xhtml:link rel="alternate" hreflang="da-dk" href="https://www.nestlehealthscience.dk/produkter"/>
     <xhtml:link rel="alternate" hreflang="en-in" href="https://www.nestlehealthscience.in/brands"/>
     <xhtml:link rel="alternate" hreflang="de-ch" href="https://www.nestlehealthscience.ch/de/marken"/>
     <xhtml:link rel="alternate" hreflang="fr-ch" href="https://www.nestlehealthscience.ch/fr/nos-marques"/>
     <xhtml:link rel="alternate" hreflang="id-id" href="https://www.nestlehealthscience.co.id/brands"/>
     <xhtml:link rel="alternate" hreflang="it-it" href="https://www.nestlehealthscience.it/prodotti"/>
     <xhtml:link rel="alternate" hreflang="pl-pl" href="https://www.nestlehealthscience.pl/produkty"/>
     <xhtml:link rel="alternate" hreflang="en-za" href="https://www.nestlehealthscience.co.za/brands"/>
     <xhtml:link rel="alternate" hreflang="en-my" href="https://www.nestlehealthscience.my/brands"/>
     <xhtml:link rel="alternate" hreflang="vi-vn" href="https://www.nestlehealthscience.vn/san-pham"/>
     <xhtml:link rel="alternate" hreflang="cs-cz" href="https://www.nestlehealthscience.cz/cz/produkty"/>
     <xhtml:link rel="alternate" hreflang="sk-cz" href="https://www.nestlehealthscience.cz/sk/produkty"/>
     <xhtml:link rel="alternate" hreflang="en-sg" href="https://www.nestlehealthscience.sg/brands"/>
     <xhtml:link rel="alternate" hreflang="zh-hans-cn" href="https://www.nestlehealthscience.cn/brands"/>
     <xhtml:link rel="alternate" hreflang="en-ph" href="https://www.nestlehealthscience.ph/brands"/>
     <xhtml:link rel="alternate" hreflang="ru-ru" href="https://www.nestlehealthscience.ru/brands"/>
     <xhtml:link rel="alternate" hreflang="nl-nl" href="https://www.nestlehealthscience.nl/nl/producten"/>
     <xhtml:link rel="alternate" hreflang="fr-nl" href="https://www.nestlehealthscience.nl/fr/producten"/>
     <xhtml:link rel="alternate" hreflang="zh-hans-tw" href="https://www.nestlehealthscience.com.tw/brands"/>
      <changefreq>daily</changefreq>
      <priority>1.0</priority>
     </url>
    </urlset>';

}

  public function australia()
  {
    return '<?xml version="1.0" encoding="UTF-8"?>
    <urlset
        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd
        http://www.w3.org/1999/xhtml http://www.w3.org/2002/08/xhtml/xhtml1-strict.xsd"
        xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:xhtml="http://www.w3.org/1999/xhtml"   
    >
    <url>
      <loc>https://www.nestlehealthscience.com.au"</loc>
     <xhtml:link rel="alternate" hreflang="en-au" href="https://www.nestlehealthscience.com.au"/>
     <xhtml:link rel="alternate" hreflang="en" href="https://www.nestlehealthscience.com"/>
    <xhtml:link rel="alternate" hreflang="en-us" href="https://www.nestlehealthscience.us"/>
    <xhtml:link rel="alternate" hreflang="en-ca" href="https://www.nestlehealthscience.ca/en"/>
    <xhtml:link rel="alternate" hreflang="fr-ca" href="https://www.nestlehealthscience.ca/fr"/>
     <xhtml:link rel="alternate" hreflang="en-gb" href="https://www.nestlehealthscience.co.uk"/>
     <xhtml:link rel="alternate" hreflang="pt-br" href="https://www.nestlehealthscience.com.br"/>
     <xhtml:link rel="alternate" hreflang="fi-fi" href="https://www.nestlehealthscience.fi"/>
     <xhtml:link rel="alternate" hreflang="pt-pt" href="https://www.nestlehealthscience.pt"/>
     <xhtml:link rel="alternate" hreflang="th-th" href="https://www.nestlehealthscience-th.com"/>
     <xhtml:link rel="alternate" hreflang="tr-tr" href="https://www.nestlehealthscience.com.tr"/>
     <xhtml:link rel="alternate" hreflang="en-ae" href="https://www.nestlehealthscience-me.com"/>
     <xhtml:link rel="alternate" hreflang="es-mx" href="https://www.nestlehealthscience.com.mx"/>
     <xhtml:link rel="alternate" hreflang="fr-fr" href="https://www.nestlehealthscience.fr"/>
     <xhtml:link rel="alternate" hreflang="sv-se" href="https://www.nestlehealthscience.se"/>
     <xhtml:link rel="alternate" hreflang="de-at" href="https://www.nestlehealthscience.at"/>
     <xhtml:link rel="alternate" hreflang="en-lk" href="https://www.nestlehealthscience.lk"/>
     <xhtml:link rel="alternate" hreflang="zh-hans-hk" href="https://www.nestlehealthscience.com.hk"/>
     <xhtml:link rel="alternate" hreflang="ja-jp" href="https://www.nestlehealthscience.jp"/>
     <xhtml:link rel="alternate" hreflang="es-es" href="https://www.nestlehealthscience.es"/>
     <xhtml:link rel="alternate" hreflang="ro-ro" href="https://www.nestlehealthscience.ro"/>
     <xhtml:link rel="alternate" hreflang="de-de" href="https://www.nestlehealthscience.de"/>
     <xhtml:link rel="alternate" hreflang="da-dk" href="https://www.nestlehealthscience.dk"/>
     <xhtml:link rel="alternate" hreflang="en-in" href="https://www.nestlehealthscience.in"/>
     <xhtml:link rel="alternate" hreflang="de-ch" href="https://www.nestlehealthscience.ch/de"/>
     <xhtml:link rel="alternate" hreflang="fr-ch" href="https://www.nestlehealthscience.ch/fr"/>
     <xhtml:link rel="alternate" hreflang="id-id" href="https://www.nestlehealthscience.co.id"/>
     <xhtml:link rel="alternate" hreflang="it-it" href="https://www.nestlehealthscience.it"/>
     <xhtml:link rel="alternate" hreflang="pl-pl" href="https://www.nestlehealthscience.pl"/>
     <xhtml:link rel="alternate" hreflang="en-za" href="https://www.nestlehealthscience.co.za"/>
     <xhtml:link rel="alternate" hreflang="en-my" href="https://www.nestlehealthscience.my"/>
     <xhtml:link rel="alternate" hreflang="vi-vn" href="https://www.nestlehealthscience.vn"/>
     <xhtml:link rel="alternate" hreflang="cs-cz" href="https://www.nestlehealthscience.cz/cz"/>
     <xhtml:link rel="alternate" hreflang="sk-cz" href="https://www.nestlehealthscience.cz/sk"/>
     <xhtml:link rel="alternate" hreflang="en-sg" href="https://www.nestlehealthscience.sg"/>
     <xhtml:link rel="alternate" hreflang="zh-hans-cn" href="https://www.nestlehealthscience.cn/"/>
     <xhtml:link rel="alternate" hreflang="en-ph" href="https://www.nestlehealthscience.ph/"/>
     <xhtml:link rel="alternate" hreflang="ru-ru" href="https://www.nestlehealthscience.ru/"/>
     <xhtml:link rel="alternate" hreflang="nl-nl" href="https://www.nestlehealthscience.nl/nl"/>
     <xhtml:link rel="alternate" hreflang="fr-nl" href="https://www.nestlehealthscience.nl/fr"/>
     <xhtml:link rel="alternate" hreflang="zh-hans-tw" href="https://www.nestlehealthscience.com.tw"/>
      <changefreq>daily</changefreq>
      <priority>1.0</priority>
     </url>
     <url>
     <loc>hhttps://www.nestlehealthscience.com.au/brands</loc>
     <xhtml:link rel="alternate" hreflang="en-au" href="https://www.nestlehealthscience.com.au/brands"/>
     <xhtml:link rel="alternate" hreflang="en" href="https://www.nestlehealthscience.com/brands"/>
    <xhtml:link rel="alternate" hreflang="en-ca" href="https://www.nestlehealthscience.ca/en/brands"/>
    <xhtml:link rel="alternate" hreflang="fr-ca" href="https://www.nestlehealthscience.ca/fr/marques/home"/>
     <xhtml:link rel="alternate" hreflang="en-gb" href="https://www.nestlehealthscience.co.uk/brands"/>
     <xhtml:link rel="alternate" hreflang="pt-br" href="https://www.nestlehealthscience.com.br/marcas"/>
     <xhtml:link rel="alternate" hreflang="fi-fi" href="https://www.nestlehealthscience.fi/tuotteet"/>
     <xhtml:link rel="alternate" hreflang="pt-pt" href="http://nestlehealthscience.pt/marcas"/>
     <xhtml:link rel="alternate" hreflang="th-th" href="https://www.nestlehealthscience-th.com"/>
     <xhtml:link rel="alternate" hreflang="tr-tr" href="https://www.nestlehealthscience.com.tr/brands"/>
     <xhtml:link rel="alternate" hreflang="en-ae" href="https://www.nestlehealthscience-me.com/en/brands"/>
     <xhtml:link rel="alternate" hreflang="es-mx" href="https://www.nestlehealthscience.com.mx/marcas"/>
     <xhtml:link rel="alternate" hreflang="fr-fr" href="https://www.nestlehealthscience.fr/nos-marques"/>
     <xhtml:link rel="alternate" hreflang="sv-se" href="https://www.nestlehealthscience.se/produkter"/>
     <xhtml:link rel="alternate" hreflang="de-at" href="https://www.nestlehealthscience.at/unsereprodukte"/>
     <xhtml:link rel="alternate" hreflang="en-lk" href="https://www.nestlehealthscience.lk/brands"/>
     <xhtml:link rel="alternate" hreflang="zh-hans-hk" href="https://www.nestlehealthscience.com.hk/zh-hans/brands"/>
     <xhtml:link rel="alternate" hreflang="ja-jp" href="https://www.nestlehealthscience.jp/brands"/>
     <xhtml:link rel="alternate" hreflang="es-es" href="https://www.nestlehealthscience.es/marcas"/>
     <xhtml:link rel="alternate" hreflang="ro-ro" href="https://www.nestlehealthscience.ro/produse"/>
     <xhtml:link rel="alternate" hreflang="de-de" href="https://www.nestlehealthscience.de/marken"/>
     <xhtml:link rel="alternate" hreflang="da-dk" href="https://www.nestlehealthscience.dk/produkter"/>
     <xhtml:link rel="alternate" hreflang="en-in" href="https://www.nestlehealthscience.in/brands"/>
     <xhtml:link rel="alternate" hreflang="de-ch" href="https://www.nestlehealthscience.ch/de/marken"/>
     <xhtml:link rel="alternate" hreflang="fr-ch" href="https://www.nestlehealthscience.ch/fr/nos-marques"/>
     <xhtml:link rel="alternate" hreflang="id-id" href="https://www.nestlehealthscience.co.id/brands"/>
     <xhtml:link rel="alternate" hreflang="it-it" href="https://www.nestlehealthscience.it/prodotti"/>
     <xhtml:link rel="alternate" hreflang="pl-pl" href="https://www.nestlehealthscience.pl/produkty"/>
     <xhtml:link rel="alternate" hreflang="en-za" href="https://www.nestlehealthscience.co.za/brands"/>
     <xhtml:link rel="alternate" hreflang="en-my" href="https://www.nestlehealthscience.my/brands"/>
     <xhtml:link rel="alternate" hreflang="vi-vn" href="https://www.nestlehealthscience.vn/san-pham"/>
     <xhtml:link rel="alternate" hreflang="cs-cz" href="https://www.nestlehealthscience.cz/cz/produkty"/>
     <xhtml:link rel="alternate" hreflang="sk-cz" href="https://www.nestlehealthscience.cz/sk/produkty"/>
     <xhtml:link rel="alternate" hreflang="en-sg" href="https://www.nestlehealthscience.sg/brands"/>
     <xhtml:link rel="alternate" hreflang="zh-hans-cn" href="https://www.nestlehealthscience.cn/brands"/>
     <xhtml:link rel="alternate" hreflang="en-ph" href="https://www.nestlehealthscience.ph/brands"/>
     <xhtml:link rel="alternate" hreflang="ru-ru" href="https://www.nestlehealthscience.ru/brands"/>
     <xhtml:link rel="alternate" hreflang="nl-nl" href="https://www.nestlehealthscience.nl/nl/producten"/>
     <xhtml:link rel="alternate" hreflang="fr-nl" href="https://www.nestlehealthscience.nl/fr/producten"/>
     <xhtml:link rel="alternate" hreflang="zh-hans-tw" href="https://www.nestlehealthscience.com.tw/brands"/>
      <changefreq>daily</changefreq>
      <priority>1.0</priority>
     </url>
    </urlset>';
  }

  public function austria()
  {
    return '<?xml version="1.0" encoding="UTF-8"?>
    <urlset
        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd
        http://www.w3.org/1999/xhtml http://www.w3.org/2002/08/xhtml/xhtml1-strict.xsd"
        xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:xhtml="http://www.w3.org/1999/xhtml"   
    >
    <url>
      <loc>https://www.nestlehealthscience.at</loc>
     <xhtml:link rel="alternate" hreflang="de-at" href="https://www.nestlehealthscience.at"/>
     <xhtml:link rel="alternate" hreflang="en" href="https://www.nestlehealthscience.com"/>
    <xhtml:link rel="alternate" hreflang="en-us" href="https://www.nestlehealthscience.us"/>
    <xhtml:link rel="alternate" hreflang="en-ca" href="https://www.nestlehealthscience.ca/en"/>
    <xhtml:link rel="alternate" hreflang="fr-ca" href="https://www.nestlehealthscience.ca/fr"/>
     <xhtml:link rel="alternate" hreflang="en-gb" href="https://www.nestlehealthscience.co.uk"/>
     <xhtml:link rel="alternate" hreflang="pt-br" href="https://www.nestlehealthscience.com.br"/>
     <xhtml:link rel="alternate" hreflang="fi-fi" href="https://www.nestlehealthscience.fi"/>
     <xhtml:link rel="alternate" hreflang="pt-pt" href="https://www.nestlehealthscience.pt"/>
     <xhtml:link rel="alternate" hreflang="th-th" href="https://www.nestlehealthscience-th.com"/>
     <xhtml:link rel="alternate" hreflang="tr-tr" href="https://www.nestlehealthscience.com.tr"/>
     <xhtml:link rel="alternate" hreflang="en-ae" href="https://www.nestlehealthscience-me.com"/>
     <xhtml:link rel="alternate" hreflang="es-mx" href="https://www.nestlehealthscience.com.mx"/>
     <xhtml:link rel="alternate" hreflang="fr-fr" href="https://www.nestlehealthscience.fr"/>
     <xhtml:link rel="alternate" hreflang="sv-se" href="https://www.nestlehealthscience.se"/>
     <xhtml:link rel="alternate" hreflang="en-lk" href="https://www.nestlehealthscience.lk"/>
     <xhtml:link rel="alternate" hreflang="zh-hans-hk" href="https://www.nestlehealthscience.com.hk"/>
     <xhtml:link rel="alternate" hreflang="ja-jp" href="https://www.nestlehealthscience.jp"/>
     <xhtml:link rel="alternate" hreflang="es-es" href="https://www.nestlehealthscience.es"/>
     <xhtml:link rel="alternate" hreflang="ro-ro" href="https://www.nestlehealthscience.ro"/>
     <xhtml:link rel="alternate" hreflang="de-de" href="https://www.nestlehealthscience.de"/>
     <xhtml:link rel="alternate" hreflang="da-dk" href="https://www.nestlehealthscience.dk"/>
     <xhtml:link rel="alternate" hreflang="en-in" href="https://www.nestlehealthscience.in"/>
     <xhtml:link rel="alternate" hreflang="de-ch" href="https://www.nestlehealthscience.ch/de"/>
     <xhtml:link rel="alternate" hreflang="fr-ch" href="https://www.nestlehealthscience.ch/fr"/>
     <xhtml:link rel="alternate" hreflang="id-id" href="https://www.nestlehealthscience.co.id"/>
     <xhtml:link rel="alternate" hreflang="it-it" href="https://www.nestlehealthscience.it"/>
     <xhtml:link rel="alternate" hreflang="pl-pl" href="https://www.nestlehealthscience.pl"/>
     <xhtml:link rel="alternate" hreflang="en-za" href="https://www.nestlehealthscience.co.za"/>
     <xhtml:link rel="alternate" hreflang="en-my" href="https://www.nestlehealthscience.my"/>
     <xhtml:link rel="alternate" hreflang="vi-vn" href="https://www.nestlehealthscience.vn"/>
     <xhtml:link rel="alternate" hreflang="cs-cz" href="https://www.nestlehealthscience.cz/cz"/>
     <xhtml:link rel="alternate" hreflang="sk-cz" href="https://www.nestlehealthscience.cz/sk"/>
     <xhtml:link rel="alternate" hreflang="en-sg" href="https://www.nestlehealthscience.sg"/>
     <xhtml:link rel="alternate" hreflang="zh-hans-cn" href="https://www.nestlehealthscience.cn/"/>
     <xhtml:link rel="alternate" hreflang="en-ph" href="https://www.nestlehealthscience.ph/"/>
     <xhtml:link rel="alternate" hreflang="ru-ru" href="https://www.nestlehealthscience.ru/"/>
     <xhtml:link rel="alternate" hreflang="nl-nl" href="https://www.nestlehealthscience.nl/nl"/>
     <xhtml:link rel="alternate" hreflang="fr-nl" href="https://www.nestlehealthscience.nl/fr"/>
     <xhtml:link rel="alternate" hreflang="zh-hans-tw" href="https://www.nestlehealthscience.com.tw"/>
      <changefreq>daily</changefreq>
      <priority>1.0</priority>
     </url>
     <url>
     <loc>https://www.nestlehealthscience.at/unsereprodukte</loc>
     <xhtml:link rel="alternate" hreflang="de-at" href="https://www.nestlehealthscience.at/unsereprodukte"/>
      <xhtml:link rel="alternate" hreflang="en" href="https://www.nestlehealthscience.com/brands"/>
    <xhtml:link rel="alternate" hreflang="en-ca" href="https://www.nestlehealthscience.ca/en/brands"/>
    <xhtml:link rel="alternate" hreflang="fr-ca" href="https://www.nestlehealthscience.ca/fr/marques/home"/>
     <xhtml:link rel="alternate" hreflang="en-gb" href="https://www.nestlehealthscience.co.uk/brands"/>
     <xhtml:link rel="alternate" hreflang="pt-br" href="https://www.nestlehealthscience.com.br/marcas"/>
     <xhtml:link rel="alternate" hreflang="fi-fi" href="https://www.nestlehealthscience.fi/tuotteet"/>
     <xhtml:link rel="alternate" hreflang="pt-pt" href="http://nestlehealthscience.pt/marcas"/>
     <xhtml:link rel="alternate" hreflang="th-th" href="https://www.nestlehealthscience-th.com"/>
     <xhtml:link rel="alternate" hreflang="tr-tr" href="https://www.nestlehealthscience.com.tr/brands"/>
     <xhtml:link rel="alternate" hreflang="en-ae" href="https://www.nestlehealthscience-me.com/en/brands"/>
     <xhtml:link rel="alternate" hreflang="es-mx" href="https://www.nestlehealthscience.com.mx/marcas"/>
     <xhtml:link rel="alternate" hreflang="fr-fr" href="https://www.nestlehealthscience.fr/nos-marques"/>
     <xhtml:link rel="alternate" hreflang="sv-se" href="https://www.nestlehealthscience.se/produkter"/>
     <xhtml:link rel="alternate" hreflang="en-lk" href="https://www.nestlehealthscience.lk/brands"/>
     <xhtml:link rel="alternate" hreflang="zh-hans-hk" href="https://www.nestlehealthscience.com.hk/zh-hans/brands"/>
     <xhtml:link rel="alternate" hreflang="ja-jp" href="https://www.nestlehealthscience.jp/brands"/>
     <xhtml:link rel="alternate" hreflang="es-es" href="https://www.nestlehealthscience.es/marcas"/>
     <xhtml:link rel="alternate" hreflang="ro-ro" href="https://www.nestlehealthscience.ro/produse"/>
     <xhtml:link rel="alternate" hreflang="de-de" href="https://www.nestlehealthscience.de/marken"/>
     <xhtml:link rel="alternate" hreflang="da-dk" href="https://www.nestlehealthscience.dk/produkter"/>
     <xhtml:link rel="alternate" hreflang="en-in" href="https://www.nestlehealthscience.in/brands"/>
     <xhtml:link rel="alternate" hreflang="de-ch" href="https://www.nestlehealthscience.ch/de/marken"/>
     <xhtml:link rel="alternate" hreflang="fr-ch" href="https://www.nestlehealthscience.ch/fr/nos-marques"/>
     <xhtml:link rel="alternate" hreflang="id-id" href="https://www.nestlehealthscience.co.id/brands"/>
     <xhtml:link rel="alternate" hreflang="it-it" href="https://www.nestlehealthscience.it/prodotti"/>
     <xhtml:link rel="alternate" hreflang="pl-pl" href="https://www.nestlehealthscience.pl/produkty"/>
     <xhtml:link rel="alternate" hreflang="en-za" href="https://www.nestlehealthscience.co.za/brands"/>
     <xhtml:link rel="alternate" hreflang="en-my" href="https://www.nestlehealthscience.my/brands"/>
     <xhtml:link rel="alternate" hreflang="vi-vn" href="https://www.nestlehealthscience.vn/san-pham"/>
     <xhtml:link rel="alternate" hreflang="cs-cz" href="https://www.nestlehealthscience.cz/cz/produkty"/>
     <xhtml:link rel="alternate" hreflang="sk-cz" href="https://www.nestlehealthscience.cz/sk/produkty"/>
     <xhtml:link rel="alternate" hreflang="en-sg" href="https://www.nestlehealthscience.sg/brands"/>
     <xhtml:link rel="alternate" hreflang="zh-hans-cn" href="https://www.nestlehealthscience.cn/brands"/>
     <xhtml:link rel="alternate" hreflang="en-ph" href="https://www.nestlehealthscience.ph/brands"/>
     <xhtml:link rel="alternate" hreflang="ru-ru" href="https://www.nestlehealthscience.ru/brands"/>
     <xhtml:link rel="alternate" hreflang="nl-nl" href="https://www.nestlehealthscience.nl/nl/producten"/>
     <xhtml:link rel="alternate" hreflang="fr-nl" href="https://www.nestlehealthscience.nl/fr/producten"/>
     <xhtml:link rel="alternate" hreflang="zh-hans-tw" href="https://www.nestlehealthscience.com.tw/brands"/>
      <changefreq>daily</changefreq>
      <priority>1.0</priority>
     </url>
    </urlset>';
  }

  public function brazil()
  {
    return '<?xml version="1.0" encoding="UTF-8"?>
    <urlset
        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd
        http://www.w3.org/1999/xhtml http://www.w3.org/2002/08/xhtml/xhtml1-strict.xsd"
        xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:xhtml="http://www.w3.org/1999/xhtml"   
    >
    <url>
      <loc>https://www.nestlehealthscience.com.br/</loc>
     <xhtml:link rel="alternate" hreflang="pt-br" href="https://www.nestlehealthscience.com.br"/>
     <xhtml:link rel="alternate" hreflang="en" href="https://www.nestlehealthscience.com"/>
    <xhtml:link rel="alternate" hreflang="en-us" href="https://www.nestlehealthscience.us"/>
    <xhtml:link rel="alternate" hreflang="en-ca" href="https://www.nestlehealthscience.ca/en"/>
    <xhtml:link rel="alternate" hreflang="fr-ca" href="https://www.nestlehealthscience.ca/fr"/>
     <xhtml:link rel="alternate" hreflang="en-gb" href="https://www.nestlehealthscience.co.uk"/>
     <xhtml:link rel="alternate" hreflang="fi-fi" href="https://www.nestlehealthscience.fi"/>
     <xhtml:link rel="alternate" hreflang="pt-pt" href="https://www.nestlehealthscience.pt"/>
     <xhtml:link rel="alternate" hreflang="th-th" href="https://www.nestlehealthscience-th.com"/>
     <xhtml:link rel="alternate" hreflang="tr-tr" href="https://www.nestlehealthscience.com.tr"/>
     <xhtml:link rel="alternate" hreflang="en-ae" href="https://www.nestlehealthscience-me.com"/>
     <xhtml:link rel="alternate" hreflang="es-mx" href="https://www.nestlehealthscience.com.mx"/>
     <xhtml:link rel="alternate" hreflang="fr-fr" href="https://www.nestlehealthscience.fr"/>
     <xhtml:link rel="alternate" hreflang="sv-se" href="https://www.nestlehealthscience.se"/>
     <xhtml:link rel="alternate" hreflang="en-lk" href="https://www.nestlehealthscience.lk"/>
     <xhtml:link rel="alternate" hreflang="zh-hans-hk" href="https://www.nestlehealthscience.com.hk"/>
     <xhtml:link rel="alternate" hreflang="ja-jp" href="https://www.nestlehealthscience.jp"/>
     <xhtml:link rel="alternate" hreflang="es-es" href="https://www.nestlehealthscience.es"/>
     <xhtml:link rel="alternate" hreflang="ro-ro" href="https://www.nestlehealthscience.ro"/>
     <xhtml:link rel="alternate" hreflang="de-de" href="https://www.nestlehealthscience.de"/>
     <xhtml:link rel="alternate" hreflang="da-dk" href="https://www.nestlehealthscience.dk"/>
     <xhtml:link rel="alternate" hreflang="en-in" href="https://www.nestlehealthscience.in"/>
     <xhtml:link rel="alternate" hreflang="de-ch" href="https://www.nestlehealthscience.ch/de"/>
     <xhtml:link rel="alternate" hreflang="fr-ch" href="https://www.nestlehealthscience.ch/fr"/>
     <xhtml:link rel="alternate" hreflang="id-id" href="https://www.nestlehealthscience.co.id"/>
     <xhtml:link rel="alternate" hreflang="it-it" href="https://www.nestlehealthscience.it"/>
     <xhtml:link rel="alternate" hreflang="pl-pl" href="https://www.nestlehealthscience.pl"/>
     <xhtml:link rel="alternate" hreflang="en-za" href="https://www.nestlehealthscience.co.za"/>
     <xhtml:link rel="alternate" hreflang="en-my" href="https://www.nestlehealthscience.my"/>
     <xhtml:link rel="alternate" hreflang="vi-vn" href="https://www.nestlehealthscience.vn"/>
     <xhtml:link rel="alternate" hreflang="cs-cz" href="https://www.nestlehealthscience.cz/cz"/>
     <xhtml:link rel="alternate" hreflang="sk-cz" href="https://www.nestlehealthscience.cz/sk"/>
     <xhtml:link rel="alternate" hreflang="en-sg" href="https://www.nestlehealthscience.sg"/>
     <xhtml:link rel="alternate" hreflang="zh-hans-cn" href="https://www.nestlehealthscience.cn/"/>
     <xhtml:link rel="alternate" hreflang="en-ph" href="https://www.nestlehealthscience.ph/"/>
     <xhtml:link rel="alternate" hreflang="ru-ru" href="https://www.nestlehealthscience.ru/"/>
     <xhtml:link rel="alternate" hreflang="nl-nl" href="https://www.nestlehealthscience.nl/nl"/>
     <xhtml:link rel="alternate" hreflang="fr-nl" href="https://www.nestlehealthscience.nl/fr"/>
     <xhtml:link rel="alternate" hreflang="zh-hans-tw" href="https://www.nestlehealthscience.com.tw"/>
      <changefreq>daily</changefreq>
      <priority>1.0</priority>
     </url>
     <url>
     <loc>https://www.nestlehealthscience.com.br/marcas</loc>
     <xhtml:link rel="alternate" hreflang="pt-br" href="https://www.nestlehealthscience.com.br/marcas"/>
      <xhtml:link rel="alternate" hreflang="en" href="https://www.nestlehealthscience.com/brands"/>
    <xhtml:link rel="alternate" hreflang="en-ca" href="https://www.nestlehealthscience.ca/en/brands"/>
    <xhtml:link rel="alternate" hreflang="fr-ca" href="https://www.nestlehealthscience.ca/fr/marques/home"/>
     <xhtml:link rel="alternate" hreflang="en-gb" href="https://www.nestlehealthscience.co.uk/brands"/>
     <xhtml:link rel="alternate" hreflang="fi-fi" href="https://www.nestlehealthscience.fi/tuotteet"/>
     <xhtml:link rel="alternate" hreflang="pt-pt" href="http://nestlehealthscience.pt/marcas"/>
     <xhtml:link rel="alternate" hreflang="th-th" href="https://www.nestlehealthscience-th.com"/>
     <xhtml:link rel="alternate" hreflang="tr-tr" href="https://www.nestlehealthscience.com.tr/brands"/>
     <xhtml:link rel="alternate" hreflang="en-ae" href="https://www.nestlehealthscience-me.com/en/brands"/>
     <xhtml:link rel="alternate" hreflang="es-mx" href="https://www.nestlehealthscience.com.mx/marcas"/>
     <xhtml:link rel="alternate" hreflang="fr-fr" href="https://www.nestlehealthscience.fr/nos-marques"/>
     <xhtml:link rel="alternate" hreflang="sv-se" href="https://www.nestlehealthscience.se/produkter"/>
     <xhtml:link rel="alternate" hreflang="en-lk" href="https://www.nestlehealthscience.lk/brands"/>
     <xhtml:link rel="alternate" hreflang="zh-hans-hk" href="https://www.nestlehealthscience.com.hk/zh-hans/brands"/>
     <xhtml:link rel="alternate" hreflang="ja-jp" href="https://www.nestlehealthscience.jp/brands"/>
     <xhtml:link rel="alternate" hreflang="es-es" href="https://www.nestlehealthscience.es/marcas"/>
     <xhtml:link rel="alternate" hreflang="ro-ro" href="https://www.nestlehealthscience.ro/produse"/>
     <xhtml:link rel="alternate" hreflang="de-de" href="https://www.nestlehealthscience.de/marken"/>
     <xhtml:link rel="alternate" hreflang="da-dk" href="https://www.nestlehealthscience.dk/produkter"/>
     <xhtml:link rel="alternate" hreflang="en-in" href="https://www.nestlehealthscience.in/brands"/>
     <xhtml:link rel="alternate" hreflang="de-ch" href="https://www.nestlehealthscience.ch/de/marken"/>
     <xhtml:link rel="alternate" hreflang="fr-ch" href="https://www.nestlehealthscience.ch/fr/nos-marques"/>
     <xhtml:link rel="alternate" hreflang="id-id" href="https://www.nestlehealthscience.co.id/brands"/>
     <xhtml:link rel="alternate" hreflang="it-it" href="https://www.nestlehealthscience.it/prodotti"/>
     <xhtml:link rel="alternate" hreflang="pl-pl" href="https://www.nestlehealthscience.pl/produkty"/>
     <xhtml:link rel="alternate" hreflang="en-za" href="https://www.nestlehealthscience.co.za/brands"/>
     <xhtml:link rel="alternate" hreflang="en-my" href="https://www.nestlehealthscience.my/brands"/>
     <xhtml:link rel="alternate" hreflang="vi-vn" href="https://www.nestlehealthscience.vn/san-pham"/>
     <xhtml:link rel="alternate" hreflang="cs-cz" href="https://www.nestlehealthscience.cz/cz/produkty"/>
     <xhtml:link rel="alternate" hreflang="sk-cz" href="https://www.nestlehealthscience.cz/sk/produkty"/>
     <xhtml:link rel="alternate" hreflang="en-sg" href="https://www.nestlehealthscience.sg/brands"/>
     <xhtml:link rel="alternate" hreflang="zh-hans-cn" href="https://www.nestlehealthscience.cn/brands"/>
     <xhtml:link rel="alternate" hreflang="en-ph" href="https://www.nestlehealthscience.ph/brands"/>
     <xhtml:link rel="alternate" hreflang="ru-ru" href="https://www.nestlehealthscience.ru/brands"/>
     <xhtml:link rel="alternate" hreflang="nl-nl" href="https://www.nestlehealthscience.nl/nl/producten"/>
     <xhtml:link rel="alternate" hreflang="fr-nl" href="https://www.nestlehealthscience.nl/fr/producten"/>
     <xhtml:link rel="alternate" hreflang="zh-hans-tw" href="https://www.nestlehealthscience.com.tw/brands"/>
      <changefreq>daily</changefreq>
      <priority>1.0</priority>
     </url>
    </urlset>';
  }

    public function canada()
    {
      return '<?xml version="1.0" encoding="UTF-8"?>
      <urlset
          xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
          xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd
          http://www.w3.org/1999/xhtml http://www.w3.org/2002/08/xhtml/xhtml1-strict.xsd"
          xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
          xmlns:xhtml="http://www.w3.org/1999/xhtml"   
      >
      <url>
        <loc>https://www.nestlehealthscience.ca/en</loc>
      <xhtml:link rel="alternate" hreflang="en-ca" href="https://www.nestlehealthscience.ca/en"/>
      <xhtml:link rel="alternate" hreflang="fr-ca" href="https://www.nestlehealthscience.ca/fr"/>
       <xhtml:link rel="alternate" hreflang="en" href="https://www.nestlehealthscience.com"/>
      <xhtml:link rel="alternate" hreflang="en-us" href="https://www.nestlehealthscience.us"/>
       <xhtml:link rel="alternate" hreflang="en-gb" href="https://www.nestlehealthscience.co.uk"/>
       <xhtml:link rel="alternate" hreflang="pt-br" href="https://www.nestlehealthscience.com.br"/>
       <xhtml:link rel="alternate" hreflang="fi-fi" href="https://www.nestlehealthscience.fi"/>
       <xhtml:link rel="alternate" hreflang="pt-pt" href="https://www.nestlehealthscience.pt"/>
       <xhtml:link rel="alternate" hreflang="th-th" href="https://www.nestlehealthscience-th.com"/>
       <xhtml:link rel="alternate" hreflang="tr-tr" href="https://www.nestlehealthscience.com.tr"/>
       <xhtml:link rel="alternate" hreflang="en-ae" href="https://www.nestlehealthscience-me.com"/>
       <xhtml:link rel="alternate" hreflang="es-mx" href="https://www.nestlehealthscience.com.mx"/>
       <xhtml:link rel="alternate" hreflang="fr-fr" href="https://www.nestlehealthscience.fr"/>
       <xhtml:link rel="alternate" hreflang="sv-se" href="https://www.nestlehealthscience.se"/>
       <xhtml:link rel="alternate" hreflang="en-lk" href="https://www.nestlehealthscience.lk"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-hk" href="https://www.nestlehealthscience.com.hk"/>
       <xhtml:link rel="alternate" hreflang="ja-jp" href="https://www.nestlehealthscience.jp"/>
       <xhtml:link rel="alternate" hreflang="es-es" href="https://www.nestlehealthscience.es"/>
       <xhtml:link rel="alternate" hreflang="ro-ro" href="https://www.nestlehealthscience.ro"/>
       <xhtml:link rel="alternate" hreflang="de-de" href="https://www.nestlehealthscience.de"/>
       <xhtml:link rel="alternate" hreflang="da-dk" href="https://www.nestlehealthscience.dk"/>
       <xhtml:link rel="alternate" hreflang="en-in" href="https://www.nestlehealthscience.in"/>
       <xhtml:link rel="alternate" hreflang="de-ch" href="https://www.nestlehealthscience.ch/de"/>
       <xhtml:link rel="alternate" hreflang="fr-ch" href="https://www.nestlehealthscience.ch/fr"/>
       <xhtml:link rel="alternate" hreflang="id-id" href="https://www.nestlehealthscience.co.id"/>
       <xhtml:link rel="alternate" hreflang="it-it" href="https://www.nestlehealthscience.it"/>
       <xhtml:link rel="alternate" hreflang="pl-pl" href="https://www.nestlehealthscience.pl"/>
       <xhtml:link rel="alternate" hreflang="en-za" href="https://www.nestlehealthscience.co.za"/>
       <xhtml:link rel="alternate" hreflang="en-my" href="https://www.nestlehealthscience.my"/>
       <xhtml:link rel="alternate" hreflang="vi-vn" href="https://www.nestlehealthscience.vn"/>
       <xhtml:link rel="alternate" hreflang="cs-cz" href="https://www.nestlehealthscience.cz/cz"/>
       <xhtml:link rel="alternate" hreflang="sk-cz" href="https://www.nestlehealthscience.cz/sk"/>
       <xhtml:link rel="alternate" hreflang="en-sg" href="https://www.nestlehealthscience.sg"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-cn" href="https://www.nestlehealthscience.cn/"/>
       <xhtml:link rel="alternate" hreflang="en-ph" href="https://www.nestlehealthscience.ph/"/>
       <xhtml:link rel="alternate" hreflang="ru-ru" href="https://www.nestlehealthscience.ru/"/>
       <xhtml:link rel="alternate" hreflang="nl-nl" href="https://www.nestlehealthscience.nl/nl"/>
       <xhtml:link rel="alternate" hreflang="fr-nl" href="https://www.nestlehealthscience.nl/fr"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-tw" href="https://www.nestlehealthscience.com.tw"/>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
       </url>
      <url>
        <loc>https://www.nestlehealthscience.ca/fr</loc>
      <xhtml:link rel="alternate" hreflang="fr-ca" href="https://www.nestlehealthscience.ca/fr"/>
      <xhtml:link rel="alternate" hreflang="en-ca" href="https://www.nestlehealthscience.ca/en"/>
       <xhtml:link rel="alternate" hreflang="en" href="https://www.nestlehealthscience.com"/>
      <xhtml:link rel="alternate" hreflang="en-us" href="https://www.nestlehealthscience.us"/>
       <xhtml:link rel="alternate" hreflang="en-gb" href="https://www.nestlehealthscience.co.uk"/>
       <xhtml:link rel="alternate" hreflang="pt-br" href="https://www.nestlehealthscience.com.br"/>
       <xhtml:link rel="alternate" hreflang="fi-fi" href="https://www.nestlehealthscience.fi"/>
       <xhtml:link rel="alternate" hreflang="pt-pt" href="https://www.nestlehealthscience.pt"/>
       <xhtml:link rel="alternate" hreflang="th-th" href="https://www.nestlehealthscience-th.com"/>
       <xhtml:link rel="alternate" hreflang="tr-tr" href="https://www.nestlehealthscience.com.tr"/>
       <xhtml:link rel="alternate" hreflang="en-ae" href="https://www.nestlehealthscience-me.com"/>
       <xhtml:link rel="alternate" hreflang="es-mx" href="https://www.nestlehealthscience.com.mx"/>
       <xhtml:link rel="alternate" hreflang="fr-fr" href="https://www.nestlehealthscience.fr"/>
       <xhtml:link rel="alternate" hreflang="sv-se" href="https://www.nestlehealthscience.se"/>
       <xhtml:link rel="alternate" hreflang="en-lk" href="https://www.nestlehealthscience.lk"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-hk" href="https://www.nestlehealthscience.com.hk"/>
       <xhtml:link rel="alternate" hreflang="ja-jp" href="https://www.nestlehealthscience.jp"/>
       <xhtml:link rel="alternate" hreflang="es-es" href="https://www.nestlehealthscience.es"/>
       <xhtml:link rel="alternate" hreflang="ro-ro" href="https://www.nestlehealthscience.ro"/>
       <xhtml:link rel="alternate" hreflang="de-de" href="https://www.nestlehealthscience.de"/>
       <xhtml:link rel="alternate" hreflang="da-dk" href="https://www.nestlehealthscience.dk"/>
       <xhtml:link rel="alternate" hreflang="en-in" href="https://www.nestlehealthscience.in"/>
       <xhtml:link rel="alternate" hreflang="de-ch" href="https://www.nestlehealthscience.ch/de"/>
       <xhtml:link rel="alternate" hreflang="fr-ch" href="https://www.nestlehealthscience.ch/fr"/>
       <xhtml:link rel="alternate" hreflang="id-id" href="https://www.nestlehealthscience.co.id"/>
       <xhtml:link rel="alternate" hreflang="it-it" href="https://www.nestlehealthscience.it"/>
       <xhtml:link rel="alternate" hreflang="pl-pl" href="https://www.nestlehealthscience.pl"/>
       <xhtml:link rel="alternate" hreflang="en-za" href="https://www.nestlehealthscience.co.za"/>
       <xhtml:link rel="alternate" hreflang="en-my" href="https://www.nestlehealthscience.my"/>
       <xhtml:link rel="alternate" hreflang="vi-vn" href="https://www.nestlehealthscience.vn"/>
       <xhtml:link rel="alternate" hreflang="cs-cz" href="https://www.nestlehealthscience.cz/cz"/>
       <xhtml:link rel="alternate" hreflang="sk-cz" href="https://www.nestlehealthscience.cz/sk"/>
       <xhtml:link rel="alternate" hreflang="en-sg" href="https://www.nestlehealthscience.sg"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-cn" href="https://www.nestlehealthscience.cn/"/>
       <xhtml:link rel="alternate" hreflang="en-ph" href="https://www.nestlehealthscience.ph/"/>
       <xhtml:link rel="alternate" hreflang="ru-ru" href="https://www.nestlehealthscience.ru/"/>
       <xhtml:link rel="alternate" hreflang="nl-nl" href="https://www.nestlehealthscience.nl/nl"/>
       <xhtml:link rel="alternate" hreflang="fr-nl" href="https://www.nestlehealthscience.nl/fr"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-tw" href="https://www.nestlehealthscience.com.tw"/>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
       </url>
       <url>
       <loc>https://www.nestlehealthscience.ca/en/brands</loc>
      <xhtml:link rel="alternate" hreflang="en-ca" href="https://www.nestlehealthscience.ca/en/brands"/>
      <xhtml:link rel="alternate" hreflang="fr-ca" href="https://www.nestlehealthscience.ca/fr/marques/home"/>
        <xhtml:link rel="alternate" hreflang="en" href="https://www.nestlehealthscience.com/brands"/>
       <xhtml:link rel="alternate" hreflang="en-gb" href="https://www.nestlehealthscience.co.uk/brands"/>
       <xhtml:link rel="alternate" hreflang="pt-br" href="https://www.nestlehealthscience.com.br/marcas"/>
       <xhtml:link rel="alternate" hreflang="fi-fi" href="https://www.nestlehealthscience.fi/tuotteet"/>
       <xhtml:link rel="alternate" hreflang="pt-pt" href="http://nestlehealthscience.pt/marcas"/>
       <xhtml:link rel="alternate" hreflang="th-th" href="https://www.nestlehealthscience-th.com"/>
       <xhtml:link rel="alternate" hreflang="tr-tr" href="https://www.nestlehealthscience.com.tr/brands"/>
       <xhtml:link rel="alternate" hreflang="en-ae" href="https://www.nestlehealthscience-me.com/en/brands"/>
       <xhtml:link rel="alternate" hreflang="es-mx" href="https://www.nestlehealthscience.com.mx/marcas"/>
       <xhtml:link rel="alternate" hreflang="fr-fr" href="https://www.nestlehealthscience.fr/nos-marques"/>
       <xhtml:link rel="alternate" hreflang="sv-se" href="https://www.nestlehealthscience.se/produkter"/>
       <xhtml:link rel="alternate" hreflang="en-lk" href="https://www.nestlehealthscience.lk/brands"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-hk" href="https://www.nestlehealthscience.com.hk/zh-hans/brands"/>
       <xhtml:link rel="alternate" hreflang="ja-jp" href="https://www.nestlehealthscience.jp/brands"/>
       <xhtml:link rel="alternate" hreflang="es-es" href="https://www.nestlehealthscience.es/marcas"/>
       <xhtml:link rel="alternate" hreflang="ro-ro" href="https://www.nestlehealthscience.ro/produse"/>
       <xhtml:link rel="alternate" hreflang="de-de" href="https://www.nestlehealthscience.de/marken"/>
       <xhtml:link rel="alternate" hreflang="da-dk" href="https://www.nestlehealthscience.dk/produkter"/>
       <xhtml:link rel="alternate" hreflang="en-in" href="https://www.nestlehealthscience.in/brands"/>
       <xhtml:link rel="alternate" hreflang="de-ch" href="https://www.nestlehealthscience.ch/de/marken"/>
       <xhtml:link rel="alternate" hreflang="fr-ch" href="https://www.nestlehealthscience.ch/fr/nos-marques"/>
       <xhtml:link rel="alternate" hreflang="id-id" href="https://www.nestlehealthscience.co.id/brands"/>
       <xhtml:link rel="alternate" hreflang="it-it" href="https://www.nestlehealthscience.it/prodotti"/>
       <xhtml:link rel="alternate" hreflang="pl-pl" href="https://www.nestlehealthscience.pl/produkty"/>
       <xhtml:link rel="alternate" hreflang="en-za" href="https://www.nestlehealthscience.co.za/brands"/>
       <xhtml:link rel="alternate" hreflang="en-my" href="https://www.nestlehealthscience.my/brands"/>
       <xhtml:link rel="alternate" hreflang="vi-vn" href="https://www.nestlehealthscience.vn/san-pham"/>
       <xhtml:link rel="alternate" hreflang="cs-cz" href="https://www.nestlehealthscience.cz/cz/produkty"/>
       <xhtml:link rel="alternate" hreflang="sk-cz" href="https://www.nestlehealthscience.cz/sk/produkty"/>
       <xhtml:link rel="alternate" hreflang="en-sg" href="https://www.nestlehealthscience.sg/brands"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-cn" href="https://www.nestlehealthscience.cn/brands"/>
       <xhtml:link rel="alternate" hreflang="en-ph" href="https://www.nestlehealthscience.ph/brands"/>
       <xhtml:link rel="alternate" hreflang="ru-ru" href="https://www.nestlehealthscience.ru/brands"/>
       <xhtml:link rel="alternate" hreflang="nl-nl" href="https://www.nestlehealthscience.nl/nl/producten"/>
       <xhtml:link rel="alternate" hreflang="fr-nl" href="https://www.nestlehealthscience.nl/fr/producten"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-tw" href="https://www.nestlehealthscience.com.tw/brands"/>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
       </url>
      <url>
       <loc>https://www.nestlehealthscience.ca/fr/marques/home</loc>
      <xhtml:link rel="alternate" hreflang="fr-ca" href="https://www.nestlehealthscience.ca/fr/marques/home"/>
      <xhtml:link rel="alternate" hreflang="en-ca" href="https://www.nestlehealthscience.ca/en/brands"/>
        <xhtml:link rel="alternate" hreflang="en" href="https://www.nestlehealthscience.com/brands"/>
       <xhtml:link rel="alternate" hreflang="en-gb" href="https://www.nestlehealthscience.co.uk/brands"/>
       <xhtml:link rel="alternate" hreflang="pt-br" href="https://www.nestlehealthscience.com.br/marcas"/>
       <xhtml:link rel="alternate" hreflang="fi-fi" href="https://www.nestlehealthscience.fi/tuotteet"/>
       <xhtml:link rel="alternate" hreflang="pt-pt" href="http://nestlehealthscience.pt/marcas"/>
       <xhtml:link rel="alternate" hreflang="th-th" href="https://www.nestlehealthscience-th.com"/>
       <xhtml:link rel="alternate" hreflang="tr-tr" href="https://www.nestlehealthscience.com.tr/brands"/>
       <xhtml:link rel="alternate" hreflang="en-ae" href="https://www.nestlehealthscience-me.com/en/brands"/>
       <xhtml:link rel="alternate" hreflang="es-mx" href="https://www.nestlehealthscience.com.mx/marcas"/>
       <xhtml:link rel="alternate" hreflang="fr-fr" href="https://www.nestlehealthscience.fr/nos-marques"/>
       <xhtml:link rel="alternate" hreflang="sv-se" href="https://www.nestlehealthscience.se/produkter"/>
       <xhtml:link rel="alternate" hreflang="en-lk" href="https://www.nestlehealthscience.lk/brands"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-hk" href="https://www.nestlehealthscience.com.hk/zh-hans/brands"/>
       <xhtml:link rel="alternate" hreflang="ja-jp" href="https://www.nestlehealthscience.jp/brands"/>
       <xhtml:link rel="alternate" hreflang="es-es" href="https://www.nestlehealthscience.es/marcas"/>
       <xhtml:link rel="alternate" hreflang="ro-ro" href="https://www.nestlehealthscience.ro/produse"/>
       <xhtml:link rel="alternate" hreflang="de-de" href="https://www.nestlehealthscience.de/marken"/>
       <xhtml:link rel="alternate" hreflang="da-dk" href="https://www.nestlehealthscience.dk/produkter"/>
       <xhtml:link rel="alternate" hreflang="en-in" href="https://www.nestlehealthscience.in/brands"/>
       <xhtml:link rel="alternate" hreflang="de-ch" href="https://www.nestlehealthscience.ch/de/marken"/>
       <xhtml:link rel="alternate" hreflang="fr-ch" href="https://www.nestlehealthscience.ch/fr/nos-marques"/>
       <xhtml:link rel="alternate" hreflang="id-id" href="https://www.nestlehealthscience.co.id/brands"/>
       <xhtml:link rel="alternate" hreflang="it-it" href="https://www.nestlehealthscience.it/prodotti"/>
       <xhtml:link rel="alternate" hreflang="pl-pl" href="https://www.nestlehealthscience.pl/produkty"/>
       <xhtml:link rel="alternate" hreflang="en-za" href="https://www.nestlehealthscience.co.za/brands"/>
       <xhtml:link rel="alternate" hreflang="en-my" href="https://www.nestlehealthscience.my/brands"/>
       <xhtml:link rel="alternate" hreflang="vi-vn" href="https://www.nestlehealthscience.vn/san-pham"/>
       <xhtml:link rel="alternate" hreflang="cs-cz" href="https://www.nestlehealthscience.cz/cz/produkty"/>
       <xhtml:link rel="alternate" hreflang="sk-cz" href="https://www.nestlehealthscience.cz/sk/produkty"/>
       <xhtml:link rel="alternate" hreflang="en-sg" href="https://www.nestlehealthscience.sg/brands"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-cn" href="https://www.nestlehealthscience.cn/brands"/>
       <xhtml:link rel="alternate" hreflang="en-ph" href="https://www.nestlehealthscience.ph/brands"/>
       <xhtml:link rel="alternate" hreflang="ru-ru" href="https://www.nestlehealthscience.ru/brands"/>
       <xhtml:link rel="alternate" hreflang="nl-nl" href="https://www.nestlehealthscience.nl/nl/producten"/>
       <xhtml:link rel="alternate" hreflang="fr-nl" href="https://www.nestlehealthscience.nl/fr/producten"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-tw" href="https://www.nestlehealthscience.com.tw/brands"/>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
       </url>
      </urlset>';
    }

    public function china()
    {
      return '<?xml version="1.0" encoding="UTF-8"?>
      <urlset
          xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
          xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd
          http://www.w3.org/1999/xhtml http://www.w3.org/2002/08/xhtml/xhtml1-strict.xsd"
          xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
          xmlns:xhtml="http://www.w3.org/1999/xhtml"   
      >
      <url>
        <loc>https://www.nestlehealthscience.cn</loc>
       <xhtml:link rel="alternate" hreflang="zh-hans-cn" href="https://www.nestlehealthscience.cn/"/>
       <xhtml:link rel="alternate" hreflang="en" href="https://www.nestlehealthscience.com"/>
      <xhtml:link rel="alternate" hreflang="en-us" href="https://www.nestlehealthscience.us"/>
      <xhtml:link rel="alternate" hreflang="en-ca" href="https://www.nestlehealthscience.ca/en"/>
      <xhtml:link rel="alternate" hreflang="fr-ca" href="https://www.nestlehealthscience.ca/fr"/>
       <xhtml:link rel="alternate" hreflang="en-gb" href="https://www.nestlehealthscience.co.uk"/>
       <xhtml:link rel="alternate" hreflang="pt-br" href="https://www.nestlehealthscience.com.br"/>
       <xhtml:link rel="alternate" hreflang="fi-fi" href="https://www.nestlehealthscience.fi"/>
       <xhtml:link rel="alternate" hreflang="pt-pt" href="https://www.nestlehealthscience.pt"/>
       <xhtml:link rel="alternate" hreflang="th-th" href="https://www.nestlehealthscience-th.com"/>
       <xhtml:link rel="alternate" hreflang="tr-tr" href="https://www.nestlehealthscience.com.tr"/>
       <xhtml:link rel="alternate" hreflang="en-ae" href="https://www.nestlehealthscience-me.com"/>
       <xhtml:link rel="alternate" hreflang="es-mx" href="https://www.nestlehealthscience.com.mx"/>
       <xhtml:link rel="alternate" hreflang="fr-fr" href="https://www.nestlehealthscience.fr"/>
       <xhtml:link rel="alternate" hreflang="sv-se" href="https://www.nestlehealthscience.se"/>
       <xhtml:link rel="alternate" hreflang="en-lk" href="https://www.nestlehealthscience.lk"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-hk" href="https://www.nestlehealthscience.com.hk"/>
       <xhtml:link rel="alternate" hreflang="ja-jp" href="https://www.nestlehealthscience.jp"/>
       <xhtml:link rel="alternate" hreflang="es-es" href="https://www.nestlehealthscience.es"/>
       <xhtml:link rel="alternate" hreflang="ro-ro" href="https://www.nestlehealthscience.ro"/>
       <xhtml:link rel="alternate" hreflang="de-de" href="https://www.nestlehealthscience.de"/>
       <xhtml:link rel="alternate" hreflang="da-dk" href="https://www.nestlehealthscience.dk"/>
       <xhtml:link rel="alternate" hreflang="en-in" href="https://www.nestlehealthscience.in"/>
       <xhtml:link rel="alternate" hreflang="de-ch" href="https://www.nestlehealthscience.ch/de"/>
       <xhtml:link rel="alternate" hreflang="fr-ch" href="https://www.nestlehealthscience.ch/fr"/>
       <xhtml:link rel="alternate" hreflang="id-id" href="https://www.nestlehealthscience.co.id"/>
       <xhtml:link rel="alternate" hreflang="it-it" href="https://www.nestlehealthscience.it"/>
       <xhtml:link rel="alternate" hreflang="pl-pl" href="https://www.nestlehealthscience.pl"/>
       <xhtml:link rel="alternate" hreflang="en-za" href="https://www.nestlehealthscience.co.za"/>
       <xhtml:link rel="alternate" hreflang="en-my" href="https://www.nestlehealthscience.my"/>
       <xhtml:link rel="alternate" hreflang="vi-vn" href="https://www.nestlehealthscience.vn"/>
       <xhtml:link rel="alternate" hreflang="cs-cz" href="https://www.nestlehealthscience.cz/cz"/>
       <xhtml:link rel="alternate" hreflang="sk-cz" href="https://www.nestlehealthscience.cz/sk"/>
       <xhtml:link rel="alternate" hreflang="en-sg" href="https://www.nestlehealthscience.sg"/>
       <xhtml:link rel="alternate" hreflang="en-ph" href="https://www.nestlehealthscience.ph/"/>
       <xhtml:link rel="alternate" hreflang="ru-ru" href="https://www.nestlehealthscience.ru/"/>
       <xhtml:link rel="alternate" hreflang="nl-nl" href="https://www.nestlehealthscience.nl/nl"/>
       <xhtml:link rel="alternate" hreflang="fr-nl" href="https://www.nestlehealthscience.nl/fr"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-tw" href="https://www.nestlehealthscience.com.tw"/>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
       </url>
       <url>
       <loc>https://www.nestlehealthscience.cn/brands</loc>
       <xhtml:link rel="alternate" hreflang="zh-hans-cn" href="https://www.nestlehealthscience.cn/brands"/>
        <xhtml:link rel="alternate" hreflang="en" href="https://www.nestlehealthscience.com/brands"/>
      <xhtml:link rel="alternate" hreflang="en-ca" href="https://www.nestlehealthscience.ca/en/brands"/>
      <xhtml:link rel="alternate" hreflang="fr-ca" href="https://www.nestlehealthscience.ca/fr/marques/home"/>
       <xhtml:link rel="alternate" hreflang="en-gb" href="https://www.nestlehealthscience.co.uk/brands"/>
       <xhtml:link rel="alternate" hreflang="pt-br" href="https://www.nestlehealthscience.com.br/marcas"/>
       <xhtml:link rel="alternate" hreflang="fi-fi" href="https://www.nestlehealthscience.fi/tuotteet"/>
       <xhtml:link rel="alternate" hreflang="pt-pt" href="http://nestlehealthscience.pt/marcas"/>
       <xhtml:link rel="alternate" hreflang="th-th" href="https://www.nestlehealthscience-th.com"/>
       <xhtml:link rel="alternate" hreflang="tr-tr" href="https://www.nestlehealthscience.com.tr/brands"/>
       <xhtml:link rel="alternate" hreflang="en-ae" href="https://www.nestlehealthscience-me.com/en/brands"/>
       <xhtml:link rel="alternate" hreflang="es-mx" href="https://www.nestlehealthscience.com.mx/marcas"/>
       <xhtml:link rel="alternate" hreflang="fr-fr" href="https://www.nestlehealthscience.fr/nos-marques"/>
       <xhtml:link rel="alternate" hreflang="sv-se" href="https://www.nestlehealthscience.se/produkter"/>
       <xhtml:link rel="alternate" hreflang="en-lk" href="https://www.nestlehealthscience.lk/brands"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-hk" href="https://www.nestlehealthscience.com.hk/zh-hans/brands"/>
       <xhtml:link rel="alternate" hreflang="ja-jp" href="https://www.nestlehealthscience.jp/brands"/>
       <xhtml:link rel="alternate" hreflang="es-es" href="https://www.nestlehealthscience.es/marcas"/>
       <xhtml:link rel="alternate" hreflang="ro-ro" href="https://www.nestlehealthscience.ro/produse"/>
       <xhtml:link rel="alternate" hreflang="de-de" href="https://www.nestlehealthscience.de/marken"/>
       <xhtml:link rel="alternate" hreflang="da-dk" href="https://www.nestlehealthscience.dk/produkter"/>
       <xhtml:link rel="alternate" hreflang="en-in" href="https://www.nestlehealthscience.in/brands"/>
       <xhtml:link rel="alternate" hreflang="de-ch" href="https://www.nestlehealthscience.ch/de/marken"/>
       <xhtml:link rel="alternate" hreflang="fr-ch" href="https://www.nestlehealthscience.ch/fr/nos-marques"/>
       <xhtml:link rel="alternate" hreflang="id-id" href="https://www.nestlehealthscience.co.id/brands"/>
       <xhtml:link rel="alternate" hreflang="it-it" href="https://www.nestlehealthscience.it/prodotti"/>
       <xhtml:link rel="alternate" hreflang="pl-pl" href="https://www.nestlehealthscience.pl/produkty"/>
       <xhtml:link rel="alternate" hreflang="en-za" href="https://www.nestlehealthscience.co.za/brands"/>
       <xhtml:link rel="alternate" hreflang="en-my" href="https://www.nestlehealthscience.my/brands"/>
       <xhtml:link rel="alternate" hreflang="vi-vn" href="https://www.nestlehealthscience.vn/san-pham"/>
       <xhtml:link rel="alternate" hreflang="cs-cz" href="https://www.nestlehealthscience.cz/cz/produkty"/>
       <xhtml:link rel="alternate" hreflang="sk-cz" href="https://www.nestlehealthscience.cz/sk/produkty"/>
       <xhtml:link rel="alternate" hreflang="en-sg" href="https://www.nestlehealthscience.sg/brands"/>
       <xhtml:link rel="alternate" hreflang="en-ph" href="https://www.nestlehealthscience.ph/brands"/>
       <xhtml:link rel="alternate" hreflang="ru-ru" href="https://www.nestlehealthscience.ru/brands"/>
       <xhtml:link rel="alternate" hreflang="nl-nl" href="https://www.nestlehealthscience.nl/nl/producten"/>
       <xhtml:link rel="alternate" hreflang="fr-nl" href="https://www.nestlehealthscience.nl/fr/producten"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-tw" href="https://www.nestlehealthscience.com.tw/brands"/>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
       </url>
      </urlset>';
    }


    public function czech()
    {
        return '<?xml version="1.0" encoding="UTF-8"?>
        <urlset
            xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
            xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd
            http://www.w3.org/1999/xhtml http://www.w3.org/2002/08/xhtml/xhtml1-strict.xsd"
            xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
            xmlns:xhtml="http://www.w3.org/1999/xhtml"   
        >
        <url>
          <loc>https://www.nestlehealthscience.cz/cz</loc>
         <xhtml:link rel="alternate" hreflang="cs-cz" href="https://www.nestlehealthscience.cz/cz"/>
         <xhtml:link rel="alternate" hreflang="sk-cz" href="https://www.nestlehealthscience.cz/sk"/>
         <xhtml:link rel="alternate" hreflang="en" href="https://www.nestlehealthscience.com"/>
        <xhtml:link rel="alternate" hreflang="en-us" href="https://www.nestlehealthscience.us"/>
        <xhtml:link rel="alternate" hreflang="en-ca" href="https://www.nestlehealthscience.ca/en"/>
        <xhtml:link rel="alternate" hreflang="fr-ca" href="https://www.nestlehealthscience.ca/fr"/>
         <xhtml:link rel="alternate" hreflang="en-gb" href="https://www.nestlehealthscience.co.uk"/>
         <xhtml:link rel="alternate" hreflang="pt-br" href="https://www.nestlehealthscience.com.br"/>
         <xhtml:link rel="alternate" hreflang="fi-fi" href="https://www.nestlehealthscience.fi"/>
         <xhtml:link rel="alternate" hreflang="pt-pt" href="https://www.nestlehealthscience.pt"/>
         <xhtml:link rel="alternate" hreflang="th-th" href="https://www.nestlehealthscience-th.com"/>
         <xhtml:link rel="alternate" hreflang="tr-tr" href="https://www.nestlehealthscience.com.tr"/>
         <xhtml:link rel="alternate" hreflang="en-ae" href="https://www.nestlehealthscience-me.com"/>
         <xhtml:link rel="alternate" hreflang="es-mx" href="https://www.nestlehealthscience.com.mx"/>
         <xhtml:link rel="alternate" hreflang="fr-fr" href="https://www.nestlehealthscience.fr"/>
         <xhtml:link rel="alternate" hreflang="sv-se" href="https://www.nestlehealthscience.se"/>
         <xhtml:link rel="alternate" hreflang="en-lk" href="https://www.nestlehealthscience.lk"/>
         <xhtml:link rel="alternate" hreflang="zh-hans-hk" href="https://www.nestlehealthscience.com.hk"/>
         <xhtml:link rel="alternate" hreflang="ja-jp" href="https://www.nestlehealthscience.jp"/>
         <xhtml:link rel="alternate" hreflang="es-es" href="https://www.nestlehealthscience.es"/>
         <xhtml:link rel="alternate" hreflang="ro-ro" href="https://www.nestlehealthscience.ro"/>
         <xhtml:link rel="alternate" hreflang="de-de" href="https://www.nestlehealthscience.de"/>
         <xhtml:link rel="alternate" hreflang="da-dk" href="https://www.nestlehealthscience.dk"/>
         <xhtml:link rel="alternate" hreflang="en-in" href="https://www.nestlehealthscience.in"/>
         <xhtml:link rel="alternate" hreflang="de-ch" href="https://www.nestlehealthscience.ch/de"/>
         <xhtml:link rel="alternate" hreflang="fr-ch" href="https://www.nestlehealthscience.ch/fr"/>
         <xhtml:link rel="alternate" hreflang="id-id" href="https://www.nestlehealthscience.co.id"/>
         <xhtml:link rel="alternate" hreflang="it-it" href="https://www.nestlehealthscience.it"/>
         <xhtml:link rel="alternate" hreflang="pl-pl" href="https://www.nestlehealthscience.pl"/>
         <xhtml:link rel="alternate" hreflang="en-za" href="https://www.nestlehealthscience.co.za"/>
         <xhtml:link rel="alternate" hreflang="en-my" href="https://www.nestlehealthscience.my"/>
         <xhtml:link rel="alternate" hreflang="vi-vn" href="https://www.nestlehealthscience.vn"/>
         <xhtml:link rel="alternate" hreflang="en-sg" href="https://www.nestlehealthscience.sg"/>
         <xhtml:link rel="alternate" hreflang="zh-hans-cn" href="https://www.nestlehealthscience.cn/"/>
         <xhtml:link rel="alternate" hreflang="en-ph" href="https://www.nestlehealthscience.ph/"/>
         <xhtml:link rel="alternate" hreflang="ru-ru" href="https://www.nestlehealthscience.ru/"/>
         <xhtml:link rel="alternate" hreflang="nl-nl" href="https://www.nestlehealthscience.nl/nl"/>
         <xhtml:link rel="alternate" hreflang="fr-nl" href="https://www.nestlehealthscience.nl/fr"/>
         <xhtml:link rel="alternate" hreflang="zh-hans-tw" href="https://www.nestlehealthscience.com.tw"/>
          <changefreq>daily</changefreq>
          <priority>1.0</priority>
         </url>
        <url>
          <loc>https://www.nestlehealthscience.cz/sk</loc>
         <xhtml:link rel="alternate" hreflang="sk-cz" href="https://www.nestlehealthscience.cz/sk"/>
         <xhtml:link rel="alternate" hreflang="cs-cz" href="https://www.nestlehealthscience.cz/cz"/>
         <xhtml:link rel="alternate" hreflang="en" href="https://www.nestlehealthscience.com"/>
        <xhtml:link rel="alternate" hreflang="en-us" href="https://www.nestlehealthscience.us"/>
        <xhtml:link rel="alternate" hreflang="en-ca" href="https://www.nestlehealthscience.ca/en"/>
        <xhtml:link rel="alternate" hreflang="fr-ca" href="https://www.nestlehealthscience.ca/fr"/>
         <xhtml:link rel="alternate" hreflang="en-gb" href="https://www.nestlehealthscience.co.uk"/>
         <xhtml:link rel="alternate" hreflang="pt-br" href="https://www.nestlehealthscience.com.br"/>
         <xhtml:link rel="alternate" hreflang="fi-fi" href="https://www.nestlehealthscience.fi"/>
         <xhtml:link rel="alternate" hreflang="pt-pt" href="https://www.nestlehealthscience.pt"/>
         <xhtml:link rel="alternate" hreflang="th-th" href="https://www.nestlehealthscience-th.com"/>
         <xhtml:link rel="alternate" hreflang="tr-tr" href="https://www.nestlehealthscience.com.tr"/>
         <xhtml:link rel="alternate" hreflang="en-ae" href="https://www.nestlehealthscience-me.com"/>
         <xhtml:link rel="alternate" hreflang="es-mx" href="https://www.nestlehealthscience.com.mx"/>
         <xhtml:link rel="alternate" hreflang="fr-fr" href="https://www.nestlehealthscience.fr"/>
         <xhtml:link rel="alternate" hreflang="sv-se" href="https://www.nestlehealthscience.se"/>
         <xhtml:link rel="alternate" hreflang="en-lk" href="https://www.nestlehealthscience.lk"/>
         <xhtml:link rel="alternate" hreflang="zh-hans-hk" href="https://www.nestlehealthscience.com.hk"/>
         <xhtml:link rel="alternate" hreflang="ja-jp" href="https://www.nestlehealthscience.jp"/>
         <xhtml:link rel="alternate" hreflang="es-es" href="https://www.nestlehealthscience.es"/>
         <xhtml:link rel="alternate" hreflang="ro-ro" href="https://www.nestlehealthscience.ro"/>
         <xhtml:link rel="alternate" hreflang="de-de" href="https://www.nestlehealthscience.de"/>
         <xhtml:link rel="alternate" hreflang="da-dk" href="https://www.nestlehealthscience.dk"/>
         <xhtml:link rel="alternate" hreflang="en-in" href="https://www.nestlehealthscience.in"/>
         <xhtml:link rel="alternate" hreflang="de-ch" href="https://www.nestlehealthscience.ch/de"/>
         <xhtml:link rel="alternate" hreflang="fr-ch" href="https://www.nestlehealthscience.ch/fr"/>
         <xhtml:link rel="alternate" hreflang="id-id" href="https://www.nestlehealthscience.co.id"/>
         <xhtml:link rel="alternate" hreflang="it-it" href="https://www.nestlehealthscience.it"/>
         <xhtml:link rel="alternate" hreflang="pl-pl" href="https://www.nestlehealthscience.pl"/>
         <xhtml:link rel="alternate" hreflang="en-za" href="https://www.nestlehealthscience.co.za"/>
         <xhtml:link rel="alternate" hreflang="en-my" href="https://www.nestlehealthscience.my"/>
         <xhtml:link rel="alternate" hreflang="vi-vn" href="https://www.nestlehealthscience.vn"/>
         <xhtml:link rel="alternate" hreflang="en-sg" href="https://www.nestlehealthscience.sg"/>
         <xhtml:link rel="alternate" hreflang="zh-hans-cn" href="https://www.nestlehealthscience.cn/"/>
         <xhtml:link rel="alternate" hreflang="en-ph" href="https://www.nestlehealthscience.ph/"/>
         <xhtml:link rel="alternate" hreflang="ru-ru" href="https://www.nestlehealthscience.ru/"/>
         <xhtml:link rel="alternate" hreflang="nl-nl" href="https://www.nestlehealthscience.nl/nl"/>
         <xhtml:link rel="alternate" hreflang="fr-nl" href="https://www.nestlehealthscience.nl/fr"/>
         <xhtml:link rel="alternate" hreflang="zh-hans-tw" href="https://www.nestlehealthscience.com.tw"/>
          <changefreq>daily</changefreq>
          <priority>1.0</priority>
         </url>
         <url>
         <loc>https://www.nestlehealthscience.cz/cz/produkty</loc>
         <xhtml:link rel="alternate" hreflang="cs-cz" href="https://www.nestlehealthscience.cz/cz/produkty"/>
         <xhtml:link rel="alternate" hreflang="sk-cz" href="https://www.nestlehealthscience.cz/sk/produkty"/>
          <xhtml:link rel="alternate" hreflang="en" href="https://www.nestlehealthscience.com/brands"/>
        <xhtml:link rel="alternate" hreflang="en-ca" href="https://www.nestlehealthscience.ca/en/brands"/>
        <xhtml:link rel="alternate" hreflang="fr-ca" href="https://www.nestlehealthscience.ca/fr/marques/home"/>
         <xhtml:link rel="alternate" hreflang="en-gb" href="https://www.nestlehealthscience.co.uk/brands"/>
         <xhtml:link rel="alternate" hreflang="pt-br" href="https://www.nestlehealthscience.com.br/marcas"/>
         <xhtml:link rel="alternate" hreflang="fi-fi" href="https://www.nestlehealthscience.fi/tuotteet"/>
         <xhtml:link rel="alternate" hreflang="pt-pt" href="http://nestlehealthscience.pt/marcas"/>
         <xhtml:link rel="alternate" hreflang="th-th" href="https://www.nestlehealthscience-th.com"/>
         <xhtml:link rel="alternate" hreflang="tr-tr" href="https://www.nestlehealthscience.com.tr/brands"/>
         <xhtml:link rel="alternate" hreflang="en-ae" href="https://www.nestlehealthscience-me.com/en/brands"/>
         <xhtml:link rel="alternate" hreflang="es-mx" href="https://www.nestlehealthscience.com.mx/marcas"/>
         <xhtml:link rel="alternate" hreflang="fr-fr" href="https://www.nestlehealthscience.fr/nos-marques"/>
         <xhtml:link rel="alternate" hreflang="sv-se" href="https://www.nestlehealthscience.se/produkter"/>
         <xhtml:link rel="alternate" hreflang="en-lk" href="https://www.nestlehealthscience.lk/brands"/>
         <xhtml:link rel="alternate" hreflang="zh-hans-hk" href="https://www.nestlehealthscience.com.hk/zh-hans/brands"/>
         <xhtml:link rel="alternate" hreflang="ja-jp" href="https://www.nestlehealthscience.jp/brands"/>
         <xhtml:link rel="alternate" hreflang="es-es" href="https://www.nestlehealthscience.es/marcas"/>
         <xhtml:link rel="alternate" hreflang="ro-ro" href="https://www.nestlehealthscience.ro/produse"/>
         <xhtml:link rel="alternate" hreflang="de-de" href="https://www.nestlehealthscience.de/marken"/>
         <xhtml:link rel="alternate" hreflang="da-dk" href="https://www.nestlehealthscience.dk/produkter"/>
         <xhtml:link rel="alternate" hreflang="en-in" href="https://www.nestlehealthscience.in/brands"/>
         <xhtml:link rel="alternate" hreflang="de-ch" href="https://www.nestlehealthscience.ch/de/marken"/>
         <xhtml:link rel="alternate" hreflang="fr-ch" href="https://www.nestlehealthscience.ch/fr/nos-marques"/>
         <xhtml:link rel="alternate" hreflang="id-id" href="https://www.nestlehealthscience.co.id/brands"/>
         <xhtml:link rel="alternate" hreflang="it-it" href="https://www.nestlehealthscience.it/prodotti"/>
         <xhtml:link rel="alternate" hreflang="pl-pl" href="https://www.nestlehealthscience.pl/produkty"/>
         <xhtml:link rel="alternate" hreflang="en-za" href="https://www.nestlehealthscience.co.za/brands"/>
         <xhtml:link rel="alternate" hreflang="en-my" href="https://www.nestlehealthscience.my/brands"/>
         <xhtml:link rel="alternate" hreflang="vi-vn" href="https://www.nestlehealthscience.vn/san-pham"/>
         <xhtml:link rel="alternate" hreflang="en-sg" href="https://www.nestlehealthscience.sg/brands"/>
         <xhtml:link rel="alternate" hreflang="zh-hans-cn" href="https://www.nestlehealthscience.cn/brands"/>
         <xhtml:link rel="alternate" hreflang="en-ph" href="https://www.nestlehealthscience.ph/brands"/>
         <xhtml:link rel="alternate" hreflang="ru-ru" href="https://www.nestlehealthscience.ru/brands"/>
         <xhtml:link rel="alternate" hreflang="nl-nl" href="https://www.nestlehealthscience.nl/nl/producten"/>
         <xhtml:link rel="alternate" hreflang="fr-nl" href="https://www.nestlehealthscience.nl/fr/producten"/>
         <xhtml:link rel="alternate" hreflang="zh-hans-tw" href="https://www.nestlehealthscience.com.tw/brands"/>
          <changefreq>daily</changefreq>
          <priority>1.0</priority>
         </url>
         <url>
         <loc>https://www.nestlehealthscience.cz/sk/produkty</loc>
         <xhtml:link rel="alternate" hreflang="sk-cz" href="https://www.nestlehealthscience.cz/sk/produkty"/>
         <xhtml:link rel="alternate" hreflang="cs-cz" href="https://www.nestlehealthscience.cz/cz/produkty"/>
          <xhtml:link rel="alternate" hreflang="en" href="https://www.nestlehealthscience.com/brands"/>
        <xhtml:link rel="alternate" hreflang="en-ca" href="https://www.nestlehealthscience.ca/en/brands"/>
        <xhtml:link rel="alternate" hreflang="fr-ca" href="https://www.nestlehealthscience.ca/fr/marques/home"/>
         <xhtml:link rel="alternate" hreflang="en-gb" href="https://www.nestlehealthscience.co.uk/brands"/>
         <xhtml:link rel="alternate" hreflang="pt-br" href="https://www.nestlehealthscience.com.br/marcas"/>
         <xhtml:link rel="alternate" hreflang="fi-fi" href="https://www.nestlehealthscience.fi/tuotteet"/>
         <xhtml:link rel="alternate" hreflang="pt-pt" href="http://nestlehealthscience.pt/marcas"/>
         <xhtml:link rel="alternate" hreflang="th-th" href="https://www.nestlehealthscience-th.com"/>
         <xhtml:link rel="alternate" hreflang="tr-tr" href="https://www.nestlehealthscience.com.tr/brands"/>
         <xhtml:link rel="alternate" hreflang="en-ae" href="https://www.nestlehealthscience-me.com/en/brands"/>
         <xhtml:link rel="alternate" hreflang="es-mx" href="https://www.nestlehealthscience.com.mx/marcas"/>
         <xhtml:link rel="alternate" hreflang="fr-fr" href="https://www.nestlehealthscience.fr/nos-marques"/>
         <xhtml:link rel="alternate" hreflang="sv-se" href="https://www.nestlehealthscience.se/produkter"/>
         <xhtml:link rel="alternate" hreflang="en-lk" href="https://www.nestlehealthscience.lk/brands"/>
         <xhtml:link rel="alternate" hreflang="zh-hans-hk" href="https://www.nestlehealthscience.com.hk/zh-hans/brands"/>
         <xhtml:link rel="alternate" hreflang="ja-jp" href="https://www.nestlehealthscience.jp/brands"/>
         <xhtml:link rel="alternate" hreflang="es-es" href="https://www.nestlehealthscience.es/marcas"/>
         <xhtml:link rel="alternate" hreflang="ro-ro" href="https://www.nestlehealthscience.ro/produse"/>
         <xhtml:link rel="alternate" hreflang="de-de" href="https://www.nestlehealthscience.de/marken"/>
         <xhtml:link rel="alternate" hreflang="da-dk" href="https://www.nestlehealthscience.dk/produkter"/>
         <xhtml:link rel="alternate" hreflang="en-in" href="https://www.nestlehealthscience.in/brands"/>
         <xhtml:link rel="alternate" hreflang="de-ch" href="https://www.nestlehealthscience.ch/de/marken"/>
         <xhtml:link rel="alternate" hreflang="fr-ch" href="https://www.nestlehealthscience.ch/fr/nos-marques"/>
         <xhtml:link rel="alternate" hreflang="id-id" href="https://www.nestlehealthscience.co.id/brands"/>
         <xhtml:link rel="alternate" hreflang="it-it" href="https://www.nestlehealthscience.it/prodotti"/>
         <xhtml:link rel="alternate" hreflang="pl-pl" href="https://www.nestlehealthscience.pl/produkty"/>
         <xhtml:link rel="alternate" hreflang="en-za" href="https://www.nestlehealthscience.co.za/brands"/>
         <xhtml:link rel="alternate" hreflang="en-my" href="https://www.nestlehealthscience.my/brands"/>
         <xhtml:link rel="alternate" hreflang="vi-vn" href="https://www.nestlehealthscience.vn/san-pham"/>
         <xhtml:link rel="alternate" hreflang="en-sg" href="https://www.nestlehealthscience.sg/brands"/>
         <xhtml:link rel="alternate" hreflang="zh-hans-cn" href="https://www.nestlehealthscience.cn/brands"/>
         <xhtml:link rel="alternate" hreflang="en-ph" href="https://www.nestlehealthscience.ph/brands"/>
         <xhtml:link rel="alternate" hreflang="ru-ru" href="https://www.nestlehealthscience.ru/brands"/>
         <xhtml:link rel="alternate" hreflang="nl-nl" href="https://www.nestlehealthscience.nl/nl/producten"/>
         <xhtml:link rel="alternate" hreflang="fr-nl" href="https://www.nestlehealthscience.nl/fr/producten"/>
         <xhtml:link rel="alternate" hreflang="zh-hans-tw" href="https://www.nestlehealthscience.com.tw/brands"/>
          <changefreq>daily</changefreq>
          <priority>1.0</priority>
         </url>
        </urlset>';
    }

    public function denmark()
    {
       return '<?xml version="1.0" encoding="UTF-8"?>
       <urlset
           xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
           xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd
           http://www.w3.org/1999/xhtml http://www.w3.org/2002/08/xhtml/xhtml1-strict.xsd"
           xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
           xmlns:xhtml="http://www.w3.org/1999/xhtml"   
       >
       <url>
         <loc>https://www.nestlehealthscience.dk</loc>
        <xhtml:link rel="alternate" hreflang="da-dk" href="https://www.nestlehealthscience.dk"/>
        <xhtml:link rel="alternate" hreflang="en" href="https://www.nestlehealthscience.com"/>
       <xhtml:link rel="alternate" hreflang="en-us" href="https://www.nestlehealthscience.us"/>
       <xhtml:link rel="alternate" hreflang="en-ca" href="https://www.nestlehealthscience.ca/en"/>
       <xhtml:link rel="alternate" hreflang="fr-ca" href="https://www.nestlehealthscience.ca/fr"/>
        <xhtml:link rel="alternate" hreflang="en-gb" href="https://www.nestlehealthscience.co.uk"/>
        <xhtml:link rel="alternate" hreflang="pt-br" href="https://www.nestlehealthscience.com.br"/>
        <xhtml:link rel="alternate" hreflang="fi-fi" href="https://www.nestlehealthscience.fi"/>
        <xhtml:link rel="alternate" hreflang="pt-pt" href="https://www.nestlehealthscience.pt"/>
        <xhtml:link rel="alternate" hreflang="th-th" href="https://www.nestlehealthscience-th.com"/>
        <xhtml:link rel="alternate" hreflang="tr-tr" href="https://www.nestlehealthscience.com.tr"/>
        <xhtml:link rel="alternate" hreflang="en-ae" href="https://www.nestlehealthscience-me.com"/>
        <xhtml:link rel="alternate" hreflang="es-mx" href="https://www.nestlehealthscience.com.mx"/>
        <xhtml:link rel="alternate" hreflang="fr-fr" href="https://www.nestlehealthscience.fr"/>
        <xhtml:link rel="alternate" hreflang="sv-se" href="https://www.nestlehealthscience.se"/>
        <xhtml:link rel="alternate" hreflang="de-at" href="https://www.nestlehealthscience.at"/>
        <xhtml:link rel="alternate" hreflang="en-lk" href="https://www.nestlehealthscience.lk"/>
        <xhtml:link rel="alternate" hreflang="en-au" href="https://www.nestlehealthscience.com.au"/>
        <xhtml:link rel="alternate" hreflang="zh-hans-hk" href="https://www.nestlehealthscience.com.hk"/>
        <xhtml:link rel="alternate" hreflang="ja-jp" href="https://www.nestlehealthscience.jp"/>
        <xhtml:link rel="alternate" hreflang="es-es" href="https://www.nestlehealthscience.es"/>
        <xhtml:link rel="alternate" hreflang="ro-ro" href="https://www.nestlehealthscience.ro"/>
        <xhtml:link rel="alternate" hreflang="de-de" href="https://www.nestlehealthscience.de"/>
        <xhtml:link rel="alternate" hreflang="en-in" href="https://www.nestlehealthscience.in"/>
        <xhtml:link rel="alternate" hreflang="de-ch" href="https://www.nestlehealthscience.ch/de"/>
        <xhtml:link rel="alternate" hreflang="fr-ch" href="https://www.nestlehealthscience.ch/fr"/>
        <xhtml:link rel="alternate" hreflang="id-id" href="https://www.nestlehealthscience.co.id"/>
        <xhtml:link rel="alternate" hreflang="it-it" href="https://www.nestlehealthscience.it"/>
        <xhtml:link rel="alternate" hreflang="pl-pl" href="https://www.nestlehealthscience.pl"/>
        <xhtml:link rel="alternate" hreflang="en-za" href="https://www.nestlehealthscience.co.za"/>
        <xhtml:link rel="alternate" hreflang="en-my" href="https://www.nestlehealthscience.my"/>
        <xhtml:link rel="alternate" hreflang="vi-vn" href="https://www.nestlehealthscience.vn"/>
        <xhtml:link rel="alternate" hreflang="cs-cz" href="https://www.nestlehealthscience.cz/cz"/>
        <xhtml:link rel="alternate" hreflang="sk-cz" href="https://www.nestlehealthscience.cz/sk"/>
        <xhtml:link rel="alternate" hreflang="en-sg" href="https://www.nestlehealthscience.sg"/>
        <xhtml:link rel="alternate" hreflang="zh-hans-cn" href="https://www.nestlehealthscience.cn/"/>
        <xhtml:link rel="alternate" hreflang="en-ph" href="https://www.nestlehealthscience.ph/"/>
        <xhtml:link rel="alternate" hreflang="ru-ru" href="https://www.nestlehealthscience.ru/"/>
        <xhtml:link rel="alternate" hreflang="nl-nl" href="https://www.nestlehealthscience.nl/nl"/>
        <xhtml:link rel="alternate" hreflang="fr-nl" href="https://www.nestlehealthscience.nl/fr"/>
        <xhtml:link rel="alternate" hreflang="zh-hans-tw" href="https://www.nestlehealthscience.com.tw"/>
         <changefreq>daily</changefreq>
         <priority>1.0</priority>
        </url>
        <url>
        <loc>https://www.nestlehealthscience.dk/produkter</loc>
        <xhtml:link rel="alternate" hreflang="da-dk" href="https://www.nestlehealthscience.dk/produkter"/>
        <xhtml:link rel="alternate" hreflang="en" href="https://www.nestlehealthscience.com/brands"/>
       <xhtml:link rel="alternate" hreflang="en-ca" href="https://www.nestlehealthscience.ca/en/brands"/>
       <xhtml:link rel="alternate" hreflang="fr-ca" href="https://www.nestlehealthscience.ca/fr/marques/home"/>
        <xhtml:link rel="alternate" hreflang="en-gb" href="https://www.nestlehealthscience.co.uk/brands"/>
        <xhtml:link rel="alternate" hreflang="pt-br" href="https://www.nestlehealthscience.com.br/marcas"/>
        <xhtml:link rel="alternate" hreflang="fi-fi" href="https://www.nestlehealthscience.fi/tuotteet"/>
        <xhtml:link rel="alternate" hreflang="pt-pt" href="http://nestlehealthscience.pt/marcas"/>
        <xhtml:link rel="alternate" hreflang="th-th" href="https://www.nestlehealthscience-th.com"/>
        <xhtml:link rel="alternate" hreflang="tr-tr" href="https://www.nestlehealthscience.com.tr/brands"/>
        <xhtml:link rel="alternate" hreflang="en-ae" href="https://www.nestlehealthscience-me.com/en/brands"/>
        <xhtml:link rel="alternate" hreflang="es-mx" href="https://www.nestlehealthscience.com.mx/marcas"/>
        <xhtml:link rel="alternate" hreflang="fr-fr" href="https://www.nestlehealthscience.fr/nos-marques"/>
        <xhtml:link rel="alternate" hreflang="sv-se" href="https://www.nestlehealthscience.se/produkter"/>
        <xhtml:link rel="alternate" hreflang="de-at" href="https://www.nestlehealthscience.at/unsereprodukte"/>
        <xhtml:link rel="alternate" hreflang="en-lk" href="https://www.nestlehealthscience.lk/brands"/>
        <xhtml:link rel="alternate" hreflang="en-au" href="https://www.nestlehealthscience.com.au/brands"/>
        <xhtml:link rel="alternate" hreflang="zh-hans-hk" href="https://www.nestlehealthscience.com.hk/zh-hans/brands"/>
        <xhtml:link rel="alternate" hreflang="ja-jp" href="https://www.nestlehealthscience.jp/brands"/>
        <xhtml:link rel="alternate" hreflang="es-es" href="https://www.nestlehealthscience.es/marcas"/>
        <xhtml:link rel="alternate" hreflang="ro-ro" href="https://www.nestlehealthscience.ro/produse"/>
        <xhtml:link rel="alternate" hreflang="de-de" href="https://www.nestlehealthscience.de/marken"/>
        <xhtml:link rel="alternate" hreflang="en-in" href="https://www.nestlehealthscience.in/brands"/>
        <xhtml:link rel="alternate" hreflang="de-ch" href="https://www.nestlehealthscience.ch/de/marken"/>
        <xhtml:link rel="alternate" hreflang="fr-ch" href="https://www.nestlehealthscience.ch/fr/nos-marques"/>
        <xhtml:link rel="alternate" hreflang="id-id" href="https://www.nestlehealthscience.co.id/brands"/>
        <xhtml:link rel="alternate" hreflang="it-it" href="https://www.nestlehealthscience.it/prodotti"/>
        <xhtml:link rel="alternate" hreflang="pl-pl" href="https://www.nestlehealthscience.pl/produkty"/>
        <xhtml:link rel="alternate" hreflang="en-za" href="https://www.nestlehealthscience.co.za/brands"/>
        <xhtml:link rel="alternate" hreflang="en-my" href="https://www.nestlehealthscience.my/brands"/>
        <xhtml:link rel="alternate" hreflang="vi-vn" href="https://www.nestlehealthscience.vn/san-pham"/>
        <xhtml:link rel="alternate" hreflang="cs-cz" href="https://www.nestlehealthscience.cz/cz/produkty"/>
        <xhtml:link rel="alternate" hreflang="sk-cz" href="https://www.nestlehealthscience.cz/sk/produkty"/>
        <xhtml:link rel="alternate" hreflang="en-sg" href="https://www.nestlehealthscience.sg/brands"/>
        <xhtml:link rel="alternate" hreflang="zh-hans-cn" href="https://www.nestlehealthscience.cn/brands"/>
        <xhtml:link rel="alternate" hreflang="en-ph" href="https://www.nestlehealthscience.ph/brands"/>
        <xhtml:link rel="alternate" hreflang="ru-ru" href="https://www.nestlehealthscience.ru/brands"/>
        <xhtml:link rel="alternate" hreflang="nl-nl" href="https://www.nestlehealthscience.nl/nl/producten"/>
        <xhtml:link rel="alternate" hreflang="fr-nl" href="https://www.nestlehealthscience.nl/fr/producten"/>
        <xhtml:link rel="alternate" hreflang="zh-hans-tw" href="https://www.nestlehealthscience.com.tw/brands"/>
         <changefreq>daily</changefreq>
         <priority>1.0</priority>
        </url>
       </urlset>';
    }

    public function finland()
    {
      return '<?xml version="1.0" encoding="UTF-8"?>
      <urlset
          xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
          xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd
          http://www.w3.org/1999/xhtml http://www.w3.org/2002/08/xhtml/xhtml1-strict.xsd"
          xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
          xmlns:xhtml="http://www.w3.org/1999/xhtml"   
      >
      <url>
        <loc>https://www.nestlehealthscience.fi/</loc>
       <xhtml:link rel="alternate" hreflang="fi-fi" href="https://www.nestlehealthscience.fi"/>
       <xhtml:link rel="alternate" hreflang="en" href="https://www.nestlehealthscience.com"/>
      <xhtml:link rel="alternate" hreflang="en-us" href="https://www.nestlehealthscience.us"/>
      <xhtml:link rel="alternate" hreflang="en-ca" href="https://www.nestlehealthscience.ca/en"/>
      <xhtml:link rel="alternate" hreflang="fr-ca" href="https://www.nestlehealthscience.ca/fr"/>
       <xhtml:link rel="alternate" hreflang="en-gb" href="https://www.nestlehealthscience.co.uk"/>
       <xhtml:link rel="alternate" hreflang="pt-br" href="https://www.nestlehealthscience.com.br"/>
       <xhtml:link rel="alternate" hreflang="pt-pt" href="https://www.nestlehealthscience.pt"/>
       <xhtml:link rel="alternate" hreflang="th-th" href="https://www.nestlehealthscience-th.com"/>
       <xhtml:link rel="alternate" hreflang="tr-tr" href="https://www.nestlehealthscience.com.tr"/>
       <xhtml:link rel="alternate" hreflang="en-ae" href="https://www.nestlehealthscience-me.com"/>
       <xhtml:link rel="alternate" hreflang="es-mx" href="https://www.nestlehealthscience.com.mx"/>
       <xhtml:link rel="alternate" hreflang="fr-fr" href="https://www.nestlehealthscience.fr"/>
       <xhtml:link rel="alternate" hreflang="sv-se" href="https://www.nestlehealthscience.se"/>
       <xhtml:link rel="alternate" hreflang="en-lk" href="https://www.nestlehealthscience.lk"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-hk" href="https://www.nestlehealthscience.com.hk"/>
       <xhtml:link rel="alternate" hreflang="ja-jp" href="https://www.nestlehealthscience.jp"/>
       <xhtml:link rel="alternate" hreflang="es-es" href="https://www.nestlehealthscience.es"/>
       <xhtml:link rel="alternate" hreflang="ro-ro" href="https://www.nestlehealthscience.ro"/>
       <xhtml:link rel="alternate" hreflang="de-de" href="https://www.nestlehealthscience.de"/>
       <xhtml:link rel="alternate" hreflang="da-dk" href="https://www.nestlehealthscience.dk"/>
       <xhtml:link rel="alternate" hreflang="en-in" href="https://www.nestlehealthscience.in"/>
       <xhtml:link rel="alternate" hreflang="de-ch" href="https://www.nestlehealthscience.ch/de"/>
       <xhtml:link rel="alternate" hreflang="fr-ch" href="https://www.nestlehealthscience.ch/fr"/>
       <xhtml:link rel="alternate" hreflang="id-id" href="https://www.nestlehealthscience.co.id"/>
       <xhtml:link rel="alternate" hreflang="it-it" href="https://www.nestlehealthscience.it"/>
       <xhtml:link rel="alternate" hreflang="pl-pl" href="https://www.nestlehealthscience.pl"/>
       <xhtml:link rel="alternate" hreflang="en-za" href="https://www.nestlehealthscience.co.za"/>
       <xhtml:link rel="alternate" hreflang="en-my" href="https://www.nestlehealthscience.my"/>
       <xhtml:link rel="alternate" hreflang="vi-vn" href="https://www.nestlehealthscience.vn"/>
       <xhtml:link rel="alternate" hreflang="cs-cz" href="https://www.nestlehealthscience.cz/cz"/>
       <xhtml:link rel="alternate" hreflang="sk-cz" href="https://www.nestlehealthscience.cz/sk"/>
       <xhtml:link rel="alternate" hreflang="en-sg" href="https://www.nestlehealthscience.sg"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-cn" href="https://www.nestlehealthscience.cn/"/>
       <xhtml:link rel="alternate" hreflang="en-ph" href="https://www.nestlehealthscience.ph/"/>
       <xhtml:link rel="alternate" hreflang="ru-ru" href="https://www.nestlehealthscience.ru/"/>
       <xhtml:link rel="alternate" hreflang="nl-nl" href="https://www.nestlehealthscience.nl/nl"/>
       <xhtml:link rel="alternate" hreflang="fr-nl" href="https://www.nestlehealthscience.nl/fr"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-tw" href="https://www.nestlehealthscience.com.tw"/>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
       </url>
       <url>
       <loc>https://www.nestlehealthscience.fi/tuotteet</loc>
       <xhtml:link rel="alternate" hreflang="fi-fi" href="https://www.nestlehealthscience.fi/tuotteet"/>
        <xhtml:link rel="alternate" hreflang="en" href="https://www.nestlehealthscience.com/brands"/>
      <xhtml:link rel="alternate" hreflang="en-ca" href="https://www.nestlehealthscience.ca/en/brands"/>
      <xhtml:link rel="alternate" hreflang="fr-ca" href="https://www.nestlehealthscience.ca/fr/marques/home"/>
       <xhtml:link rel="alternate" hreflang="en-gb" href="https://www.nestlehealthscience.co.uk/brands"/>
       <xhtml:link rel="alternate" hreflang="pt-br" href="https://www.nestlehealthscience.com.br/marcas"/>
       <xhtml:link rel="alternate" hreflang="pt-pt" href="http://nestlehealthscience.pt/marcas"/>
       <xhtml:link rel="alternate" hreflang="th-th" href="https://www.nestlehealthscience-th.com"/>
       <xhtml:link rel="alternate" hreflang="tr-tr" href="https://www.nestlehealthscience.com.tr/brands"/>
       <xhtml:link rel="alternate" hreflang="en-ae" href="https://www.nestlehealthscience-me.com/en/brands"/>
       <xhtml:link rel="alternate" hreflang="es-mx" href="https://www.nestlehealthscience.com.mx/marcas"/>
       <xhtml:link rel="alternate" hreflang="fr-fr" href="https://www.nestlehealthscience.fr/nos-marques"/>
       <xhtml:link rel="alternate" hreflang="sv-se" href="https://www.nestlehealthscience.se/produkter"/>
       <xhtml:link rel="alternate" hreflang="en-lk" href="https://www.nestlehealthscience.lk/brands"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-hk" href="https://www.nestlehealthscience.com.hk/zh-hans/brands"/>
       <xhtml:link rel="alternate" hreflang="ja-jp" href="https://www.nestlehealthscience.jp/brands"/>
       <xhtml:link rel="alternate" hreflang="es-es" href="https://www.nestlehealthscience.es/marcas"/>
       <xhtml:link rel="alternate" hreflang="ro-ro" href="https://www.nestlehealthscience.ro/produse"/>
       <xhtml:link rel="alternate" hreflang="de-de" href="https://www.nestlehealthscience.de/marken"/>
       <xhtml:link rel="alternate" hreflang="da-dk" href="https://www.nestlehealthscience.dk/produkter"/>
       <xhtml:link rel="alternate" hreflang="en-in" href="https://www.nestlehealthscience.in/brands"/>
       <xhtml:link rel="alternate" hreflang="de-ch" href="https://www.nestlehealthscience.ch/de/marken"/>
       <xhtml:link rel="alternate" hreflang="fr-ch" href="https://www.nestlehealthscience.ch/fr/nos-marques"/>
       <xhtml:link rel="alternate" hreflang="id-id" href="https://www.nestlehealthscience.co.id/brands"/>
       <xhtml:link rel="alternate" hreflang="it-it" href="https://www.nestlehealthscience.it/prodotti"/>
       <xhtml:link rel="alternate" hreflang="pl-pl" href="https://www.nestlehealthscience.pl/produkty"/>
       <xhtml:link rel="alternate" hreflang="en-za" href="https://www.nestlehealthscience.co.za/brands"/>
       <xhtml:link rel="alternate" hreflang="en-my" href="https://www.nestlehealthscience.my/brands"/>
       <xhtml:link rel="alternate" hreflang="vi-vn" href="https://www.nestlehealthscience.vn/san-pham"/>
       <xhtml:link rel="alternate" hreflang="cs-cz" href="https://www.nestlehealthscience.cz/cz/produkty"/>
       <xhtml:link rel="alternate" hreflang="sk-cz" href="https://www.nestlehealthscience.cz/sk/produkty"/>
       <xhtml:link rel="alternate" hreflang="en-sg" href="https://www.nestlehealthscience.sg/brands"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-cn" href="https://www.nestlehealthscience.cn/brands"/>
       <xhtml:link rel="alternate" hreflang="en-ph" href="https://www.nestlehealthscience.ph/brands"/>
       <xhtml:link rel="alternate" hreflang="ru-ru" href="https://www.nestlehealthscience.ru/brands"/>
       <xhtml:link rel="alternate" hreflang="nl-nl" href="https://www.nestlehealthscience.nl/nl/producten"/>
       <xhtml:link rel="alternate" hreflang="fr-nl" href="https://www.nestlehealthscience.nl/fr/producten"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-tw" href="https://www.nestlehealthscience.com.tw/brands"/>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
       </url>
      </urlset>';
    }

    public function france()
    {
       return '<?xml version="1.0" encoding="UTF-8"?>
       <urlset
           xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
           xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd
           http://www.w3.org/1999/xhtml http://www.w3.org/2002/08/xhtml/xhtml1-strict.xsd"
           xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
           xmlns:xhtml="http://www.w3.org/1999/xhtml"   
       >
       <url>
         <loc>https://www.nestlehealthscience.fr</loc>
        <xhtml:link rel="alternate" hreflang="fr-fr" href="https://www.nestlehealthscience.fr"/>
        <xhtml:link rel="alternate" hreflang="en" href="https://www.nestlehealthscience.com"/>
       <xhtml:link rel="alternate" hreflang="en-us" href="https://www.nestlehealthscience.us"/>
       <xhtml:link rel="alternate" hreflang="en-ca" href="https://www.nestlehealthscience.ca/en"/>
       <xhtml:link rel="alternate" hreflang="fr-ca" href="https://www.nestlehealthscience.ca/fr"/>
        <xhtml:link rel="alternate" hreflang="en-gb" href="https://www.nestlehealthscience.co.uk"/>
        <xhtml:link rel="alternate" hreflang="pt-br" href="https://www.nestlehealthscience.com.br"/>
        <xhtml:link rel="alternate" hreflang="fi-fi" href="https://www.nestlehealthscience.fi"/>
        <xhtml:link rel="alternate" hreflang="pt-pt" href="https://www.nestlehealthscience.pt"/>
        <xhtml:link rel="alternate" hreflang="th-th" href="https://www.nestlehealthscience-th.com"/>
        <xhtml:link rel="alternate" hreflang="tr-tr" href="https://www.nestlehealthscience.com.tr"/>
        <xhtml:link rel="alternate" hreflang="en-ae" href="https://www.nestlehealthscience-me.com"/>
        <xhtml:link rel="alternate" hreflang="es-mx" href="https://www.nestlehealthscience.com.mx"/>
        <xhtml:link rel="alternate" hreflang="sv-se" href="https://www.nestlehealthscience.se"/>
        <xhtml:link rel="alternate" hreflang="en-lk" href="https://www.nestlehealthscience.lk"/>
        <xhtml:link rel="alternate" hreflang="zh-hans-hk" href="https://www.nestlehealthscience.com.hk"/>
        <xhtml:link rel="alternate" hreflang="ja-jp" href="https://www.nestlehealthscience.jp"/>
        <xhtml:link rel="alternate" hreflang="es-es" href="https://www.nestlehealthscience.es"/>
        <xhtml:link rel="alternate" hreflang="ro-ro" href="https://www.nestlehealthscience.ro"/>
        <xhtml:link rel="alternate" hreflang="de-de" href="https://www.nestlehealthscience.de"/>
        <xhtml:link rel="alternate" hreflang="da-dk" href="https://www.nestlehealthscience.dk"/>
        <xhtml:link rel="alternate" hreflang="en-in" href="https://www.nestlehealthscience.in"/>
        <xhtml:link rel="alternate" hreflang="de-ch" href="https://www.nestlehealthscience.ch/de"/>
        <xhtml:link rel="alternate" hreflang="fr-ch" href="https://www.nestlehealthscience.ch/fr"/>
        <xhtml:link rel="alternate" hreflang="id-id" href="https://www.nestlehealthscience.co.id"/>
        <xhtml:link rel="alternate" hreflang="it-it" href="https://www.nestlehealthscience.it"/>
        <xhtml:link rel="alternate" hreflang="pl-pl" href="https://www.nestlehealthscience.pl"/>
        <xhtml:link rel="alternate" hreflang="en-za" href="https://www.nestlehealthscience.co.za"/>
        <xhtml:link rel="alternate" hreflang="en-my" href="https://www.nestlehealthscience.my"/>
        <xhtml:link rel="alternate" hreflang="vi-vn" href="https://www.nestlehealthscience.vn"/>
        <xhtml:link rel="alternate" hreflang="cs-cz" href="https://www.nestlehealthscience.cz/cz"/>
        <xhtml:link rel="alternate" hreflang="sk-cz" href="https://www.nestlehealthscience.cz/sk"/>
        <xhtml:link rel="alternate" hreflang="en-sg" href="https://www.nestlehealthscience.sg"/>
        <xhtml:link rel="alternate" hreflang="zh-hans-cn" href="https://www.nestlehealthscience.cn/"/>
        <xhtml:link rel="alternate" hreflang="en-ph" href="https://www.nestlehealthscience.ph/"/>
        <xhtml:link rel="alternate" hreflang="ru-ru" href="https://www.nestlehealthscience.ru/"/>
        <xhtml:link rel="alternate" hreflang="nl-nl" href="https://www.nestlehealthscience.nl/nl"/>
        <xhtml:link rel="alternate" hreflang="fr-nl" href="https://www.nestlehealthscience.nl/fr"/>
        <xhtml:link rel="alternate" hreflang="zh-hans-tw" href="https://www.nestlehealthscience.com.tw"/>
         <changefreq>daily</changefreq>
         <priority>1.0</priority>
        </url>
        <url>
        <loc>https://www.nestlehealthscience.fr/nos-marques</loc>
        <xhtml:link rel="alternate" hreflang="fr-fr" href="https://www.nestlehealthscience.fr/nos-marques"/>
         <xhtml:link rel="alternate" hreflang="en" href="https://www.nestlehealthscience.com/brands"/>
       <xhtml:link rel="alternate" hreflang="en-ca" href="https://www.nestlehealthscience.ca/en/brands"/>
       <xhtml:link rel="alternate" hreflang="fr-ca" href="https://www.nestlehealthscience.ca/fr/marques/home"/>
        <xhtml:link rel="alternate" hreflang="en-gb" href="https://www.nestlehealthscience.co.uk/brands"/>
        <xhtml:link rel="alternate" hreflang="pt-br" href="https://www.nestlehealthscience.com.br/marcas"/>
        <xhtml:link rel="alternate" hreflang="fi-fi" href="https://www.nestlehealthscience.fi/tuotteet"/>
        <xhtml:link rel="alternate" hreflang="pt-pt" href="http://nestlehealthscience.pt/marcas"/>
        <xhtml:link rel="alternate" hreflang="th-th" href="https://www.nestlehealthscience-th.com"/>
        <xhtml:link rel="alternate" hreflang="tr-tr" href="https://www.nestlehealthscience.com.tr/brands"/>
        <xhtml:link rel="alternate" hreflang="en-ae" href="https://www.nestlehealthscience-me.com/en/brands"/>
        <xhtml:link rel="alternate" hreflang="es-mx" href="https://www.nestlehealthscience.com.mx/marcas"/>
        <xhtml:link rel="alternate" hreflang="sv-se" href="https://www.nestlehealthscience.se/produkter"/>
        <xhtml:link rel="alternate" hreflang="en-lk" href="https://www.nestlehealthscience.lk/brands"/>
        <xhtml:link rel="alternate" hreflang="zh-hans-hk" href="https://www.nestlehealthscience.com.hk/zh-hans/brands"/>
        <xhtml:link rel="alternate" hreflang="ja-jp" href="https://www.nestlehealthscience.jp/brands"/>
        <xhtml:link rel="alternate" hreflang="es-es" href="https://www.nestlehealthscience.es/marcas"/>
        <xhtml:link rel="alternate" hreflang="ro-ro" href="https://www.nestlehealthscience.ro/produse"/>
        <xhtml:link rel="alternate" hreflang="de-de" href="https://www.nestlehealthscience.de/marken"/>
        <xhtml:link rel="alternate" hreflang="da-dk" href="https://www.nestlehealthscience.dk/produkter"/>
        <xhtml:link rel="alternate" hreflang="en-in" href="https://www.nestlehealthscience.in/brands"/>
        <xhtml:link rel="alternate" hreflang="de-ch" href="https://www.nestlehealthscience.ch/de/marken"/>
        <xhtml:link rel="alternate" hreflang="fr-ch" href="https://www.nestlehealthscience.ch/fr/nos-marques"/>
        <xhtml:link rel="alternate" hreflang="id-id" href="https://www.nestlehealthscience.co.id/brands"/>
        <xhtml:link rel="alternate" hreflang="it-it" href="https://www.nestlehealthscience.it/prodotti"/>
        <xhtml:link rel="alternate" hreflang="pl-pl" href="https://www.nestlehealthscience.pl/produkty"/>
        <xhtml:link rel="alternate" hreflang="en-za" href="https://www.nestlehealthscience.co.za/brands"/>
        <xhtml:link rel="alternate" hreflang="en-my" href="https://www.nestlehealthscience.my/brands"/>
        <xhtml:link rel="alternate" hreflang="vi-vn" href="https://www.nestlehealthscience.vn/san-pham"/>
        <xhtml:link rel="alternate" hreflang="cs-cz" href="https://www.nestlehealthscience.cz/cz/produkty"/>
        <xhtml:link rel="alternate" hreflang="sk-cz" href="https://www.nestlehealthscience.cz/sk/produkty"/>
        <xhtml:link rel="alternate" hreflang="en-sg" href="https://www.nestlehealthscience.sg/brands"/>
        <xhtml:link rel="alternate" hreflang="zh-hans-cn" href="https://www.nestlehealthscience.cn/brands"/>
        <xhtml:link rel="alternate" hreflang="en-ph" href="https://www.nestlehealthscience.ph/brands"/>
        <xhtml:link rel="alternate" hreflang="ru-ru" href="https://www.nestlehealthscience.ru/brands"/>
        <xhtml:link rel="alternate" hreflang="nl-nl" href="https://www.nestlehealthscience.nl/nl/producten"/>
        <xhtml:link rel="alternate" hreflang="fr-nl" href="https://www.nestlehealthscience.nl/fr/producten"/>
        <xhtml:link rel="alternate" hreflang="zh-hans-tw" href="https://www.nestlehealthscience.com.tw/brands"/>
         <changefreq>daily</changefreq>
         <priority>1.0</priority>
        </url>
       </urlset>';
    }

    public function germany()
    {
       return '<?xml version="1.0" encoding="UTF-8"?>
       <urlset
           xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
           xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd
           http://www.w3.org/1999/xhtml http://www.w3.org/2002/08/xhtml/xhtml1-strict.xsd"
           xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
           xmlns:xhtml="http://www.w3.org/1999/xhtml"   
       >
       <url>
         <loc>https://www.nestlehealthscience.de</loc>
        <xhtml:link rel="alternate" hreflang="de-de" href="https://www.nestlehealthscience.de"/>
        <xhtml:link rel="alternate" hreflang="en" href="https://www.nestlehealthscience.com"/>
       <xhtml:link rel="alternate" hreflang="en-us" href="https://www.nestlehealthscience.us"/>
       <xhtml:link rel="alternate" hreflang="en-ca" href="https://www.nestlehealthscience.ca/en"/>
       <xhtml:link rel="alternate" hreflang="fr-ca" href="https://www.nestlehealthscience.ca/fr"/>
        <xhtml:link rel="alternate" hreflang="en-gb" href="https://www.nestlehealthscience.co.uk"/>
        <xhtml:link rel="alternate" hreflang="pt-br" href="https://www.nestlehealthscience.com.br"/>
        <xhtml:link rel="alternate" hreflang="fi-fi" href="https://www.nestlehealthscience.fi"/>
        <xhtml:link rel="alternate" hreflang="pt-pt" href="https://www.nestlehealthscience.pt"/>
        <xhtml:link rel="alternate" hreflang="th-th" href="https://www.nestlehealthscience-th.com"/>
        <xhtml:link rel="alternate" hreflang="tr-tr" href="https://www.nestlehealthscience.com.tr"/>
        <xhtml:link rel="alternate" hreflang="en-ae" href="https://www.nestlehealthscience-me.com"/>
        <xhtml:link rel="alternate" hreflang="es-mx" href="https://www.nestlehealthscience.com.mx"/>
        <xhtml:link rel="alternate" hreflang="fr-fr" href="https://www.nestlehealthscience.fr"/>
        <xhtml:link rel="alternate" hreflang="sv-se" href="https://www.nestlehealthscience.se"/>
        <xhtml:link rel="alternate" hreflang="en-lk" href="https://www.nestlehealthscience.lk"/>
        <xhtml:link rel="alternate" hreflang="zh-hans-hk" href="https://www.nestlehealthscience.com.hk"/>
        <xhtml:link rel="alternate" hreflang="ja-jp" href="https://www.nestlehealthscience.jp"/>
        <xhtml:link rel="alternate" hreflang="es-es" href="https://www.nestlehealthscience.es"/>
        <xhtml:link rel="alternate" hreflang="ro-ro" href="https://www.nestlehealthscience.ro"/>
        <xhtml:link rel="alternate" hreflang="da-dk" href="https://www.nestlehealthscience.dk"/>
        <xhtml:link rel="alternate" hreflang="en-in" href="https://www.nestlehealthscience.in"/>
        <xhtml:link rel="alternate" hreflang="de-ch" href="https://www.nestlehealthscience.ch/de"/>
        <xhtml:link rel="alternate" hreflang="fr-ch" href="https://www.nestlehealthscience.ch/fr"/>
        <xhtml:link rel="alternate" hreflang="id-id" href="https://www.nestlehealthscience.co.id"/>
        <xhtml:link rel="alternate" hreflang="it-it" href="https://www.nestlehealthscience.it"/>
        <xhtml:link rel="alternate" hreflang="pl-pl" href="https://www.nestlehealthscience.pl"/>
        <xhtml:link rel="alternate" hreflang="en-za" href="https://www.nestlehealthscience.co.za"/>
        <xhtml:link rel="alternate" hreflang="en-my" href="https://www.nestlehealthscience.my"/>
        <xhtml:link rel="alternate" hreflang="vi-vn" href="https://www.nestlehealthscience.vn"/>
        <xhtml:link rel="alternate" hreflang="cs-cz" href="https://www.nestlehealthscience.cz/cz"/>
        <xhtml:link rel="alternate" hreflang="sk-cz" href="https://www.nestlehealthscience.cz/sk"/>
        <xhtml:link rel="alternate" hreflang="en-sg" href="https://www.nestlehealthscience.sg"/>
        <xhtml:link rel="alternate" hreflang="zh-hans-cn" href="https://www.nestlehealthscience.cn/"/>
        <xhtml:link rel="alternate" hreflang="en-ph" href="https://www.nestlehealthscience.ph/"/>
        <xhtml:link rel="alternate" hreflang="ru-ru" href="https://www.nestlehealthscience.ru/"/>
        <xhtml:link rel="alternate" hreflang="nl-nl" href="https://www.nestlehealthscience.nl/nl"/>
        <xhtml:link rel="alternate" hreflang="fr-nl" href="https://www.nestlehealthscience.nl/fr"/>
        <xhtml:link rel="alternate" hreflang="zh-hans-tw" href="https://www.nestlehealthscience.com.tw"/>
         <changefreq>daily</changefreq>
         <priority>1.0</priority>
        </url>
        <url>
        <loc>https://www.nestlehealthscience.de/marken</loc>
        <xhtml:link rel="alternate" hreflang="de-de" href="https://www.nestlehealthscience.de/marken"/>
         <xhtml:link rel="alternate" hreflang="en" href="https://www.nestlehealthscience.com/brands"/>
       <xhtml:link rel="alternate" hreflang="en-ca" href="https://www.nestlehealthscience.ca/en/brands"/>
       <xhtml:link rel="alternate" hreflang="fr-ca" href="https://www.nestlehealthscience.ca/fr/marques/home"/>
        <xhtml:link rel="alternate" hreflang="en-gb" href="https://www.nestlehealthscience.co.uk/brands"/>
        <xhtml:link rel="alternate" hreflang="pt-br" href="https://www.nestlehealthscience.com.br/marcas"/>
        <xhtml:link rel="alternate" hreflang="fi-fi" href="https://www.nestlehealthscience.fi/tuotteet"/>
        <xhtml:link rel="alternate" hreflang="pt-pt" href="http://nestlehealthscience.pt/marcas"/>
        <xhtml:link rel="alternate" hreflang="th-th" href="https://www.nestlehealthscience-th.com"/>
        <xhtml:link rel="alternate" hreflang="tr-tr" href="https://www.nestlehealthscience.com.tr/brands"/>
        <xhtml:link rel="alternate" hreflang="en-ae" href="https://www.nestlehealthscience-me.com/en/brands"/>
        <xhtml:link rel="alternate" hreflang="es-mx" href="https://www.nestlehealthscience.com.mx/marcas"/>
        <xhtml:link rel="alternate" hreflang="fr-fr" href="https://www.nestlehealthscience.fr/nos-marques"/>
        <xhtml:link rel="alternate" hreflang="sv-se" href="https://www.nestlehealthscience.se/produkter"/>
        <xhtml:link rel="alternate" hreflang="en-lk" href="https://www.nestlehealthscience.lk/brands"/>
        <xhtml:link rel="alternate" hreflang="zh-hans-hk" href="https://www.nestlehealthscience.com.hk/zh-hans/brands"/>
        <xhtml:link rel="alternate" hreflang="ja-jp" href="https://www.nestlehealthscience.jp/brands"/>
        <xhtml:link rel="alternate" hreflang="es-es" href="https://www.nestlehealthscience.es/marcas"/>
        <xhtml:link rel="alternate" hreflang="ro-ro" href="https://www.nestlehealthscience.ro/produse"/>
        <xhtml:link rel="alternate" hreflang="da-dk" href="https://www.nestlehealthscience.dk/produkter"/>
        <xhtml:link rel="alternate" hreflang="en-in" href="https://www.nestlehealthscience.in/brands"/>
        <xhtml:link rel="alternate" hreflang="de-ch" href="https://www.nestlehealthscience.ch/de/marken"/>
        <xhtml:link rel="alternate" hreflang="fr-ch" href="https://www.nestlehealthscience.ch/fr/nos-marques"/>
        <xhtml:link rel="alternate" hreflang="id-id" href="https://www.nestlehealthscience.co.id/brands"/>
        <xhtml:link rel="alternate" hreflang="it-it" href="https://www.nestlehealthscience.it/prodotti"/>
        <xhtml:link rel="alternate" hreflang="pl-pl" href="https://www.nestlehealthscience.pl/produkty"/>
        <xhtml:link rel="alternate" hreflang="en-za" href="https://www.nestlehealthscience.co.za/brands"/>
        <xhtml:link rel="alternate" hreflang="en-my" href="https://www.nestlehealthscience.my/brands"/>
        <xhtml:link rel="alternate" hreflang="vi-vn" href="https://www.nestlehealthscience.vn/san-pham"/>
        <xhtml:link rel="alternate" hreflang="cs-cz" href="https://www.nestlehealthscience.cz/cz/produkty"/>
        <xhtml:link rel="alternate" hreflang="sk-cz" href="https://www.nestlehealthscience.cz/sk/produkty"/>
        <xhtml:link rel="alternate" hreflang="en-sg" href="https://www.nestlehealthscience.sg/brands"/>
        <xhtml:link rel="alternate" hreflang="zh-hans-cn" href="https://www.nestlehealthscience.cn/brands"/>
        <xhtml:link rel="alternate" hreflang="en-ph" href="https://www.nestlehealthscience.ph/brands"/>
        <xhtml:link rel="alternate" hreflang="ru-ru" href="https://www.nestlehealthscience.ru/brands"/>
        <xhtml:link rel="alternate" hreflang="nl-nl" href="https://www.nestlehealthscience.nl/nl/producten"/>
        <xhtml:link rel="alternate" hreflang="fr-nl" href="https://www.nestlehealthscience.nl/fr/producten"/>
        <xhtml:link rel="alternate" hreflang="zh-hans-tw" href="https://www.nestlehealthscience.com.tw/brands"/>
         <changefreq>daily</changefreq>
         <priority>1.0</priority>
        </url>
       </urlset>';
    }
    
    public function hongkong()
    {
       return '<?xml version="1.0" encoding="UTF-8"?>
       <urlset
           xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
           xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd
           http://www.w3.org/1999/xhtml http://www.w3.org/2002/08/xhtml/xhtml1-strict.xsd"
           xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
           xmlns:xhtml="http://www.w3.org/1999/xhtml"   
       >
       <url>
         <loc>https://www.nestlehealthscience.com.hk</loc>
        <xhtml:link rel="alternate" hreflang="zh-hans-hk" href="https://www.nestlehealthscience.com.hk"/>
        <xhtml:link rel="alternate" hreflang="en" href="https://www.nestlehealthscience.com"/>
       <xhtml:link rel="alternate" hreflang="en-us" href="https://www.nestlehealthscience.us"/>
       <xhtml:link rel="alternate" hreflang="en-ca" href="https://www.nestlehealthscience.ca/en"/>
       <xhtml:link rel="alternate" hreflang="fr-ca" href="https://www.nestlehealthscience.ca/fr"/>
        <xhtml:link rel="alternate" hreflang="en-gb" href="https://www.nestlehealthscience.co.uk"/>
        <xhtml:link rel="alternate" hreflang="pt-br" href="https://www.nestlehealthscience.com.br"/>
        <xhtml:link rel="alternate" hreflang="fi-fi" href="https://www.nestlehealthscience.fi"/>
        <xhtml:link rel="alternate" hreflang="pt-pt" href="https://www.nestlehealthscience.pt"/>
        <xhtml:link rel="alternate" hreflang="th-th" href="https://www.nestlehealthscience-th.com"/>
        <xhtml:link rel="alternate" hreflang="tr-tr" href="https://www.nestlehealthscience.com.tr"/>
        <xhtml:link rel="alternate" hreflang="en-ae" href="https://www.nestlehealthscience-me.com"/>
        <xhtml:link rel="alternate" hreflang="es-mx" href="https://www.nestlehealthscience.com.mx"/>
        <xhtml:link rel="alternate" hreflang="fr-fr" href="https://www.nestlehealthscience.fr"/>
        <xhtml:link rel="alternate" hreflang="sv-se" href="https://www.nestlehealthscience.se"/>
        <xhtml:link rel="alternate" hreflang="en-lk" href="https://www.nestlehealthscience.lk"/>
        <xhtml:link rel="alternate" hreflang="ja-jp" href="https://www.nestlehealthscience.jp"/>
        <xhtml:link rel="alternate" hreflang="es-es" href="https://www.nestlehealthscience.es"/>
        <xhtml:link rel="alternate" hreflang="ro-ro" href="https://www.nestlehealthscience.ro"/>
        <xhtml:link rel="alternate" hreflang="de-de" href="https://www.nestlehealthscience.de"/>
        <xhtml:link rel="alternate" hreflang="da-dk" href="https://www.nestlehealthscience.dk"/>
        <xhtml:link rel="alternate" hreflang="en-in" href="https://www.nestlehealthscience.in"/>
        <xhtml:link rel="alternate" hreflang="de-ch" href="https://www.nestlehealthscience.ch/de"/>
        <xhtml:link rel="alternate" hreflang="fr-ch" href="https://www.nestlehealthscience.ch/fr"/>
        <xhtml:link rel="alternate" hreflang="id-id" href="https://www.nestlehealthscience.co.id"/>
        <xhtml:link rel="alternate" hreflang="it-it" href="https://www.nestlehealthscience.it"/>
        <xhtml:link rel="alternate" hreflang="pl-pl" href="https://www.nestlehealthscience.pl"/>
        <xhtml:link rel="alternate" hreflang="en-za" href="https://www.nestlehealthscience.co.za"/>
        <xhtml:link rel="alternate" hreflang="en-my" href="https://www.nestlehealthscience.my"/>
        <xhtml:link rel="alternate" hreflang="vi-vn" href="https://www.nestlehealthscience.vn"/>
        <xhtml:link rel="alternate" hreflang="cs-cz" href="https://www.nestlehealthscience.cz/cz"/>
        <xhtml:link rel="alternate" hreflang="sk-cz" href="https://www.nestlehealthscience.cz/sk"/>
        <xhtml:link rel="alternate" hreflang="en-sg" href="https://www.nestlehealthscience.sg"/>
        <xhtml:link rel="alternate" hreflang="zh-hans-cn" href="https://www.nestlehealthscience.cn/"/>
        <xhtml:link rel="alternate" hreflang="en-ph" href="https://www.nestlehealthscience.ph/"/>
        <xhtml:link rel="alternate" hreflang="ru-ru" href="https://www.nestlehealthscience.ru/"/>
        <xhtml:link rel="alternate" hreflang="nl-nl" href="https://www.nestlehealthscience.nl/nl"/>
        <xhtml:link rel="alternate" hreflang="fr-nl" href="https://www.nestlehealthscience.nl/fr"/>
        <xhtml:link rel="alternate" hreflang="zh-hans-tw" href="https://www.nestlehealthscience.com.tw"/>
         <changefreq>daily</changefreq>
         <priority>1.0</priority>
        </url>
        <url>
        <loc>https://www.nestlehealthscience.com.hk/zh-hans/brands</loc>
        <xhtml:link rel="alternate" hreflang="zh-hans-hk" href="https://www.nestlehealthscience.com.hk/zh-hans/brands"/> 
         <xhtml:link rel="alternate" hreflang="en" href="https://www.nestlehealthscience.com/brands"/>
       <xhtml:link rel="alternate" hreflang="en-ca" href="https://www.nestlehealthscience.ca/en/brands"/>
       <xhtml:link rel="alternate" hreflang="fr-ca" href="https://www.nestlehealthscience.ca/fr/marques/home"/>
        <xhtml:link rel="alternate" hreflang="en-gb" href="https://www.nestlehealthscience.co.uk/brands"/>
        <xhtml:link rel="alternate" hreflang="pt-br" href="https://www.nestlehealthscience.com.br/marcas"/>
        <xhtml:link rel="alternate" hreflang="fi-fi" href="https://www.nestlehealthscience.fi/tuotteet"/>
        <xhtml:link rel="alternate" hreflang="pt-pt" href="http://nestlehealthscience.pt/marcas"/>
        <xhtml:link rel="alternate" hreflang="th-th" href="https://www.nestlehealthscience-th.com"/>
        <xhtml:link rel="alternate" hreflang="tr-tr" href="https://www.nestlehealthscience.com.tr/brands"/>
        <xhtml:link rel="alternate" hreflang="en-ae" href="https://www.nestlehealthscience-me.com/en/brands"/>
        <xhtml:link rel="alternate" hreflang="es-mx" href="https://www.nestlehealthscience.com.mx/marcas"/>
        <xhtml:link rel="alternate" hreflang="fr-fr" href="https://www.nestlehealthscience.fr/nos-marques"/>
        <xhtml:link rel="alternate" hreflang="sv-se" href="https://www.nestlehealthscience.se/produkter"/>
        <xhtml:link rel="alternate" hreflang="en-lk" href="https://www.nestlehealthscience.lk/brands"/>
        <xhtml:link rel="alternate" hreflang="ja-jp" href="https://www.nestlehealthscience.jp/brands"/>
        <xhtml:link rel="alternate" hreflang="es-es" href="https://www.nestlehealthscience.es/marcas"/>
        <xhtml:link rel="alternate" hreflang="ro-ro" href="https://www.nestlehealthscience.ro/produse"/>
        <xhtml:link rel="alternate" hreflang="de-de" href="https://www.nestlehealthscience.de/marken"/>
        <xhtml:link rel="alternate" hreflang="da-dk" href="https://www.nestlehealthscience.dk/produkter"/>
        <xhtml:link rel="alternate" hreflang="en-in" href="https://www.nestlehealthscience.in/brands"/>
        <xhtml:link rel="alternate" hreflang="de-ch" href="https://www.nestlehealthscience.ch/de/marken"/>
        <xhtml:link rel="alternate" hreflang="fr-ch" href="https://www.nestlehealthscience.ch/fr/nos-marques"/>
        <xhtml:link rel="alternate" hreflang="id-id" href="https://www.nestlehealthscience.co.id/brands"/>
        <xhtml:link rel="alternate" hreflang="it-it" href="https://www.nestlehealthscience.it/prodotti"/>
        <xhtml:link rel="alternate" hreflang="pl-pl" href="https://www.nestlehealthscience.pl/produkty"/>
        <xhtml:link rel="alternate" hreflang="en-za" href="https://www.nestlehealthscience.co.za/brands"/>
        <xhtml:link rel="alternate" hreflang="en-my" href="https://www.nestlehealthscience.my/brands"/>
        <xhtml:link rel="alternate" hreflang="vi-vn" href="https://www.nestlehealthscience.vn/san-pham"/>
        <xhtml:link rel="alternate" hreflang="cs-cz" href="https://www.nestlehealthscience.cz/cz/produkty"/>
        <xhtml:link rel="alternate" hreflang="sk-cz" href="https://www.nestlehealthscience.cz/sk/produkty"/>
        <xhtml:link rel="alternate" hreflang="en-sg" href="https://www.nestlehealthscience.sg/brands"/>
        <xhtml:link rel="alternate" hreflang="zh-hans-cn" href="https://www.nestlehealthscience.cn/brands"/>
        <xhtml:link rel="alternate" hreflang="en-ph" href="https://www.nestlehealthscience.ph/brands"/>
        <xhtml:link rel="alternate" hreflang="ru-ru" href="https://www.nestlehealthscience.ru/brands"/>
        <xhtml:link rel="alternate" hreflang="nl-nl" href="https://www.nestlehealthscience.nl/nl/producten"/>
        <xhtml:link rel="alternate" hreflang="fr-nl" href="https://www.nestlehealthscience.nl/fr/producten"/>
        <xhtml:link rel="alternate" hreflang="zh-hans-tw" href="https://www.nestlehealthscience.com.tw/brands"/>
         <changefreq>daily</changefreq>
         <priority>1.0</priority>
        </url>
       </urlset>';
    }


    public function india()
    {
      return '<?xml version="1.0" encoding="UTF-8"?>
      <urlset
          xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
          xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd
          http://www.w3.org/1999/xhtml http://www.w3.org/2002/08/xhtml/xhtml1-strict.xsd"
          xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
          xmlns:xhtml="http://www.w3.org/1999/xhtml"   
      >
      <url>
        <loc>https://www.nestlehealthscience.in</loc>
       <xhtml:link rel="alternate" hreflang="en-in" href="https://www.nestlehealthscience.in"/>
       <xhtml:link rel="alternate" hreflang="en" href="https://www.nestlehealthscience.com"/>
      <xhtml:link rel="alternate" hreflang="en-us" href="https://www.nestlehealthscience.us"/>
      <xhtml:link rel="alternate" hreflang="en-ca" href="https://www.nestlehealthscience.ca/en"/>
      <xhtml:link rel="alternate" hreflang="fr-ca" href="https://www.nestlehealthscience.ca/fr"/>
       <xhtml:link rel="alternate" hreflang="en-gb" href="https://www.nestlehealthscience.co.uk"/>
       <xhtml:link rel="alternate" hreflang="pt-br" href="https://www.nestlehealthscience.com.br"/>
       <xhtml:link rel="alternate" hreflang="fi-fi" href="https://www.nestlehealthscience.fi"/>
       <xhtml:link rel="alternate" hreflang="pt-pt" href="https://www.nestlehealthscience.pt"/>
       <xhtml:link rel="alternate" hreflang="th-th" href="https://www.nestlehealthscience-th.com"/>
       <xhtml:link rel="alternate" hreflang="tr-tr" href="https://www.nestlehealthscience.com.tr"/>
       <xhtml:link rel="alternate" hreflang="en-ae" href="https://www.nestlehealthscience-me.com"/>
       <xhtml:link rel="alternate" hreflang="es-mx" href="https://www.nestlehealthscience.com.mx"/>
       <xhtml:link rel="alternate" hreflang="fr-fr" href="https://www.nestlehealthscience.fr"/>
       <xhtml:link rel="alternate" hreflang="sv-se" href="https://www.nestlehealthscience.se"/>
       <xhtml:link rel="alternate" hreflang="en-lk" href="https://www.nestlehealthscience.lk"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-hk" href="https://www.nestlehealthscience.com.hk"/>
       <xhtml:link rel="alternate" hreflang="ja-jp" href="https://www.nestlehealthscience.jp"/>
       <xhtml:link rel="alternate" hreflang="es-es" href="https://www.nestlehealthscience.es"/>
       <xhtml:link rel="alternate" hreflang="ro-ro" href="https://www.nestlehealthscience.ro"/>
       <xhtml:link rel="alternate" hreflang="de-de" href="https://www.nestlehealthscience.de"/>
       <xhtml:link rel="alternate" hreflang="da-dk" href="https://www.nestlehealthscience.dk"/>
       <xhtml:link rel="alternate" hreflang="de-ch" href="https://www.nestlehealthscience.ch/de"/>
       <xhtml:link rel="alternate" hreflang="fr-ch" href="https://www.nestlehealthscience.ch/fr"/>
       <xhtml:link rel="alternate" hreflang="id-id" href="https://www.nestlehealthscience.co.id"/>
       <xhtml:link rel="alternate" hreflang="it-it" href="https://www.nestlehealthscience.it"/>
       <xhtml:link rel="alternate" hreflang="pl-pl" href="https://www.nestlehealthscience.pl"/>
       <xhtml:link rel="alternate" hreflang="en-za" href="https://www.nestlehealthscience.co.za"/>
       <xhtml:link rel="alternate" hreflang="en-my" href="https://www.nestlehealthscience.my"/>
       <xhtml:link rel="alternate" hreflang="vi-vn" href="https://www.nestlehealthscience.vn"/>
       <xhtml:link rel="alternate" hreflang="cs-cz" href="https://www.nestlehealthscience.cz/cz"/>
       <xhtml:link rel="alternate" hreflang="sk-cz" href="https://www.nestlehealthscience.cz/sk"/>
       <xhtml:link rel="alternate" hreflang="en-sg" href="https://www.nestlehealthscience.sg"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-cn" href="https://www.nestlehealthscience.cn/"/>
       <xhtml:link rel="alternate" hreflang="en-ph" href="https://www.nestlehealthscience.ph/"/>
       <xhtml:link rel="alternate" hreflang="ru-ru" href="https://www.nestlehealthscience.ru/"/>
       <xhtml:link rel="alternate" hreflang="nl-nl" href="https://www.nestlehealthscience.nl/nl"/>
       <xhtml:link rel="alternate" hreflang="fr-nl" href="https://www.nestlehealthscience.nl/fr"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-tw" href="https://www.nestlehealthscience.com.tw"/>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
       </url>
       <url>
       <loc>https://www.nestlehealthscience.in/brands</loc>
       <xhtml:link rel="alternate" hreflang="en-in" href="https://www.nestlehealthscience.in/brands"/>
        <xhtml:link rel="alternate" hreflang="en" href="https://www.nestlehealthscience.com/brands"/>
      <xhtml:link rel="alternate" hreflang="en-ca" href="https://www.nestlehealthscience.ca/en/brands"/>
      <xhtml:link rel="alternate" hreflang="fr-ca" href="https://www.nestlehealthscience.ca/fr/marques/home"/>
       <xhtml:link rel="alternate" hreflang="en-gb" href="https://www.nestlehealthscience.co.uk/brands"/>
       <xhtml:link rel="alternate" hreflang="pt-br" href="https://www.nestlehealthscience.com.br/marcas"/>
       <xhtml:link rel="alternate" hreflang="fi-fi" href="https://www.nestlehealthscience.fi/tuotteet"/>
       <xhtml:link rel="alternate" hreflang="pt-pt" href="http://nestlehealthscience.pt/marcas"/>
       <xhtml:link rel="alternate" hreflang="th-th" href="https://www.nestlehealthscience-th.com"/>
       <xhtml:link rel="alternate" hreflang="tr-tr" href="https://www.nestlehealthscience.com.tr/brands"/>
       <xhtml:link rel="alternate" hreflang="en-ae" href="https://www.nestlehealthscience-me.com/en/brands"/>
       <xhtml:link rel="alternate" hreflang="es-mx" href="https://www.nestlehealthscience.com.mx/marcas"/>
       <xhtml:link rel="alternate" hreflang="fr-fr" href="https://www.nestlehealthscience.fr/nos-marques"/>
       <xhtml:link rel="alternate" hreflang="sv-se" href="https://www.nestlehealthscience.se/produkter"/>
       <xhtml:link rel="alternate" hreflang="en-lk" href="https://www.nestlehealthscience.lk/brands"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-hk" href="https://www.nestlehealthscience.com.hk/zh-hans/brands"/>
       <xhtml:link rel="alternate" hreflang="ja-jp" href="https://www.nestlehealthscience.jp/brands"/>
       <xhtml:link rel="alternate" hreflang="es-es" href="https://www.nestlehealthscience.es/marcas"/>
       <xhtml:link rel="alternate" hreflang="ro-ro" href="https://www.nestlehealthscience.ro/produse"/>
       <xhtml:link rel="alternate" hreflang="de-de" href="https://www.nestlehealthscience.de/marken"/>
       <xhtml:link rel="alternate" hreflang="da-dk" href="https://www.nestlehealthscience.dk/produkter"/>
       <xhtml:link rel="alternate" hreflang="de-ch" href="https://www.nestlehealthscience.ch/de/marken"/>
       <xhtml:link rel="alternate" hreflang="fr-ch" href="https://www.nestlehealthscience.ch/fr/nos-marques"/>
       <xhtml:link rel="alternate" hreflang="id-id" href="https://www.nestlehealthscience.co.id/brands"/>
       <xhtml:link rel="alternate" hreflang="it-it" href="https://www.nestlehealthscience.it/prodotti"/>
       <xhtml:link rel="alternate" hreflang="pl-pl" href="https://www.nestlehealthscience.pl/produkty"/>
       <xhtml:link rel="alternate" hreflang="en-za" href="https://www.nestlehealthscience.co.za/brands"/>
       <xhtml:link rel="alternate" hreflang="en-my" href="https://www.nestlehealthscience.my/brands"/>
       <xhtml:link rel="alternate" hreflang="vi-vn" href="https://www.nestlehealthscience.vn/san-pham"/>
       <xhtml:link rel="alternate" hreflang="cs-cz" href="https://www.nestlehealthscience.cz/cz/produkty"/>
       <xhtml:link rel="alternate" hreflang="sk-cz" href="https://www.nestlehealthscience.cz/sk/produkty"/>
       <xhtml:link rel="alternate" hreflang="en-sg" href="https://www.nestlehealthscience.sg/brands"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-cn" href="https://www.nestlehealthscience.cn/brands"/>
       <xhtml:link rel="alternate" hreflang="en-ph" href="https://www.nestlehealthscience.ph/brands"/>
       <xhtml:link rel="alternate" hreflang="ru-ru" href="https://www.nestlehealthscience.ru/brands"/>
       <xhtml:link rel="alternate" hreflang="nl-nl" href="https://www.nestlehealthscience.nl/nl/producten"/>
       <xhtml:link rel="alternate" hreflang="fr-nl" href="https://www.nestlehealthscience.nl/fr/producten"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-tw" href="https://www.nestlehealthscience.com.tw/brands"/>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
       </url>
      </urlset>';
    }

    public function indonesia()
    {
      return '<?xml version="1.0" encoding="UTF-8"?>
      <urlset
          xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
          xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd
          http://www.w3.org/1999/xhtml http://www.w3.org/2002/08/xhtml/xhtml1-strict.xsd"
          xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
          xmlns:xhtml="http://www.w3.org/1999/xhtml"   
      >
      <url>
        <loc>https://www.nestlehealthscience.co.id</loc>
       <xhtml:link rel="alternate" hreflang="id-id" href="https://www.nestlehealthscience.co.id"/>
       <xhtml:link rel="alternate" hreflang="en" href="https://www.nestlehealthscience.com"/>
      <xhtml:link rel="alternate" hreflang="en-us" href="https://www.nestlehealthscience.us"/>
      <xhtml:link rel="alternate" hreflang="en-ca" href="https://www.nestlehealthscience.ca/en"/>
      <xhtml:link rel="alternate" hreflang="fr-ca" href="https://www.nestlehealthscience.ca/fr"/>
       <xhtml:link rel="alternate" hreflang="en-gb" href="https://www.nestlehealthscience.co.uk"/>
       <xhtml:link rel="alternate" hreflang="pt-br" href="https://www.nestlehealthscience.com.br"/>
       <xhtml:link rel="alternate" hreflang="fi-fi" href="https://www.nestlehealthscience.fi"/>
       <xhtml:link rel="alternate" hreflang="pt-pt" href="https://www.nestlehealthscience.pt"/>
       <xhtml:link rel="alternate" hreflang="th-th" href="https://www.nestlehealthscience-th.com"/>
       <xhtml:link rel="alternate" hreflang="tr-tr" href="https://www.nestlehealthscience.com.tr"/>
       <xhtml:link rel="alternate" hreflang="en-ae" href="https://www.nestlehealthscience-me.com"/>
       <xhtml:link rel="alternate" hreflang="es-mx" href="https://www.nestlehealthscience.com.mx"/>
       <xhtml:link rel="alternate" hreflang="fr-fr" href="https://www.nestlehealthscience.fr"/>
       <xhtml:link rel="alternate" hreflang="sv-se" href="https://www.nestlehealthscience.se"/>
       <xhtml:link rel="alternate" hreflang="en-lk" href="https://www.nestlehealthscience.lk"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-hk" href="https://www.nestlehealthscience.com.hk"/>
       <xhtml:link rel="alternate" hreflang="ja-jp" href="https://www.nestlehealthscience.jp"/>
       <xhtml:link rel="alternate" hreflang="es-es" href="https://www.nestlehealthscience.es"/>
       <xhtml:link rel="alternate" hreflang="ro-ro" href="https://www.nestlehealthscience.ro"/>
       <xhtml:link rel="alternate" hreflang="de-de" href="https://www.nestlehealthscience.de"/>
       <xhtml:link rel="alternate" hreflang="da-dk" href="https://www.nestlehealthscience.dk"/>
       <xhtml:link rel="alternate" hreflang="en-in" href="https://www.nestlehealthscience.in"/>
       <xhtml:link rel="alternate" hreflang="de-ch" href="https://www.nestlehealthscience.ch/de"/>
       <xhtml:link rel="alternate" hreflang="fr-ch" href="https://www.nestlehealthscience.ch/fr"/>
       <xhtml:link rel="alternate" hreflang="it-it" href="https://www.nestlehealthscience.it"/>
       <xhtml:link rel="alternate" hreflang="pl-pl" href="https://www.nestlehealthscience.pl"/>
       <xhtml:link rel="alternate" hreflang="en-za" href="https://www.nestlehealthscience.co.za"/>
       <xhtml:link rel="alternate" hreflang="en-my" href="https://www.nestlehealthscience.my"/>
       <xhtml:link rel="alternate" hreflang="vi-vn" href="https://www.nestlehealthscience.vn"/>
       <xhtml:link rel="alternate" hreflang="cs-cz" href="https://www.nestlehealthscience.cz/cz"/>
       <xhtml:link rel="alternate" hreflang="sk-cz" href="https://www.nestlehealthscience.cz/sk"/>
       <xhtml:link rel="alternate" hreflang="en-sg" href="https://www.nestlehealthscience.sg"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-cn" href="https://www.nestlehealthscience.cn/"/>
       <xhtml:link rel="alternate" hreflang="en-ph" href="https://www.nestlehealthscience.ph/"/>
       <xhtml:link rel="alternate" hreflang="ru-ru" href="https://www.nestlehealthscience.ru/"/>
       <xhtml:link rel="alternate" hreflang="nl-nl" href="https://www.nestlehealthscience.nl/nl"/>
       <xhtml:link rel="alternate" hreflang="fr-nl" href="https://www.nestlehealthscience.nl/fr"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-tw" href="https://www.nestlehealthscience.com.tw"/>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
       </url>
       <url>
       <loc>https://www.nestlehealthscience.co.id/brands</loc>
       <xhtml:link rel="alternate" hreflang="id-id" href="https://www.nestlehealthscience.co.id/brands"/>
        <xhtml:link rel="alternate" hreflang="en" href="https://www.nestlehealthscience.com/brands"/>
      <xhtml:link rel="alternate" hreflang="en-ca" href="https://www.nestlehealthscience.ca/en/brands"/>
      <xhtml:link rel="alternate" hreflang="fr-ca" href="https://www.nestlehealthscience.ca/fr/marques/home"/>
       <xhtml:link rel="alternate" hreflang="en-gb" href="https://www.nestlehealthscience.co.uk/brands"/>
       <xhtml:link rel="alternate" hreflang="pt-br" href="https://www.nestlehealthscience.com.br/marcas"/>
       <xhtml:link rel="alternate" hreflang="fi-fi" href="https://www.nestlehealthscience.fi/tuotteet"/>
       <xhtml:link rel="alternate" hreflang="pt-pt" href="http://nestlehealthscience.pt/marcas"/>
       <xhtml:link rel="alternate" hreflang="th-th" href="https://www.nestlehealthscience-th.com"/>
       <xhtml:link rel="alternate" hreflang="tr-tr" href="https://www.nestlehealthscience.com.tr/brands"/>
       <xhtml:link rel="alternate" hreflang="en-ae" href="https://www.nestlehealthscience-me.com/en/brands"/>
       <xhtml:link rel="alternate" hreflang="es-mx" href="https://www.nestlehealthscience.com.mx/marcas"/>
       <xhtml:link rel="alternate" hreflang="fr-fr" href="https://www.nestlehealthscience.fr/nos-marques"/>
       <xhtml:link rel="alternate" hreflang="sv-se" href="https://www.nestlehealthscience.se/produkter"/>
       <xhtml:link rel="alternate" hreflang="en-lk" href="https://www.nestlehealthscience.lk/brands"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-hk" href="https://www.nestlehealthscience.com.hk/zh-hans/brands"/>
       <xhtml:link rel="alternate" hreflang="ja-jp" href="https://www.nestlehealthscience.jp/brands"/>
       <xhtml:link rel="alternate" hreflang="es-es" href="https://www.nestlehealthscience.es/marcas"/>
       <xhtml:link rel="alternate" hreflang="ro-ro" href="https://www.nestlehealthscience.ro/produse"/>
       <xhtml:link rel="alternate" hreflang="de-de" href="https://www.nestlehealthscience.de/marken"/>
       <xhtml:link rel="alternate" hreflang="da-dk" href="https://www.nestlehealthscience.dk/produkter"/>
       <xhtml:link rel="alternate" hreflang="en-in" href="https://www.nestlehealthscience.in/brands"/>
       <xhtml:link rel="alternate" hreflang="de-ch" href="https://www.nestlehealthscience.ch/de/marken"/>
       <xhtml:link rel="alternate" hreflang="fr-ch" href="https://www.nestlehealthscience.ch/fr/nos-marques"/>
       <xhtml:link rel="alternate" hreflang="it-it" href="https://www.nestlehealthscience.it/prodotti"/>
       <xhtml:link rel="alternate" hreflang="pl-pl" href="https://www.nestlehealthscience.pl/produkty"/>
       <xhtml:link rel="alternate" hreflang="en-za" href="https://www.nestlehealthscience.co.za/brands"/>
       <xhtml:link rel="alternate" hreflang="en-my" href="https://www.nestlehealthscience.my/brands"/>
       <xhtml:link rel="alternate" hreflang="vi-vn" href="https://www.nestlehealthscience.vn/san-pham"/>
       <xhtml:link rel="alternate" hreflang="cs-cz" href="https://www.nestlehealthscience.cz/cz/produkty"/>
       <xhtml:link rel="alternate" hreflang="sk-cz" href="https://www.nestlehealthscience.cz/sk/produkty"/>
       <xhtml:link rel="alternate" hreflang="en-sg" href="https://www.nestlehealthscience.sg/brands"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-cn" href="https://www.nestlehealthscience.cn/brands"/>
       <xhtml:link rel="alternate" hreflang="en-ph" href="https://www.nestlehealthscience.ph/brands"/>
       <xhtml:link rel="alternate" hreflang="ru-ru" href="https://www.nestlehealthscience.ru/brands"/>
       <xhtml:link rel="alternate" hreflang="nl-nl" href="https://www.nestlehealthscience.nl/nl/producten"/>
       <xhtml:link rel="alternate" hreflang="fr-nl" href="https://www.nestlehealthscience.nl/fr/producten"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-tw" href="https://www.nestlehealthscience.com.tw/brands"/>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
       </url>
      </urlset>';
    }


    public function italy()
    {
      return '<?xml version="1.0" encoding="UTF-8"?>
      <urlset
          xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
          xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd
          http://www.w3.org/1999/xhtml http://www.w3.org/2002/08/xhtml/xhtml1-strict.xsd"
          xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
          xmlns:xhtml="http://www.w3.org/1999/xhtml"   
      >
      <url>
        <loc>https://www.nestlehealthscience.it</loc>
       <xhtml:link rel="alternate" hreflang="it-it" href="https://www.nestlehealthscience.it"/>
       <xhtml:link rel="alternate" hreflang="en" href="https://www.nestlehealthscience.com"/>
      <xhtml:link rel="alternate" hreflang="en-us" href="https://www.nestlehealthscience.us"/>
      <xhtml:link rel="alternate" hreflang="en-ca" href="https://www.nestlehealthscience.ca/en"/>
      <xhtml:link rel="alternate" hreflang="fr-ca" href="https://www.nestlehealthscience.ca/fr"/>
       <xhtml:link rel="alternate" hreflang="en-gb" href="https://www.nestlehealthscience.co.uk"/>
       <xhtml:link rel="alternate" hreflang="pt-br" href="https://www.nestlehealthscience.com.br"/>
       <xhtml:link rel="alternate" hreflang="fi-fi" href="https://www.nestlehealthscience.fi"/>
       <xhtml:link rel="alternate" hreflang="pt-pt" href="https://www.nestlehealthscience.pt"/>
       <xhtml:link rel="alternate" hreflang="th-th" href="https://www.nestlehealthscience-th.com"/>
       <xhtml:link rel="alternate" hreflang="tr-tr" href="https://www.nestlehealthscience.com.tr"/>
       <xhtml:link rel="alternate" hreflang="en-ae" href="https://www.nestlehealthscience-me.com"/>
       <xhtml:link rel="alternate" hreflang="es-mx" href="https://www.nestlehealthscience.com.mx"/>
       <xhtml:link rel="alternate" hreflang="fr-fr" href="https://www.nestlehealthscience.fr"/>
       <xhtml:link rel="alternate" hreflang="sv-se" href="https://www.nestlehealthscience.se"/>
       <xhtml:link rel="alternate" hreflang="en-lk" href="https://www.nestlehealthscience.lk"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-hk" href="https://www.nestlehealthscience.com.hk"/>
       <xhtml:link rel="alternate" hreflang="ja-jp" href="https://www.nestlehealthscience.jp"/>
       <xhtml:link rel="alternate" hreflang="es-es" href="https://www.nestlehealthscience.es"/>
       <xhtml:link rel="alternate" hreflang="ro-ro" href="https://www.nestlehealthscience.ro"/>
       <xhtml:link rel="alternate" hreflang="de-de" href="https://www.nestlehealthscience.de"/>
       <xhtml:link rel="alternate" hreflang="da-dk" href="https://www.nestlehealthscience.dk"/>
       <xhtml:link rel="alternate" hreflang="en-in" href="https://www.nestlehealthscience.in"/>
       <xhtml:link rel="alternate" hreflang="de-ch" href="https://www.nestlehealthscience.ch/de"/>
       <xhtml:link rel="alternate" hreflang="fr-ch" href="https://www.nestlehealthscience.ch/fr"/>
       <xhtml:link rel="alternate" hreflang="id-id" href="https://www.nestlehealthscience.co.id"/>
       <xhtml:link rel="alternate" hreflang="pl-pl" href="https://www.nestlehealthscience.pl"/>
       <xhtml:link rel="alternate" hreflang="en-za" href="https://www.nestlehealthscience.co.za"/>
       <xhtml:link rel="alternate" hreflang="en-my" href="https://www.nestlehealthscience.my"/>
       <xhtml:link rel="alternate" hreflang="vi-vn" href="https://www.nestlehealthscience.vn"/>
       <xhtml:link rel="alternate" hreflang="cs-cz" href="https://www.nestlehealthscience.cz/cz"/>
       <xhtml:link rel="alternate" hreflang="sk-cz" href="https://www.nestlehealthscience.cz/sk"/>
       <xhtml:link rel="alternate" hreflang="en-sg" href="https://www.nestlehealthscience.sg"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-cn" href="https://www.nestlehealthscience.cn/"/>
       <xhtml:link rel="alternate" hreflang="en-ph" href="https://www.nestlehealthscience.ph/"/>
       <xhtml:link rel="alternate" hreflang="ru-ru" href="https://www.nestlehealthscience.ru/"/>
       <xhtml:link rel="alternate" hreflang="nl-nl" href="https://www.nestlehealthscience.nl/nl"/>
       <xhtml:link rel="alternate" hreflang="fr-nl" href="https://www.nestlehealthscience.nl/fr"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-tw" href="https://www.nestlehealthscience.com.tw"/>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
       </url>
       <url>
       <loc>https://www.nestlehealthscience.it/prodotti</loc>
       <xhtml:link rel="alternate" hreflang="it-it" href="https://www.nestlehealthscience.it/prodotti"/>
        <xhtml:link rel="alternate" hreflang="en" href="https://www.nestlehealthscience.com/brands"/>
      <xhtml:link rel="alternate" hreflang="en-ca" href="https://www.nestlehealthscience.ca/en/brands"/>
      <xhtml:link rel="alternate" hreflang="fr-ca" href="https://www.nestlehealthscience.ca/fr/marques/home"/>
       <xhtml:link rel="alternate" hreflang="en-gb" href="https://www.nestlehealthscience.co.uk/brands"/>
       <xhtml:link rel="alternate" hreflang="pt-br" href="https://www.nestlehealthscience.com.br/marcas"/>
       <xhtml:link rel="alternate" hreflang="fi-fi" href="https://www.nestlehealthscience.fi/tuotteet"/>
       <xhtml:link rel="alternate" hreflang="pt-pt" href="http://nestlehealthscience.pt/marcas"/>
       <xhtml:link rel="alternate" hreflang="th-th" href="https://www.nestlehealthscience-th.com"/>
       <xhtml:link rel="alternate" hreflang="tr-tr" href="https://www.nestlehealthscience.com.tr/brands"/>
       <xhtml:link rel="alternate" hreflang="en-ae" href="https://www.nestlehealthscience-me.com/en/brands"/>
       <xhtml:link rel="alternate" hreflang="es-mx" href="https://www.nestlehealthscience.com.mx/marcas"/>
       <xhtml:link rel="alternate" hreflang="fr-fr" href="https://www.nestlehealthscience.fr/nos-marques"/>
       <xhtml:link rel="alternate" hreflang="sv-se" href="https://www.nestlehealthscience.se/produkter"/>
       <xhtml:link rel="alternate" hreflang="en-lk" href="https://www.nestlehealthscience.lk/brands"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-hk" href="https://www.nestlehealthscience.com.hk/zh-hans/brands"/>
       <xhtml:link rel="alternate" hreflang="ja-jp" href="https://www.nestlehealthscience.jp/brands"/>
       <xhtml:link rel="alternate" hreflang="es-es" href="https://www.nestlehealthscience.es/marcas"/>
       <xhtml:link rel="alternate" hreflang="ro-ro" href="https://www.nestlehealthscience.ro/produse"/>
       <xhtml:link rel="alternate" hreflang="de-de" href="https://www.nestlehealthscience.de/marken"/>
       <xhtml:link rel="alternate" hreflang="da-dk" href="https://www.nestlehealthscience.dk/produkter"/>
       <xhtml:link rel="alternate" hreflang="en-in" href="https://www.nestlehealthscience.in/brands"/>
       <xhtml:link rel="alternate" hreflang="de-ch" href="https://www.nestlehealthscience.ch/de/marken"/>
       <xhtml:link rel="alternate" hreflang="fr-ch" href="https://www.nestlehealthscience.ch/fr/nos-marques"/>
       <xhtml:link rel="alternate" hreflang="id-id" href="https://www.nestlehealthscience.co.id/brands"/>
       <xhtml:link rel="alternate" hreflang="pl-pl" href="https://www.nestlehealthscience.pl/produkty"/>
       <xhtml:link rel="alternate" hreflang="en-za" href="https://www.nestlehealthscience.co.za/brands"/>
       <xhtml:link rel="alternate" hreflang="en-my" href="https://www.nestlehealthscience.my/brands"/>
       <xhtml:link rel="alternate" hreflang="vi-vn" href="https://www.nestlehealthscience.vn/san-pham"/>
       <xhtml:link rel="alternate" hreflang="cs-cz" href="https://www.nestlehealthscience.cz/cz/produkty"/>
       <xhtml:link rel="alternate" hreflang="sk-cz" href="https://www.nestlehealthscience.cz/sk/produkty"/>
       <xhtml:link rel="alternate" hreflang="en-sg" href="https://www.nestlehealthscience.sg/brands"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-cn" href="https://www.nestlehealthscience.cn/brands"/>
       <xhtml:link rel="alternate" hreflang="en-ph" href="https://www.nestlehealthscience.ph/brands"/>
       <xhtml:link rel="alternate" hreflang="ru-ru" href="https://www.nestlehealthscience.ru/brands"/>
       <xhtml:link rel="alternate" hreflang="nl-nl" href="https://www.nestlehealthscience.nl/nl/producten"/>
       <xhtml:link rel="alternate" hreflang="fr-nl" href="https://www.nestlehealthscience.nl/fr/producten"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-tw" href="https://www.nestlehealthscience.com.tw/brands"/>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
       </url>
      </urlset>';
    }

    public function malaysia()
    {
      return '<?xml version="1.0" encoding="UTF-8"?>
      <urlset
          xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
          xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd
          http://www.w3.org/1999/xhtml http://www.w3.org/2002/08/xhtml/xhtml1-strict.xsd"
          xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
          xmlns:xhtml="http://www.w3.org/1999/xhtml"   
      >
      <url>
        <loc>https://www.nestlehealthscience.my</loc>
       <xhtml:link rel="alternate" hreflang="en-my" href="https://www.nestlehealthscience.my"/>
       <xhtml:link rel="alternate" hreflang="en" href="https://www.nestlehealthscience.com"/>
      <xhtml:link rel="alternate" hreflang="en-us" href="https://www.nestlehealthscience.us"/>
      <xhtml:link rel="alternate" hreflang="en-ca" href="https://www.nestlehealthscience.ca/en"/>
      <xhtml:link rel="alternate" hreflang="fr-ca" href="https://www.nestlehealthscience.ca/fr"/>
       <xhtml:link rel="alternate" hreflang="en-gb" href="https://www.nestlehealthscience.co.uk"/>
       <xhtml:link rel="alternate" hreflang="pt-br" href="https://www.nestlehealthscience.com.br"/>
       <xhtml:link rel="alternate" hreflang="fi-fi" href="https://www.nestlehealthscience.fi"/>
       <xhtml:link rel="alternate" hreflang="pt-pt" href="https://www.nestlehealthscience.pt"/>
       <xhtml:link rel="alternate" hreflang="th-th" href="https://www.nestlehealthscience-th.com"/>
       <xhtml:link rel="alternate" hreflang="tr-tr" href="https://www.nestlehealthscience.com.tr"/>
       <xhtml:link rel="alternate" hreflang="en-ae" href="https://www.nestlehealthscience-me.com"/>
       <xhtml:link rel="alternate" hreflang="es-mx" href="https://www.nestlehealthscience.com.mx"/>
       <xhtml:link rel="alternate" hreflang="fr-fr" href="https://www.nestlehealthscience.fr"/>
       <xhtml:link rel="alternate" hreflang="sv-se" href="https://www.nestlehealthscience.se"/>
       <xhtml:link rel="alternate" hreflang="en-lk" href="https://www.nestlehealthscience.lk"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-hk" href="https://www.nestlehealthscience.com.hk"/>
       <xhtml:link rel="alternate" hreflang="ja-jp" href="https://www.nestlehealthscience.jp"/>
       <xhtml:link rel="alternate" hreflang="es-es" href="https://www.nestlehealthscience.es"/>
       <xhtml:link rel="alternate" hreflang="ro-ro" href="https://www.nestlehealthscience.ro"/>
       <xhtml:link rel="alternate" hreflang="de-de" href="https://www.nestlehealthscience.de"/>
       <xhtml:link rel="alternate" hreflang="da-dk" href="https://www.nestlehealthscience.dk"/>
       <xhtml:link rel="alternate" hreflang="en-in" href="https://www.nestlehealthscience.in"/>
       <xhtml:link rel="alternate" hreflang="de-ch" href="https://www.nestlehealthscience.ch/de"/>
       <xhtml:link rel="alternate" hreflang="fr-ch" href="https://www.nestlehealthscience.ch/fr"/>
       <xhtml:link rel="alternate" hreflang="id-id" href="https://www.nestlehealthscience.co.id"/>
       <xhtml:link rel="alternate" hreflang="it-it" href="https://www.nestlehealthscience.it"/>
       <xhtml:link rel="alternate" hreflang="pl-pl" href="https://www.nestlehealthscience.pl"/>
       <xhtml:link rel="alternate" hreflang="en-za" href="https://www.nestlehealthscience.co.za"/>
       <xhtml:link rel="alternate" hreflang="vi-vn" href="https://www.nestlehealthscience.vn"/>
       <xhtml:link rel="alternate" hreflang="cs-cz" href="https://www.nestlehealthscience.cz/cz"/>
       <xhtml:link rel="alternate" hreflang="sk-cz" href="https://www.nestlehealthscience.cz/sk"/>
       <xhtml:link rel="alternate" hreflang="en-sg" href="https://www.nestlehealthscience.sg"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-cn" href="https://www.nestlehealthscience.cn/"/>
       <xhtml:link rel="alternate" hreflang="en-ph" href="https://www.nestlehealthscience.ph/"/>
       <xhtml:link rel="alternate" hreflang="ru-ru" href="https://www.nestlehealthscience.ru/"/>
       <xhtml:link rel="alternate" hreflang="nl-nl" href="https://www.nestlehealthscience.nl/nl"/>
       <xhtml:link rel="alternate" hreflang="fr-nl" href="https://www.nestlehealthscience.nl/fr"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-tw" href="https://www.nestlehealthscience.com.tw"/>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
       </url>
       <url>
       <loc>https://www.nestlehealthscience.my/brands</loc>
      <xhtml:link rel="alternate" hreflang="en-my" href="https://www.nestlehealthscience.my/brands"/>
        <xhtml:link rel="alternate" hreflang="en" href="https://www.nestlehealthscience.com/brands"/>
      <xhtml:link rel="alternate" hreflang="en-ca" href="https://www.nestlehealthscience.ca/en/brands"/>
      <xhtml:link rel="alternate" hreflang="fr-ca" href="https://www.nestlehealthscience.ca/fr/marques/home"/>
       <xhtml:link rel="alternate" hreflang="en-gb" href="https://www.nestlehealthscience.co.uk/brands"/>
       <xhtml:link rel="alternate" hreflang="pt-br" href="https://www.nestlehealthscience.com.br/marcas"/>
       <xhtml:link rel="alternate" hreflang="fi-fi" href="https://www.nestlehealthscience.fi/tuotteet"/>
       <xhtml:link rel="alternate" hreflang="pt-pt" href="http://nestlehealthscience.pt/marcas"/>
       <xhtml:link rel="alternate" hreflang="th-th" href="https://www.nestlehealthscience-th.com"/>
       <xhtml:link rel="alternate" hreflang="tr-tr" href="https://www.nestlehealthscience.com.tr/brands"/>
       <xhtml:link rel="alternate" hreflang="en-ae" href="https://www.nestlehealthscience-me.com/en/brands"/>
       <xhtml:link rel="alternate" hreflang="es-mx" href="https://www.nestlehealthscience.com.mx/marcas"/>
       <xhtml:link rel="alternate" hreflang="fr-fr" href="https://www.nestlehealthscience.fr/nos-marques"/>
       <xhtml:link rel="alternate" hreflang="sv-se" href="https://www.nestlehealthscience.se/produkter"/>
       <xhtml:link rel="alternate" hreflang="en-lk" href="https://www.nestlehealthscience.lk/brands"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-hk" href="https://www.nestlehealthscience.com.hk/zh-hans/brands"/>
       <xhtml:link rel="alternate" hreflang="ja-jp" href="https://www.nestlehealthscience.jp/brands"/>
       <xhtml:link rel="alternate" hreflang="es-es" href="https://www.nestlehealthscience.es/marcas"/>
       <xhtml:link rel="alternate" hreflang="ro-ro" href="https://www.nestlehealthscience.ro/produse"/>
       <xhtml:link rel="alternate" hreflang="de-de" href="https://www.nestlehealthscience.de/marken"/>
       <xhtml:link rel="alternate" hreflang="da-dk" href="https://www.nestlehealthscience.dk/produkter"/>
       <xhtml:link rel="alternate" hreflang="en-in" href="https://www.nestlehealthscience.in/brands"/>
       <xhtml:link rel="alternate" hreflang="de-ch" href="https://www.nestlehealthscience.ch/de/marken"/>
       <xhtml:link rel="alternate" hreflang="fr-ch" href="https://www.nestlehealthscience.ch/fr/nos-marques"/>
       <xhtml:link rel="alternate" hreflang="id-id" href="https://www.nestlehealthscience.co.id/brands"/>
       <xhtml:link rel="alternate" hreflang="it-it" href="https://www.nestlehealthscience.it/prodotti"/>
       <xhtml:link rel="alternate" hreflang="pl-pl" href="https://www.nestlehealthscience.pl/produkty"/>
       <xhtml:link rel="alternate" hreflang="en-za" href="https://www.nestlehealthscience.co.za/brands"/>
       <xhtml:link rel="alternate" hreflang="vi-vn" href="https://www.nestlehealthscience.vn/san-pham"/>
       <xhtml:link rel="alternate" hreflang="cs-cz" href="https://www.nestlehealthscience.cz/cz/produkty"/>
       <xhtml:link rel="alternate" hreflang="sk-cz" href="https://www.nestlehealthscience.cz/sk/produkty"/>
       <xhtml:link rel="alternate" hreflang="en-sg" href="https://www.nestlehealthscience.sg/brands"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-cn" href="https://www.nestlehealthscience.cn/brands"/>
       <xhtml:link rel="alternate" hreflang="en-ph" href="https://www.nestlehealthscience.ph/brands"/>
       <xhtml:link rel="alternate" hreflang="ru-ru" href="https://www.nestlehealthscience.ru/brands"/>
       <xhtml:link rel="alternate" hreflang="nl-nl" href="https://www.nestlehealthscience.nl/nl/producten"/>
       <xhtml:link rel="alternate" hreflang="fr-nl" href="https://www.nestlehealthscience.nl/fr/producten"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-tw" href="https://www.nestlehealthscience.com.tw/brands"/>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
       </url>
      </urlset>
      
      ';
    }

    public function mexico()
    {
      return '<?xml version="1.0" encoding="UTF-8"?>
      <urlset
          xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
          xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd
          http://www.w3.org/1999/xhtml http://www.w3.org/2002/08/xhtml/xhtml1-strict.xsd"
          xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
          xmlns:xhtml="http://www.w3.org/1999/xhtml"   
      >
      <url>
        <loc>https://www.nestlehealthscience.com.mx</loc>
       <xhtml:link rel="alternate" hreflang="es-mx" href="https://www.nestlehealthscience.com.mx"/>
       <xhtml:link rel="alternate" hreflang="en" href="https://www.nestlehealthscience.com"/>
      <xhtml:link rel="alternate" hreflang="en-us" href="https://www.nestlehealthscience.us"/>
      <xhtml:link rel="alternate" hreflang="en-ca" href="https://www.nestlehealthscience.ca/en"/>
      <xhtml:link rel="alternate" hreflang="fr-ca" href="https://www.nestlehealthscience.ca/fr"/>
       <xhtml:link rel="alternate" hreflang="en-gb" href="https://www.nestlehealthscience.co.uk"/>
       <xhtml:link rel="alternate" hreflang="pt-br" href="https://www.nestlehealthscience.com.br"/>
       <xhtml:link rel="alternate" hreflang="fi-fi" href="https://www.nestlehealthscience.fi"/>
       <xhtml:link rel="alternate" hreflang="pt-pt" href="https://www.nestlehealthscience.pt"/>
       <xhtml:link rel="alternate" hreflang="th-th" href="https://www.nestlehealthscience-th.com"/>
       <xhtml:link rel="alternate" hreflang="tr-tr" href="https://www.nestlehealthscience.com.tr"/>
       <xhtml:link rel="alternate" hreflang="en-ae" href="https://www.nestlehealthscience-me.com"/>
       <xhtml:link rel="alternate" hreflang="fr-fr" href="https://www.nestlehealthscience.fr"/>
       <xhtml:link rel="alternate" hreflang="sv-se" href="https://www.nestlehealthscience.se"/>
       <xhtml:link rel="alternate" hreflang="en-lk" href="https://www.nestlehealthscience.lk"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-hk" href="https://www.nestlehealthscience.com.hk"/>
       <xhtml:link rel="alternate" hreflang="ja-jp" href="https://www.nestlehealthscience.jp"/>
       <xhtml:link rel="alternate" hreflang="es-es" href="https://www.nestlehealthscience.es"/>
       <xhtml:link rel="alternate" hreflang="ro-ro" href="https://www.nestlehealthscience.ro"/>
       <xhtml:link rel="alternate" hreflang="de-de" href="https://www.nestlehealthscience.de"/>
       <xhtml:link rel="alternate" hreflang="da-dk" href="https://www.nestlehealthscience.dk"/>
       <xhtml:link rel="alternate" hreflang="en-in" href="https://www.nestlehealthscience.in"/>
       <xhtml:link rel="alternate" hreflang="de-ch" href="https://www.nestlehealthscience.ch/de"/>
       <xhtml:link rel="alternate" hreflang="fr-ch" href="https://www.nestlehealthscience.ch/fr"/>
       <xhtml:link rel="alternate" hreflang="id-id" href="https://www.nestlehealthscience.co.id"/>
       <xhtml:link rel="alternate" hreflang="it-it" href="https://www.nestlehealthscience.it"/>
       <xhtml:link rel="alternate" hreflang="pl-pl" href="https://www.nestlehealthscience.pl"/>
       <xhtml:link rel="alternate" hreflang="en-za" href="https://www.nestlehealthscience.co.za"/>
       <xhtml:link rel="alternate" hreflang="en-my" href="https://www.nestlehealthscience.my"/>
       <xhtml:link rel="alternate" hreflang="vi-vn" href="https://www.nestlehealthscience.vn"/>
       <xhtml:link rel="alternate" hreflang="cs-cz" href="https://www.nestlehealthscience.cz/cz"/>
       <xhtml:link rel="alternate" hreflang="sk-cz" href="https://www.nestlehealthscience.cz/sk"/>
       <xhtml:link rel="alternate" hreflang="en-sg" href="https://www.nestlehealthscience.sg"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-cn" href="https://www.nestlehealthscience.cn/"/>
       <xhtml:link rel="alternate" hreflang="en-ph" href="https://www.nestlehealthscience.ph/"/>
       <xhtml:link rel="alternate" hreflang="ru-ru" href="https://www.nestlehealthscience.ru/"/>
       <xhtml:link rel="alternate" hreflang="nl-nl" href="https://www.nestlehealthscience.nl/nl"/>
       <xhtml:link rel="alternate" hreflang="fr-nl" href="https://www.nestlehealthscience.nl/fr"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-tw" href="https://www.nestlehealthscience.com.tw"/>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
       </url>
       <url>
       <loc>https://www.nestlehealthscience.com.mx/marcas</loc>
       <xhtml:link rel="alternate" hreflang="es-mx" href="https://www.nestlehealthscience.com.mx/marcas"/>
        <xhtml:link rel="alternate" hreflang="en" href="https://www.nestlehealthscience.com/brands"/>
      <xhtml:link rel="alternate" hreflang="en-ca" href="https://www.nestlehealthscience.ca/en/brands"/>
      <xhtml:link rel="alternate" hreflang="fr-ca" href="https://www.nestlehealthscience.ca/fr/marques/home"/>
       <xhtml:link rel="alternate" hreflang="en-gb" href="https://www.nestlehealthscience.co.uk/brands"/>
       <xhtml:link rel="alternate" hreflang="pt-br" href="https://www.nestlehealthscience.com.br/marcas"/>
       <xhtml:link rel="alternate" hreflang="fi-fi" href="https://www.nestlehealthscience.fi/tuotteet"/>
       <xhtml:link rel="alternate" hreflang="pt-pt" href="http://nestlehealthscience.pt/marcas"/>
       <xhtml:link rel="alternate" hreflang="th-th" href="https://www.nestlehealthscience-th.com"/>
       <xhtml:link rel="alternate" hreflang="tr-tr" href="https://www.nestlehealthscience.com.tr/brands"/>
       <xhtml:link rel="alternate" hreflang="en-ae" href="https://www.nestlehealthscience-me.com/en/brands"/>
       <xhtml:link rel="alternate" hreflang="fr-fr" href="https://www.nestlehealthscience.fr/nos-marques"/>
       <xhtml:link rel="alternate" hreflang="sv-se" href="https://www.nestlehealthscience.se/produkter"/>
       <xhtml:link rel="alternate" hreflang="en-lk" href="https://www.nestlehealthscience.lk/brands"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-hk" href="https://www.nestlehealthscience.com.hk/zh-hans/brands"/>
       <xhtml:link rel="alternate" hreflang="ja-jp" href="https://www.nestlehealthscience.jp/brands"/>
       <xhtml:link rel="alternate" hreflang="es-es" href="https://www.nestlehealthscience.es/marcas"/>
       <xhtml:link rel="alternate" hreflang="ro-ro" href="https://www.nestlehealthscience.ro/produse"/>
       <xhtml:link rel="alternate" hreflang="de-de" href="https://www.nestlehealthscience.de/marken"/>
       <xhtml:link rel="alternate" hreflang="da-dk" href="https://www.nestlehealthscience.dk/produkter"/>
       <xhtml:link rel="alternate" hreflang="en-in" href="https://www.nestlehealthscience.in/brands"/>
       <xhtml:link rel="alternate" hreflang="de-ch" href="https://www.nestlehealthscience.ch/de/marken"/>
       <xhtml:link rel="alternate" hreflang="fr-ch" href="https://www.nestlehealthscience.ch/fr/nos-marques"/>
       <xhtml:link rel="alternate" hreflang="id-id" href="https://www.nestlehealthscience.co.id/brands"/>
       <xhtml:link rel="alternate" hreflang="it-it" href="https://www.nestlehealthscience.it/prodotti"/>
       <xhtml:link rel="alternate" hreflang="pl-pl" href="https://www.nestlehealthscience.pl/produkty"/>
       <xhtml:link rel="alternate" hreflang="en-za" href="https://www.nestlehealthscience.co.za/brands"/>
       <xhtml:link rel="alternate" hreflang="en-my" href="https://www.nestlehealthscience.my/brands"/>
       <xhtml:link rel="alternate" hreflang="vi-vn" href="https://www.nestlehealthscience.vn/san-pham"/>
       <xhtml:link rel="alternate" hreflang="cs-cz" href="https://www.nestlehealthscience.cz/cz/produkty"/>
       <xhtml:link rel="alternate" hreflang="sk-cz" href="https://www.nestlehealthscience.cz/sk/produkty"/>
       <xhtml:link rel="alternate" hreflang="en-sg" href="https://www.nestlehealthscience.sg/brands"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-cn" href="https://www.nestlehealthscience.cn/brands"/>
       <xhtml:link rel="alternate" hreflang="en-ph" href="https://www.nestlehealthscience.ph/brands"/>
       <xhtml:link rel="alternate" hreflang="ru-ru" href="https://www.nestlehealthscience.ru/brands"/>
       <xhtml:link rel="alternate" hreflang="nl-nl" href="https://www.nestlehealthscience.nl/nl/producten"/>
       <xhtml:link rel="alternate" hreflang="fr-nl" href="https://www.nestlehealthscience.nl/fr/producten"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-tw" href="https://www.nestlehealthscience.com.tw/brands"/>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
       </url>
      </urlset>';
    }


    public function netherlands()
    {
      return '<?xml version="1.0" encoding="UTF-8"?>
      <urlset
          xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
          xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd
          http://www.w3.org/1999/xhtml http://www.w3.org/2002/08/xhtml/xhtml1-strict.xsd"
          xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
          xmlns:xhtml="http://www.w3.org/1999/xhtml"   
      >
      <url>
        <loc>https://www.nestlehealthscience.nl/nl</loc>
       <xhtml:link rel="alternate" hreflang="nl-nl" href="https://www.nestlehealthscience.nl/nl"/>
       <xhtml:link rel="alternate" hreflang="fr-nl" href="https://www.nestlehealthscience.nl/fr"/>
       <xhtml:link rel="alternate" hreflang="en" href="https://www.nestlehealthscience.com"/>
      <xhtml:link rel="alternate" hreflang="en-us" href="https://www.nestlehealthscience.us"/>
      <xhtml:link rel="alternate" hreflang="en-ca" href="https://www.nestlehealthscience.ca/en"/>
      <xhtml:link rel="alternate" hreflang="fr-ca" href="https://www.nestlehealthscience.ca/fr"/>
       <xhtml:link rel="alternate" hreflang="en-gb" href="https://www.nestlehealthscience.co.uk"/>
       <xhtml:link rel="alternate" hreflang="pt-br" href="https://www.nestlehealthscience.com.br"/>
       <xhtml:link rel="alternate" hreflang="fi-fi" href="https://www.nestlehealthscience.fi"/>
       <xhtml:link rel="alternate" hreflang="pt-pt" href="https://www.nestlehealthscience.pt"/>
       <xhtml:link rel="alternate" hreflang="th-th" href="https://www.nestlehealthscience-th.com"/>
       <xhtml:link rel="alternate" hreflang="tr-tr" href="https://www.nestlehealthscience.com.tr"/>
       <xhtml:link rel="alternate" hreflang="en-ae" href="https://www.nestlehealthscience-me.com"/>
       <xhtml:link rel="alternate" hreflang="es-mx" href="https://www.nestlehealthscience.com.mx"/>
       <xhtml:link rel="alternate" hreflang="fr-fr" href="https://www.nestlehealthscience.fr"/>
       <xhtml:link rel="alternate" hreflang="sv-se" href="https://www.nestlehealthscience.se"/>
       <xhtml:link rel="alternate" hreflang="en-lk" href="https://www.nestlehealthscience.lk"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-hk" href="https://www.nestlehealthscience.com.hk"/>
       <xhtml:link rel="alternate" hreflang="ja-jp" href="https://www.nestlehealthscience.jp"/>
       <xhtml:link rel="alternate" hreflang="es-es" href="https://www.nestlehealthscience.es"/>
       <xhtml:link rel="alternate" hreflang="ro-ro" href="https://www.nestlehealthscience.ro"/>
       <xhtml:link rel="alternate" hreflang="de-de" href="https://www.nestlehealthscience.de"/>
       <xhtml:link rel="alternate" hreflang="da-dk" href="https://www.nestlehealthscience.dk"/>
       <xhtml:link rel="alternate" hreflang="en-in" href="https://www.nestlehealthscience.in"/>
       <xhtml:link rel="alternate" hreflang="de-ch" href="https://www.nestlehealthscience.ch/de"/>
       <xhtml:link rel="alternate" hreflang="fr-ch" href="https://www.nestlehealthscience.ch/fr"/>
       <xhtml:link rel="alternate" hreflang="id-id" href="https://www.nestlehealthscience.co.id"/>
       <xhtml:link rel="alternate" hreflang="it-it" href="https://www.nestlehealthscience.it"/>
       <xhtml:link rel="alternate" hreflang="pl-pl" href="https://www.nestlehealthscience.pl"/>
       <xhtml:link rel="alternate" hreflang="en-za" href="https://www.nestlehealthscience.co.za"/>
       <xhtml:link rel="alternate" hreflang="en-my" href="https://www.nestlehealthscience.my"/>
       <xhtml:link rel="alternate" hreflang="vi-vn" href="https://www.nestlehealthscience.vn"/>
       <xhtml:link rel="alternate" hreflang="cs-cz" href="https://www.nestlehealthscience.cz/cz"/>
       <xhtml:link rel="alternate" hreflang="sk-cz" href="https://www.nestlehealthscience.cz/sk"/>
       <xhtml:link rel="alternate" hreflang="en-sg" href="https://www.nestlehealthscience.sg"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-cn" href="https://www.nestlehealthscience.cn/"/>
       <xhtml:link rel="alternate" hreflang="en-ph" href="https://www.nestlehealthscience.ph/"/>
       <xhtml:link rel="alternate" hreflang="ru-ru" href="https://www.nestlehealthscience.ru/"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-tw" href="https://www.nestlehealthscience.com.tw"/>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
       </url>
      <url>
        <loc>https://www.nestlehealthscience.nl/fr</loc>
       <xhtml:link rel="alternate" hreflang="fr-nl" href="https://www.nestlehealthscience.nl/fr"/>
       <xhtml:link rel="alternate" hreflang="nl-nl" href="https://www.nestlehealthscience.nl/nl"/>
       <xhtml:link rel="alternate" hreflang="en" href="https://www.nestlehealthscience.com"/>
      <xhtml:link rel="alternate" hreflang="en-us" href="https://www.nestlehealthscience.us"/>
      <xhtml:link rel="alternate" hreflang="en-ca" href="https://www.nestlehealthscience.ca/en"/>
      <xhtml:link rel="alternate" hreflang="fr-ca" href="https://www.nestlehealthscience.ca/fr"/>
       <xhtml:link rel="alternate" hreflang="en-gb" href="https://www.nestlehealthscience.co.uk"/>
       <xhtml:link rel="alternate" hreflang="pt-br" href="https://www.nestlehealthscience.com.br"/>
       <xhtml:link rel="alternate" hreflang="fi-fi" href="https://www.nestlehealthscience.fi"/>
       <xhtml:link rel="alternate" hreflang="pt-pt" href="https://www.nestlehealthscience.pt"/>
       <xhtml:link rel="alternate" hreflang="th-th" href="https://www.nestlehealthscience-th.com"/>
       <xhtml:link rel="alternate" hreflang="tr-tr" href="https://www.nestlehealthscience.com.tr"/>
       <xhtml:link rel="alternate" hreflang="en-ae" href="https://www.nestlehealthscience-me.com"/>
       <xhtml:link rel="alternate" hreflang="es-mx" href="https://www.nestlehealthscience.com.mx"/>
       <xhtml:link rel="alternate" hreflang="fr-fr" href="https://www.nestlehealthscience.fr"/>
       <xhtml:link rel="alternate" hreflang="sv-se" href="https://www.nestlehealthscience.se"/>
       <xhtml:link rel="alternate" hreflang="en-lk" href="https://www.nestlehealthscience.lk"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-hk" href="https://www.nestlehealthscience.com.hk"/>
       <xhtml:link rel="alternate" hreflang="ja-jp" href="https://www.nestlehealthscience.jp"/>
       <xhtml:link rel="alternate" hreflang="es-es" href="https://www.nestlehealthscience.es"/>
       <xhtml:link rel="alternate" hreflang="ro-ro" href="https://www.nestlehealthscience.ro"/>
       <xhtml:link rel="alternate" hreflang="de-de" href="https://www.nestlehealthscience.de"/>
       <xhtml:link rel="alternate" hreflang="da-dk" href="https://www.nestlehealthscience.dk"/>
       <xhtml:link rel="alternate" hreflang="en-in" href="https://www.nestlehealthscience.in"/>
       <xhtml:link rel="alternate" hreflang="de-ch" href="https://www.nestlehealthscience.ch/de"/>
       <xhtml:link rel="alternate" hreflang="fr-ch" href="https://www.nestlehealthscience.ch/fr"/>
       <xhtml:link rel="alternate" hreflang="id-id" href="https://www.nestlehealthscience.co.id"/>
       <xhtml:link rel="alternate" hreflang="it-it" href="https://www.nestlehealthscience.it"/>
       <xhtml:link rel="alternate" hreflang="pl-pl" href="https://www.nestlehealthscience.pl"/>
       <xhtml:link rel="alternate" hreflang="en-za" href="https://www.nestlehealthscience.co.za"/>
       <xhtml:link rel="alternate" hreflang="en-my" href="https://www.nestlehealthscience.my"/>
       <xhtml:link rel="alternate" hreflang="vi-vn" href="https://www.nestlehealthscience.vn"/>
       <xhtml:link rel="alternate" hreflang="cs-cz" href="https://www.nestlehealthscience.cz/cz"/>
       <xhtml:link rel="alternate" hreflang="sk-cz" href="https://www.nestlehealthscience.cz/sk"/>
       <xhtml:link rel="alternate" hreflang="en-sg" href="https://www.nestlehealthscience.sg"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-cn" href="https://www.nestlehealthscience.cn/"/>
       <xhtml:link rel="alternate" hreflang="en-ph" href="https://www.nestlehealthscience.ph/"/>
       <xhtml:link rel="alternate" hreflang="ru-ru" href="https://www.nestlehealthscience.ru/"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-tw" href="https://www.nestlehealthscience.com.tw"/>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
       </url>
       <url>
       <loc>https://www.nestlehealthscience.nl/nl/producten</loc>
       <xhtml:link rel="alternate" hreflang="nl-nl" href="https://www.nestlehealthscience.nl/nl/producten"/>
       <xhtml:link rel="alternate" hreflang="fr-nl" href="https://www.nestlehealthscience.nl/fr/producten"/>
        <xhtml:link rel="alternate" hreflang="en" href="https://www.nestlehealthscience.com/brands"/>
      <xhtml:link rel="alternate" hreflang="en-ca" href="https://www.nestlehealthscience.ca/en/brands"/>
      <xhtml:link rel="alternate" hreflang="fr-ca" href="https://www.nestlehealthscience.ca/fr/marques/home"/>
       <xhtml:link rel="alternate" hreflang="en-gb" href="https://www.nestlehealthscience.co.uk/brands"/>
       <xhtml:link rel="alternate" hreflang="pt-br" href="https://www.nestlehealthscience.com.br/marcas"/>
       <xhtml:link rel="alternate" hreflang="fi-fi" href="https://www.nestlehealthscience.fi/tuotteet"/>
       <xhtml:link rel="alternate" hreflang="pt-pt" href="http://nestlehealthscience.pt/marcas"/>
       <xhtml:link rel="alternate" hreflang="th-th" href="https://www.nestlehealthscience-th.com"/>
       <xhtml:link rel="alternate" hreflang="tr-tr" href="https://www.nestlehealthscience.com.tr/brands"/>
       <xhtml:link rel="alternate" hreflang="en-ae" href="https://www.nestlehealthscience-me.com/en/brands"/>
       <xhtml:link rel="alternate" hreflang="es-mx" href="https://www.nestlehealthscience.com.mx/marcas"/>
       <xhtml:link rel="alternate" hreflang="fr-fr" href="https://www.nestlehealthscience.fr/nos-marques"/>
       <xhtml:link rel="alternate" hreflang="sv-se" href="https://www.nestlehealthscience.se/produkter"/>
       <xhtml:link rel="alternate" hreflang="en-lk" href="https://www.nestlehealthscience.lk/brands"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-hk" href="https://www.nestlehealthscience.com.hk/zh-hans/brands"/>
       <xhtml:link rel="alternate" hreflang="ja-jp" href="https://www.nestlehealthscience.jp/brands"/>
       <xhtml:link rel="alternate" hreflang="es-es" href="https://www.nestlehealthscience.es/marcas"/>
       <xhtml:link rel="alternate" hreflang="ro-ro" href="https://www.nestlehealthscience.ro/produse"/>
       <xhtml:link rel="alternate" hreflang="de-de" href="https://www.nestlehealthscience.de/marken"/>
       <xhtml:link rel="alternate" hreflang="da-dk" href="https://www.nestlehealthscience.dk/produkter"/>
       <xhtml:link rel="alternate" hreflang="en-in" href="https://www.nestlehealthscience.in/brands"/>
       <xhtml:link rel="alternate" hreflang="de-ch" href="https://www.nestlehealthscience.ch/de/marken"/>
       <xhtml:link rel="alternate" hreflang="fr-ch" href="https://www.nestlehealthscience.ch/fr/nos-marques"/>
       <xhtml:link rel="alternate" hreflang="id-id" href="https://www.nestlehealthscience.co.id/brands"/>
       <xhtml:link rel="alternate" hreflang="it-it" href="https://www.nestlehealthscience.it/prodotti"/>
       <xhtml:link rel="alternate" hreflang="pl-pl" href="https://www.nestlehealthscience.pl/produkty"/>
       <xhtml:link rel="alternate" hreflang="en-za" href="https://www.nestlehealthscience.co.za/brands"/>
       <xhtml:link rel="alternate" hreflang="en-my" href="https://www.nestlehealthscience.my/brands"/>
       <xhtml:link rel="alternate" hreflang="vi-vn" href="https://www.nestlehealthscience.vn/san-pham"/>
       <xhtml:link rel="alternate" hreflang="cs-cz" href="https://www.nestlehealthscience.cz/cz/produkty"/>
       <xhtml:link rel="alternate" hreflang="sk-cz" href="https://www.nestlehealthscience.cz/sk/produkty"/>
       <xhtml:link rel="alternate" hreflang="en-sg" href="https://www.nestlehealthscience.sg/brands"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-cn" href="https://www.nestlehealthscience.cn/brands"/>
       <xhtml:link rel="alternate" hreflang="en-ph" href="https://www.nestlehealthscience.ph/brands"/>
       <xhtml:link rel="alternate" hreflang="ru-ru" href="https://www.nestlehealthscience.ru/brands"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-tw" href="https://www.nestlehealthscience.com.tw/brands"/>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
       </url>
       <url>
       <loc>https://www.nestlehealthscience.nl/fr/producten</loc>
       <xhtml:link rel="alternate" hreflang="fr-nl" href="https://www.nestlehealthscience.nl/fr/producten"/>
       <xhtml:link rel="alternate" hreflang="nl-nl" href="https://www.nestlehealthscience.nl/nl/producten"/>
        <xhtml:link rel="alternate" hreflang="en" href="https://www.nestlehealthscience.com/brands"/>
      <xhtml:link rel="alternate" hreflang="en-ca" href="https://www.nestlehealthscience.ca/en/brands"/>
      <xhtml:link rel="alternate" hreflang="fr-ca" href="https://www.nestlehealthscience.ca/fr/marques/home"/>
       <xhtml:link rel="alternate" hreflang="en-gb" href="https://www.nestlehealthscience.co.uk/brands"/>
       <xhtml:link rel="alternate" hreflang="pt-br" href="https://www.nestlehealthscience.com.br/marcas"/>
       <xhtml:link rel="alternate" hreflang="fi-fi" href="https://www.nestlehealthscience.fi/tuotteet"/>
       <xhtml:link rel="alternate" hreflang="pt-pt" href="http://nestlehealthscience.pt/marcas"/>
       <xhtml:link rel="alternate" hreflang="th-th" href="https://www.nestlehealthscience-th.com"/>
       <xhtml:link rel="alternate" hreflang="tr-tr" href="https://www.nestlehealthscience.com.tr/brands"/>
       <xhtml:link rel="alternate" hreflang="en-ae" href="https://www.nestlehealthscience-me.com/en/brands"/>
       <xhtml:link rel="alternate" hreflang="es-mx" href="https://www.nestlehealthscience.com.mx/marcas"/>
       <xhtml:link rel="alternate" hreflang="fr-fr" href="https://www.nestlehealthscience.fr/nos-marques"/>
       <xhtml:link rel="alternate" hreflang="sv-se" href="https://www.nestlehealthscience.se/produkter"/>
       <xhtml:link rel="alternate" hreflang="en-lk" href="https://www.nestlehealthscience.lk/brands"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-hk" href="https://www.nestlehealthscience.com.hk/zh-hans/brands"/>
       <xhtml:link rel="alternate" hreflang="ja-jp" href="https://www.nestlehealthscience.jp/brands"/>
       <xhtml:link rel="alternate" hreflang="es-es" href="https://www.nestlehealthscience.es/marcas"/>
       <xhtml:link rel="alternate" hreflang="ro-ro" href="https://www.nestlehealthscience.ro/produse"/>
       <xhtml:link rel="alternate" hreflang="de-de" href="https://www.nestlehealthscience.de/marken"/>
       <xhtml:link rel="alternate" hreflang="da-dk" href="https://www.nestlehealthscience.dk/produkter"/>
       <xhtml:link rel="alternate" hreflang="en-in" href="https://www.nestlehealthscience.in/brands"/>
       <xhtml:link rel="alternate" hreflang="de-ch" href="https://www.nestlehealthscience.ch/de/marken"/>
       <xhtml:link rel="alternate" hreflang="fr-ch" href="https://www.nestlehealthscience.ch/fr/nos-marques"/>
       <xhtml:link rel="alternate" hreflang="id-id" href="https://www.nestlehealthscience.co.id/brands"/>
       <xhtml:link rel="alternate" hreflang="it-it" href="https://www.nestlehealthscience.it/prodotti"/>
       <xhtml:link rel="alternate" hreflang="pl-pl" href="https://www.nestlehealthscience.pl/produkty"/>
       <xhtml:link rel="alternate" hreflang="en-za" href="https://www.nestlehealthscience.co.za/brands"/>
       <xhtml:link rel="alternate" hreflang="en-my" href="https://www.nestlehealthscience.my/brands"/>
       <xhtml:link rel="alternate" hreflang="vi-vn" href="https://www.nestlehealthscience.vn/san-pham"/>
       <xhtml:link rel="alternate" hreflang="cs-cz" href="https://www.nestlehealthscience.cz/cz/produkty"/>
       <xhtml:link rel="alternate" hreflang="sk-cz" href="https://www.nestlehealthscience.cz/sk/produkty"/>
       <xhtml:link rel="alternate" hreflang="en-sg" href="https://www.nestlehealthscience.sg/brands"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-cn" href="https://www.nestlehealthscience.cn/brands"/>
       <xhtml:link rel="alternate" hreflang="en-ph" href="https://www.nestlehealthscience.ph/brands"/>
       <xhtml:link rel="alternate" hreflang="ru-ru" href="https://www.nestlehealthscience.ru/brands"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-tw" href="https://www.nestlehealthscience.com.tw/brands"/>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
       </url>
      </urlset>';
    }


    public function philippines()
    {

      return '<?xml version="1.0" encoding="UTF-8"?>
      <urlset
          xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
          xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd
          http://www.w3.org/1999/xhtml http://www.w3.org/2002/08/xhtml/xhtml1-strict.xsd"
          xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
          xmlns:xhtml="http://www.w3.org/1999/xhtml"   
      >
      <url>
        <loc>https://www.nestlehealthscience.ph</loc>
       <xhtml:link rel="alternate" hreflang="en-ph" href="https://www.nestlehealthscience.ph"/>
       <xhtml:link rel="alternate" hreflang="en" href="https://www.nestlehealthscience.com"/>
      <xhtml:link rel="alternate" hreflang="en-us" href="https://www.nestlehealthscience.us"/>
      <xhtml:link rel="alternate" hreflang="en-ca" href="https://www.nestlehealthscience.ca/en"/>
      <xhtml:link rel="alternate" hreflang="fr-ca" href="https://www.nestlehealthscience.ca/fr"/>
       <xhtml:link rel="alternate" hreflang="en-gb" href="https://www.nestlehealthscience.co.uk"/>
       <xhtml:link rel="alternate" hreflang="pt-br" href="https://www.nestlehealthscience.com.br"/>
       <xhtml:link rel="alternate" hreflang="fi-fi" href="https://www.nestlehealthscience.fi"/>
       <xhtml:link rel="alternate" hreflang="pt-pt" href="https://www.nestlehealthscience.pt"/>
       <xhtml:link rel="alternate" hreflang="th-th" href="https://www.nestlehealthscience-th.com"/>
       <xhtml:link rel="alternate" hreflang="tr-tr" href="https://www.nestlehealthscience.com.tr"/>
       <xhtml:link rel="alternate" hreflang="en-ae" href="https://www.nestlehealthscience-me.com"/>
       <xhtml:link rel="alternate" hreflang="es-mx" href="https://www.nestlehealthscience.com.mx"/>
       <xhtml:link rel="alternate" hreflang="fr-fr" href="https://www.nestlehealthscience.fr"/>
       <xhtml:link rel="alternate" hreflang="sv-se" href="https://www.nestlehealthscience.se"/>
       <xhtml:link rel="alternate" hreflang="en-lk" href="https://www.nestlehealthscience.lk"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-hk" href="https://www.nestlehealthscience.com.hk"/>
       <xhtml:link rel="alternate" hreflang="ja-jp" href="https://www.nestlehealthscience.jp"/>
       <xhtml:link rel="alternate" hreflang="es-es" href="https://www.nestlehealthscience.es"/>
       <xhtml:link rel="alternate" hreflang="ro-ro" href="https://www.nestlehealthscience.ro"/>
       <xhtml:link rel="alternate" hreflang="de-de" href="https://www.nestlehealthscience.de"/>
       <xhtml:link rel="alternate" hreflang="da-dk" href="https://www.nestlehealthscience.dk"/>
       <xhtml:link rel="alternate" hreflang="en-in" href="https://www.nestlehealthscience.in"/>
       <xhtml:link rel="alternate" hreflang="de-ch" href="https://www.nestlehealthscience.ch/de"/>
       <xhtml:link rel="alternate" hreflang="fr-ch" href="https://www.nestlehealthscience.ch/fr"/>
       <xhtml:link rel="alternate" hreflang="id-id" href="https://www.nestlehealthscience.co.id"/>
       <xhtml:link rel="alternate" hreflang="it-it" href="https://www.nestlehealthscience.it"/>
       <xhtml:link rel="alternate" hreflang="pl-pl" href="https://www.nestlehealthscience.pl"/>
       <xhtml:link rel="alternate" hreflang="en-za" href="https://www.nestlehealthscience.co.za"/>
       <xhtml:link rel="alternate" hreflang="en-my" href="https://www.nestlehealthscience.my"/>
       <xhtml:link rel="alternate" hreflang="vi-vn" href="https://www.nestlehealthscience.vn"/>
       <xhtml:link rel="alternate" hreflang="cs-cz" href="https://www.nestlehealthscience.cz/cz"/>
       <xhtml:link rel="alternate" hreflang="sk-cz" href="https://www.nestlehealthscience.cz/sk"/>
       <xhtml:link rel="alternate" hreflang="en-sg" href="https://www.nestlehealthscience.sg"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-cn" href="https://www.nestlehealthscience.cn/"/>
       <xhtml:link rel="alternate" hreflang="ru-ru" href="https://www.nestlehealthscience.ru/"/>
       <xhtml:link rel="alternate" hreflang="nl-nl" href="https://www.nestlehealthscience.nl/nl"/>
       <xhtml:link rel="alternate" hreflang="fr-nl" href="https://www.nestlehealthscience.nl/fr"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-tw" href="https://www.nestlehealthscience.com.tw"/>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
       </url>
       <url>
       <loc>https://www.nestlehealthscience.ph/brands</loc>
       <xhtml:link rel="alternate" hreflang="en-ph" href="https://www.nestlehealthscience.ph/brands"/>
        <xhtml:link rel="alternate" hreflang="en" href="https://www.nestlehealthscience.com/brands"/>
      <xhtml:link rel="alternate" hreflang="en-ca" href="https://www.nestlehealthscience.ca/en/brands"/>
      <xhtml:link rel="alternate" hreflang="fr-ca" href="https://www.nestlehealthscience.ca/fr/marques/home"/>
       <xhtml:link rel="alternate" hreflang="en-gb" href="https://www.nestlehealthscience.co.uk/brands"/>
       <xhtml:link rel="alternate" hreflang="pt-br" href="https://www.nestlehealthscience.com.br/marcas"/>
       <xhtml:link rel="alternate" hreflang="fi-fi" href="https://www.nestlehealthscience.fi/tuotteet"/>
       <xhtml:link rel="alternate" hreflang="pt-pt" href="http://nestlehealthscience.pt/marcas"/>
       <xhtml:link rel="alternate" hreflang="th-th" href="https://www.nestlehealthscience-th.com"/>
       <xhtml:link rel="alternate" hreflang="tr-tr" href="https://www.nestlehealthscience.com.tr/brands"/>
       <xhtml:link rel="alternate" hreflang="en-ae" href="https://www.nestlehealthscience-me.com/en/brands"/>
       <xhtml:link rel="alternate" hreflang="es-mx" href="https://www.nestlehealthscience.com.mx/marcas"/>
       <xhtml:link rel="alternate" hreflang="fr-fr" href="https://www.nestlehealthscience.fr/nos-marques"/>
       <xhtml:link rel="alternate" hreflang="sv-se" href="https://www.nestlehealthscience.se/produkter"/>
       <xhtml:link rel="alternate" hreflang="en-lk" href="https://www.nestlehealthscience.lk/brands"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-hk" href="https://www.nestlehealthscience.com.hk/zh-hans/brands"/>
       <xhtml:link rel="alternate" hreflang="ja-jp" href="https://www.nestlehealthscience.jp/brands"/>
       <xhtml:link rel="alternate" hreflang="es-es" href="https://www.nestlehealthscience.es/marcas"/>
       <xhtml:link rel="alternate" hreflang="ro-ro" href="https://www.nestlehealthscience.ro/produse"/>
       <xhtml:link rel="alternate" hreflang="de-de" href="https://www.nestlehealthscience.de/marken"/>
       <xhtml:link rel="alternate" hreflang="da-dk" href="https://www.nestlehealthscience.dk/produkter"/>
       <xhtml:link rel="alternate" hreflang="en-in" href="https://www.nestlehealthscience.in/brands"/>
       <xhtml:link rel="alternate" hreflang="de-ch" href="https://www.nestlehealthscience.ch/de/marken"/>
       <xhtml:link rel="alternate" hreflang="fr-ch" href="https://www.nestlehealthscience.ch/fr/nos-marques"/>
       <xhtml:link rel="alternate" hreflang="id-id" href="https://www.nestlehealthscience.co.id/brands"/>
       <xhtml:link rel="alternate" hreflang="it-it" href="https://www.nestlehealthscience.it/prodotti"/>
       <xhtml:link rel="alternate" hreflang="pl-pl" href="https://www.nestlehealthscience.pl/produkty"/>
       <xhtml:link rel="alternate" hreflang="en-za" href="https://www.nestlehealthscience.co.za/brands"/>
       <xhtml:link rel="alternate" hreflang="en-my" href="https://www.nestlehealthscience.my/brands"/>
       <xhtml:link rel="alternate" hreflang="vi-vn" href="https://www.nestlehealthscience.vn/san-pham"/>
       <xhtml:link rel="alternate" hreflang="cs-cz" href="https://www.nestlehealthscience.cz/cz/produkty"/>
       <xhtml:link rel="alternate" hreflang="sk-cz" href="https://www.nestlehealthscience.cz/sk/produkty"/>
       <xhtml:link rel="alternate" hreflang="en-sg" href="https://www.nestlehealthscience.sg/brands"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-cn" href="https://www.nestlehealthscience.cn/brands"/>
       <xhtml:link rel="alternate" hreflang="ru-ru" href="https://www.nestlehealthscience.ru/brands"/>
       <xhtml:link rel="alternate" hreflang="nl-nl" href="https://www.nestlehealthscience.nl/nl/producten"/>
       <xhtml:link rel="alternate" hreflang="fr-nl" href="https://www.nestlehealthscience.nl/fr/producten"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-tw" href="https://www.nestlehealthscience.com.tw/brands"/>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
       </url>
      </urlset>';
    }


    public function poland()
    {
      return '<?xml version="1.0" encoding="UTF-8"?>
      <urlset
          xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
          xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd
          http://www.w3.org/1999/xhtml http://www.w3.org/2002/08/xhtml/xhtml1-strict.xsd"
          xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
          xmlns:xhtml="http://www.w3.org/1999/xhtml"   
      >
      <url>
        <loc>https://www.nestlehealthscience.pl</loc>
       <xhtml:link rel="alternate" hreflang="pl-pl" href="https://www.nestlehealthscience.pl"/>
       <xhtml:link rel="alternate" hreflang="en" href="https://www.nestlehealthscience.com"/>
      <xhtml:link rel="alternate" hreflang="en-us" href="https://www.nestlehealthscience.us"/>
      <xhtml:link rel="alternate" hreflang="en-ca" href="https://www.nestlehealthscience.ca/en"/>
      <xhtml:link rel="alternate" hreflang="fr-ca" href="https://www.nestlehealthscience.ca/fr"/>
       <xhtml:link rel="alternate" hreflang="en-gb" href="https://www.nestlehealthscience.co.uk"/>
       <xhtml:link rel="alternate" hreflang="pt-br" href="https://www.nestlehealthscience.com.br"/>
       <xhtml:link rel="alternate" hreflang="fi-fi" href="https://www.nestlehealthscience.fi"/>
       <xhtml:link rel="alternate" hreflang="pt-pt" href="https://www.nestlehealthscience.pt"/>
       <xhtml:link rel="alternate" hreflang="th-th" href="https://www.nestlehealthscience-th.com"/>
       <xhtml:link rel="alternate" hreflang="tr-tr" href="https://www.nestlehealthscience.com.tr"/>
       <xhtml:link rel="alternate" hreflang="en-ae" href="https://www.nestlehealthscience-me.com"/>
       <xhtml:link rel="alternate" hreflang="es-mx" href="https://www.nestlehealthscience.com.mx"/>
       <xhtml:link rel="alternate" hreflang="fr-fr" href="https://www.nestlehealthscience.fr"/>
       <xhtml:link rel="alternate" hreflang="sv-se" href="https://www.nestlehealthscience.se"/>
       <xhtml:link rel="alternate" hreflang="en-lk" href="https://www.nestlehealthscience.lk"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-hk" href="https://www.nestlehealthscience.com.hk"/>
       <xhtml:link rel="alternate" hreflang="ja-jp" href="https://www.nestlehealthscience.jp"/>
       <xhtml:link rel="alternate" hreflang="es-es" href="https://www.nestlehealthscience.es"/>
       <xhtml:link rel="alternate" hreflang="ro-ro" href="https://www.nestlehealthscience.ro"/>
       <xhtml:link rel="alternate" hreflang="de-de" href="https://www.nestlehealthscience.de"/>
       <xhtml:link rel="alternate" hreflang="da-dk" href="https://www.nestlehealthscience.dk"/>
       <xhtml:link rel="alternate" hreflang="en-in" href="https://www.nestlehealthscience.in"/>
       <xhtml:link rel="alternate" hreflang="de-ch" href="https://www.nestlehealthscience.ch/de"/>
       <xhtml:link rel="alternate" hreflang="fr-ch" href="https://www.nestlehealthscience.ch/fr"/>
       <xhtml:link rel="alternate" hreflang="id-id" href="https://www.nestlehealthscience.co.id"/>
       <xhtml:link rel="alternate" hreflang="it-it" href="https://www.nestlehealthscience.it"/>
       <xhtml:link rel="alternate" hreflang="en-za" href="https://www.nestlehealthscience.co.za"/>
       <xhtml:link rel="alternate" hreflang="en-my" href="https://www.nestlehealthscience.my"/>
       <xhtml:link rel="alternate" hreflang="vi-vn" href="https://www.nestlehealthscience.vn"/>
       <xhtml:link rel="alternate" hreflang="cs-cz" href="https://www.nestlehealthscience.cz/cz"/>
       <xhtml:link rel="alternate" hreflang="sk-cz" href="https://www.nestlehealthscience.cz/sk"/>
       <xhtml:link rel="alternate" hreflang="en-sg" href="https://www.nestlehealthscience.sg"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-cn" href="https://www.nestlehealthscience.cn/"/>
       <xhtml:link rel="alternate" hreflang="en-ph" href="https://www.nestlehealthscience.ph/"/>
       <xhtml:link rel="alternate" hreflang="ru-ru" href="https://www.nestlehealthscience.ru/"/>
       <xhtml:link rel="alternate" hreflang="nl-nl" href="https://www.nestlehealthscience.nl/nl"/>
       <xhtml:link rel="alternate" hreflang="fr-nl" href="https://www.nestlehealthscience.nl/fr"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-tw" href="https://www.nestlehealthscience.com.tw"/>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
       </url>
       <url>
       <loc>https://www.nestlehealthscience.pl/produkty</loc>
       <xhtml:link rel="alternate" hreflang="pl-pl" href="https://www.nestlehealthscience.pl/produkty"/>
        <xhtml:link rel="alternate" hreflang="en" href="https://www.nestlehealthscience.com/brands"/>
      <xhtml:link rel="alternate" hreflang="en-ca" href="https://www.nestlehealthscience.ca/en/brands"/>
      <xhtml:link rel="alternate" hreflang="fr-ca" href="https://www.nestlehealthscience.ca/fr/marques/home"/>
       <xhtml:link rel="alternate" hreflang="en-gb" href="https://www.nestlehealthscience.co.uk/brands"/>
       <xhtml:link rel="alternate" hreflang="pt-br" href="https://www.nestlehealthscience.com.br/marcas"/>
       <xhtml:link rel="alternate" hreflang="fi-fi" href="https://www.nestlehealthscience.fi/tuotteet"/>
       <xhtml:link rel="alternate" hreflang="pt-pt" href="http://nestlehealthscience.pt/marcas"/>
       <xhtml:link rel="alternate" hreflang="th-th" href="https://www.nestlehealthscience-th.com"/>
       <xhtml:link rel="alternate" hreflang="tr-tr" href="https://www.nestlehealthscience.com.tr/brands"/>
       <xhtml:link rel="alternate" hreflang="en-ae" href="https://www.nestlehealthscience-me.com/en/brands"/>
       <xhtml:link rel="alternate" hreflang="es-mx" href="https://www.nestlehealthscience.com.mx/marcas"/>
       <xhtml:link rel="alternate" hreflang="fr-fr" href="https://www.nestlehealthscience.fr/nos-marques"/>
       <xhtml:link rel="alternate" hreflang="sv-se" href="https://www.nestlehealthscience.se/produkter"/>
       <xhtml:link rel="alternate" hreflang="en-lk" href="https://www.nestlehealthscience.lk/brands"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-hk" href="https://www.nestlehealthscience.com.hk/zh-hans/brands"/>
       <xhtml:link rel="alternate" hreflang="ja-jp" href="https://www.nestlehealthscience.jp/brands"/>
       <xhtml:link rel="alternate" hreflang="es-es" href="https://www.nestlehealthscience.es/marcas"/>
       <xhtml:link rel="alternate" hreflang="ro-ro" href="https://www.nestlehealthscience.ro/produse"/>
       <xhtml:link rel="alternate" hreflang="de-de" href="https://www.nestlehealthscience.de/marken"/>
       <xhtml:link rel="alternate" hreflang="da-dk" href="https://www.nestlehealthscience.dk/produkter"/>
       <xhtml:link rel="alternate" hreflang="en-in" href="https://www.nestlehealthscience.in/brands"/>
       <xhtml:link rel="alternate" hreflang="de-ch" href="https://www.nestlehealthscience.ch/de/marken"/>
       <xhtml:link rel="alternate" hreflang="fr-ch" href="https://www.nestlehealthscience.ch/fr/nos-marques"/>
       <xhtml:link rel="alternate" hreflang="id-id" href="https://www.nestlehealthscience.co.id/brands"/>
       <xhtml:link rel="alternate" hreflang="it-it" href="https://www.nestlehealthscience.it/prodotti"/>
       <xhtml:link rel="alternate" hreflang="en-za" href="https://www.nestlehealthscience.co.za/brands"/>
       <xhtml:link rel="alternate" hreflang="en-my" href="https://www.nestlehealthscience.my/brands"/>
       <xhtml:link rel="alternate" hreflang="vi-vn" href="https://www.nestlehealthscience.vn/san-pham"/>
       <xhtml:link rel="alternate" hreflang="cs-cz" href="https://www.nestlehealthscience.cz/cz/produkty"/>
       <xhtml:link rel="alternate" hreflang="sk-cz" href="https://www.nestlehealthscience.cz/sk/produkty"/>
       <xhtml:link rel="alternate" hreflang="en-sg" href="https://www.nestlehealthscience.sg/brands"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-cn" href="https://www.nestlehealthscience.cn/brands"/>
       <xhtml:link rel="alternate" hreflang="en-ph" href="https://www.nestlehealthscience.ph/brands"/>
       <xhtml:link rel="alternate" hreflang="ru-ru" href="https://www.nestlehealthscience.ru/brands"/>
       <xhtml:link rel="alternate" hreflang="nl-nl" href="https://www.nestlehealthscience.nl/nl/producten"/>
       <xhtml:link rel="alternate" hreflang="fr-nl" href="https://www.nestlehealthscience.nl/fr/producten"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-tw" href="https://www.nestlehealthscience.com.tw/brands"/>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
       </url>
      </urlset>';
    }

    public function portugal()
    {
       return '<?xml version="1.0" encoding="UTF-8"?>
       <urlset
           xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
           xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd
           http://www.w3.org/1999/xhtml http://www.w3.org/2002/08/xhtml/xhtml1-strict.xsd"
           xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
           xmlns:xhtml="http://www.w3.org/1999/xhtml"   
       >
       <url>
         <loc>https://www.nestlehealthscience.pt/</loc>
        <xhtml:link rel="alternate" hreflang="pt-pt" href="https://www.nestlehealthscience.pt"/>
        <xhtml:link rel="alternate" hreflang="en" href="https://www.nestlehealthscience.com"/>
       <xhtml:link rel="alternate" hreflang="en-us" href="https://www.nestlehealthscience.us"/>
       <xhtml:link rel="alternate" hreflang="en-ca" href="https://www.nestlehealthscience.ca/en"/>
       <xhtml:link rel="alternate" hreflang="fr-ca" href="https://www.nestlehealthscience.ca/fr"/>
        <xhtml:link rel="alternate" hreflang="en-gb" href="https://www.nestlehealthscience.co.uk"/>
        <xhtml:link rel="alternate" hreflang="pt-br" href="https://www.nestlehealthscience.com.br"/>
        <xhtml:link rel="alternate" hreflang="fi-fi" href="https://www.nestlehealthscience.fi"/>
        <xhtml:link rel="alternate" hreflang="th-th" href="https://www.nestlehealthscience-th.com"/>
        <xhtml:link rel="alternate" hreflang="tr-tr" href="https://www.nestlehealthscience.com.tr"/>
        <xhtml:link rel="alternate" hreflang="en-ae" href="https://www.nestlehealthscience-me.com"/>
        <xhtml:link rel="alternate" hreflang="es-mx" href="https://www.nestlehealthscience.com.mx"/>
        <xhtml:link rel="alternate" hreflang="fr-fr" href="https://www.nestlehealthscience.fr"/>
        <xhtml:link rel="alternate" hreflang="sv-se" href="https://www.nestlehealthscience.se"/>
        <xhtml:link rel="alternate" hreflang="en-lk" href="https://www.nestlehealthscience.lk"/>
        <xhtml:link rel="alternate" hreflang="zh-hans-hk" href="https://www.nestlehealthscience.com.hk"/>
        <xhtml:link rel="alternate" hreflang="ja-jp" href="https://www.nestlehealthscience.jp"/>
        <xhtml:link rel="alternate" hreflang="es-es" href="https://www.nestlehealthscience.es"/>
        <xhtml:link rel="alternate" hreflang="ro-ro" href="https://www.nestlehealthscience.ro"/>
        <xhtml:link rel="alternate" hreflang="de-de" href="https://www.nestlehealthscience.de"/>
        <xhtml:link rel="alternate" hreflang="da-dk" href="https://www.nestlehealthscience.dk"/>
        <xhtml:link rel="alternate" hreflang="en-in" href="https://www.nestlehealthscience.in"/>
        <xhtml:link rel="alternate" hreflang="de-ch" href="https://www.nestlehealthscience.ch/de"/>
        <xhtml:link rel="alternate" hreflang="fr-ch" href="https://www.nestlehealthscience.ch/fr"/>
        <xhtml:link rel="alternate" hreflang="id-id" href="https://www.nestlehealthscience.co.id"/>
        <xhtml:link rel="alternate" hreflang="it-it" href="https://www.nestlehealthscience.it"/>
        <xhtml:link rel="alternate" hreflang="pl-pl" href="https://www.nestlehealthscience.pl"/>
        <xhtml:link rel="alternate" hreflang="en-za" href="https://www.nestlehealthscience.co.za"/>
        <xhtml:link rel="alternate" hreflang="en-my" href="https://www.nestlehealthscience.my"/>
        <xhtml:link rel="alternate" hreflang="vi-vn" href="https://www.nestlehealthscience.vn"/>
        <xhtml:link rel="alternate" hreflang="cs-cz" href="https://www.nestlehealthscience.cz/cz"/>
        <xhtml:link rel="alternate" hreflang="sk-cz" href="https://www.nestlehealthscience.cz/sk"/>
        <xhtml:link rel="alternate" hreflang="en-sg" href="https://www.nestlehealthscience.sg"/>
        <xhtml:link rel="alternate" hreflang="zh-hans-cn" href="https://www.nestlehealthscience.cn/"/>
        <xhtml:link rel="alternate" hreflang="en-ph" href="https://www.nestlehealthscience.ph/"/>
        <xhtml:link rel="alternate" hreflang="ru-ru" href="https://www.nestlehealthscience.ru/"/>
        <xhtml:link rel="alternate" hreflang="nl-nl" href="https://www.nestlehealthscience.nl/nl"/>
        <xhtml:link rel="alternate" hreflang="fr-nl" href="https://www.nestlehealthscience.nl/fr"/>
        <xhtml:link rel="alternate" hreflang="zh-hans-tw" href="https://www.nestlehealthscience.com.tw"/>
         <changefreq>daily</changefreq>
         <priority>1.0</priority>
        </url>
        <url>
        <loc>https://www.nestlehealthscience.pt/marcas</loc>
        <xhtml:link rel="alternate" hreflang="pt-pt" href="http://nestlehealthscience.pt/marcas"/>
         <xhtml:link rel="alternate" hreflang="en" href="https://www.nestlehealthscience.com/brands"/>
       <xhtml:link rel="alternate" hreflang="en-ca" href="https://www.nestlehealthscience.ca/en/brands"/>
       <xhtml:link rel="alternate" hreflang="fr-ca" href="https://www.nestlehealthscience.ca/fr/marques/home"/>
        <xhtml:link rel="alternate" hreflang="en-gb" href="https://www.nestlehealthscience.co.uk/brands"/>
        <xhtml:link rel="alternate" hreflang="pt-br" href="https://www.nestlehealthscience.com.br/marcas"/>
        <xhtml:link rel="alternate" hreflang="fi-fi" href="https://www.nestlehealthscience.fi/tuotteet"/>
        <xhtml:link rel="alternate" hreflang="th-th" href="https://www.nestlehealthscience-th.com"/>
        <xhtml:link rel="alternate" hreflang="tr-tr" href="https://www.nestlehealthscience.com.tr/brands"/>
        <xhtml:link rel="alternate" hreflang="en-ae" href="https://www.nestlehealthscience-me.com/en/brands"/>
        <xhtml:link rel="alternate" hreflang="es-mx" href="https://www.nestlehealthscience.com.mx/marcas"/>
        <xhtml:link rel="alternate" hreflang="fr-fr" href="https://www.nestlehealthscience.fr/nos-marques"/>
        <xhtml:link rel="alternate" hreflang="sv-se" href="https://www.nestlehealthscience.se/produkter"/>
        <xhtml:link rel="alternate" hreflang="en-lk" href="https://www.nestlehealthscience.lk/brands"/>
        <xhtml:link rel="alternate" hreflang="zh-hans-hk" href="https://www.nestlehealthscience.com.hk/zh-hans/brands"/>
        <xhtml:link rel="alternate" hreflang="ja-jp" href="https://www.nestlehealthscience.jp/brands"/>
        <xhtml:link rel="alternate" hreflang="es-es" href="https://www.nestlehealthscience.es/marcas"/>
        <xhtml:link rel="alternate" hreflang="ro-ro" href="https://www.nestlehealthscience.ro/produse"/>
        <xhtml:link rel="alternate" hreflang="de-de" href="https://www.nestlehealthscience.de/marken"/>
        <xhtml:link rel="alternate" hreflang="da-dk" href="https://www.nestlehealthscience.dk/produkter"/>
        <xhtml:link rel="alternate" hreflang="en-in" href="https://www.nestlehealthscience.in/brands"/>
        <xhtml:link rel="alternate" hreflang="de-ch" href="https://www.nestlehealthscience.ch/de/marken"/>
        <xhtml:link rel="alternate" hreflang="fr-ch" href="https://www.nestlehealthscience.ch/fr/nos-marques"/>
        <xhtml:link rel="alternate" hreflang="id-id" href="https://www.nestlehealthscience.co.id/brands"/>
        <xhtml:link rel="alternate" hreflang="it-it" href="https://www.nestlehealthscience.it/prodotti"/>
        <xhtml:link rel="alternate" hreflang="pl-pl" href="https://www.nestlehealthscience.pl/produkty"/>
        <xhtml:link rel="alternate" hreflang="en-za" href="https://www.nestlehealthscience.co.za/brands"/>
        <xhtml:link rel="alternate" hreflang="en-my" href="https://www.nestlehealthscience.my/brands"/>
        <xhtml:link rel="alternate" hreflang="vi-vn" href="https://www.nestlehealthscience.vn/san-pham"/>
        <xhtml:link rel="alternate" hreflang="cs-cz" href="https://www.nestlehealthscience.cz/cz/produkty"/>
        <xhtml:link rel="alternate" hreflang="sk-cz" href="https://www.nestlehealthscience.cz/sk/produkty"/>
        <xhtml:link rel="alternate" hreflang="en-sg" href="https://www.nestlehealthscience.sg/brands"/>
        <xhtml:link rel="alternate" hreflang="zh-hans-cn" href="https://www.nestlehealthscience.cn/brands"/>
        <xhtml:link rel="alternate" hreflang="en-ph" href="https://www.nestlehealthscience.ph/brands"/>
        <xhtml:link rel="alternate" hreflang="ru-ru" href="https://www.nestlehealthscience.ru/brands"/>
        <xhtml:link rel="alternate" hreflang="nl-nl" href="https://www.nestlehealthscience.nl/nl/producten"/>
        <xhtml:link rel="alternate" hreflang="fr-nl" href="https://www.nestlehealthscience.nl/fr/producten"/>
        <xhtml:link rel="alternate" hreflang="zh-hans-tw" href="https://www.nestlehealthscience.com.tw/brands"/>
         <changefreq>daily</changefreq>
         <priority>1.0</priority>
        </url>
       </urlset>';
    }

    public function romania()
    {
      return '<?xml version="1.0" encoding="UTF-8"?>
      <urlset
          xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
          xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd
          http://www.w3.org/1999/xhtml http://www.w3.org/2002/08/xhtml/xhtml1-strict.xsd"
          xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
          xmlns:xhtml="http://www.w3.org/1999/xhtml"   
      >
      <url>
        <loc>https://www.nestlehealthscience.ro</loc>
       <xhtml:link rel="alternate" hreflang="ro-ro" href="https://www.nestlehealthscience.ro"/>
       <xhtml:link rel="alternate" hreflang="en" href="https://www.nestlehealthscience.com"/>
      <xhtml:link rel="alternate" hreflang="en-us" href="https://www.nestlehealthscience.us"/>
      <xhtml:link rel="alternate" hreflang="en-ca" href="https://www.nestlehealthscience.ca/en"/>
      <xhtml:link rel="alternate" hreflang="fr-ca" href="https://www.nestlehealthscience.ca/fr"/>
       <xhtml:link rel="alternate" hreflang="en-gb" href="https://www.nestlehealthscience.co.uk"/>
       <xhtml:link rel="alternate" hreflang="pt-br" href="https://www.nestlehealthscience.com.br"/>
       <xhtml:link rel="alternate" hreflang="fi-fi" href="https://www.nestlehealthscience.fi"/>
       <xhtml:link rel="alternate" hreflang="pt-pt" href="https://www.nestlehealthscience.pt"/>
       <xhtml:link rel="alternate" hreflang="th-th" href="https://www.nestlehealthscience-th.com"/>
       <xhtml:link rel="alternate" hreflang="tr-tr" href="https://www.nestlehealthscience.com.tr"/>
       <xhtml:link rel="alternate" hreflang="en-ae" href="https://www.nestlehealthscience-me.com"/>
       <xhtml:link rel="alternate" hreflang="es-mx" href="https://www.nestlehealthscience.com.mx"/>
       <xhtml:link rel="alternate" hreflang="fr-fr" href="https://www.nestlehealthscience.fr"/>
       <xhtml:link rel="alternate" hreflang="sv-se" href="https://www.nestlehealthscience.se"/>
       <xhtml:link rel="alternate" hreflang="en-lk" href="https://www.nestlehealthscience.lk"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-hk" href="https://www.nestlehealthscience.com.hk"/>
       <xhtml:link rel="alternate" hreflang="ja-jp" href="https://www.nestlehealthscience.jp"/>
       <xhtml:link rel="alternate" hreflang="es-es" href="https://www.nestlehealthscience.es"/>
       <xhtml:link rel="alternate" hreflang="de-de" href="https://www.nestlehealthscience.de"/>
       <xhtml:link rel="alternate" hreflang="da-dk" href="https://www.nestlehealthscience.dk"/>
       <xhtml:link rel="alternate" hreflang="en-in" href="https://www.nestlehealthscience.in"/>
       <xhtml:link rel="alternate" hreflang="de-ch" href="https://www.nestlehealthscience.ch/de"/>
       <xhtml:link rel="alternate" hreflang="fr-ch" href="https://www.nestlehealthscience.ch/fr"/>
       <xhtml:link rel="alternate" hreflang="id-id" href="https://www.nestlehealthscience.co.id"/>
       <xhtml:link rel="alternate" hreflang="it-it" href="https://www.nestlehealthscience.it"/>
       <xhtml:link rel="alternate" hreflang="pl-pl" href="https://www.nestlehealthscience.pl"/>
       <xhtml:link rel="alternate" hreflang="en-za" href="https://www.nestlehealthscience.co.za"/>
       <xhtml:link rel="alternate" hreflang="en-my" href="https://www.nestlehealthscience.my"/>
       <xhtml:link rel="alternate" hreflang="vi-vn" href="https://www.nestlehealthscience.vn"/>
       <xhtml:link rel="alternate" hreflang="cs-cz" href="https://www.nestlehealthscience.cz/cz"/>
       <xhtml:link rel="alternate" hreflang="sk-cz" href="https://www.nestlehealthscience.cz/sk"/>
       <xhtml:link rel="alternate" hreflang="en-sg" href="https://www.nestlehealthscience.sg"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-cn" href="https://www.nestlehealthscience.cn/"/>
       <xhtml:link rel="alternate" hreflang="en-ph" href="https://www.nestlehealthscience.ph/"/>
       <xhtml:link rel="alternate" hreflang="ru-ru" href="https://www.nestlehealthscience.ru/"/>
       <xhtml:link rel="alternate" hreflang="nl-nl" href="https://www.nestlehealthscience.nl/nl"/>
       <xhtml:link rel="alternate" hreflang="fr-nl" href="https://www.nestlehealthscience.nl/fr"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-tw" href="https://www.nestlehealthscience.com.tw"/>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
       </url>
       <url>
       <loc>https://www.nestlehealthscience.ro/produse</loc>
       <xhtml:link rel="alternate" hreflang="ro-ro" href="https://www.nestlehealthscience.ro/produse"/>
        <xhtml:link rel="alternate" hreflang="en" href="https://www.nestlehealthscience.com/brands"/>
      <xhtml:link rel="alternate" hreflang="en-ca" href="https://www.nestlehealthscience.ca/en/brands"/>
      <xhtml:link rel="alternate" hreflang="fr-ca" href="https://www.nestlehealthscience.ca/fr/marques/home"/>
       <xhtml:link rel="alternate" hreflang="en-gb" href="https://www.nestlehealthscience.co.uk/brands"/>
       <xhtml:link rel="alternate" hreflang="pt-br" href="https://www.nestlehealthscience.com.br/marcas"/>
       <xhtml:link rel="alternate" hreflang="fi-fi" href="https://www.nestlehealthscience.fi/tuotteet"/>
       <xhtml:link rel="alternate" hreflang="pt-pt" href="http://nestlehealthscience.pt/marcas"/>
       <xhtml:link rel="alternate" hreflang="th-th" href="https://www.nestlehealthscience-th.com"/>
       <xhtml:link rel="alternate" hreflang="tr-tr" href="https://www.nestlehealthscience.com.tr/brands"/>
       <xhtml:link rel="alternate" hreflang="en-ae" href="https://www.nestlehealthscience-me.com/en/brands"/>
       <xhtml:link rel="alternate" hreflang="es-mx" href="https://www.nestlehealthscience.com.mx/marcas"/>
       <xhtml:link rel="alternate" hreflang="fr-fr" href="https://www.nestlehealthscience.fr/nos-marques"/>
       <xhtml:link rel="alternate" hreflang="sv-se" href="https://www.nestlehealthscience.se/produkter"/>
       <xhtml:link rel="alternate" hreflang="en-lk" href="https://www.nestlehealthscience.lk/brands"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-hk" href="https://www.nestlehealthscience.com.hk/zh-hans/brands"/>
       <xhtml:link rel="alternate" hreflang="ja-jp" href="https://www.nestlehealthscience.jp/brands"/>
       <xhtml:link rel="alternate" hreflang="es-es" href="https://www.nestlehealthscience.es/marcas"/>
       <xhtml:link rel="alternate" hreflang="de-de" href="https://www.nestlehealthscience.de/marken"/>
       <xhtml:link rel="alternate" hreflang="da-dk" href="https://www.nestlehealthscience.dk/produkter"/>
       <xhtml:link rel="alternate" hreflang="en-in" href="https://www.nestlehealthscience.in/brands"/>
       <xhtml:link rel="alternate" hreflang="de-ch" href="https://www.nestlehealthscience.ch/de/marken"/>
       <xhtml:link rel="alternate" hreflang="fr-ch" href="https://www.nestlehealthscience.ch/fr/nos-marques"/>
       <xhtml:link rel="alternate" hreflang="id-id" href="https://www.nestlehealthscience.co.id/brands"/>
       <xhtml:link rel="alternate" hreflang="it-it" href="https://www.nestlehealthscience.it/prodotti"/>
       <xhtml:link rel="alternate" hreflang="pl-pl" href="https://www.nestlehealthscience.pl/produkty"/>
       <xhtml:link rel="alternate" hreflang="en-za" href="https://www.nestlehealthscience.co.za/brands"/>
       <xhtml:link rel="alternate" hreflang="en-my" href="https://www.nestlehealthscience.my/brands"/>
       <xhtml:link rel="alternate" hreflang="vi-vn" href="https://www.nestlehealthscience.vn/san-pham"/>
       <xhtml:link rel="alternate" hreflang="cs-cz" href="https://www.nestlehealthscience.cz/cz/produkty"/>
       <xhtml:link rel="alternate" hreflang="sk-cz" href="https://www.nestlehealthscience.cz/sk/produkty"/>
       <xhtml:link rel="alternate" hreflang="en-sg" href="https://www.nestlehealthscience.sg/brands"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-cn" href="https://www.nestlehealthscience.cn/brands"/>
       <xhtml:link rel="alternate" hreflang="en-ph" href="https://www.nestlehealthscience.ph/brands"/>
       <xhtml:link rel="alternate" hreflang="ru-ru" href="https://www.nestlehealthscience.ru/brands"/>
       <xhtml:link rel="alternate" hreflang="nl-nl" href="https://www.nestlehealthscience.nl/nl/producten"/>
       <xhtml:link rel="alternate" hreflang="fr-nl" href="https://www.nestlehealthscience.nl/fr/producten"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-tw" href="https://www.nestlehealthscience.com.tw/brands"/>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
       </url>
      </urlset>';
    }


    public function russia(){

      return '<?xml version="1.0" encoding="UTF-8"?>
      <urlset
          xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
          xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd
          http://www.w3.org/1999/xhtml http://www.w3.org/2002/08/xhtml/xhtml1-strict.xsd"
          xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
          xmlns:xhtml="http://www.w3.org/1999/xhtml"   
      >
      <url>
        <loc>https://www.nestlehealthscience.ru</loc>
       <xhtml:link rel="alternate" hreflang="ru-ru" href="https://www.nestlehealthscience.ru"/>
       <xhtml:link rel="alternate" hreflang="en" href="https://www.nestlehealthscience.com"/>
      <xhtml:link rel="alternate" hreflang="en-us" href="https://www.nestlehealthscience.us"/>
      <xhtml:link rel="alternate" hreflang="en-ca" href="https://www.nestlehealthscience.ca/en"/>
      <xhtml:link rel="alternate" hreflang="fr-ca" href="https://www.nestlehealthscience.ca/fr"/>
       <xhtml:link rel="alternate" hreflang="en-gb" href="https://www.nestlehealthscience.co.uk"/>
       <xhtml:link rel="alternate" hreflang="pt-br" href="https://www.nestlehealthscience.com.br"/>
       <xhtml:link rel="alternate" hreflang="fi-fi" href="https://www.nestlehealthscience.fi"/>
       <xhtml:link rel="alternate" hreflang="pt-pt" href="https://www.nestlehealthscience.pt"/>
       <xhtml:link rel="alternate" hreflang="th-th" href="https://www.nestlehealthscience-th.com"/>
       <xhtml:link rel="alternate" hreflang="tr-tr" href="https://www.nestlehealthscience.com.tr"/>
       <xhtml:link rel="alternate" hreflang="en-ae" href="https://www.nestlehealthscience-me.com"/>
       <xhtml:link rel="alternate" hreflang="es-mx" href="https://www.nestlehealthscience.com.mx"/>
       <xhtml:link rel="alternate" hreflang="fr-fr" href="https://www.nestlehealthscience.fr"/>
       <xhtml:link rel="alternate" hreflang="sv-se" href="https://www.nestlehealthscience.se"/>
       <xhtml:link rel="alternate" hreflang="en-lk" href="https://www.nestlehealthscience.lk"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-hk" href="https://www.nestlehealthscience.com.hk"/>
       <xhtml:link rel="alternate" hreflang="ja-jp" href="https://www.nestlehealthscience.jp"/>
       <xhtml:link rel="alternate" hreflang="es-es" href="https://www.nestlehealthscience.es"/>
       <xhtml:link rel="alternate" hreflang="ro-ro" href="https://www.nestlehealthscience.ro"/>
       <xhtml:link rel="alternate" hreflang="de-de" href="https://www.nestlehealthscience.de"/>
       <xhtml:link rel="alternate" hreflang="da-dk" href="https://www.nestlehealthscience.dk"/>
       <xhtml:link rel="alternate" hreflang="en-in" href="https://www.nestlehealthscience.in"/>
       <xhtml:link rel="alternate" hreflang="de-ch" href="https://www.nestlehealthscience.ch/de"/>
       <xhtml:link rel="alternate" hreflang="fr-ch" href="https://www.nestlehealthscience.ch/fr"/>
       <xhtml:link rel="alternate" hreflang="id-id" href="https://www.nestlehealthscience.co.id"/>
       <xhtml:link rel="alternate" hreflang="it-it" href="https://www.nestlehealthscience.it"/>
       <xhtml:link rel="alternate" hreflang="pl-pl" href="https://www.nestlehealthscience.pl"/>
       <xhtml:link rel="alternate" hreflang="en-za" href="https://www.nestlehealthscience.co.za"/>
       <xhtml:link rel="alternate" hreflang="en-my" href="https://www.nestlehealthscience.my"/>
       <xhtml:link rel="alternate" hreflang="vi-vn" href="https://www.nestlehealthscience.vn"/>
       <xhtml:link rel="alternate" hreflang="cs-cz" href="https://www.nestlehealthscience.cz/cz"/>
       <xhtml:link rel="alternate" hreflang="sk-cz" href="https://www.nestlehealthscience.cz/sk"/>
       <xhtml:link rel="alternate" hreflang="en-sg" href="https://www.nestlehealthscience.sg"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-cn" href="https://www.nestlehealthscience.cn/"/>
       <xhtml:link rel="alternate" hreflang="en-ph" href="https://www.nestlehealthscience.ph/"/>
       <xhtml:link rel="alternate" hreflang="nl-nl" href="https://www.nestlehealthscience.nl/nl"/>
       <xhtml:link rel="alternate" hreflang="fr-nl" href="https://www.nestlehealthscience.nl/fr"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-tw" href="https://www.nestlehealthscience.com.tw"/>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
       </url>
       <url>
       <loc>https://www.nestlehealthscience.ru/brands</loc>
       <xhtml:link rel="alternate" hreflang="ru-ru" href="https://www.nestlehealthscience.ru/brands"/>
        <xhtml:link rel="alternate" hreflang="en" href="https://www.nestlehealthscience.com/brands"/>
      <xhtml:link rel="alternate" hreflang="en-ca" href="https://www.nestlehealthscience.ca/en/brands"/>
      <xhtml:link rel="alternate" hreflang="fr-ca" href="https://www.nestlehealthscience.ca/fr/marques/home"/>
       <xhtml:link rel="alternate" hreflang="en-gb" href="https://www.nestlehealthscience.co.uk/brands"/>
       <xhtml:link rel="alternate" hreflang="pt-br" href="https://www.nestlehealthscience.com.br/marcas"/>
       <xhtml:link rel="alternate" hreflang="fi-fi" href="https://www.nestlehealthscience.fi/tuotteet"/>
       <xhtml:link rel="alternate" hreflang="pt-pt" href="http://nestlehealthscience.pt/marcas"/>
       <xhtml:link rel="alternate" hreflang="th-th" href="https://www.nestlehealthscience-th.com"/>
       <xhtml:link rel="alternate" hreflang="tr-tr" href="https://www.nestlehealthscience.com.tr/brands"/>
       <xhtml:link rel="alternate" hreflang="en-ae" href="https://www.nestlehealthscience-me.com/en/brands"/>
       <xhtml:link rel="alternate" hreflang="es-mx" href="https://www.nestlehealthscience.com.mx/marcas"/>
       <xhtml:link rel="alternate" hreflang="fr-fr" href="https://www.nestlehealthscience.fr/nos-marques"/>
       <xhtml:link rel="alternate" hreflang="sv-se" href="https://www.nestlehealthscience.se/produkter"/>
       <xhtml:link rel="alternate" hreflang="en-lk" href="https://www.nestlehealthscience.lk/brands"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-hk" href="https://www.nestlehealthscience.com.hk/zh-hans/brands"/>
       <xhtml:link rel="alternate" hreflang="ja-jp" href="https://www.nestlehealthscience.jp/brands"/>
       <xhtml:link rel="alternate" hreflang="es-es" href="https://www.nestlehealthscience.es/marcas"/>
       <xhtml:link rel="alternate" hreflang="ro-ro" href="https://www.nestlehealthscience.ro/produse"/>
       <xhtml:link rel="alternate" hreflang="de-de" href="https://www.nestlehealthscience.de/marken"/>
       <xhtml:link rel="alternate" hreflang="da-dk" href="https://www.nestlehealthscience.dk/produkter"/>
       <xhtml:link rel="alternate" hreflang="en-in" href="https://www.nestlehealthscience.in/brands"/>
       <xhtml:link rel="alternate" hreflang="de-ch" href="https://www.nestlehealthscience.ch/de/marken"/>
       <xhtml:link rel="alternate" hreflang="fr-ch" href="https://www.nestlehealthscience.ch/fr/nos-marques"/>
       <xhtml:link rel="alternate" hreflang="id-id" href="https://www.nestlehealthscience.co.id/brands"/>
       <xhtml:link rel="alternate" hreflang="it-it" href="https://www.nestlehealthscience.it/prodotti"/>
       <xhtml:link rel="alternate" hreflang="pl-pl" href="https://www.nestlehealthscience.pl/produkty"/>
       <xhtml:link rel="alternate" hreflang="en-za" href="https://www.nestlehealthscience.co.za/brands"/>
       <xhtml:link rel="alternate" hreflang="en-my" href="https://www.nestlehealthscience.my/brands"/>
       <xhtml:link rel="alternate" hreflang="vi-vn" href="https://www.nestlehealthscience.vn/san-pham"/>
       <xhtml:link rel="alternate" hreflang="cs-cz" href="https://www.nestlehealthscience.cz/cz/produkty"/>
       <xhtml:link rel="alternate" hreflang="sk-cz" href="https://www.nestlehealthscience.cz/sk/produkty"/>
       <xhtml:link rel="alternate" hreflang="en-sg" href="https://www.nestlehealthscience.sg/brands"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-cn" href="https://www.nestlehealthscience.cn/brands"/>
       <xhtml:link rel="alternate" hreflang="en-ph" href="https://www.nestlehealthscience.ph/brands"/>
       <xhtml:link rel="alternate" hreflang="nl-nl" href="https://www.nestlehealthscience.nl/nl/producten"/>
       <xhtml:link rel="alternate" hreflang="fr-nl" href="https://www.nestlehealthscience.nl/fr/producten"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-tw" href="https://www.nestlehealthscience.com.tw/brands"/>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
       </url>
      </urlset>';
    }

    public function singapore()
    {
      return '<?xml version="1.0" encoding="UTF-8"?>
      <urlset
          xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
          xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd
          http://www.w3.org/1999/xhtml http://www.w3.org/2002/08/xhtml/xhtml1-strict.xsd"
          xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
          xmlns:xhtml="http://www.w3.org/1999/xhtml"   
      >
      <url>
        <loc>https://www.nestlehealthscience.sg</loc>
       <xhtml:link rel="alternate" hreflang="en-sg" href="https://www.nestlehealthscience.sg"/>
       <xhtml:link rel="alternate" hreflang="en" href="https://www.nestlehealthscience.com"/>
      <xhtml:link rel="alternate" hreflang="en-us" href="https://www.nestlehealthscience.us"/>
      <xhtml:link rel="alternate" hreflang="en-ca" href="https://www.nestlehealthscience.ca/en"/>
      <xhtml:link rel="alternate" hreflang="fr-ca" href="https://www.nestlehealthscience.ca/fr"/>
       <xhtml:link rel="alternate" hreflang="en-gb" href="https://www.nestlehealthscience.co.uk"/>
       <xhtml:link rel="alternate" hreflang="pt-br" href="https://www.nestlehealthscience.com.br"/>
       <xhtml:link rel="alternate" hreflang="fi-fi" href="https://www.nestlehealthscience.fi"/>
       <xhtml:link rel="alternate" hreflang="pt-pt" href="https://www.nestlehealthscience.pt"/>
       <xhtml:link rel="alternate" hreflang="th-th" href="https://www.nestlehealthscience-th.com"/>
       <xhtml:link rel="alternate" hreflang="tr-tr" href="https://www.nestlehealthscience.com.tr"/>
       <xhtml:link rel="alternate" hreflang="en-ae" href="https://www.nestlehealthscience-me.com"/>
       <xhtml:link rel="alternate" hreflang="es-mx" href="https://www.nestlehealthscience.com.mx"/>
       <xhtml:link rel="alternate" hreflang="fr-fr" href="https://www.nestlehealthscience.fr"/>
       <xhtml:link rel="alternate" hreflang="sv-se" href="https://www.nestlehealthscience.se"/>
       <xhtml:link rel="alternate" hreflang="en-lk" href="https://www.nestlehealthscience.lk"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-hk" href="https://www.nestlehealthscience.com.hk"/>
       <xhtml:link rel="alternate" hreflang="ja-jp" href="https://www.nestlehealthscience.jp"/>
       <xhtml:link rel="alternate" hreflang="es-es" href="https://www.nestlehealthscience.es"/>
       <xhtml:link rel="alternate" hreflang="ro-ro" href="https://www.nestlehealthscience.ro"/>
       <xhtml:link rel="alternate" hreflang="de-de" href="https://www.nestlehealthscience.de"/>
       <xhtml:link rel="alternate" hreflang="da-dk" href="https://www.nestlehealthscience.dk"/>
       <xhtml:link rel="alternate" hreflang="en-in" href="https://www.nestlehealthscience.in"/>
       <xhtml:link rel="alternate" hreflang="de-ch" href="https://www.nestlehealthscience.ch/de"/>
       <xhtml:link rel="alternate" hreflang="fr-ch" href="https://www.nestlehealthscience.ch/fr"/>
       <xhtml:link rel="alternate" hreflang="id-id" href="https://www.nestlehealthscience.co.id"/>
       <xhtml:link rel="alternate" hreflang="it-it" href="https://www.nestlehealthscience.it"/>
       <xhtml:link rel="alternate" hreflang="pl-pl" href="https://www.nestlehealthscience.pl"/>
       <xhtml:link rel="alternate" hreflang="en-za" href="https://www.nestlehealthscience.co.za"/>
       <xhtml:link rel="alternate" hreflang="en-my" href="https://www.nestlehealthscience.my"/>
       <xhtml:link rel="alternate" hreflang="vi-vn" href="https://www.nestlehealthscience.vn"/>
       <xhtml:link rel="alternate" hreflang="cs-cz" href="https://www.nestlehealthscience.cz/cz"/>
       <xhtml:link rel="alternate" hreflang="sk-cz" href="https://www.nestlehealthscience.cz/sk"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-cn" href="https://www.nestlehealthscience.cn/"/>
       <xhtml:link rel="alternate" hreflang="en-ph" href="https://www.nestlehealthscience.ph/"/>
       <xhtml:link rel="alternate" hreflang="ru-ru" href="https://www.nestlehealthscience.ru/"/>
       <xhtml:link rel="alternate" hreflang="nl-nl" href="https://www.nestlehealthscience.nl/nl"/>
       <xhtml:link rel="alternate" hreflang="fr-nl" href="https://www.nestlehealthscience.nl/fr"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-tw" href="https://www.nestlehealthscience.com.tw"/>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
       </url>
       <url>
       <loc>https://www.nestlehealthscience.sg/brands</loc>
       <xhtml:link rel="alternate" hreflang="en-sg" href="https://www.nestlehealthscience.sg/brands"/>
        <xhtml:link rel="alternate" hreflang="en" href="https://www.nestlehealthscience.com/brands"/>
      <xhtml:link rel="alternate" hreflang="en-ca" href="https://www.nestlehealthscience.ca/en/brands"/>
      <xhtml:link rel="alternate" hreflang="fr-ca" href="https://www.nestlehealthscience.ca/fr/marques/home"/>
       <xhtml:link rel="alternate" hreflang="en-gb" href="https://www.nestlehealthscience.co.uk/brands"/>
       <xhtml:link rel="alternate" hreflang="pt-br" href="https://www.nestlehealthscience.com.br/marcas"/>
       <xhtml:link rel="alternate" hreflang="fi-fi" href="https://www.nestlehealthscience.fi/tuotteet"/>
       <xhtml:link rel="alternate" hreflang="pt-pt" href="http://nestlehealthscience.pt/marcas"/>
       <xhtml:link rel="alternate" hreflang="th-th" href="https://www.nestlehealthscience-th.com"/>
       <xhtml:link rel="alternate" hreflang="tr-tr" href="https://www.nestlehealthscience.com.tr/brands"/>
       <xhtml:link rel="alternate" hreflang="en-ae" href="https://www.nestlehealthscience-me.com/en/brands"/>
       <xhtml:link rel="alternate" hreflang="es-mx" href="https://www.nestlehealthscience.com.mx/marcas"/>
       <xhtml:link rel="alternate" hreflang="fr-fr" href="https://www.nestlehealthscience.fr/nos-marques"/>
       <xhtml:link rel="alternate" hreflang="sv-se" href="https://www.nestlehealthscience.se/produkter"/>
       <xhtml:link rel="alternate" hreflang="en-lk" href="https://www.nestlehealthscience.lk/brands"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-hk" href="https://www.nestlehealthscience.com.hk/zh-hans/brands"/>
       <xhtml:link rel="alternate" hreflang="ja-jp" href="https://www.nestlehealthscience.jp/brands"/>
       <xhtml:link rel="alternate" hreflang="es-es" href="https://www.nestlehealthscience.es/marcas"/>
       <xhtml:link rel="alternate" hreflang="ro-ro" href="https://www.nestlehealthscience.ro/produse"/>
       <xhtml:link rel="alternate" hreflang="de-de" href="https://www.nestlehealthscience.de/marken"/>
       <xhtml:link rel="alternate" hreflang="da-dk" href="https://www.nestlehealthscience.dk/produkter"/>
       <xhtml:link rel="alternate" hreflang="en-in" href="https://www.nestlehealthscience.in/brands"/>
       <xhtml:link rel="alternate" hreflang="de-ch" href="https://www.nestlehealthscience.ch/de/marken"/>
       <xhtml:link rel="alternate" hreflang="fr-ch" href="https://www.nestlehealthscience.ch/fr/nos-marques"/>
       <xhtml:link rel="alternate" hreflang="id-id" href="https://www.nestlehealthscience.co.id/brands"/>
       <xhtml:link rel="alternate" hreflang="it-it" href="https://www.nestlehealthscience.it/prodotti"/>
       <xhtml:link rel="alternate" hreflang="pl-pl" href="https://www.nestlehealthscience.pl/produkty"/>
       <xhtml:link rel="alternate" hreflang="en-za" href="https://www.nestlehealthscience.co.za/brands"/>
       <xhtml:link rel="alternate" hreflang="en-my" href="https://www.nestlehealthscience.my/brands"/>
       <xhtml:link rel="alternate" hreflang="vi-vn" href="https://www.nestlehealthscience.vn/san-pham"/>
       <xhtml:link rel="alternate" hreflang="cs-cz" href="https://www.nestlehealthscience.cz/cz/produkty"/>
       <xhtml:link rel="alternate" hreflang="sk-cz" href="https://www.nestlehealthscience.cz/sk/produkty"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-cn" href="https://www.nestlehealthscience.cn/brands"/>
       <xhtml:link rel="alternate" hreflang="en-ph" href="https://www.nestlehealthscience.ph/brands"/>
       <xhtml:link rel="alternate" hreflang="ru-ru" href="https://www.nestlehealthscience.ru/brands"/>
       <xhtml:link rel="alternate" hreflang="nl-nl" href="https://www.nestlehealthscience.nl/nl/producten"/>
       <xhtml:link rel="alternate" hreflang="fr-nl" href="https://www.nestlehealthscience.nl/fr/producten"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-tw" href="https://www.nestlehealthscience.com.tw/brands"/>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
       </url>
      </urlset>';
    }

    public function southafrica()
    {
      return '<?xml version="1.0" encoding="UTF-8"?>
      <urlset
          xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
          xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd
          http://www.w3.org/1999/xhtml http://www.w3.org/2002/08/xhtml/xhtml1-strict.xsd"
          xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
          xmlns:xhtml="http://www.w3.org/1999/xhtml"   
      >
      <url>
        <loc>https://www.nestlehealthscience.co.za</loc>
       <xhtml:link rel="alternate" hreflang="en-za" href="https://www.nestlehealthscience.co.za"/>
       <xhtml:link rel="alternate" hreflang="en" href="https://www.nestlehealthscience.com"/>
      <xhtml:link rel="alternate" hreflang="en-us" href="https://www.nestlehealthscience.us"/>
      <xhtml:link rel="alternate" hreflang="en-ca" href="https://www.nestlehealthscience.ca/en"/>
      <xhtml:link rel="alternate" hreflang="fr-ca" href="https://www.nestlehealthscience.ca/fr"/>
       <xhtml:link rel="alternate" hreflang="en-gb" href="https://www.nestlehealthscience.co.uk"/>
       <xhtml:link rel="alternate" hreflang="pt-br" href="https://www.nestlehealthscience.com.br"/>
       <xhtml:link rel="alternate" hreflang="fi-fi" href="https://www.nestlehealthscience.fi"/>
       <xhtml:link rel="alternate" hreflang="pt-pt" href="https://www.nestlehealthscience.pt"/>
       <xhtml:link rel="alternate" hreflang="th-th" href="https://www.nestlehealthscience-th.com"/>
       <xhtml:link rel="alternate" hreflang="tr-tr" href="https://www.nestlehealthscience.com.tr"/>
       <xhtml:link rel="alternate" hreflang="en-ae" href="https://www.nestlehealthscience-me.com"/>
       <xhtml:link rel="alternate" hreflang="es-mx" href="https://www.nestlehealthscience.com.mx"/>
       <xhtml:link rel="alternate" hreflang="fr-fr" href="https://www.nestlehealthscience.fr"/>
       <xhtml:link rel="alternate" hreflang="sv-se" href="https://www.nestlehealthscience.se"/>
       <xhtml:link rel="alternate" hreflang="en-lk" href="https://www.nestlehealthscience.lk"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-hk" href="https://www.nestlehealthscience.com.hk"/>
       <xhtml:link rel="alternate" hreflang="ja-jp" href="https://www.nestlehealthscience.jp"/>
       <xhtml:link rel="alternate" hreflang="es-es" href="https://www.nestlehealthscience.es"/>
       <xhtml:link rel="alternate" hreflang="ro-ro" href="https://www.nestlehealthscience.ro"/>
       <xhtml:link rel="alternate" hreflang="de-de" href="https://www.nestlehealthscience.de"/>
       <xhtml:link rel="alternate" hreflang="da-dk" href="https://www.nestlehealthscience.dk"/>
       <xhtml:link rel="alternate" hreflang="en-in" href="https://www.nestlehealthscience.in"/>
       <xhtml:link rel="alternate" hreflang="de-ch" href="https://www.nestlehealthscience.ch/de"/>
       <xhtml:link rel="alternate" hreflang="fr-ch" href="https://www.nestlehealthscience.ch/fr"/>
       <xhtml:link rel="alternate" hreflang="id-id" href="https://www.nestlehealthscience.co.id"/>
       <xhtml:link rel="alternate" hreflang="it-it" href="https://www.nestlehealthscience.it"/>
       <xhtml:link rel="alternate" hreflang="pl-pl" href="https://www.nestlehealthscience.pl"/>
       <xhtml:link rel="alternate" hreflang="en-my" href="https://www.nestlehealthscience.my"/>
       <xhtml:link rel="alternate" hreflang="vi-vn" href="https://www.nestlehealthscience.vn"/>
       <xhtml:link rel="alternate" hreflang="cs-cz" href="https://www.nestlehealthscience.cz/cz"/>
       <xhtml:link rel="alternate" hreflang="sk-cz" href="https://www.nestlehealthscience.cz/sk"/>
       <xhtml:link rel="alternate" hreflang="en-sg" href="https://www.nestlehealthscience.sg"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-cn" href="https://www.nestlehealthscience.cn/"/>
       <xhtml:link rel="alternate" hreflang="en-ph" href="https://www.nestlehealthscience.ph/"/>
       <xhtml:link rel="alternate" hreflang="ru-ru" href="https://www.nestlehealthscience.ru/"/>
       <xhtml:link rel="alternate" hreflang="nl-nl" href="https://www.nestlehealthscience.nl/nl"/>
       <xhtml:link rel="alternate" hreflang="fr-nl" href="https://www.nestlehealthscience.nl/fr"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-tw" href="https://www.nestlehealthscience.com.tw"/>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
       </url>
       <url>
       <loc>https://www.nestlehealthscience.co.za/brands</loc>
       <xhtml:link rel="alternate" hreflang="en-za" href="https://www.nestlehealthscience.co.za/brands"/>
        <xhtml:link rel="alternate" hreflang="en" href="https://www.nestlehealthscience.com/brands"/>
      <xhtml:link rel="alternate" hreflang="en-ca" href="https://www.nestlehealthscience.ca/en/brands"/>
      <xhtml:link rel="alternate" hreflang="fr-ca" href="https://www.nestlehealthscience.ca/fr/marques/home"/>
       <xhtml:link rel="alternate" hreflang="en-gb" href="https://www.nestlehealthscience.co.uk/brands"/>
       <xhtml:link rel="alternate" hreflang="pt-br" href="https://www.nestlehealthscience.com.br/marcas"/>
       <xhtml:link rel="alternate" hreflang="fi-fi" href="https://www.nestlehealthscience.fi/tuotteet"/>
       <xhtml:link rel="alternate" hreflang="pt-pt" href="http://nestlehealthscience.pt/marcas"/>
       <xhtml:link rel="alternate" hreflang="th-th" href="https://www.nestlehealthscience-th.com"/>
       <xhtml:link rel="alternate" hreflang="tr-tr" href="https://www.nestlehealthscience.com.tr/brands"/>
       <xhtml:link rel="alternate" hreflang="en-ae" href="https://www.nestlehealthscience-me.com/en/brands"/>
       <xhtml:link rel="alternate" hreflang="es-mx" href="https://www.nestlehealthscience.com.mx/marcas"/>
       <xhtml:link rel="alternate" hreflang="fr-fr" href="https://www.nestlehealthscience.fr/nos-marques"/>
       <xhtml:link rel="alternate" hreflang="sv-se" href="https://www.nestlehealthscience.se/produkter"/>
       <xhtml:link rel="alternate" hreflang="en-lk" href="https://www.nestlehealthscience.lk/brands"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-hk" href="https://www.nestlehealthscience.com.hk/zh-hans/brands"/>
       <xhtml:link rel="alternate" hreflang="ja-jp" href="https://www.nestlehealthscience.jp/brands"/>
       <xhtml:link rel="alternate" hreflang="es-es" href="https://www.nestlehealthscience.es/marcas"/>
       <xhtml:link rel="alternate" hreflang="ro-ro" href="https://www.nestlehealthscience.ro/produse"/>
       <xhtml:link rel="alternate" hreflang="de-de" href="https://www.nestlehealthscience.de/marken"/>
       <xhtml:link rel="alternate" hreflang="da-dk" href="https://www.nestlehealthscience.dk/produkter"/>
       <xhtml:link rel="alternate" hreflang="en-in" href="https://www.nestlehealthscience.in/brands"/>
       <xhtml:link rel="alternate" hreflang="de-ch" href="https://www.nestlehealthscience.ch/de/marken"/>
       <xhtml:link rel="alternate" hreflang="fr-ch" href="https://www.nestlehealthscience.ch/fr/nos-marques"/>
       <xhtml:link rel="alternate" hreflang="id-id" href="https://www.nestlehealthscience.co.id/brands"/>
       <xhtml:link rel="alternate" hreflang="it-it" href="https://www.nestlehealthscience.it/prodotti"/>
       <xhtml:link rel="alternate" hreflang="pl-pl" href="https://www.nestlehealthscience.pl/produkty"/>
       <xhtml:link rel="alternate" hreflang="en-my" href="https://www.nestlehealthscience.my/brands"/>
       <xhtml:link rel="alternate" hreflang="vi-vn" href="https://www.nestlehealthscience.vn/san-pham"/>
       <xhtml:link rel="alternate" hreflang="cs-cz" href="https://www.nestlehealthscience.cz/cz/produkty"/>
       <xhtml:link rel="alternate" hreflang="sk-cz" href="https://www.nestlehealthscience.cz/sk/produkty"/>
       <xhtml:link rel="alternate" hreflang="en-sg" href="https://www.nestlehealthscience.sg/brands"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-cn" href="https://www.nestlehealthscience.cn/brands"/>
       <xhtml:link rel="alternate" hreflang="en-ph" href="https://www.nestlehealthscience.ph/brands"/>
       <xhtml:link rel="alternate" hreflang="ru-ru" href="https://www.nestlehealthscience.ru/brands"/>
       <xhtml:link rel="alternate" hreflang="nl-nl" href="https://www.nestlehealthscience.nl/nl/producten"/>
       <xhtml:link rel="alternate" hreflang="fr-nl" href="https://www.nestlehealthscience.nl/fr/producten"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-tw" href="https://www.nestlehealthscience.com.tw/brands"/>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
       </url>
      </urlset>';
    }
    

    public function spain()
    {
      return '<?xml version="1.0" encoding="UTF-8"?>
      <urlset
          xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
          xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd
          http://www.w3.org/1999/xhtml http://www.w3.org/2002/08/xhtml/xhtml1-strict.xsd"
          xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
          xmlns:xhtml="http://www.w3.org/1999/xhtml"   
      >
      <url>
        <loc>https://www.nestlehealthscience.es</loc>
       <xhtml:link rel="alternate" hreflang="es-es" href="https://www.nestlehealthscience.es"/>
       <xhtml:link rel="alternate" hreflang="en" href="https://www.nestlehealthscience.com"/>
      <xhtml:link rel="alternate" hreflang="en-us" href="https://www.nestlehealthscience.us"/>
      <xhtml:link rel="alternate" hreflang="en-ca" href="https://www.nestlehealthscience.ca/en"/>
      <xhtml:link rel="alternate" hreflang="fr-ca" href="https://www.nestlehealthscience.ca/fr"/>
       <xhtml:link rel="alternate" hreflang="en-gb" href="https://www.nestlehealthscience.co.uk"/>
       <xhtml:link rel="alternate" hreflang="pt-br" href="https://www.nestlehealthscience.com.br"/>
       <xhtml:link rel="alternate" hreflang="fi-fi" href="https://www.nestlehealthscience.fi"/>
       <xhtml:link rel="alternate" hreflang="pt-pt" href="https://www.nestlehealthscience.pt"/>
       <xhtml:link rel="alternate" hreflang="th-th" href="https://www.nestlehealthscience-th.com"/>
       <xhtml:link rel="alternate" hreflang="tr-tr" href="https://www.nestlehealthscience.com.tr"/>
       <xhtml:link rel="alternate" hreflang="en-ae" href="https://www.nestlehealthscience-me.com"/>
       <xhtml:link rel="alternate" hreflang="es-mx" href="https://www.nestlehealthscience.com.mx"/>
       <xhtml:link rel="alternate" hreflang="fr-fr" href="https://www.nestlehealthscience.fr"/>
       <xhtml:link rel="alternate" hreflang="sv-se" href="https://www.nestlehealthscience.se"/>
       <xhtml:link rel="alternate" hreflang="en-lk" href="https://www.nestlehealthscience.lk"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-hk" href="https://www.nestlehealthscience.com.hk"/>
       <xhtml:link rel="alternate" hreflang="ja-jp" href="https://www.nestlehealthscience.jp"/>
       <xhtml:link rel="alternate" hreflang="ro-ro" href="https://www.nestlehealthscience.ro"/>
       <xhtml:link rel="alternate" hreflang="de-de" href="https://www.nestlehealthscience.de"/>
       <xhtml:link rel="alternate" hreflang="da-dk" href="https://www.nestlehealthscience.dk"/>
       <xhtml:link rel="alternate" hreflang="en-in" href="https://www.nestlehealthscience.in"/>
       <xhtml:link rel="alternate" hreflang="de-ch" href="https://www.nestlehealthscience.ch/de"/>
       <xhtml:link rel="alternate" hreflang="fr-ch" href="https://www.nestlehealthscience.ch/fr"/>
       <xhtml:link rel="alternate" hreflang="id-id" href="https://www.nestlehealthscience.co.id"/>
       <xhtml:link rel="alternate" hreflang="it-it" href="https://www.nestlehealthscience.it"/>
       <xhtml:link rel="alternate" hreflang="pl-pl" href="https://www.nestlehealthscience.pl"/>
       <xhtml:link rel="alternate" hreflang="en-za" href="https://www.nestlehealthscience.co.za"/>
       <xhtml:link rel="alternate" hreflang="en-my" href="https://www.nestlehealthscience.my"/>
       <xhtml:link rel="alternate" hreflang="vi-vn" href="https://www.nestlehealthscience.vn"/>
       <xhtml:link rel="alternate" hreflang="cs-cz" href="https://www.nestlehealthscience.cz/cz"/>
       <xhtml:link rel="alternate" hreflang="sk-cz" href="https://www.nestlehealthscience.cz/sk"/>
       <xhtml:link rel="alternate" hreflang="en-sg" href="https://www.nestlehealthscience.sg"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-cn" href="https://www.nestlehealthscience.cn/"/>
       <xhtml:link rel="alternate" hreflang="en-ph" href="https://www.nestlehealthscience.ph/"/>
       <xhtml:link rel="alternate" hreflang="ru-ru" href="https://www.nestlehealthscience.ru/"/>
       <xhtml:link rel="alternate" hreflang="nl-nl" href="https://www.nestlehealthscience.nl/nl"/>
       <xhtml:link rel="alternate" hreflang="fr-nl" href="https://www.nestlehealthscience.nl/fr"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-tw" href="https://www.nestlehealthscience.com.tw"/>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
       </url>
       <url>
       <loc>https://www.nestlehealthscience.es/marcas</loc>
       <xhtml:link rel="alternate" hreflang="es-es" href="https://www.nestlehealthscience.es/marcas"/>
      
        <xhtml:link rel="alternate" hreflang="en" href="https://www.nestlehealthscience.com/brands"/>
      <xhtml:link rel="alternate" hreflang="en-ca" href="https://www.nestlehealthscience.ca/en/brands"/>
      <xhtml:link rel="alternate" hreflang="fr-ca" href="https://www.nestlehealthscience.ca/fr/marques/home"/>
       <xhtml:link rel="alternate" hreflang="en-gb" href="https://www.nestlehealthscience.co.uk/brands"/>
       <xhtml:link rel="alternate" hreflang="pt-br" href="https://www.nestlehealthscience.com.br/marcas"/>
       <xhtml:link rel="alternate" hreflang="fi-fi" href="https://www.nestlehealthscience.fi/tuotteet"/>
       <xhtml:link rel="alternate" hreflang="pt-pt" href="http://nestlehealthscience.pt/marcas"/>
       <xhtml:link rel="alternate" hreflang="th-th" href="https://www.nestlehealthscience-th.com"/>
       <xhtml:link rel="alternate" hreflang="tr-tr" href="https://www.nestlehealthscience.com.tr/brands"/>
       <xhtml:link rel="alternate" hreflang="en-ae" href="https://www.nestlehealthscience-me.com/en/brands"/>
       <xhtml:link rel="alternate" hreflang="es-mx" href="https://www.nestlehealthscience.com.mx/marcas"/>
       <xhtml:link rel="alternate" hreflang="fr-fr" href="https://www.nestlehealthscience.fr/nos-marques"/>
       <xhtml:link rel="alternate" hreflang="sv-se" href="https://www.nestlehealthscience.se/produkter"/>
       <xhtml:link rel="alternate" hreflang="en-lk" href="https://www.nestlehealthscience.lk/brands"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-hk" href="https://www.nestlehealthscience.com.hk/zh-hans/brands"/>
       <xhtml:link rel="alternate" hreflang="ja-jp" href="https://www.nestlehealthscience.jp/brands"/>
       <xhtml:link rel="alternate" hreflang="ro-ro" href="https://www.nestlehealthscience.ro/produse"/>
       <xhtml:link rel="alternate" hreflang="de-de" href="https://www.nestlehealthscience.de/marken"/>
       <xhtml:link rel="alternate" hreflang="da-dk" href="https://www.nestlehealthscience.dk/produkter"/>
       <xhtml:link rel="alternate" hreflang="en-in" href="https://www.nestlehealthscience.in/brands"/>
       <xhtml:link rel="alternate" hreflang="de-ch" href="https://www.nestlehealthscience.ch/de/marken"/>
       <xhtml:link rel="alternate" hreflang="fr-ch" href="https://www.nestlehealthscience.ch/fr/nos-marques"/>
       <xhtml:link rel="alternate" hreflang="id-id" href="https://www.nestlehealthscience.co.id/brands"/>
       <xhtml:link rel="alternate" hreflang="it-it" href="https://www.nestlehealthscience.it/prodotti"/>
       <xhtml:link rel="alternate" hreflang="pl-pl" href="https://www.nestlehealthscience.pl/produkty"/>
       <xhtml:link rel="alternate" hreflang="en-za" href="https://www.nestlehealthscience.co.za/brands"/>
       <xhtml:link rel="alternate" hreflang="en-my" href="https://www.nestlehealthscience.my/brands"/>
       <xhtml:link rel="alternate" hreflang="vi-vn" href="https://www.nestlehealthscience.vn/san-pham"/>
       <xhtml:link rel="alternate" hreflang="cs-cz" href="https://www.nestlehealthscience.cz/cz/produkty"/>
       <xhtml:link rel="alternate" hreflang="sk-cz" href="https://www.nestlehealthscience.cz/sk/produkty"/>
       <xhtml:link rel="alternate" hreflang="en-sg" href="https://www.nestlehealthscience.sg/brands"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-cn" href="https://www.nestlehealthscience.cn/brands"/>
       <xhtml:link rel="alternate" hreflang="en-ph" href="https://www.nestlehealthscience.ph/brands"/>
       <xhtml:link rel="alternate" hreflang="ru-ru" href="https://www.nestlehealthscience.ru/brands"/>
       <xhtml:link rel="alternate" hreflang="nl-nl" href="https://www.nestlehealthscience.nl/nl/producten"/>
       <xhtml:link rel="alternate" hreflang="fr-nl" href="https://www.nestlehealthscience.nl/fr/producten"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-tw" href="https://www.nestlehealthscience.com.tw/brands"/>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
       </url>
      </urlset>';
    }


    public function srilanka()
    {
      return '<?xml version="1.0" encoding="UTF-8"?>
      <urlset
          xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
          xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd
          http://www.w3.org/1999/xhtml http://www.w3.org/2002/08/xhtml/xhtml1-strict.xsd"
          xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
          xmlns:xhtml="http://www.w3.org/1999/xhtml"   
      >
      <url>
        <loc>https://www.nestlehealthscience.lk</loc>
       <xhtml:link rel="alternate" hreflang="en-lk" href="https://www.nestlehealthscience.lk"/>
       <xhtml:link rel="alternate" hreflang="en" href="https://www.nestlehealthscience.com"/>
      <xhtml:link rel="alternate" hreflang="en-us" href="https://www.nestlehealthscience.us"/>
      <xhtml:link rel="alternate" hreflang="en-ca" href="https://www.nestlehealthscience.ca/en"/>
      <xhtml:link rel="alternate" hreflang="fr-ca" href="https://www.nestlehealthscience.ca/fr"/>
       <xhtml:link rel="alternate" hreflang="en-gb" href="https://www.nestlehealthscience.co.uk"/>
       <xhtml:link rel="alternate" hreflang="pt-br" href="https://www.nestlehealthscience.com.br"/>
       <xhtml:link rel="alternate" hreflang="fi-fi" href="https://www.nestlehealthscience.fi"/>
       <xhtml:link rel="alternate" hreflang="pt-pt" href="https://www.nestlehealthscience.pt"/>
       <xhtml:link rel="alternate" hreflang="th-th" href="https://www.nestlehealthscience-th.com"/>
       <xhtml:link rel="alternate" hreflang="tr-tr" href="https://www.nestlehealthscience.com.tr"/>
       <xhtml:link rel="alternate" hreflang="en-ae" href="https://www.nestlehealthscience-me.com"/>
       <xhtml:link rel="alternate" hreflang="es-mx" href="https://www.nestlehealthscience.com.mx"/>
       <xhtml:link rel="alternate" hreflang="fr-fr" href="https://www.nestlehealthscience.fr"/>
       <xhtml:link rel="alternate" hreflang="sv-se" href="https://www.nestlehealthscience.se"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-hk" href="https://www.nestlehealthscience.com.hk"/>
       <xhtml:link rel="alternate" hreflang="ja-jp" href="https://www.nestlehealthscience.jp"/>
       <xhtml:link rel="alternate" hreflang="es-es" href="https://www.nestlehealthscience.es"/>
       <xhtml:link rel="alternate" hreflang="ro-ro" href="https://www.nestlehealthscience.ro"/>
       <xhtml:link rel="alternate" hreflang="de-de" href="https://www.nestlehealthscience.de"/>
       <xhtml:link rel="alternate" hreflang="da-dk" href="https://www.nestlehealthscience.dk"/>
       <xhtml:link rel="alternate" hreflang="en-in" href="https://www.nestlehealthscience.in"/>
       <xhtml:link rel="alternate" hreflang="de-ch" href="https://www.nestlehealthscience.ch/de"/>
       <xhtml:link rel="alternate" hreflang="fr-ch" href="https://www.nestlehealthscience.ch/fr"/>
       <xhtml:link rel="alternate" hreflang="id-id" href="https://www.nestlehealthscience.co.id"/>
       <xhtml:link rel="alternate" hreflang="it-it" href="https://www.nestlehealthscience.it"/>
       <xhtml:link rel="alternate" hreflang="pl-pl" href="https://www.nestlehealthscience.pl"/>
       <xhtml:link rel="alternate" hreflang="en-za" href="https://www.nestlehealthscience.co.za"/>
       <xhtml:link rel="alternate" hreflang="en-my" href="https://www.nestlehealthscience.my"/>
       <xhtml:link rel="alternate" hreflang="vi-vn" href="https://www.nestlehealthscience.vn"/>
       <xhtml:link rel="alternate" hreflang="cs-cz" href="https://www.nestlehealthscience.cz/cz"/>
       <xhtml:link rel="alternate" hreflang="sk-cz" href="https://www.nestlehealthscience.cz/sk"/>
       <xhtml:link rel="alternate" hreflang="en-sg" href="https://www.nestlehealthscience.sg"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-cn" href="https://www.nestlehealthscience.cn/"/>
       <xhtml:link rel="alternate" hreflang="en-ph" href="https://www.nestlehealthscience.ph/"/>
       <xhtml:link rel="alternate" hreflang="ru-ru" href="https://www.nestlehealthscience.ru/"/>
       <xhtml:link rel="alternate" hreflang="nl-nl" href="https://www.nestlehealthscience.nl/nl"/>
       <xhtml:link rel="alternate" hreflang="fr-nl" href="https://www.nestlehealthscience.nl/fr"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-tw" href="https://www.nestlehealthscience.com.tw"/>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
       </url>
       <url>
       <loc>https://www.nestlehealthscience.lk/brands</loc>
       <xhtml:link rel="alternate" hreflang="en-lk" href="https://www.nestlehealthscience.lk/brands"/>
        <xhtml:link rel="alternate" hreflang="en" href="https://www.nestlehealthscience.com/brands"/>
      <xhtml:link rel="alternate" hreflang="en-ca" href="https://www.nestlehealthscience.ca/en/brands"/>
      <xhtml:link rel="alternate" hreflang="fr-ca" href="https://www.nestlehealthscience.ca/fr/marques/home"/>
       <xhtml:link rel="alternate" hreflang="en-gb" href="https://www.nestlehealthscience.co.uk/brands"/>
       <xhtml:link rel="alternate" hreflang="pt-br" href="https://www.nestlehealthscience.com.br/marcas"/>
       <xhtml:link rel="alternate" hreflang="fi-fi" href="https://www.nestlehealthscience.fi/tuotteet"/>
       <xhtml:link rel="alternate" hreflang="pt-pt" href="http://nestlehealthscience.pt/marcas"/>
       <xhtml:link rel="alternate" hreflang="th-th" href="https://www.nestlehealthscience-th.com"/>
       <xhtml:link rel="alternate" hreflang="tr-tr" href="https://www.nestlehealthscience.com.tr/brands"/>
       <xhtml:link rel="alternate" hreflang="en-ae" href="https://www.nestlehealthscience-me.com/en/brands"/>
       <xhtml:link rel="alternate" hreflang="es-mx" href="https://www.nestlehealthscience.com.mx/marcas"/>
       <xhtml:link rel="alternate" hreflang="fr-fr" href="https://www.nestlehealthscience.fr/nos-marques"/>
       <xhtml:link rel="alternate" hreflang="sv-se" href="https://www.nestlehealthscience.se/produkter"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-hk" href="https://www.nestlehealthscience.com.hk/zh-hans/brands"/>
       <xhtml:link rel="alternate" hreflang="ja-jp" href="https://www.nestlehealthscience.jp/brands"/>
       <xhtml:link rel="alternate" hreflang="es-es" href="https://www.nestlehealthscience.es/marcas"/>
       <xhtml:link rel="alternate" hreflang="ro-ro" href="https://www.nestlehealthscience.ro/produse"/>
       <xhtml:link rel="alternate" hreflang="de-de" href="https://www.nestlehealthscience.de/marken"/>
       <xhtml:link rel="alternate" hreflang="da-dk" href="https://www.nestlehealthscience.dk/produkter"/>
       <xhtml:link rel="alternate" hreflang="en-in" href="https://www.nestlehealthscience.in/brands"/>
       <xhtml:link rel="alternate" hreflang="de-ch" href="https://www.nestlehealthscience.ch/de/marken"/>
       <xhtml:link rel="alternate" hreflang="fr-ch" href="https://www.nestlehealthscience.ch/fr/nos-marques"/>
       <xhtml:link rel="alternate" hreflang="id-id" href="https://www.nestlehealthscience.co.id/brands"/>
       <xhtml:link rel="alternate" hreflang="it-it" href="https://www.nestlehealthscience.it/prodotti"/>
       <xhtml:link rel="alternate" hreflang="pl-pl" href="https://www.nestlehealthscience.pl/produkty"/>
       <xhtml:link rel="alternate" hreflang="en-za" href="https://www.nestlehealthscience.co.za/brands"/>
       <xhtml:link rel="alternate" hreflang="en-my" href="https://www.nestlehealthscience.my/brands"/>
       <xhtml:link rel="alternate" hreflang="vi-vn" href="https://www.nestlehealthscience.vn/san-pham"/>
       <xhtml:link rel="alternate" hreflang="cs-cz" href="https://www.nestlehealthscience.cz/cz/produkty"/>
       <xhtml:link rel="alternate" hreflang="sk-cz" href="https://www.nestlehealthscience.cz/sk/produkty"/>
       <xhtml:link rel="alternate" hreflang="en-sg" href="https://www.nestlehealthscience.sg/brands"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-cn" href="https://www.nestlehealthscience.cn/brands"/>
       <xhtml:link rel="alternate" hreflang="en-ph" href="https://www.nestlehealthscience.ph/brands"/>
       <xhtml:link rel="alternate" hreflang="ru-ru" href="https://www.nestlehealthscience.ru/brands"/>
       <xhtml:link rel="alternate" hreflang="nl-nl" href="https://www.nestlehealthscience.nl/nl/producten"/>
       <xhtml:link rel="alternate" hreflang="fr-nl" href="https://www.nestlehealthscience.nl/fr/producten"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-tw" href="https://www.nestlehealthscience.com.tw/brands"/>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
       </url>
      </urlset>';
    }
    

    public function sweden()
    {
      return '<?xml version="1.0" encoding="UTF-8"?>
      <urlset
          xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
          xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd
          http://www.w3.org/1999/xhtml http://www.w3.org/2002/08/xhtml/xhtml1-strict.xsd"
          xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
          xmlns:xhtml="http://www.w3.org/1999/xhtml"   
      >
      <url>
        <loc>https://www.nestlehealthscience.se/</loc>
       <xhtml:link rel="alternate" hreflang="sv-se" href="https://www.nestlehealthscience.se"/>
       <xhtml:link rel="alternate" hreflang="en" href="https://www.nestlehealthscience.com"/>
      <xhtml:link rel="alternate" hreflang="en-ca" href="https://www.nestlehealthscience.ca/en"/>
      <xhtml:link rel="alternate" hreflang="fr-ca" href="https://www.nestlehealthscience.ca/fr"/>
       <xhtml:link rel="alternate" hreflang="en-gb" href="https://www.nestlehealthscience.co.uk"/>
       <xhtml:link rel="alternate" hreflang="pt-br" href="https://www.nestlehealthscience.com.br"/>
       <xhtml:link rel="alternate" hreflang="fi-fi" href="https://www.nestlehealthscience.fi"/>
       <xhtml:link rel="alternate" hreflang="pt-pt" href="https://www.nestlehealthscience.pt"/>
       <xhtml:link rel="alternate" hreflang="th-th" href="https://www.nestlehealthscience-th.com"/>
       <xhtml:link rel="alternate" hreflang="tr-tr" href="https://www.nestlehealthscience.com.tr"/>
       <xhtml:link rel="alternate" hreflang="en-ae" href="https://www.nestlehealthscience-me.com"/>
       <xhtml:link rel="alternate" hreflang="es-mx" href="https://www.nestlehealthscience.com.mx"/>
       <xhtml:link rel="alternate" hreflang="fr-fr" href="https://www.nestlehealthscience.fr"/>
       <xhtml:link rel="alternate" hreflang="de-at" href="https://www.nestlehealthscience.at"/>
       <xhtml:link rel="alternate" hreflang="en-lk" href="https://www.nestlehealthscience.lk"/>
       <xhtml:link rel="alternate" hreflang="en-au" href="https://www.nestlehealthscience.com.au"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-hk" href="https://www.nestlehealthscience.com.hk"/>
       <xhtml:link rel="alternate" hreflang="ja-jp" href="https://www.nestlehealthscience.jp"/>
       <xhtml:link rel="alternate" hreflang="es-es" href="https://www.nestlehealthscience.es"/>
       <xhtml:link rel="alternate" hreflang="ro-ro" href="https://www.nestlehealthscience.ro"/>
       <xhtml:link rel="alternate" hreflang="de-de" href="https://www.nestlehealthscience.de"/>
       <xhtml:link rel="alternate" hreflang="en-in" href="https://www.nestlehealthscience.in"/>
       <xhtml:link rel="alternate" hreflang="de-ch" href="https://www.nestlehealthscience.ch/de"/>
       <xhtml:link rel="alternate" hreflang="fr-ch" href="https://www.nestlehealthscience.ch/fr"/>
       <xhtml:link rel="alternate" hreflang="id-id" href="https://www.nestlehealthscience.co.id"/>
       <xhtml:link rel="alternate" hreflang="it-it" href="https://www.nestlehealthscience.it"/>
       <xhtml:link rel="alternate" hreflang="pl-pl" href="https://www.nestlehealthscience.pl"/>
       <xhtml:link rel="alternate" hreflang="en-za" href="https://www.nestlehealthscience.co.za"/>
       <xhtml:link rel="alternate" hreflang="en-my" href="https://www.nestlehealthscience.my"/>
       <xhtml:link rel="alternate" hreflang="vi-vn" href="https://www.nestlehealthscience.vn"/>
       <xhtml:link rel="alternate" hreflang="cs-cz" href="https://www.nestlehealthscience.cz/cz"/>
       <xhtml:link rel="alternate" hreflang="sk-cz" href="https://www.nestlehealthscience.cz/sk"/>
       <xhtml:link rel="alternate" hreflang="en-sg" href="https://www.nestlehealthscience.sg"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-cn" href="https://www.nestlehealthscience.cn/"/>
       <xhtml:link rel="alternate" hreflang="en-ph" href="https://www.nestlehealthscience.ph/"/>
       <xhtml:link rel="alternate" hreflang="ru-ru" href="https://www.nestlehealthscience.ru/"/>
       <xhtml:link rel="alternate" hreflang="nl-nl" href="https://www.nestlehealthscience.nl/nl"/>
       <xhtml:link rel="alternate" hreflang="fr-nl" href="https://www.nestlehealthscience.nl/fr"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-tw" href="https://www.nestlehealthscience.com.tw"/>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
       </url>
       <url>
       <loc>https://www.nestlehealthscience.se/produkter</loc>
       <xhtml:link rel="alternate" hreflang="sv-se" href="https://www.nestlehealthscience.se/produkter"/>
        <xhtml:link rel="alternate" hreflang="en" href="https://www.nestlehealthscience.com/brands"/>
      <xhtml:link rel="alternate" hreflang="en-ca" href="https://www.nestlehealthscience.ca/en/brands"/>
      <xhtml:link rel="alternate" hreflang="fr-ca" href="https://www.nestlehealthscience.ca/fr/marques/home"/>
       <xhtml:link rel="alternate" hreflang="en-gb" href="https://www.nestlehealthscience.co.uk/brands"/>
       <xhtml:link rel="alternate" hreflang="pt-br" href="https://www.nestlehealthscience.com.br/marcas"/>
       <xhtml:link rel="alternate" hreflang="fi-fi" href="https://www.nestlehealthscience.fi/tuotteet"/>
       <xhtml:link rel="alternate" hreflang="pt-pt" href="http://nestlehealthscience.pt/marcas"/>
       <xhtml:link rel="alternate" hreflang="th-th" href="https://www.nestlehealthscience-th.com"/>
       <xhtml:link rel="alternate" hreflang="tr-tr" href="https://www.nestlehealthscience.com.tr/brands"/>
       <xhtml:link rel="alternate" hreflang="en-ae" href="https://www.nestlehealthscience-me.com/en/brands"/>
       <xhtml:link rel="alternate" hreflang="es-mx" href="https://www.nestlehealthscience.com.mx/marcas"/>
       <xhtml:link rel="alternate" hreflang="fr-fr" href="https://www.nestlehealthscience.fr/nos-marques"/>
       <xhtml:link rel="alternate" hreflang="en-lk" href="https://www.nestlehealthscience.lk/brands"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-hk" href="https://www.nestlehealthscience.com.hk/zh-hans/brands"/>
       <xhtml:link rel="alternate" hreflang="ja-jp" href="https://www.nestlehealthscience.jp/brands"/>
       <xhtml:link rel="alternate" hreflang="es-es" href="https://www.nestlehealthscience.es/marcas"/>
       <xhtml:link rel="alternate" hreflang="ro-ro" href="https://www.nestlehealthscience.ro/produse"/>
       <xhtml:link rel="alternate" hreflang="de-de" href="https://www.nestlehealthscience.de/marken"/>
       <xhtml:link rel="alternate" hreflang="da-dk" href="https://www.nestlehealthscience.dk/produkter"/>
       <xhtml:link rel="alternate" hreflang="en-in" href="https://www.nestlehealthscience.in/brands"/>
       <xhtml:link rel="alternate" hreflang="de-ch" href="https://www.nestlehealthscience.ch/de/marken"/>
       <xhtml:link rel="alternate" hreflang="fr-ch" href="https://www.nestlehealthscience.ch/fr/nos-marques"/>
       <xhtml:link rel="alternate" hreflang="id-id" href="https://www.nestlehealthscience.co.id/brands"/>
       <xhtml:link rel="alternate" hreflang="it-it" href="https://www.nestlehealthscience.it/prodotti"/>
       <xhtml:link rel="alternate" hreflang="pl-pl" href="https://www.nestlehealthscience.pl/produkty"/>
       <xhtml:link rel="alternate" hreflang="en-za" href="https://www.nestlehealthscience.co.za/brands"/>
       <xhtml:link rel="alternate" hreflang="en-my" href="https://www.nestlehealthscience.my/brands"/>
       <xhtml:link rel="alternate" hreflang="vi-vn" href="https://www.nestlehealthscience.vn/san-pham"/>
       <xhtml:link rel="alternate" hreflang="cs-cz" href="https://www.nestlehealthscience.cz/cz/produkty"/>
       <xhtml:link rel="alternate" hreflang="sk-cz" href="https://www.nestlehealthscience.cz/sk/produkty"/>
       <xhtml:link rel="alternate" hreflang="en-sg" href="https://www.nestlehealthscience.sg/brands"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-cn" href="https://www.nestlehealthscience.cn/brands"/>
       <xhtml:link rel="alternate" hreflang="en-ph" href="https://www.nestlehealthscience.ph/brands"/>
       <xhtml:link rel="alternate" hreflang="ru-ru" href="https://www.nestlehealthscience.ru/brands"/>
       <xhtml:link rel="alternate" hreflang="nl-nl" href="https://www.nestlehealthscience.nl/nl/producten"/>
       <xhtml:link rel="alternate" hreflang="fr-nl" href="https://www.nestlehealthscience.nl/fr/producten"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-tw" href="https://www.nestlehealthscience.com.tw/brands"/>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
       </url>
      </urlset>';
    }


    public function switzerland()
    {
      return '<?xml version="1.0" encoding="UTF-8"?>
      <urlset
          xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
          xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd
          http://www.w3.org/1999/xhtml http://www.w3.org/2002/08/xhtml/xhtml1-strict.xsd"
          xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
          xmlns:xhtml="http://www.w3.org/1999/xhtml"   
      >
      <url>
        <loc>https://www.nestlehealthscience.ch/de</loc>
       <xhtml:link rel="alternate" hreflang="de-ch" href="https://www.nestlehealthscience.ch/de"/>
       <xhtml:link rel="alternate" hreflang="fr-ch" href="https://www.nestlehealthscience.ch/fr"/>
       <xhtml:link rel="alternate" hreflang="en" href="https://www.nestlehealthscience.com"/>
      <xhtml:link rel="alternate" hreflang="en-us" href="https://www.nestlehealthscience.us"/>
      <xhtml:link rel="alternate" hreflang="en-ca" href="https://www.nestlehealthscience.ca/en"/>
      <xhtml:link rel="alternate" hreflang="fr-ca" href="https://www.nestlehealthscience.ca/fr"/>
       <xhtml:link rel="alternate" hreflang="en-gb" href="https://www.nestlehealthscience.co.uk"/>
       <xhtml:link rel="alternate" hreflang="pt-br" href="https://www.nestlehealthscience.com.br"/>
       <xhtml:link rel="alternate" hreflang="fi-fi" href="https://www.nestlehealthscience.fi"/>
       <xhtml:link rel="alternate" hreflang="pt-pt" href="https://www.nestlehealthscience.pt"/>
       <xhtml:link rel="alternate" hreflang="th-th" href="https://www.nestlehealthscience-th.com"/>
       <xhtml:link rel="alternate" hreflang="tr-tr" href="https://www.nestlehealthscience.com.tr"/>
       <xhtml:link rel="alternate" hreflang="en-ae" href="https://www.nestlehealthscience-me.com"/>
       <xhtml:link rel="alternate" hreflang="es-mx" href="https://www.nestlehealthscience.com.mx"/>
       <xhtml:link rel="alternate" hreflang="fr-fr" href="https://www.nestlehealthscience.fr"/>
       <xhtml:link rel="alternate" hreflang="sv-se" href="https://www.nestlehealthscience.se"/>
       <xhtml:link rel="alternate" hreflang="en-lk" href="https://www.nestlehealthscience.lk"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-hk" href="https://www.nestlehealthscience.com.hk"/>
       <xhtml:link rel="alternate" hreflang="ja-jp" href="https://www.nestlehealthscience.jp"/>
       <xhtml:link rel="alternate" hreflang="es-es" href="https://www.nestlehealthscience.es"/>
       <xhtml:link rel="alternate" hreflang="ro-ro" href="https://www.nestlehealthscience.ro"/>
       <xhtml:link rel="alternate" hreflang="de-de" href="https://www.nestlehealthscience.de"/>
       <xhtml:link rel="alternate" hreflang="da-dk" href="https://www.nestlehealthscience.dk"/>
       <xhtml:link rel="alternate" hreflang="en-in" href="https://www.nestlehealthscience.in"/>
       <xhtml:link rel="alternate" hreflang="id-id" href="https://www.nestlehealthscience.co.id"/>
       <xhtml:link rel="alternate" hreflang="it-it" href="https://www.nestlehealthscience.it"/>
       <xhtml:link rel="alternate" hreflang="pl-pl" href="https://www.nestlehealthscience.pl"/>
       <xhtml:link rel="alternate" hreflang="en-za" href="https://www.nestlehealthscience.co.za"/>
       <xhtml:link rel="alternate" hreflang="en-my" href="https://www.nestlehealthscience.my"/>
       <xhtml:link rel="alternate" hreflang="vi-vn" href="https://www.nestlehealthscience.vn"/>
       <xhtml:link rel="alternate" hreflang="cs-cz" href="https://www.nestlehealthscience.cz/cz"/>
       <xhtml:link rel="alternate" hreflang="sk-cz" href="https://www.nestlehealthscience.cz/sk"/>
       <xhtml:link rel="alternate" hreflang="en-sg" href="https://www.nestlehealthscience.sg"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-cn" href="https://www.nestlehealthscience.cn/"/>
       <xhtml:link rel="alternate" hreflang="en-ph" href="https://www.nestlehealthscience.ph/"/>
       <xhtml:link rel="alternate" hreflang="ru-ru" href="https://www.nestlehealthscience.ru/"/>
       <xhtml:link rel="alternate" hreflang="nl-nl" href="https://www.nestlehealthscience.nl/nl"/>
       <xhtml:link rel="alternate" hreflang="fr-nl" href="https://www.nestlehealthscience.nl/fr"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-tw" href="https://www.nestlehealthscience.com.tw"/>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
       </url>
      <url>
        <loc>https://www.nestlehealthscience.ch/fr</loc>
       <xhtml:link rel="alternate" hreflang="fr-ch" href="https://www.nestlehealthscience.ch/fr"/>
       <xhtml:link rel="alternate" hreflang="de-ch" href="https://www.nestlehealthscience.ch/de"/>
       <xhtml:link rel="alternate" hreflang="en" href="https://www.nestlehealthscience.com"/>
      <xhtml:link rel="alternate" hreflang="en-us" href="https://www.nestlehealthscience.us"/>
      <xhtml:link rel="alternate" hreflang="en-ca" href="https://www.nestlehealthscience.ca/en"/>
      <xhtml:link rel="alternate" hreflang="fr-ca" href="https://www.nestlehealthscience.ca/fr"/>
       <xhtml:link rel="alternate" hreflang="en-gb" href="https://www.nestlehealthscience.co.uk"/>
       <xhtml:link rel="alternate" hreflang="pt-br" href="https://www.nestlehealthscience.com.br"/>
       <xhtml:link rel="alternate" hreflang="fi-fi" href="https://www.nestlehealthscience.fi"/>
       <xhtml:link rel="alternate" hreflang="pt-pt" href="https://www.nestlehealthscience.pt"/>
       <xhtml:link rel="alternate" hreflang="th-th" href="https://www.nestlehealthscience-th.com"/>
       <xhtml:link rel="alternate" hreflang="tr-tr" href="https://www.nestlehealthscience.com.tr"/>
       <xhtml:link rel="alternate" hreflang="en-ae" href="https://www.nestlehealthscience-me.com"/>
       <xhtml:link rel="alternate" hreflang="es-mx" href="https://www.nestlehealthscience.com.mx"/>
       <xhtml:link rel="alternate" hreflang="fr-fr" href="https://www.nestlehealthscience.fr"/>
       <xhtml:link rel="alternate" hreflang="sv-se" href="https://www.nestlehealthscience.se"/>
       <xhtml:link rel="alternate" hreflang="en-lk" href="https://www.nestlehealthscience.lk"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-hk" href="https://www.nestlehealthscience.com.hk"/>
       <xhtml:link rel="alternate" hreflang="ja-jp" href="https://www.nestlehealthscience.jp"/>
       <xhtml:link rel="alternate" hreflang="es-es" href="https://www.nestlehealthscience.es"/>
       <xhtml:link rel="alternate" hreflang="ro-ro" href="https://www.nestlehealthscience.ro"/>
       <xhtml:link rel="alternate" hreflang="de-de" href="https://www.nestlehealthscience.de"/>
       <xhtml:link rel="alternate" hreflang="da-dk" href="https://www.nestlehealthscience.dk"/>
       <xhtml:link rel="alternate" hreflang="en-in" href="https://www.nestlehealthscience.in"/>
       <xhtml:link rel="alternate" hreflang="id-id" href="https://www.nestlehealthscience.co.id"/>
       <xhtml:link rel="alternate" hreflang="it-it" href="https://www.nestlehealthscience.it"/>
       <xhtml:link rel="alternate" hreflang="pl-pl" href="https://www.nestlehealthscience.pl"/>
       <xhtml:link rel="alternate" hreflang="en-za" href="https://www.nestlehealthscience.co.za"/>
       <xhtml:link rel="alternate" hreflang="en-my" href="https://www.nestlehealthscience.my"/>
       <xhtml:link rel="alternate" hreflang="vi-vn" href="https://www.nestlehealthscience.vn"/>
       <xhtml:link rel="alternate" hreflang="cs-cz" href="https://www.nestlehealthscience.cz/cz"/>
       <xhtml:link rel="alternate" hreflang="sk-cz" href="https://www.nestlehealthscience.cz/sk"/>
       <xhtml:link rel="alternate" hreflang="en-sg" href="https://www.nestlehealthscience.sg"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-cn" href="https://www.nestlehealthscience.cn/"/>
       <xhtml:link rel="alternate" hreflang="en-ph" href="https://www.nestlehealthscience.ph/"/>
       <xhtml:link rel="alternate" hreflang="ru-ru" href="https://www.nestlehealthscience.ru/"/>
       <xhtml:link rel="alternate" hreflang="nl-nl" href="https://www.nestlehealthscience.nl/nl"/>
       <xhtml:link rel="alternate" hreflang="fr-nl" href="https://www.nestlehealthscience.nl/fr"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-tw" href="https://www.nestlehealthscience.com.tw"/>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
       </url>
       <url>
       <loc>https://www.nestlehealthscience.ch/de/marken</loc>
       <xhtml:link rel="alternate" hreflang="de-ch" href="https://www.nestlehealthscience.ch/de/marken"/>
       <xhtml:link rel="alternate" hreflang="fr-ch" href="https://www.nestlehealthscience.ch/fr/nos-marques"/>
        <xhtml:link rel="alternate" hreflang="en" href="https://www.nestlehealthscience.com/brands"/>
      <xhtml:link rel="alternate" hreflang="en-ca" href="https://www.nestlehealthscience.ca/en/brands"/>
      <xhtml:link rel="alternate" hreflang="fr-ca" href="https://www.nestlehealthscience.ca/fr/marques/home"/>
       <xhtml:link rel="alternate" hreflang="en-gb" href="https://www.nestlehealthscience.co.uk/brands"/>
       <xhtml:link rel="alternate" hreflang="pt-br" href="https://www.nestlehealthscience.com.br/marcas"/>
       <xhtml:link rel="alternate" hreflang="fi-fi" href="https://www.nestlehealthscience.fi/tuotteet"/>
       <xhtml:link rel="alternate" hreflang="pt-pt" href="http://nestlehealthscience.pt/marcas"/>
       <xhtml:link rel="alternate" hreflang="th-th" href="https://www.nestlehealthscience-th.com"/>
       <xhtml:link rel="alternate" hreflang="tr-tr" href="https://www.nestlehealthscience.com.tr/brands"/>
       <xhtml:link rel="alternate" hreflang="en-ae" href="https://www.nestlehealthscience-me.com/en/brands"/>
       <xhtml:link rel="alternate" hreflang="es-mx" href="https://www.nestlehealthscience.com.mx/marcas"/>
       <xhtml:link rel="alternate" hreflang="fr-fr" href="https://www.nestlehealthscience.fr/nos-marques"/>
       <xhtml:link rel="alternate" hreflang="sv-se" href="https://www.nestlehealthscience.se/produkter"/>
       <xhtml:link rel="alternate" hreflang="en-lk" href="https://www.nestlehealthscience.lk/brands"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-hk" href="https://www.nestlehealthscience.com.hk/zh-hans/brands"/>
       <xhtml:link rel="alternate" hreflang="ja-jp" href="https://www.nestlehealthscience.jp/brands"/>
       <xhtml:link rel="alternate" hreflang="es-es" href="https://www.nestlehealthscience.es/marcas"/>
       <xhtml:link rel="alternate" hreflang="ro-ro" href="https://www.nestlehealthscience.ro/produse"/>
       <xhtml:link rel="alternate" hreflang="de-de" href="https://www.nestlehealthscience.de/marken"/>
       <xhtml:link rel="alternate" hreflang="da-dk" href="https://www.nestlehealthscience.dk/produkter"/>
       <xhtml:link rel="alternate" hreflang="en-in" href="https://www.nestlehealthscience.in/brands"/>
       <xhtml:link rel="alternate" hreflang="id-id" href="https://www.nestlehealthscience.co.id/brands"/>
       <xhtml:link rel="alternate" hreflang="it-it" href="https://www.nestlehealthscience.it/prodotti"/>
       <xhtml:link rel="alternate" hreflang="pl-pl" href="https://www.nestlehealthscience.pl/produkty"/>
       <xhtml:link rel="alternate" hreflang="en-za" href="https://www.nestlehealthscience.co.za/brands"/>
       <xhtml:link rel="alternate" hreflang="en-my" href="https://www.nestlehealthscience.my/brands"/>
       <xhtml:link rel="alternate" hreflang="vi-vn" href="https://www.nestlehealthscience.vn/san-pham"/>
       <xhtml:link rel="alternate" hreflang="cs-cz" href="https://www.nestlehealthscience.cz/cz/produkty"/>
       <xhtml:link rel="alternate" hreflang="sk-cz" href="https://www.nestlehealthscience.cz/sk/produkty"/>
       <xhtml:link rel="alternate" hreflang="en-sg" href="https://www.nestlehealthscience.sg/brands"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-cn" href="https://www.nestlehealthscience.cn/brands"/>
       <xhtml:link rel="alternate" hreflang="en-ph" href="https://www.nestlehealthscience.ph/brands"/>
       <xhtml:link rel="alternate" hreflang="ru-ru" href="https://www.nestlehealthscience.ru/brands"/>
       <xhtml:link rel="alternate" hreflang="nl-nl" href="https://www.nestlehealthscience.nl/nl/producten"/>
       <xhtml:link rel="alternate" hreflang="fr-nl" href="https://www.nestlehealthscience.nl/fr/producten"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-tw" href="https://www.nestlehealthscience.com.tw/brands"/>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
       </url>
      <url>
       <loc>https://www.nestlehealthscience.ch/fr/nos-marques</loc>
       <xhtml:link rel="alternate" hreflang="fr-ch" href="https://www.nestlehealthscience.ch/fr/nos-marques"/>
       <xhtml:link rel="alternate" hreflang="de-ch" href="https://www.nestlehealthscience.ch/de/marken"/>
        <xhtml:link rel="alternate" hreflang="en" href="https://www.nestlehealthscience.com/brands"/>
      <xhtml:link rel="alternate" hreflang="en-ca" href="https://www.nestlehealthscience.ca/en/brands"/>
      <xhtml:link rel="alternate" hreflang="fr-ca" href="https://www.nestlehealthscience.ca/fr/marques/home"/>
       <xhtml:link rel="alternate" hreflang="en-gb" href="https://www.nestlehealthscience.co.uk/brands"/>
       <xhtml:link rel="alternate" hreflang="pt-br" href="https://www.nestlehealthscience.com.br/marcas"/>
       <xhtml:link rel="alternate" hreflang="fi-fi" href="https://www.nestlehealthscience.fi/tuotteet"/>
       <xhtml:link rel="alternate" hreflang="pt-pt" href="http://nestlehealthscience.pt/marcas"/>
       <xhtml:link rel="alternate" hreflang="th-th" href="https://www.nestlehealthscience-th.com"/>
       <xhtml:link rel="alternate" hreflang="tr-tr" href="https://www.nestlehealthscience.com.tr/brands"/>
       <xhtml:link rel="alternate" hreflang="en-ae" href="https://www.nestlehealthscience-me.com/en/brands"/>
       <xhtml:link rel="alternate" hreflang="es-mx" href="https://www.nestlehealthscience.com.mx/marcas"/>
       <xhtml:link rel="alternate" hreflang="fr-fr" href="https://www.nestlehealthscience.fr/nos-marques"/>
       <xhtml:link rel="alternate" hreflang="sv-se" href="https://www.nestlehealthscience.se/produkter"/>
       <xhtml:link rel="alternate" hreflang="en-lk" href="https://www.nestlehealthscience.lk/brands"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-hk" href="https://www.nestlehealthscience.com.hk/zh-hans/brands"/>
       <xhtml:link rel="alternate" hreflang="ja-jp" href="https://www.nestlehealthscience.jp/brands"/>
       <xhtml:link rel="alternate" hreflang="es-es" href="https://www.nestlehealthscience.es/marcas"/>
       <xhtml:link rel="alternate" hreflang="ro-ro" href="https://www.nestlehealthscience.ro/produse"/>
       <xhtml:link rel="alternate" hreflang="de-de" href="https://www.nestlehealthscience.de/marken"/>
       <xhtml:link rel="alternate" hreflang="da-dk" href="https://www.nestlehealthscience.dk/produkter"/>
       <xhtml:link rel="alternate" hreflang="en-in" href="https://www.nestlehealthscience.in/brands"/>
       <xhtml:link rel="alternate" hreflang="id-id" href="https://www.nestlehealthscience.co.id/brands"/>
       <xhtml:link rel="alternate" hreflang="it-it" href="https://www.nestlehealthscience.it/prodotti"/>
       <xhtml:link rel="alternate" hreflang="pl-pl" href="https://www.nestlehealthscience.pl/produkty"/>
       <xhtml:link rel="alternate" hreflang="en-za" href="https://www.nestlehealthscience.co.za/brands"/>
       <xhtml:link rel="alternate" hreflang="en-my" href="https://www.nestlehealthscience.my/brands"/>
       <xhtml:link rel="alternate" hreflang="vi-vn" href="https://www.nestlehealthscience.vn/san-pham"/>
       <xhtml:link rel="alternate" hreflang="cs-cz" href="https://www.nestlehealthscience.cz/cz/produkty"/>
       <xhtml:link rel="alternate" hreflang="sk-cz" href="https://www.nestlehealthscience.cz/sk/produkty"/>
       <xhtml:link rel="alternate" hreflang="en-sg" href="https://www.nestlehealthscience.sg/brands"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-cn" href="https://www.nestlehealthscience.cn/brands"/>
       <xhtml:link rel="alternate" hreflang="en-ph" href="https://www.nestlehealthscience.ph/brands"/>
       <xhtml:link rel="alternate" hreflang="ru-ru" href="https://www.nestlehealthscience.ru/brands"/>
       <xhtml:link rel="alternate" hreflang="nl-nl" href="https://www.nestlehealthscience.nl/nl/producten"/>
       <xhtml:link rel="alternate" hreflang="fr-nl" href="https://www.nestlehealthscience.nl/fr/producten"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-tw" href="https://www.nestlehealthscience.com.tw/brands"/>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
       </url>
      </urlset>';
    }

    public function taiwan()
    {
      return '<?xml version="1.0" encoding="UTF-8"?>
      <urlset
          xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
          xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd
          http://www.w3.org/1999/xhtml http://www.w3.org/2002/08/xhtml/xhtml1-strict.xsd"
          xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
          xmlns:xhtml="http://www.w3.org/1999/xhtml"   
      >
      <url>
        <loc>https://www.nestlehealthscience.com.tw</loc>
       <xhtml:link rel="alternate" hreflang="zh-hans-tw" href="https://www.nestlehealthscience.com.tw"/>
       <xhtml:link rel="alternate" hreflang="en" href="https://www.nestlehealthscience.com"/>
      <xhtml:link rel="alternate" hreflang="en-us" href="https://www.nestlehealthscience.us"/>
      <xhtml:link rel="alternate" hreflang="en-ca" href="https://www.nestlehealthscience.ca/en"/>
      <xhtml:link rel="alternate" hreflang="fr-ca" href="https://www.nestlehealthscience.ca/fr"/>
       <xhtml:link rel="alternate" hreflang="en-gb" href="https://www.nestlehealthscience.co.uk"/>
       <xhtml:link rel="alternate" hreflang="pt-br" href="https://www.nestlehealthscience.com.br"/>
       <xhtml:link rel="alternate" hreflang="fi-fi" href="https://www.nestlehealthscience.fi"/>
       <xhtml:link rel="alternate" hreflang="pt-pt" href="https://www.nestlehealthscience.pt"/>
       <xhtml:link rel="alternate" hreflang="th-th" href="https://www.nestlehealthscience-th.com"/>
       <xhtml:link rel="alternate" hreflang="tr-tr" href="https://www.nestlehealthscience.com.tr"/>
       <xhtml:link rel="alternate" hreflang="en-ae" href="https://www.nestlehealthscience-me.com"/>
       <xhtml:link rel="alternate" hreflang="es-mx" href="https://www.nestlehealthscience.com.mx"/>
       <xhtml:link rel="alternate" hreflang="fr-fr" href="https://www.nestlehealthscience.fr"/>
       <xhtml:link rel="alternate" hreflang="sv-se" href="https://www.nestlehealthscience.se"/>
       <xhtml:link rel="alternate" hreflang="en-lk" href="https://www.nestlehealthscience.lk"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-hk" href="https://www.nestlehealthscience.com.hk"/>
       <xhtml:link rel="alternate" hreflang="ja-jp" href="https://www.nestlehealthscience.jp"/>
       <xhtml:link rel="alternate" hreflang="es-es" href="https://www.nestlehealthscience.es"/>
       <xhtml:link rel="alternate" hreflang="ro-ro" href="https://www.nestlehealthscience.ro"/>
       <xhtml:link rel="alternate" hreflang="de-de" href="https://www.nestlehealthscience.de"/>
       <xhtml:link rel="alternate" hreflang="da-dk" href="https://www.nestlehealthscience.dk"/>
       <xhtml:link rel="alternate" hreflang="en-in" href="https://www.nestlehealthscience.in"/>
       <xhtml:link rel="alternate" hreflang="de-ch" href="https://www.nestlehealthscience.ch/de"/>
       <xhtml:link rel="alternate" hreflang="fr-ch" href="https://www.nestlehealthscience.ch/fr"/>
       <xhtml:link rel="alternate" hreflang="id-id" href="https://www.nestlehealthscience.co.id"/>
       <xhtml:link rel="alternate" hreflang="it-it" href="https://www.nestlehealthscience.it"/>
       <xhtml:link rel="alternate" hreflang="pl-pl" href="https://www.nestlehealthscience.pl"/>
       <xhtml:link rel="alternate" hreflang="en-za" href="https://www.nestlehealthscience.co.za"/>
       <xhtml:link rel="alternate" hreflang="en-my" href="https://www.nestlehealthscience.my"/>
       <xhtml:link rel="alternate" hreflang="vi-vn" href="https://www.nestlehealthscience.vn"/>
       <xhtml:link rel="alternate" hreflang="cs-cz" href="https://www.nestlehealthscience.cz/cz"/>
       <xhtml:link rel="alternate" hreflang="sk-cz" href="https://www.nestlehealthscience.cz/sk"/>
       <xhtml:link rel="alternate" hreflang="en-sg" href="https://www.nestlehealthscience.sg"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-cn" href="https://www.nestlehealthscience.cn/"/>
       <xhtml:link rel="alternate" hreflang="en-ph" href="https://www.nestlehealthscience.ph/"/>
       <xhtml:link rel="alternate" hreflang="ru-ru" href="https://www.nestlehealthscience.ru/"/>
       <xhtml:link rel="alternate" hreflang="nl-nl" href="https://www.nestlehealthscience.nl/nl"/>
       <xhtml:link rel="alternate" hreflang="fr-nl" href="https://www.nestlehealthscience.nl/fr"/>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
       </url>
       <url>
       <loc>https://www.nestlehealthscience.com.tw/brands</loc>
       <xhtml:link rel="alternate" hreflang="zh-hans-tw" href="https://www.nestlehealthscience.com.tw/brands"/>
        <xhtml:link rel="alternate" hreflang="en" href="https://www.nestlehealthscience.com/brands"/>
      <xhtml:link rel="alternate" hreflang="en-ca" href="https://www.nestlehealthscience.ca/en/brands"/>
      <xhtml:link rel="alternate" hreflang="fr-ca" href="https://www.nestlehealthscience.ca/fr/marques/home"/>
       <xhtml:link rel="alternate" hreflang="en-gb" href="https://www.nestlehealthscience.co.uk/brands"/>
       <xhtml:link rel="alternate" hreflang="pt-br" href="https://www.nestlehealthscience.com.br/marcas"/>
       <xhtml:link rel="alternate" hreflang="fi-fi" href="https://www.nestlehealthscience.fi/tuotteet"/>
       <xhtml:link rel="alternate" hreflang="pt-pt" href="http://nestlehealthscience.pt/marcas"/>
       <xhtml:link rel="alternate" hreflang="th-th" href="https://www.nestlehealthscience-th.com"/>
       <xhtml:link rel="alternate" hreflang="tr-tr" href="https://www.nestlehealthscience.com.tr/brands"/>
       <xhtml:link rel="alternate" hreflang="en-ae" href="https://www.nestlehealthscience-me.com/en/brands"/>
       <xhtml:link rel="alternate" hreflang="es-mx" href="https://www.nestlehealthscience.com.mx/marcas"/>
       <xhtml:link rel="alternate" hreflang="fr-fr" href="https://www.nestlehealthscience.fr/nos-marques"/>
       <xhtml:link rel="alternate" hreflang="sv-se" href="https://www.nestlehealthscience.se/produkter"/>
       <xhtml:link rel="alternate" hreflang="en-lk" href="https://www.nestlehealthscience.lk/brands"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-hk" href="https://www.nestlehealthscience.com.hk/zh-hans/brands"/>
       <xhtml:link rel="alternate" hreflang="ja-jp" href="https://www.nestlehealthscience.jp/brands"/>
       <xhtml:link rel="alternate" hreflang="es-es" href="https://www.nestlehealthscience.es/marcas"/>
       <xhtml:link rel="alternate" hreflang="ro-ro" href="https://www.nestlehealthscience.ro/produse"/>
       <xhtml:link rel="alternate" hreflang="de-de" href="https://www.nestlehealthscience.de/marken"/>
       <xhtml:link rel="alternate" hreflang="da-dk" href="https://www.nestlehealthscience.dk/produkter"/>
       <xhtml:link rel="alternate" hreflang="en-in" href="https://www.nestlehealthscience.in/brands"/>
       <xhtml:link rel="alternate" hreflang="de-ch" href="https://www.nestlehealthscience.ch/de/marken"/>
       <xhtml:link rel="alternate" hreflang="fr-ch" href="https://www.nestlehealthscience.ch/fr/nos-marques"/>
       <xhtml:link rel="alternate" hreflang="id-id" href="https://www.nestlehealthscience.co.id/brands"/>
       <xhtml:link rel="alternate" hreflang="it-it" href="https://www.nestlehealthscience.it/prodotti"/>
       <xhtml:link rel="alternate" hreflang="pl-pl" href="https://www.nestlehealthscience.pl/produkty"/>
       <xhtml:link rel="alternate" hreflang="en-za" href="https://www.nestlehealthscience.co.za/brands"/>
       <xhtml:link rel="alternate" hreflang="en-my" href="https://www.nestlehealthscience.my/brands"/>
       <xhtml:link rel="alternate" hreflang="vi-vn" href="https://www.nestlehealthscience.vn/san-pham"/>
       <xhtml:link rel="alternate" hreflang="cs-cz" href="https://www.nestlehealthscience.cz/cz/produkty"/>
       <xhtml:link rel="alternate" hreflang="sk-cz" href="https://www.nestlehealthscience.cz/sk/produkty"/>
       <xhtml:link rel="alternate" hreflang="en-sg" href="https://www.nestlehealthscience.sg/brands"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-cn" href="https://www.nestlehealthscience.cn/brands"/>
       <xhtml:link rel="alternate" hreflang="en-ph" href="https://www.nestlehealthscience.ph/brands"/>
       <xhtml:link rel="alternate" hreflang="ru-ru" href="https://www.nestlehealthscience.ru/brands"/>
       <xhtml:link rel="alternate" hreflang="nl-nl" href="https://www.nestlehealthscience.nl/nl/producten"/>
       <xhtml:link rel="alternate" hreflang="fr-nl" href="https://www.nestlehealthscience.nl/fr/producten"/>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
       </url>
      </urlset>';
    }

    public function thailand(){

      return '<?xml version="1.0" encoding="UTF-8"?>
      <urlset
          xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
          xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd
          http://www.w3.org/1999/xhtml http://www.w3.org/2002/08/xhtml/xhtml1-strict.xsd"
          xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
          xmlns:xhtml="http://www.w3.org/1999/xhtml"   
      >
      <url>
        <loc>https://www.nestlehealthscience-th.com</loc>
       <xhtml:link rel="alternate" hreflang="th-th" href="https://www.nestlehealthscience-th.com"/>
      html:link rel="alternate" hreflang="en" href="https://www.nestlehealthscience.com"/>
      <xhtml:link rel="alternate" hreflang="en-us" href="https://www.nestlehealthscience.us"/>
      <xhtml:link rel="alternate" hreflang="en-ca" href="https://www.nestlehealthscience.ca/en"/>
      <xhtml:link rel="alternate" hreflang="fr-ca" href="https://www.nestlehealthscience.ca/fr"/>
       <xhtml:link rel="alternate" hreflang="en-gb" href="https://www.nestlehealthscience.co.uk"/>
       <xhtml:link rel="alternate" hreflang="pt-br" href="https://www.nestlehealthscience.com.br"/>
       <xhtml:link rel="alternate" hreflang="fi-fi" href="https://www.nestlehealthscience.fi"/>
       <xhtml:link rel="alternate" hreflang="pt-pt" href="https://www.nestlehealthscience.pt"/>
       <xhtml:link rel="alternate" hreflang="tr-tr" href="https://www.nestlehealthscience.com.tr"/>
       <xhtml:link rel="alternate" hreflang="en-ae" href="https://www.nestlehealthscience-me.com"/>
       <xhtml:link rel="alternate" hreflang="es-mx" href="https://www.nestlehealthscience.com.mx"/>
       <xhtml:link rel="alternate" hreflang="fr-fr" href="https://www.nestlehealthscience.fr"/>
       <xhtml:link rel="alternate" hreflang="sv-se" href="https://www.nestlehealthscience.se"/>
       <xhtml:link rel="alternate" hreflang="en-lk" href="https://www.nestlehealthscience.lk"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-hk" href="https://www.nestlehealthscience.com.hk"/>
       <xhtml:link rel="alternate" hreflang="ja-jp" href="https://www.nestlehealthscience.jp"/>
       <xhtml:link rel="alternate" hreflang="es-es" href="https://www.nestlehealthscience.es"/>
       <xhtml:link rel="alternate" hreflang="ro-ro" href="https://www.nestlehealthscience.ro"/>
       <xhtml:link rel="alternate" hreflang="de-de" href="https://www.nestlehealthscience.de"/>
       <xhtml:link rel="alternate" hreflang="da-dk" href="https://www.nestlehealthscience.dk"/>
       <xhtml:link rel="alternate" hreflang="en-in" href="https://www.nestlehealthscience.in"/>
       <xhtml:link rel="alternate" hreflang="de-ch" href="https://www.nestlehealthscience.ch/de"/>
       <xhtml:link rel="alternate" hreflang="fr-ch" href="https://www.nestlehealthscience.ch/fr"/>
       <xhtml:link rel="alternate" hreflang="id-id" href="https://www.nestlehealthscience.co.id"/>
       <xhtml:link rel="alternate" hreflang="it-it" href="https://www.nestlehealthscience.it"/>
       <xhtml:link rel="alternate" hreflang="pl-pl" href="https://www.nestlehealthscience.pl"/>
       <xhtml:link rel="alternate" hreflang="en-za" href="https://www.nestlehealthscience.co.za"/>
       <xhtml:link rel="alternate" hreflang="en-my" href="https://www.nestlehealthscience.my"/>
       <xhtml:link rel="alternate" hreflang="vi-vn" href="https://www.nestlehealthscience.vn"/>
       <xhtml:link rel="alternate" hreflang="cs-cz" href="https://www.nestlehealthscience.cz/cz"/>
       <xhtml:link rel="alternate" hreflang="sk-cz" href="https://www.nestlehealthscience.cz/sk"/>
       <xhtml:link rel="alternate" hreflang="en-sg" href="https://www.nestlehealthscience.sg"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-cn" href="https://www.nestlehealthscience.cn/"/>
       <xhtml:link rel="alternate" hreflang="en-ph" href="https://www.nestlehealthscience.ph/"/>
       <xhtml:link rel="alternate" hreflang="ru-ru" href="https://www.nestlehealthscience.ru/"/>
       <xhtml:link rel="alternate" hreflang="nl-nl" href="https://www.nestlehealthscience.nl/nl"/>
       <xhtml:link rel="alternate" hreflang="fr-nl" href="https://www.nestlehealthscience.nl/fr"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-tw" href="https://www.nestlehealthscience.com.tw"/>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
       </url>
      </urlset>';
    }


    public function turkey()
    {
      return '<?xml version="1.0" encoding="UTF-8"?>
      <urlset
          xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
          xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd
          http://www.w3.org/1999/xhtml http://www.w3.org/2002/08/xhtml/xhtml1-strict.xsd"
          xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
          xmlns:xhtml="http://www.w3.org/1999/xhtml"   
      >
      <url>
        <loc>https://www.nestlehealthscience.com.tr</loc>
       <xhtml:link rel="alternate" hreflang="tr-tr" href="https://www.nestlehealthscience.com.tr"/>
      html:link rel="alternate" hreflang="en" href="https://www.nestlehealthscience.com"/>
      <xhtml:link rel="alternate" hreflang="en-us" href="https://www.nestlehealthscience.us"/>
      <xhtml:link rel="alternate" hreflang="en-ca" href="https://www.nestlehealthscience.ca/en"/>
      <xhtml:link rel="alternate" hreflang="fr-ca" href="https://www.nestlehealthscience.ca/fr"/>
       <xhtml:link rel="alternate" hreflang="en-gb" href="https://www.nestlehealthscience.co.uk"/>
       <xhtml:link rel="alternate" hreflang="pt-br" href="https://www.nestlehealthscience.com.br"/>
       <xhtml:link rel="alternate" hreflang="fi-fi" href="https://www.nestlehealthscience.fi"/>
       <xhtml:link rel="alternate" hreflang="pt-pt" href="https://www.nestlehealthscience.pt"/>
       <xhtml:link rel="alternate" hreflang="th-th" href="https://www.nestlehealthscience-th.com"/>
       <xhtml:link rel="alternate" hreflang="en-ae" href="https://www.nestlehealthscience-me.com"/>
       <xhtml:link rel="alternate" hreflang="es-mx" href="https://www.nestlehealthscience.com.mx"/>
       <xhtml:link rel="alternate" hreflang="fr-fr" href="https://www.nestlehealthscience.fr"/>
       <xhtml:link rel="alternate" hreflang="sv-se" href="https://www.nestlehealthscience.se"/>
       <xhtml:link rel="alternate" hreflang="en-lk" href="https://www.nestlehealthscience.lk"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-hk" href="https://www.nestlehealthscience.com.hk"/>
       <xhtml:link rel="alternate" hreflang="ja-jp" href="https://www.nestlehealthscience.jp"/>
       <xhtml:link rel="alternate" hreflang="es-es" href="https://www.nestlehealthscience.es"/>
       <xhtml:link rel="alternate" hreflang="ro-ro" href="https://www.nestlehealthscience.ro"/>
       <xhtml:link rel="alternate" hreflang="de-de" href="https://www.nestlehealthscience.de"/>
       <xhtml:link rel="alternate" hreflang="da-dk" href="https://www.nestlehealthscience.dk"/>
       <xhtml:link rel="alternate" hreflang="en-in" href="https://www.nestlehealthscience.in"/>
       <xhtml:link rel="alternate" hreflang="de-ch" href="https://www.nestlehealthscience.ch/de"/>
       <xhtml:link rel="alternate" hreflang="fr-ch" href="https://www.nestlehealthscience.ch/fr"/>
       <xhtml:link rel="alternate" hreflang="id-id" href="https://www.nestlehealthscience.co.id"/>
       <xhtml:link rel="alternate" hreflang="it-it" href="https://www.nestlehealthscience.it"/>
       <xhtml:link rel="alternate" hreflang="pl-pl" href="https://www.nestlehealthscience.pl"/>
       <xhtml:link rel="alternate" hreflang="en-za" href="https://www.nestlehealthscience.co.za"/>
       <xhtml:link rel="alternate" hreflang="en-my" href="https://www.nestlehealthscience.my"/>
       <xhtml:link rel="alternate" hreflang="vi-vn" href="https://www.nestlehealthscience.vn"/>
       <xhtml:link rel="alternate" hreflang="cs-cz" href="https://www.nestlehealthscience.cz/cz"/>
       <xhtml:link rel="alternate" hreflang="sk-cz" href="https://www.nestlehealthscience.cz/sk"/>
       <xhtml:link rel="alternate" hreflang="en-sg" href="https://www.nestlehealthscience.sg"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-cn" href="https://www.nestlehealthscience.cn/"/>
       <xhtml:link rel="alternate" hreflang="en-ph" href="https://www.nestlehealthscience.ph/"/>
       <xhtml:link rel="alternate" hreflang="ru-ru" href="https://www.nestlehealthscience.ru/"/>
       <xhtml:link rel="alternate" hreflang="nl-nl" href="https://www.nestlehealthscience.nl/nl"/>
       <xhtml:link rel="alternate" hreflang="fr-nl" href="https://www.nestlehealthscience.nl/fr"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-tw" href="https://www.nestlehealthscience.com.tw"/>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
       </url>
       <url>
       <loc>https://www.nestlehealthscience.com.tr/brands</loc>
       <xhtml:link rel="alternate" hreflang="tr-tr" href="https://www.nestlehealthscience.com.tr/brands"/>
        <xhtml:link rel="alternate" hreflang="en" href="https://www.nestlehealthscience.com/brands"/>
      <xhtml:link rel="alternate" hreflang="en-ca" href="https://www.nestlehealthscience.ca/en/brands"/>
      <xhtml:link rel="alternate" hreflang="fr-ca" href="https://www.nestlehealthscience.ca/fr/marques/home"/>
       <xhtml:link rel="alternate" hreflang="en-gb" href="https://www.nestlehealthscience.co.uk/brands"/>
       <xhtml:link rel="alternate" hreflang="pt-br" href="https://www.nestlehealthscience.com.br/marcas"/>
       <xhtml:link rel="alternate" hreflang="fi-fi" href="https://www.nestlehealthscience.fi/tuotteet"/>
       <xhtml:link rel="alternate" hreflang="pt-pt" href="http://nestlehealthscience.pt/marcas"/>
       <xhtml:link rel="alternate" hreflang="th-th" href="https://www.nestlehealthscience-th.com"/>
       <xhtml:link rel="alternate" hreflang="en-ae" href="https://www.nestlehealthscience-me.com/en/brands"/>
       <xhtml:link rel="alternate" hreflang="es-mx" href="https://www.nestlehealthscience.com.mx/marcas"/>
       <xhtml:link rel="alternate" hreflang="fr-fr" href="https://www.nestlehealthscience.fr/nos-marques"/>
       <xhtml:link rel="alternate" hreflang="sv-se" href="https://www.nestlehealthscience.se/produkter"/>
       <xhtml:link rel="alternate" hreflang="en-lk" href="https://www.nestlehealthscience.lk/brands"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-hk" href="https://www.nestlehealthscience.com.hk/zh-hans/brands"/>
       <xhtml:link rel="alternate" hreflang="ja-jp" href="https://www.nestlehealthscience.jp/brands"/>
       <xhtml:link rel="alternate" hreflang="es-es" href="https://www.nestlehealthscience.es/marcas"/>
       <xhtml:link rel="alternate" hreflang="ro-ro" href="https://www.nestlehealthscience.ro/produse"/>
       <xhtml:link rel="alternate" hreflang="de-de" href="https://www.nestlehealthscience.de/marken"/>
       <xhtml:link rel="alternate" hreflang="da-dk" href="https://www.nestlehealthscience.dk/produkter"/>
       <xhtml:link rel="alternate" hreflang="en-in" href="https://www.nestlehealthscience.in/brands"/>
       <xhtml:link rel="alternate" hreflang="de-ch" href="https://www.nestlehealthscience.ch/de/marken"/>
       <xhtml:link rel="alternate" hreflang="fr-ch" href="https://www.nestlehealthscience.ch/fr/nos-marques"/>
       <xhtml:link rel="alternate" hreflang="id-id" href="https://www.nestlehealthscience.co.id/brands"/>
       <xhtml:link rel="alternate" hreflang="it-it" href="https://www.nestlehealthscience.it/prodotti"/>
       <xhtml:link rel="alternate" hreflang="pl-pl" href="https://www.nestlehealthscience.pl/produkty"/>
       <xhtml:link rel="alternate" hreflang="en-za" href="https://www.nestlehealthscience.co.za/brands"/>
       <xhtml:link rel="alternate" hreflang="en-my" href="https://www.nestlehealthscience.my/brands"/>
       <xhtml:link rel="alternate" hreflang="vi-vn" href="https://www.nestlehealthscience.vn/san-pham"/>
       <xhtml:link rel="alternate" hreflang="cs-cz" href="https://www.nestlehealthscience.cz/cz/produkty"/>
       <xhtml:link rel="alternate" hreflang="sk-cz" href="https://www.nestlehealthscience.cz/sk/produkty"/>
       <xhtml:link rel="alternate" hreflang="en-sg" href="https://www.nestlehealthscience.sg/brands"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-cn" href="https://www.nestlehealthscience.cn/brands"/>
       <xhtml:link rel="alternate" hreflang="en-ph" href="https://www.nestlehealthscience.ph/brands"/>
       <xhtml:link rel="alternate" hreflang="ru-ru" href="https://www.nestlehealthscience.ru/brands"/>
       <xhtml:link rel="alternate" hreflang="nl-nl" href="https://www.nestlehealthscience.nl/nl/producten"/>
       <xhtml:link rel="alternate" hreflang="fr-nl" href="https://www.nestlehealthscience.nl/fr/producten"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-tw" href="https://www.nestlehealthscience.com.tw/brands"/>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
       </url>
      </urlset>';
    }


    public function uae()
    {
      return '<?xml version="1.0" encoding="UTF-8"?>
      <urlset
          xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
          xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd
          http://www.w3.org/1999/xhtml http://www.w3.org/2002/08/xhtml/xhtml1-strict.xsd"
          xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
          xmlns:xhtml="http://www.w3.org/1999/xhtml"   
      >
      <url>
        <loc>https://www.nestlehealthscience-me.com</loc>
       <xhtml:link rel="alternate" hreflang="en-ae" href="https://www.nestlehealthscience-me.com"/>
       <xhtml:link rel="alternate" hreflang="en" href="https://www.nestlehealthscience.com"/>
      <xhtml:link rel="alternate" hreflang="en-us" href="https://www.nestlehealthscience.us"/>
      <xhtml:link rel="alternate" hreflang="en-ca" href="https://www.nestlehealthscience.ca/en"/>
      <xhtml:link rel="alternate" hreflang="fr-ca" href="https://www.nestlehealthscience.ca/fr"/>
       <xhtml:link rel="alternate" hreflang="en-gb" href="https://www.nestlehealthscience.co.uk"/>
       <xhtml:link rel="alternate" hreflang="pt-br" href="https://www.nestlehealthscience.com.br"/>
       <xhtml:link rel="alternate" hreflang="fi-fi" href="https://www.nestlehealthscience.fi"/>
       <xhtml:link rel="alternate" hreflang="pt-pt" href="https://www.nestlehealthscience.pt"/>
       <xhtml:link rel="alternate" hreflang="th-th" href="https://www.nestlehealthscience-th.com"/>
       <xhtml:link rel="alternate" hreflang="tr-tr" href="https://www.nestlehealthscience.com.tr"/>
       <xhtml:link rel="alternate" hreflang="es-mx" href="https://www.nestlehealthscience.com.mx"/>
       <xhtml:link rel="alternate" hreflang="fr-fr" href="https://www.nestlehealthscience.fr"/>
       <xhtml:link rel="alternate" hreflang="sv-se" href="https://www.nestlehealthscience.se"/>
       <xhtml:link rel="alternate" hreflang="en-lk" href="https://www.nestlehealthscience.lk"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-hk" href="https://www.nestlehealthscience.com.hk"/>
       <xhtml:link rel="alternate" hreflang="ja-jp" href="https://www.nestlehealthscience.jp"/>
       <xhtml:link rel="alternate" hreflang="es-es" href="https://www.nestlehealthscience.es"/>
       <xhtml:link rel="alternate" hreflang="ro-ro" href="https://www.nestlehealthscience.ro"/>
       <xhtml:link rel="alternate" hreflang="de-de" href="https://www.nestlehealthscience.de"/>
       <xhtml:link rel="alternate" hreflang="da-dk" href="https://www.nestlehealthscience.dk"/>
       <xhtml:link rel="alternate" hreflang="en-in" href="https://www.nestlehealthscience.in"/>
       <xhtml:link rel="alternate" hreflang="de-ch" href="https://www.nestlehealthscience.ch/de"/>
       <xhtml:link rel="alternate" hreflang="fr-ch" href="https://www.nestlehealthscience.ch/fr"/>
       <xhtml:link rel="alternate" hreflang="id-id" href="https://www.nestlehealthscience.co.id"/>
       <xhtml:link rel="alternate" hreflang="it-it" href="https://www.nestlehealthscience.it"/>
       <xhtml:link rel="alternate" hreflang="pl-pl" href="https://www.nestlehealthscience.pl"/>
       <xhtml:link rel="alternate" hreflang="en-za" href="https://www.nestlehealthscience.co.za"/>
       <xhtml:link rel="alternate" hreflang="en-my" href="https://www.nestlehealthscience.my"/>
       <xhtml:link rel="alternate" hreflang="vi-vn" href="https://www.nestlehealthscience.vn"/>
       <xhtml:link rel="alternate" hreflang="cs-cz" href="https://www.nestlehealthscience.cz/cz"/>
       <xhtml:link rel="alternate" hreflang="sk-cz" href="https://www.nestlehealthscience.cz/sk"/>
       <xhtml:link rel="alternate" hreflang="en-sg" href="https://www.nestlehealthscience.sg"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-cn" href="https://www.nestlehealthscience.cn/"/>
       <xhtml:link rel="alternate" hreflang="en-ph" href="https://www.nestlehealthscience.ph/"/>
       <xhtml:link rel="alternate" hreflang="ru-ru" href="https://www.nestlehealthscience.ru/"/>
       <xhtml:link rel="alternate" hreflang="nl-nl" href="https://www.nestlehealthscience.nl/nl"/>
       <xhtml:link rel="alternate" hreflang="fr-nl" href="https://www.nestlehealthscience.nl/fr"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-tw" href="https://www.nestlehealthscience.com.tw"/>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
       </url>
       <url>
       <loc>https://www.nestlehealthscience-me.com/en/brands</loc>
       <xhtml:link rel="alternate" hreflang="en-ae" href="https://www.nestlehealthscience-me.com/en/brands"/>
        <xhtml:link rel="alternate" hreflang="en" href="https://www.nestlehealthscience.com/brands"/>
      <xhtml:link rel="alternate" hreflang="en-ca" href="https://www.nestlehealthscience.ca/en/brands"/>
      <xhtml:link rel="alternate" hreflang="fr-ca" href="https://www.nestlehealthscience.ca/fr/marques/home"/>
       <xhtml:link rel="alternate" hreflang="en-gb" href="https://www.nestlehealthscience.co.uk/brands"/>
       <xhtml:link rel="alternate" hreflang="pt-br" href="https://www.nestlehealthscience.com.br/marcas"/>
       <xhtml:link rel="alternate" hreflang="fi-fi" href="https://www.nestlehealthscience.fi/tuotteet"/>
       <xhtml:link rel="alternate" hreflang="pt-pt" href="http://nestlehealthscience.pt/marcas"/>
       <xhtml:link rel="alternate" hreflang="th-th" href="https://www.nestlehealthscience-th.com"/>
       <xhtml:link rel="alternate" hreflang="tr-tr" href="https://www.nestlehealthscience.com.tr/brands"/>
       <xhtml:link rel="alternate" hreflang="es-mx" href="https://www.nestlehealthscience.com.mx/marcas"/>
       <xhtml:link rel="alternate" hreflang="fr-fr" href="https://www.nestlehealthscience.fr/nos-marques"/>
       <xhtml:link rel="alternate" hreflang="sv-se" href="https://www.nestlehealthscience.se/produkter"/>
       <xhtml:link rel="alternate" hreflang="en-lk" href="https://www.nestlehealthscience.lk/brands"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-hk" href="https://www.nestlehealthscience.com.hk/zh-hans/brands"/>
       <xhtml:link rel="alternate" hreflang="ja-jp" href="https://www.nestlehealthscience.jp/brands"/>
       <xhtml:link rel="alternate" hreflang="es-es" href="https://www.nestlehealthscience.es/marcas"/>
       <xhtml:link rel="alternate" hreflang="ro-ro" href="https://www.nestlehealthscience.ro/produse"/>
       <xhtml:link rel="alternate" hreflang="de-de" href="https://www.nestlehealthscience.de/marken"/>
       <xhtml:link rel="alternate" hreflang="da-dk" href="https://www.nestlehealthscience.dk/produkter"/>
       <xhtml:link rel="alternate" hreflang="en-in" href="https://www.nestlehealthscience.in/brands"/>
       <xhtml:link rel="alternate" hreflang="de-ch" href="https://www.nestlehealthscience.ch/de/marken"/>
       <xhtml:link rel="alternate" hreflang="fr-ch" href="https://www.nestlehealthscience.ch/fr/nos-marques"/>
       <xhtml:link rel="alternate" hreflang="id-id" href="https://www.nestlehealthscience.co.id/brands"/>
       <xhtml:link rel="alternate" hreflang="it-it" href="https://www.nestlehealthscience.it/prodotti"/>
       <xhtml:link rel="alternate" hreflang="pl-pl" href="https://www.nestlehealthscience.pl/produkty"/>
       <xhtml:link rel="alternate" hreflang="en-za" href="https://www.nestlehealthscience.co.za/brands"/>
       <xhtml:link rel="alternate" hreflang="en-my" href="https://www.nestlehealthscience.my/brands"/>
       <xhtml:link rel="alternate" hreflang="vi-vn" href="https://www.nestlehealthscience.vn/san-pham"/>
       <xhtml:link rel="alternate" hreflang="cs-cz" href="https://www.nestlehealthscience.cz/cz/produkty"/>
       <xhtml:link rel="alternate" hreflang="sk-cz" href="https://www.nestlehealthscience.cz/sk/produkty"/>
       <xhtml:link rel="alternate" hreflang="en-sg" href="https://www.nestlehealthscience.sg/brands"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-cn" href="https://www.nestlehealthscience.cn/brands"/>
       <xhtml:link rel="alternate" hreflang="en-ph" href="https://www.nestlehealthscience.ph/brands"/>
       <xhtml:link rel="alternate" hreflang="ru-ru" href="https://www.nestlehealthscience.ru/brands"/>
       <xhtml:link rel="alternate" hreflang="nl-nl" href="https://www.nestlehealthscience.nl/nl/producten"/>
       <xhtml:link rel="alternate" hreflang="fr-nl" href="https://www.nestlehealthscience.nl/fr/producten"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-tw" href="https://www.nestlehealthscience.com.tw/brands"/>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
       </url>
      </urlset>';
    }


    public function unitedkingdom()
    {
      return '<?xml version="1.0" encoding="UTF-8"?>
      <urlset
          xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
          xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd
          http://www.w3.org/1999/xhtml http://www.w3.org/2002/08/xhtml/xhtml1-strict.xsd"
          xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
          xmlns:xhtml="http://www.w3.org/1999/xhtml"   
      >
      <url>
        <loc>https://www.nestlehealthscience.co.uk/</loc>
       <xhtml:link rel="alternate" hreflang="en-gb" href="https://www.nestlehealthscience.co.uk"/>
       <xhtml:link rel="alternate" hreflang="en" href="https://www.nestlehealthscience.com"/>
      <xhtml:link rel="alternate" hreflang="en-us" href="https://www.nestlehealthscience.us"/>
      <xhtml:link rel="alternate" hreflang="en-ca" href="https://www.nestlehealthscience.ca/en"/>
      <xhtml:link rel="alternate" hreflang="fr-ca" href="https://www.nestlehealthscience.ca/fr"/>
       <xhtml:link rel="alternate" hreflang="pt-br" href="https://www.nestlehealthscience.com.br"/>
       <xhtml:link rel="alternate" hreflang="fi-fi" href="https://www.nestlehealthscience.fi"/>
       <xhtml:link rel="alternate" hreflang="pt-pt" href="https://www.nestlehealthscience.pt"/>
       <xhtml:link rel="alternate" hreflang="th-th" href="https://www.nestlehealthscience-th.com"/>
       <xhtml:link rel="alternate" hreflang="tr-tr" href="https://www.nestlehealthscience.com.tr"/>
       <xhtml:link rel="alternate" hreflang="en-ae" href="https://www.nestlehealthscience-me.com"/>
       <xhtml:link rel="alternate" hreflang="es-mx" href="https://www.nestlehealthscience.com.mx"/>
       <xhtml:link rel="alternate" hreflang="fr-fr" href="https://www.nestlehealthscience.fr"/>
       <xhtml:link rel="alternate" hreflang="sv-se" href="https://www.nestlehealthscience.se"/>
       <xhtml:link rel="alternate" hreflang="en-lk" href="https://www.nestlehealthscience.lk"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-hk" href="https://www.nestlehealthscience.com.hk"/>
       <xhtml:link rel="alternate" hreflang="ja-jp" href="https://www.nestlehealthscience.jp"/>
       <xhtml:link rel="alternate" hreflang="es-es" href="https://www.nestlehealthscience.es"/>
       <xhtml:link rel="alternate" hreflang="ro-ro" href="https://www.nestlehealthscience.ro"/>
       <xhtml:link rel="alternate" hreflang="de-de" href="https://www.nestlehealthscience.de"/>
       <xhtml:link rel="alternate" hreflang="da-dk" href="https://www.nestlehealthscience.dk"/>
       <xhtml:link rel="alternate" hreflang="en-in" href="https://www.nestlehealthscience.in"/>
       <xhtml:link rel="alternate" hreflang="de-ch" href="https://www.nestlehealthscience.ch/de"/>
       <xhtml:link rel="alternate" hreflang="fr-ch" href="https://www.nestlehealthscience.ch/fr"/>
       <xhtml:link rel="alternate" hreflang="id-id" href="https://www.nestlehealthscience.co.id"/>
       <xhtml:link rel="alternate" hreflang="it-it" href="https://www.nestlehealthscience.it"/>
       <xhtml:link rel="alternate" hreflang="pl-pl" href="https://www.nestlehealthscience.pl"/>
       <xhtml:link rel="alternate" hreflang="en-za" href="https://www.nestlehealthscience.co.za"/>
       <xhtml:link rel="alternate" hreflang="en-my" href="https://www.nestlehealthscience.my"/>
       <xhtml:link rel="alternate" hreflang="vi-vn" href="https://www.nestlehealthscience.vn"/>
       <xhtml:link rel="alternate" hreflang="cs-cz" href="https://www.nestlehealthscience.cz/cz"/>
       <xhtml:link rel="alternate" hreflang="sk-cz" href="https://www.nestlehealthscience.cz/sk"/>
       <xhtml:link rel="alternate" hreflang="en-sg" href="https://www.nestlehealthscience.sg"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-cn" href="https://www.nestlehealthscience.cn/"/>
       <xhtml:link rel="alternate" hreflang="en-ph" href="https://www.nestlehealthscience.ph/"/>
       <xhtml:link rel="alternate" hreflang="ru-ru" href="https://www.nestlehealthscience.ru/"/>
       <xhtml:link rel="alternate" hreflang="nl-nl" href="https://www.nestlehealthscience.nl/nl"/>
       <xhtml:link rel="alternate" hreflang="fr-nl" href="https://www.nestlehealthscience.nl/fr"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-tw" href="https://www.nestlehealthscience.com.tw"/>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
       </url>
       <url>
       <loc>https://www.nestlehealthscience.co.uk/brands</loc>
       <xhtml:link rel="alternate" hreflang="en-gb" href="https://www.nestlehealthscience.co.uk/brands"/>
        <xhtml:link rel="alternate" hreflang="en" href="https://www.nestlehealthscience.com/brands"/>
      <xhtml:link rel="alternate" hreflang="en-ca" href="https://www.nestlehealthscience.ca/en/brands"/>
      <xhtml:link rel="alternate" hreflang="fr-ca" href="https://www.nestlehealthscience.ca/fr/marques/home"/>
       <xhtml:link rel="alternate" hreflang="pt-br" href="https://www.nestlehealthscience.com.br/marcas"/>
       <xhtml:link rel="alternate" hreflang="fi-fi" href="https://www.nestlehealthscience.fi/tuotteet"/>
       <xhtml:link rel="alternate" hreflang="pt-pt" href="http://nestlehealthscience.pt/marcas"/>
       <xhtml:link rel="alternate" hreflang="th-th" href="https://www.nestlehealthscience-th.com"/>
       <xhtml:link rel="alternate" hreflang="tr-tr" href="https://www.nestlehealthscience.com.tr/brands"/>
       <xhtml:link rel="alternate" hreflang="en-ae" href="https://www.nestlehealthscience-me.com/en/brands"/>
       <xhtml:link rel="alternate" hreflang="es-mx" href="https://www.nestlehealthscience.com.mx/marcas"/>
       <xhtml:link rel="alternate" hreflang="fr-fr" href="https://www.nestlehealthscience.fr/nos-marques"/>
       <xhtml:link rel="alternate" hreflang="sv-se" href="https://www.nestlehealthscience.se/produkter"/>
       <xhtml:link rel="alternate" hreflang="en-lk" href="https://www.nestlehealthscience.lk/brands"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-hk" href="https://www.nestlehealthscience.com.hk/zh-hans/brands"/>
       <xhtml:link rel="alternate" hreflang="ja-jp" href="https://www.nestlehealthscience.jp/brands"/>
       <xhtml:link rel="alternate" hreflang="es-es" href="https://www.nestlehealthscience.es/marcas"/>
       <xhtml:link rel="alternate" hreflang="ro-ro" href="https://www.nestlehealthscience.ro/produse"/>
       <xhtml:link rel="alternate" hreflang="de-de" href="https://www.nestlehealthscience.de/marken"/>
       <xhtml:link rel="alternate" hreflang="da-dk" href="https://www.nestlehealthscience.dk/produkter"/>
       <xhtml:link rel="alternate" hreflang="en-in" href="https://www.nestlehealthscience.in/brands"/>
       <xhtml:link rel="alternate" hreflang="de-ch" href="https://www.nestlehealthscience.ch/de/marken"/>
       <xhtml:link rel="alternate" hreflang="fr-ch" href="https://www.nestlehealthscience.ch/fr/nos-marques"/>
       <xhtml:link rel="alternate" hreflang="id-id" href="https://www.nestlehealthscience.co.id/brands"/>
       <xhtml:link rel="alternate" hreflang="it-it" href="https://www.nestlehealthscience.it/prodotti"/>
       <xhtml:link rel="alternate" hreflang="pl-pl" href="https://www.nestlehealthscience.pl/produkty"/>
       <xhtml:link rel="alternate" hreflang="en-za" href="https://www.nestlehealthscience.co.za/brands"/>
       <xhtml:link rel="alternate" hreflang="en-my" href="https://www.nestlehealthscience.my/brands"/>
       <xhtml:link rel="alternate" hreflang="vi-vn" href="https://www.nestlehealthscience.vn/san-pham"/>
       <xhtml:link rel="alternate" hreflang="cs-cz" href="https://www.nestlehealthscience.cz/cz/produkty"/>
       <xhtml:link rel="alternate" hreflang="sk-cz" href="https://www.nestlehealthscience.cz/sk/produkty"/>
       <xhtml:link rel="alternate" hreflang="en-sg" href="https://www.nestlehealthscience.sg/brands"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-cn" href="https://www.nestlehealthscience.cn/brands"/>
       <xhtml:link rel="alternate" hreflang="en-ph" href="https://www.nestlehealthscience.ph/brands"/>
       <xhtml:link rel="alternate" hreflang="ru-ru" href="https://www.nestlehealthscience.ru/brands"/>
       <xhtml:link rel="alternate" hreflang="nl-nl" href="https://www.nestlehealthscience.nl/nl/producten"/>
       <xhtml:link rel="alternate" hreflang="fr-nl" href="https://www.nestlehealthscience.nl/fr/producten"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-tw" href="https://www.nestlehealthscience.com.tw/brands"/>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
       </url>
      </urlset>';
    }


    public function unitedstates()
    {
      return '<?xml version="1.0" encoding="UTF-8"?>
      <urlset
          xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
          xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd
          http://www.w3.org/1999/xhtml http://www.w3.org/2002/08/xhtml/xhtml1-strict.xsd"
          xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
          xmlns:xhtml="http://www.w3.org/1999/xhtml"   
      >
      <url>
        <loc>https://www.nestlehealthscience.us</loc>
      <xhtml:link rel="alternate" hreflang="en-us" href="https://www.nestlehealthscience.us"/>
       <xhtml:link rel="alternate" hreflang="en" href="https://www.nestlehealthscience.com"/>
      <xhtml:link rel="alternate" hreflang="en-ca" href="https://www.nestlehealthscience.ca/en"/>
      <xhtml:link rel="alternate" hreflang="fr-ca" href="https://www.nestlehealthscience.ca/fr"/>
       <xhtml:link rel="alternate" hreflang="en-gb" href="https://www.nestlehealthscience.co.uk"/>
       <xhtml:link rel="alternate" hreflang="pt-br" href="https://www.nestlehealthscience.com.br"/>
       <xhtml:link rel="alternate" hreflang="fi-fi" href="https://www.nestlehealthscience.fi"/>
       <xhtml:link rel="alternate" hreflang="pt-pt" href="https://www.nestlehealthscience.pt"/>
       <xhtml:link rel="alternate" hreflang="th-th" href="https://www.nestlehealthscience-th.com"/>
       <xhtml:link rel="alternate" hreflang="tr-tr" href="https://www.nestlehealthscience.com.tr"/>
       <xhtml:link rel="alternate" hreflang="en-ae" href="https://www.nestlehealthscience-me.com"/>
       <xhtml:link rel="alternate" hreflang="es-mx" href="https://www.nestlehealthscience.com.mx"/>
       <xhtml:link rel="alternate" hreflang="fr-fr" href="https://www.nestlehealthscience.fr"/>
       <xhtml:link rel="alternate" hreflang="sv-se" href="https://www.nestlehealthscience.se"/>
       <xhtml:link rel="alternate" hreflang="de-at" href="https://www.nestlehealthscience.at"/>
       <xhtml:link rel="alternate" hreflang="en-lk" href="https://www.nestlehealthscience.lk"/>
       <xhtml:link rel="alternate" hreflang="en-au" href="https://www.nestlehealthscience.com.au"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-hk" href="https://www.nestlehealthscience.com.hk"/>
       <xhtml:link rel="alternate" hreflang="ja-jp" href="https://www.nestlehealthscience.jp"/>
       <xhtml:link rel="alternate" hreflang="es-es" href="https://www.nestlehealthscience.es"/>
       <xhtml:link rel="alternate" hreflang="ro-ro" href="https://www.nestlehealthscience.ro"/>
       <xhtml:link rel="alternate" hreflang="de-de" href="https://www.nestlehealthscience.de"/>
       <xhtml:link rel="alternate" hreflang="da-dk" href="https://www.nestlehealthscience.dk"/>
       <xhtml:link rel="alternate" hreflang="en-in" href="https://www.nestlehealthscience.in"/>
       <xhtml:link rel="alternate" hreflang="de-ch" href="https://www.nestlehealthscience.ch/de"/>
       <xhtml:link rel="alternate" hreflang="fr-ch" href="https://www.nestlehealthscience.ch/fr"/>
       <xhtml:link rel="alternate" hreflang="id-id" href="https://www.nestlehealthscience.co.id"/>
       <xhtml:link rel="alternate" hreflang="it-it" href="https://www.nestlehealthscience.it"/>
       <xhtml:link rel="alternate" hreflang="pl-pl" href="https://www.nestlehealthscience.pl"/>
       <xhtml:link rel="alternate" hreflang="en-za" href="https://www.nestlehealthscience.co.za"/>
       <xhtml:link rel="alternate" hreflang="en-my" href="https://www.nestlehealthscience.my"/>
       <xhtml:link rel="alternate" hreflang="vi-vn" href="https://www.nestlehealthscience.vn"/>
       <xhtml:link rel="alternate" hreflang="cs-cz" href="https://www.nestlehealthscience.cz/cz"/>
       <xhtml:link rel="alternate" hreflang="sk-cz" href="https://www.nestlehealthscience.cz/sk"/>
       <xhtml:link rel="alternate" hreflang="en-sg" href="https://www.nestlehealthscience.sg"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-cn" href="https://www.nestlehealthscience.cn/"/>
       <xhtml:link rel="alternate" hreflang="en-ph" href="https://www.nestlehealthscience.ph/"/>
       <xhtml:link rel="alternate" hreflang="ru-ru" href="https://www.nestlehealthscience.ru/"/>
       <xhtml:link rel="alternate" hreflang="nl-nl" href="https://www.nestlehealthscience.nl/nl"/>
       <xhtml:link rel="alternate" hreflang="fr-nl" href="https://www.nestlehealthscience.nl/fr"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-tw" href="https://www.nestlehealthscience.com.tw"/>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
       </url>
      </urlset>';
    }


    public function vietnam(){
      return '<?xml version="1.0" encoding="UTF-8"?>
      <urlset
          xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
          xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd
          http://www.w3.org/1999/xhtml http://www.w3.org/2002/08/xhtml/xhtml1-strict.xsd"
          xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
          xmlns:xhtml="http://www.w3.org/1999/xhtml"   
      >
      <url>
        <loc>https://www.nestlehealthscience.vn</loc>
       <xhtml:link rel="alternate" hreflang="vi-vn" href="https://www.nestlehealthscience.vn"/>
       <xhtml:link rel="alternate" hreflang="en" href="https://www.nestlehealthscience.com"/>
      <xhtml:link rel="alternate" hreflang="en-us" href="https://www.nestlehealthscience.us"/>
      <xhtml:link rel="alternate" hreflang="en-ca" href="https://www.nestlehealthscience.ca/en"/>
      <xhtml:link rel="alternate" hreflang="fr-ca" href="https://www.nestlehealthscience.ca/fr"/>
       <xhtml:link rel="alternate" hreflang="en-gb" href="https://www.nestlehealthscience.co.uk"/>
       <xhtml:link rel="alternate" hreflang="pt-br" href="https://www.nestlehealthscience.com.br"/>
       <xhtml:link rel="alternate" hreflang="fi-fi" href="https://www.nestlehealthscience.fi"/>
       <xhtml:link rel="alternate" hreflang="pt-pt" href="https://www.nestlehealthscience.pt"/>
       <xhtml:link rel="alternate" hreflang="th-th" href="https://www.nestlehealthscience-th.com"/>
       <xhtml:link rel="alternate" hreflang="tr-tr" href="https://www.nestlehealthscience.com.tr"/>
       <xhtml:link rel="alternate" hreflang="en-ae" href="https://www.nestlehealthscience-me.com"/>
       <xhtml:link rel="alternate" hreflang="es-mx" href="https://www.nestlehealthscience.com.mx"/>
       <xhtml:link rel="alternate" hreflang="fr-fr" href="https://www.nestlehealthscience.fr"/>
       <xhtml:link rel="alternate" hreflang="sv-se" href="https://www.nestlehealthscience.se"/>
       <xhtml:link rel="alternate" hreflang="en-lk" href="https://www.nestlehealthscience.lk"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-hk" href="https://www.nestlehealthscience.com.hk"/>
       <xhtml:link rel="alternate" hreflang="ja-jp" href="https://www.nestlehealthscience.jp"/>
       <xhtml:link rel="alternate" hreflang="es-es" href="https://www.nestlehealthscience.es"/>
       <xhtml:link rel="alternate" hreflang="ro-ro" href="https://www.nestlehealthscience.ro"/>
       <xhtml:link rel="alternate" hreflang="de-de" href="https://www.nestlehealthscience.de"/>
       <xhtml:link rel="alternate" hreflang="da-dk" href="https://www.nestlehealthscience.dk"/>
       <xhtml:link rel="alternate" hreflang="en-in" href="https://www.nestlehealthscience.in"/>
       <xhtml:link rel="alternate" hreflang="de-ch" href="https://www.nestlehealthscience.ch/de"/>
       <xhtml:link rel="alternate" hreflang="fr-ch" href="https://www.nestlehealthscience.ch/fr"/>
       <xhtml:link rel="alternate" hreflang="id-id" href="https://www.nestlehealthscience.co.id"/>
       <xhtml:link rel="alternate" hreflang="it-it" href="https://www.nestlehealthscience.it"/>
       <xhtml:link rel="alternate" hreflang="pl-pl" href="https://www.nestlehealthscience.pl"/>
       <xhtml:link rel="alternate" hreflang="en-za" href="https://www.nestlehealthscience.co.za"/>
       <xhtml:link rel="alternate" hreflang="en-my" href="https://www.nestlehealthscience.my"/>
       <xhtml:link rel="alternate" hreflang="cs-cz" href="https://www.nestlehealthscience.cz/cz"/>
       <xhtml:link rel="alternate" hreflang="sk-cz" href="https://www.nestlehealthscience.cz/sk"/>
       <xhtml:link rel="alternate" hreflang="en-sg" href="https://www.nestlehealthscience.sg"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-cn" href="https://www.nestlehealthscience.cn/"/>
       <xhtml:link rel="alternate" hreflang="en-ph" href="https://www.nestlehealthscience.ph/"/>
       <xhtml:link rel="alternate" hreflang="ru-ru" href="https://www.nestlehealthscience.ru/"/>
       <xhtml:link rel="alternate" hreflang="nl-nl" href="https://www.nestlehealthscience.nl/nl"/>
       <xhtml:link rel="alternate" hreflang="fr-nl" href="https://www.nestlehealthscience.nl/fr"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-tw" href="https://www.nestlehealthscience.com.tw"/>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
       </url>
       <url>
       <loc>https://www.nestlehealthscience.vn/san-pham</loc>
       <xhtml:link rel="alternate" hreflang="vi-vn" href="https://www.nestlehealthscience.vn/san-pham"/>
        <xhtml:link rel="alternate" hreflang="en" href="https://www.nestlehealthscience.com/brands"/>
      <xhtml:link rel="alternate" hreflang="en-ca" href="https://www.nestlehealthscience.ca/en/brands"/>
      <xhtml:link rel="alternate" hreflang="fr-ca" href="https://www.nestlehealthscience.ca/fr/marques/home"/>
       <xhtml:link rel="alternate" hreflang="en-gb" href="https://www.nestlehealthscience.co.uk/brands"/>
       <xhtml:link rel="alternate" hreflang="pt-br" href="https://www.nestlehealthscience.com.br/marcas"/>
       <xhtml:link rel="alternate" hreflang="fi-fi" href="https://www.nestlehealthscience.fi/tuotteet"/>
       <xhtml:link rel="alternate" hreflang="pt-pt" href="http://nestlehealthscience.pt/marcas"/>
       <xhtml:link rel="alternate" hreflang="th-th" href="https://www.nestlehealthscience-th.com"/>
       <xhtml:link rel="alternate" hreflang="tr-tr" href="https://www.nestlehealthscience.com.tr/brands"/>
       <xhtml:link rel="alternate" hreflang="en-ae" href="https://www.nestlehealthscience-me.com/en/brands"/>
       <xhtml:link rel="alternate" hreflang="es-mx" href="https://www.nestlehealthscience.com.mx/marcas"/>
       <xhtml:link rel="alternate" hreflang="fr-fr" href="https://www.nestlehealthscience.fr/nos-marques"/>
       <xhtml:link rel="alternate" hreflang="sv-se" href="https://www.nestlehealthscience.se/produkter"/>
       <xhtml:link rel="alternate" hreflang="en-lk" href="https://www.nestlehealthscience.lk/brands"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-hk" href="https://www.nestlehealthscience.com.hk/zh-hans/brands"/>
       <xhtml:link rel="alternate" hreflang="ja-jp" href="https://www.nestlehealthscience.jp/brands"/>
       <xhtml:link rel="alternate" hreflang="es-es" href="https://www.nestlehealthscience.es/marcas"/>
       <xhtml:link rel="alternate" hreflang="ro-ro" href="https://www.nestlehealthscience.ro/produse"/>
       <xhtml:link rel="alternate" hreflang="de-de" href="https://www.nestlehealthscience.de/marken"/>
       <xhtml:link rel="alternate" hreflang="da-dk" href="https://www.nestlehealthscience.dk/produkter"/>
       <xhtml:link rel="alternate" hreflang="en-in" href="https://www.nestlehealthscience.in/brands"/>
       <xhtml:link rel="alternate" hreflang="de-ch" href="https://www.nestlehealthscience.ch/de/marken"/>
       <xhtml:link rel="alternate" hreflang="fr-ch" href="https://www.nestlehealthscience.ch/fr/nos-marques"/>
       <xhtml:link rel="alternate" hreflang="id-id" href="https://www.nestlehealthscience.co.id/brands"/>
       <xhtml:link rel="alternate" hreflang="it-it" href="https://www.nestlehealthscience.it/prodotti"/>
       <xhtml:link rel="alternate" hreflang="pl-pl" href="https://www.nestlehealthscience.pl/produkty"/>
       <xhtml:link rel="alternate" hreflang="en-za" href="https://www.nestlehealthscience.co.za/brands"/>
       <xhtml:link rel="alternate" hreflang="en-my" href="https://www.nestlehealthscience.my/brands"/>
       <xhtml:link rel="alternate" hreflang="cs-cz" href="https://www.nestlehealthscience.cz/cz/produkty"/>
       <xhtml:link rel="alternate" hreflang="sk-cz" href="https://www.nestlehealthscience.cz/sk/produkty"/>
       <xhtml:link rel="alternate" hreflang="en-sg" href="https://www.nestlehealthscience.sg/brands"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-cn" href="https://www.nestlehealthscience.cn/brands"/>
       <xhtml:link rel="alternate" hreflang="en-ph" href="https://www.nestlehealthscience.ph/brands"/>
       <xhtml:link rel="alternate" hreflang="ru-ru" href="https://www.nestlehealthscience.ru/brands"/>
       <xhtml:link rel="alternate" hreflang="nl-nl" href="https://www.nestlehealthscience.nl/nl/producten"/>
       <xhtml:link rel="alternate" hreflang="fr-nl" href="https://www.nestlehealthscience.nl/fr/producten"/>
       <xhtml:link rel="alternate" hreflang="zh-hans-tw" href="https://www.nestlehealthscience.com.tw/brands"/>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
       </url>
      </urlset>';
    }
  
}