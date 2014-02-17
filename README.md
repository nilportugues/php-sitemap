[![Build Status](https://travis-ci.org/sonrisa/sitemap-component.png)](https://travis-ci.org/sonrisa/sitemap-component) Sitemap Component
=================

Builds sitemaps for pages, images and media files and provides a class to submit them to search engines.

* [1.Installation](#block1)
* [2. Features](#block2)
* [3. Automatic sitemap submission](#block3)
* [4. Usage](#block4) 
    * [4.1. Submit to search engines](#block4.1)
    * [4.2. Build a Sitemap Index](#block4.2)
      * [Creation](#block4.2.1)
      * [Output](#block4.2.2)
    * [4.3. Build a simple Sitemap](#block4.3)
      * [Creation](#block4.3.1)
      * [Output](#block4.3.2)
    * [4.4. Build a Sitemap with Images](#block4.4)
      * [Creation](#block4.4.1)
      * [Output](#block4.4.2)
    * [4.5. Build a Sitemap with Videos](#block4.5)
      * [Creation](#block4.5.1)
      * [Output](#block4.5.2)
    * [4.6. Build a Media Sitemap (mRSS feed as a Sitemap)](#block4.6)
      * [Creation](#block4.6.1)
      * [Output](#block4.6.2)
    * [4.7 - Build a Sitemap for News](#block4.7)
      * [Creation](#block4.7.1)
      * [Output](#block4.7.2)
* [5. Fully tested](#block5)
* [6. Author](#block6)

<a name="block1"></a>
## 1.Installation
Add the following to your `composer.json` file :

```js
{
    "require": {
        "sonrisa/sitemap-component":"dev-master"
    }
}
```
<a name="block2"></a>
## 2. Features
This component builds sitemaps supported by the main search engines, Google and Bing, in xml and gzip formats.

The **Sitemap Component** is able of building the following types of sitemaps:

- **sitemap-index.xml**: A sitemap that serves as a index containing references to other sitemap.xml files.
- **sitemap.xml**: Text content sitemaps, the most common type of sitemap found around the Internet.
- **sitemap.images.xml**: Sitemap for for images.
- **sitemap.videos.xml**: Sitemap for for videos.
- **media.xml**: Alternative for video sitemaps . More documentation can be found [here](https://support.google.com/webmasters/answer/183265?hl=en).
- **sitemap.news.xml**: Sitemap for news articles.

The sitemap component follow 100% the standards, meaning that it follows strictly the contrains:

- A sitemap file cannot contain **50000 items per file**.
- A sitemap file cannot be larger than **50 MBytes, uncompressed**.
- An image sitemap file cannot contain more than **1000 images** per `<url>` element.

<a name="block3"></a>
## 3. Automatic sitemap submission

This component also provides a method to submit the generated sitemaps to the following search engines:
- Google
- Bing

<a name="block4"></a>
## 4. Usage

<a name="block4.1"></a>
### 4.1 - Submit to search engines
```php
<?php
use Sonrisa\Component\Sitemap\SubmitSitemap;

// $status = array('google' => true, 'bing' => true); if everything went OK.
$status = SubmitSitemap::submit('http://example.com/sitemap-index.xml');
```

<a name="block4.2"></a>
### 4.2 - Build a Sitemap Index

In order to use a Sitemap Index, you need to build sitemap files first. Check out 4.3, 4.4 and 4.5.

<a name="block4.2.1"></a>
#### Creation
```php
<?php
use Sonrisa\Component\Sitemap\IndexSitemap;

$sitemapIndex = new IndexSitemap();
$sitemapIndex->addSitemap('http://www.example.com/sitemap.content.xml','2005-05-10T17:33:30+08:00');
$sitemapIndex->addSitemap('http://www.example.com/sitemap.media.xml','2005-05-10T17:33:30+08:00');

//var_dump($files) should be an array holding the sitemap files created.
$files = $sitemapIndex->build()->write('path/to/public/www','sitemap.xml');

```
<a name="block4.2.2"></a>
#### Output
```xml
<?xml version="1.0" encoding="UTF-8"?>
<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  <sitemap>
    <loc>http://www.example.com/sitemap.content.xml</loc>
    <lastmod>2005-05-10T17:33:30+08:00</lastmod>
  </sitemap>
  <sitemap>
    <loc>http://www.example.com/sitemap.media.xml</loc>
    <lastmod>2005-05-10T17:33:30+08:00</lastmod>
  </sitemap>
</sitemapindex>
```


<a name="block4.3"></a>
### 4.3 - Build a simple Sitemap

<a name="block4.3.1"></a>
#### Creation
```php
<?php
use Sonrisa\Component\Sitemap\Sitemap;

$sitemap = new Sitemap();
$sitemap->addUrl('http://www.example.com/','1.0','daily','2014-05-10T17:33:30+08:00');
$sitemap->addUrl('http://www.example.com/blog','0.9','monthly','2014-05-10T17:33:30+08:00');
$sitemap->addUrl('http://www.example.com/contact','0.8','never','2014-05-10T17:33:30+08:00');

//var_dump($files) should be an array holding the sitemap files created.
files = $sitemap->build()->write('path/to/public/www','sitemap.xml');
```
<a name="block4.3.2"></a>
#### Output

<a name="block4.4"></a>
### 4.4 - Build a Sitemap with Images

<a name="block4.4.1"></a>
#### Creation
```php
<?php
use Sonrisa\Component\Sitemap\ImageSitemap;

$sitemap = new ImageSitemap();

//Add images to the sitemap by relating them to a Url.
$this->sitemap->addImage(array(
 'loc' => 'http://www.example.com/logo.png', 
 'title' => 'Example.com logo' 
),'http://www.example.com/');

$this->sitemap->addImage(array(
 'loc' => 'http://www.example.com/main.png', 
 'title' => 'Main image' 
),'http://www.example.com/');

//var_dump($files) should be an array holding the sitemap files created.
$files = $sitemap->build()->write('path/to/public/www','sitemap.xml');
```
<a name="block4.4.2"></a>
#### Output
```xml
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
  <url>
    <loc>http://www.example.com/</loc>
    <image:image>
      <image:loc><![CDATA[http://www.example.com/logo.png]]></image:loc>
      <image:title><![CDATA[Example.com logo]]></image:title>
    </image:image>
    <image:image>
      <image:loc><![CDATA[http://www.example.com/main.png]]></image:loc>
      <image:title><![CDATA[Main image]]></image:title>
    </image:image>
  </url>
</urlset>
```

<a name="block4.5"></a>
### 4.5 - Build a Sitemap with videos
<a name="block4.5.1"></a>
#### Creation
```php
<?php
use Sonrisa\Component\Sitemap\VideoSitemap;
```
<a name="block4.5.2"></a>
#### Output
```xml
```

<a name="block4.6"></a>
### 4.6 - Build a Media Sitemap (mRSS feed as a Sitemap)

<a name="block4.6.1"></a>
#### Creation
```php
<?php
use Sonrisa\Component\Sitemap\MediaSitemap;

$sitemap = new MediaSitemap();
$sitemap->setTitle('Media RSS de ejemplo');
$sitemap->setLink('http://www.example.com/ejemplos/mrss/');
$sitemap->setDescription('Ejemplo de MRSS');

$sitemap->addItem('http://www.example.com/examples/mrss/example1.html',array
(
    'mimetype'      =>  'video/x-flv',
    'player'        =>  'http://www.example.com/shows/example/video.swf?flash_params',
    'duration'      =>  120,
    'title'         =>  'Barbacoas en verano',
    'description'   =>  'Consigue que los filetes queden perfectamente hechos siempre',
    'thumbnail'     =>  'http://www.example.com/examples/mrss/example1.png',
    'height'        =>  120,
    'width'         =>  160,
));

$sitemap->addItem('http://www.example.com/examples/mrss/example2.html',array
(
    'mimetype'      =>  'video/x-flv',
    'player'        =>  'http://www.example.com/shows/example/video.swf?flash_params',
    'duration'      =>  240,
    'title'         =>  'Barbacoas en invierno',
    'description'   =>  'Consigue unos filetes frios',
    'thumbnail'     =>  'http://www.example.com/examples/mrss/example2.png',
    'height'        =>  120,
    'width'         =>  160,
));

//var_dump($files) should be an array holding the sitemap files created.
$files = $sitemap->build()->write('path/to/public/www','sitemap.xml');
```
<a name="block4.6.2"></a>
#### Output
```xml
<?xml version="1.0" encoding="UTF-8"?>
<rss version="2.0" xmlns:media="http://search.yahoo.com/mrss/" xmlns:dcterms="http://purl.org/dc/terms/">
<channel>
  <title>Media RSS de ejemplo</title>
  <link>http://www.example.com/ejemplos/mrss/</link>
  <description>Ejemplo de MRSS</description>
  <item xmlns:media="http://search.yahoo.com/mrss/" xmlns:dcterms="http://purl.org/dc/terms/">
    <link>http://www.example.com/examples/mrss/example1.html</link>
    <media:content type="video/x-flv" duration="120">
      <media:player url="http://www.example.com/shows/example/video.swf?flash_params" />
      <media:title>Barbacoas en verano</media:title>
      <media:description>Consigue que los filetes queden perfectamente hechos siempre</media:description>
      <media:thumbnail url="http://www.example.com/examples/mrss/example1.png" height="120" width="160"/>
    </media:content>
  </item>
  <item xmlns:media="http://search.yahoo.com/mrss/" xmlns:dcterms="http://purl.org/dc/terms/">
    <link>http://www.example.com/examples/mrss/example2.html</link>
    <media:content type="video/x-flv" duration="240">
      <media:player url="http://www.example.com/shows/example/video.swf?flash_params" />
      <media:title>Barbacoas en invierno</media:title>
      <media:description>Consigue unos filetes frios</media:description>
      <media:thumbnail url="http://www.example.com/examples/mrss/example2.png" height="120" width="160"/>
    </media:content>
  </item>
</channel>
</rss>
```

<a name="block4.7"></a>
### 4.7 - Build a Sitemap for News
<a name="block4.7.1"></a>
#### Creation
```php
<?php
use Sonrisa\Component\Sitemap\NewsSitemap;
```
<a name="block4.7.2"></a>
#### Output
```xml
```

<a name="block5"></a>
## 5. Fully tested.
Testing has been done using PHPUnit and [Travis-CI](https://travis-ci.org). All code has been tested to be compatible from PHP 5.3 up to PHP 5.5 and [Facebook's PHP Virtual Machine: HipHop](http://hiphop-php.com).

<a name="block6"></a>
## 6. Author
Nil Portugués Calderó
 - <contact@nilportugues.com>
 - http://nilportugues.com
