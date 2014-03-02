<?php

include 'vendor/autoload.php';

use \Sonrisa\Component\Sitemap\VideoSitemap;
use \Sonrisa\Component\Sitemap\Items\VideoItem;
use \Sonrisa\Component\Sitemap\Exceptions\SitemapException;

try {
    //Build sitemap
    $sitemap = new VideoSitemap();

    //Create sitemap item
    $item = new VideoItem();
    $item->setTitle('hello title')
         ->setContentLoc('http://google.com/video.mp4');

    //Push item to sitemap.
    $sitemap->add($item,'http://google.com');

    $data = $sitemap->build();
    var_dump($data);
} catch (SitemapException $e) {
    echo $e->getMessage();
}
