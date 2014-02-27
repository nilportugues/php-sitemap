<?php

include 'vendor/autoload.php';

$validator = new \Sonrisa\Component\Sitemap\Validators\VideoValidator();
$item = new \Sonrisa\Component\Sitemap\Items\VideoItem($validator);
$sitemap = new \Sonrisa\Component\Sitemap\VideoSitemap();

try
{
    $item->setTitle('hello title')
         ->setContentLoc('http://google.com/video.mp4');

    $sitemap->add($item,'http://google.com');

    $data = $sitemap->build();
    var_dump($data);    
}
catch (\Sonrisa\Component\Sitemap\Exceptions\SitemapException $e)
{
    echo $e->getMessage();    
}
