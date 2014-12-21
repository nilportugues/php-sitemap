<?php
include 'vendor/autoload.php';

use NilPortugues\Sitemap\ImageSitemap;
use NilPortugues\Sitemap\Item\Image\ImageItem;
use NilPortugues\Sitemap\SitemapException;

if(file_exists('sitemaptest.xml')) {
    unlink('sitemaptest.xml');
}

try{

    $siteMap = new ImageSitemap('.', 'sitemaptest.xml', false);
    $j = 1;
    $url = 'http://www.example.com/gallery-' . $j .'.html';

    for ($i = 0; $i < 50020; $i++) {

        if(0 === $i % 1001) {
            $url = 'http://www.example.com/gallery-' . $j .'.html';
            $j++;
        }

        $imageUrl = 'http://www.example.com/' . $i .'.jpg';

        $item = new ImageItem($imageUrl);
        $siteMap->add($item, $url);
    }
    $siteMap->build();

} catch(SitemapException $e) {
    die($e->getMessage());
}