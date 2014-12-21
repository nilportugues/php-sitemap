<?php
include 'vendor/autoload.php';

use NilPortugues\Sitemap\Item\Url\UrlItem;
use NilPortugues\Sitemap\Sitemap;
use NilPortugues\Sitemap\SitemapException;

try{

    $siteMap = new Sitemap('.', 'sitemaptest.xml', false);

    for ($i = 0; $i < 50020; $i++) {

        $item = new UrlItem('http://www.example.com/' . $i);
        $item->setPriority('1.0');
        $item->setChangeFreq('daily');
        $item->setLastMod('2014-05-10T17:33:30+08:00');

        $siteMap->add($item);
    }
    $siteMap->build();

} catch(SitemapException $e) {
    die($e->getMessage());
}