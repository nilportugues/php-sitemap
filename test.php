<?php

include 'vendor/autoload.php';

$sitemap = new \Sonrisa\Component\Sitemap\VideoSitemap();

$validator = new \Sonrisa\Component\Sitemap\Validators\VideoValidator();
$item = new \Sonrisa\Component\Sitemap\Items\VideoItem($validator);

$item->setTitle('hello title')
     ->setContentLoc('http://google.com/video.mp4');

$sitemap->add($item,'http://google.com');

$data = $sitemap->build();

var_dump($data);