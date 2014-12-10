<?php
use NilPortugues\Sitemap\Item\Url\UrlItem;

include 'vendor/autoload.php';



	for ($i = 0; $i < 50000; $i++) {

		$item = new UrlItem('http://www.example.com/' . $i);
		$item->setPriority('1.0');
		$item->setChangeFreq('daily');
		$item->setLastMod('2014-05-10T17:33:30+08:00');

        echo $item->build().PHP_EOL;
    }