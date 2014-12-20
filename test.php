<?php
use NilPortugues\Sitemap\Item\Url\UrlItem;

include 'vendor/autoload.php';

/*
    $file = fopen('sitemap.xml', 'w');

    fputs($file, UrlItem::getHeader());
	for ($i = 0; $i < 50000; $i++) {

		$item = new UrlItem('http://www.example.com/' . $i);
		$item->setPriority('1.0');
		$item->setChangeFreq('daily');
		$item->setLastMod('2014-05-10T17:33:30+08:00');


        fwrite($file, $item->build());
    }
    fputs($file, UrlItem::getFooter());
    fclose($file);
*/

$siteMap = new \NilPortugues\Sitemap\Sitemap('.', 'sitemaptest.xml', false);
for ($i = 0; $i < 50020; $i++) {

    $item = new UrlItem('http://www.example.com/' . $i);
    $item->setPriority('1.0');
    $item->setChangeFreq('daily');
    $item->setLastMod('2014-05-10T17:33:30+08:00');

    $siteMap->add($item);
}
$siteMap->build();
