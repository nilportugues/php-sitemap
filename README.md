[![Build Status](https://travis-ci.org/sonrisa/sitemap-component.png)](https://travis-ci.org/sonrisa/sitemap-component) Sitemap Component
=================

Builds sitemaps for pages, images and media files and provides a class to submit them to search engines.

* [1.Installation](#block1)
* [2. Build your sitemaps](#block2)
* [3. Automatic sitemap submission](#block3)
* [4. Usage](#block4) 
    * [4.1. Submit to search engines](#block4.1)
    * [4.2. Build a Sitemap without Images](#block4.2)
      * [Creation](#block4.2.1)
      * [Output](#block4.2.2)
    * [4.3. Build a Sitemap with Images](#block4.3)
      * [Creation](#block4.3.1)
      * [Output](#block4.3.2)
    * [4.4. Build a Media Sitemap](#block4.4)
      * [Creation](#block4.4.1)
      * [Output](#block4.4.2)
* [5. Fully tested](#block5)
* [6. Author](#block6)

<a name="block1"></a>
## 1.Installation
Add the following to your `composer.json` file :

```js
"sonrisa/sitemap-component":"dev-master"
```
<a name="block2"></a>
## 2. Build your sitemaps
This component builds sitemaps supported by the main search engines, Google and Bing, in xml and gzip formats.

The **Sitemap Component** is able of building the following types of sitemaps:

- **sitemap.xml**: Text content sitemaps, the most common type of sitemap found around the Internet.
- **media.xml**: Media sitemaps, videos files belong here. Usually used as for podcasts.
 
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
use Sonrisa\Component\Sitemap\Sitemap;

// $status = array('google' => true, 'bing' => true); if everything went OK.
$status = Sitemap::submit('http://example.com/sitemap.xml');

```
<a name="block4.2"></a>
### 4.2 - Build a Sitemap without Images
```php
<?php
use Sonrisa\Component\Sitemap\XMLSitemap;

$sitemap = new XMLSitemap();

$sitemap->addUrl('http://www.example.com/','1.0','daily','2014-05-10T17:33:30+08:00');
$sitemap->addUrl('http://www.example.com/blog','0.9','monthly','2014-05-10T17:33:30+08:00');
$sitemap->addUrl('http://www.example.com/contact','0.8','never','2014-05-10T17:33:30+08:00');

//Option 1: Output status of generating sitemap and writing to disk.
//var_dump($status) should be true
$status = $sitemap->build()->write('path/to/public/www','sitemap.xml');

//Option 2: Output the generated sitemap as an array.
//var_dump($array) should be an array holding xml data.
$array = $sitemap->build()->get();
```
<a name="block4.3"></a>
### 4.3 - Build a Sitemap with Images

<a name="block4.3.1"></a>
#### Creation
```php
<?php
use Sonrisa\Component\Sitemap\XMLSitemap;

$sitemap = new XMLSitemap();

$this->sitemap->addUrl('http://www.example.com/','0.8','monthly','2005-05-10T17:33:30+08:00');

//Add images to the sitemap by relating them to a Url.
$this->sitemap->addImage('http://www.example.com/',array(
 'loc' => 'http://www.example.com/logo.png', 
 'title' => 'Example.com logo' 
));

$this->sitemap->addImage('http://www.example.com/',array(
 'loc' => 'http://www.example.com/main.png', 
 'title' => 'Main image' 
));

//Option 1: Output status of generating sitemap and writing to disk.
//var_dump($status) should be true
$status = $sitemap->build()->write('path/to/public/www','sitemap.xml');

//Option 2: Output the generated sitemap as an array.
//var_dump($array) should be an array holding xml data.
$array = $sitemap->build()->get();
```
<a name="block4.3.2"></a>
#### Output
```xml
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
  <url>
    <loc>http://www.example.com/</loc>
    <lastmod>2005-05-10T17:33:30+08:00</lastmod>
    <changefreq>monthly</changefreq>
    <priority>0.8</priority>
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

<a name="block4.4"></a>
### 4.4 - Build a Media Sitemap

#### Creation
```php
<?php
use Sonrisa\Component\Sitemap\MediaSitemap;

$sitemap = new MediaSitemap();

$sitemap->setTitle('Media RSS de ejemplo');
$sitemap->setLink('http://www.example.com/ejemplos/mrss/');
$sitemap->setDescription('Ejemplo de MRSS');
$sitemap->addItem('http://www.example.com/examples/mrss/example.html',array
(
    'mimetype'      =>  'video/x-flv',
    'player'        =>  'http://www.example.com/shows/example/video.swf?flash_params',
    'duration'      =>  120,
    'title'         =>  'Barbacoas en verano',
    'description'   =>  'Consigue que los filetes queden perfectamente hechos siempre',
    'thumbnail'     =>  'http://www.example.com/examples/mrss/example.png',
    'height'        =>  120,
    'width'         =>  160,
));

//Option 1: Output status of generating sitemap and writing to disk.
//var_dump($status) should be true
$status = $sitemap->build()->write('path/to/public/www','sitemap.xml');

//Option 2: Output the generated sitemap as an array.
//var_dump($array) should be an array holding xml data.
$array = $sitemap->build()->get();
```

#### Output
```xml
<?xml version="1.0" encoding="UTF-8"?>
<rss version="2.0" xmlns:media="http://search.yahoo.com/mrss/" xmlns:dcterms="http://purl.org/dc/terms/">
<channel>
  <title>Media RSS de ejemplo</title>
  <link>http://www.example.com/ejemplos/mrss/</link>
  <description>Ejemplo de MRSS</description>
  <item xmlns:media="http://search.yahoo.com/mrss/" xmlns:dcterms="http://purl.org/dc/terms/">
    <link>http://www.example.com/examples/mrss/example.html</link>
    <media:content type="video/x-flv" duration="120">
      <media:player url="http://www.example.com/shows/example/video.swf?flash_params" />
      <media:title>Barbacoas en verano</media:title>
      <media:description>Consigue que los filetes queden perfectamente hechos siempre</media:description>
      <media:thumbnail url="http://www.example.com/examples/mrss/example.png" height="120" width="160"/>
    </media:content>
  </item>
</channel>
</rss>
```

<a name="block5"></a>
## 5. Fully tested.
Testing has been done using PHPUnit and [Travis-CI](https://travis-ci.org). All code has been tested to be compatible from PHP 5.3 up to PHP 5.5 and [Facebook's PHP Virtual Machine: HipHop](http://hiphop-php.com).

<a name="block6"></a>
## 6. Author
Nil Portugués Calderó
 - <contact@nilportugues.com>
 - http://nilportugues.com
