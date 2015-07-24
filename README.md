Sitemap Component
=================

[![Build Status](https://travis-ci.org/nilportugues/sitemap-component.svg)](https://travis-ci.org/nilportugues/sitemap-component) [![Coverage Status](https://img.shields.io/coveralls/nilportugues/sitemap-component.svg)](https://coveralls.io/r/nilportugues/sitemap-component) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/nilportugues/sitemap-component/badges/quality-score.png)](https://scrutinizer-ci.com/g/nilportugues/sitemap-component/) [![Latest Stable Version](https://poser.pugx.org/nilportugues/sitemap-component/v/stable)](https://packagist.org/packages/nilportugues/sitemap-component) [![Total Downloads](https://poser.pugx.org/nilportugues/sitemap-component/downloads)](https://packagist.org/packages/nilportugues/sitemap-component) [![License](https://poser.pugx.org/nilportugues/sitemap-component/license)](https://packagist.org/packages/nilportugues/sitemap-component) [![SensioLabsInsight](https://insight.sensiolabs.com/projects/b065a032-4ab2-4feb-a88c-d7a8423e1cf7/mini.png)](https://insight.sensiolabs.com/projects/b065a032-4ab2-4feb-a88c-d7a8423e1cf7)

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
* [6. Questions?](#block6)
* [7. Author](#block7)

---

<a name="block1"></a>
## 1.Installation
The recommended way to install the Sitemap Component is through [Composer](http://getcomposer.org). Run the following command to install it:

```sh
php composer.phar require nilportugues/sitemap-component
```
---

<a name="block2"></a>
## 2. Features
This component builds sitemaps supported by the main search engines, Google and Bing, in xml and gzip formats.

The **Sitemap Component** is able of building the following types of sitemaps:

#### Sitemap Index
A sitemap that serves as a index containing references to other sitemap.xml files. 
More documentation can be found [here](https://support.google.com/webmasters/answer/71453?hl=en).

#### Basic Sitemap
Text content sitemaps, the most common type of sitemap found around the Internet. 
More documentation can be found [here](https://support.google.com/webmasters/answer/183668?hl=en&ref_topic=8476).

#### Image Sitemap
Sitemap for for images. More documentation can be found [here](https://support.google.com/webmasters/answer/178636?hl=en).

#### Video Sitemap
Sitemap for for videos. More documentation can be found [here](https://support.google.com/webmasters/answer/80472?hl=en&ref_topic=10079).

#### Media Sitemap
Alternative for video sitemaps. More documentation can be found [here](https://support.google.com/webmasters/answer/183265?hl=en).

#### News Sitemap
Sitemap for news articles. More documentation can be found [here](https://support.google.com/webmasters/answer/74288?hl=en).

#### Standard compilant
The sitemap component follow 100% the standards, meaning that it follows strictly the contrains:

- A sitemap file cannot contain **50000 items per file**.
- A sitemap file cannot be larger than **50 MBytes, uncompressed**.
- An Image Sitemap file cannot contain more than **1000 images** per `<url>` element.

---

<a name="block3"></a>
## 3. Automatic sitemap submission

This component also provides a method to submit the generated sitemaps to the following search engines:
- Google
- Bing

---

<a name="block4"></a>
## 4. Usage

<a name="block4.1"></a>
### 4.1 - Submit to search engines
```php
<?php
use NilPortugues\Sitemap\SubmitSitemap;

// $status = ['google' => true, 'bing' => true]; if everything went OK.
$status = SubmitSitemap::send('http://example.com/sitemap-index.xml');
```

<a name="block4.2"></a>
### 4.2 - Build a Sitemap Index

In order to use a Sitemap Index, you need to build sitemap files first. Check out 4.3, 4.4 and 4.5.

<a name="block4.2.1"></a>
#### Creation
```php
use NilPortugues\Sitemap\IndexSitemap;
use NilPortugues\Sitemap\Item\Index\IndexItem;
use NilPortugues\Sitemap\SitemapException;

try {
    $sitemap = new IndexSitemap('path/to/folder','sitemap.index.xml');

    $item = new IndexItem('http://www.example.com/sitemap.content.xml');
    $item->setLastMod('2005-05-10T17:33:30+08:00'); //Optional
    $sitemap->add($item);

    $item = new IndexItem('http://www.example.com/sitemap.media.xml');
    $item->setLastMod('2005-05-10T17:33:30+08:00');
    $sitemap->add($item);

    $sitemap->build();

} catch (SitemapException $e) {

    echo $e->getMessage();
}
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
use NilPortugues\Sitemap\Sitemap;
use NilPortugues\Sitemap\Item\Url\UrlItem;
use NilPortugues\Sitemap\SitemapException;

try {
    $sitemap = new Sitemap('path/to/folder','sitemap.index.xml');

    $item = new UrlItem('http://www.example.com/');
    $item->setPriority('1.0'); //Optional
    $item->setChangeFreq('daily'); //Optional
    $item->setLastMod('2014-05-10T17:33:30+08:00'); //Optional
    $sitemap->add($item);

    $item = new UrlItem('http://www.example.com/blog');
    $item->setPriority('0.9');
    $item->setChangeFreq('monthly');
    $item->setLastMod('2014-05-10T17:33:30+08:00');
    $sitemap->add($item);

    $item = new UrlItem('http://www.example.com/contact');
    $item->setPriority('0.8');
    $item->setChangeFreq('never');
    $item->setLastMod('2014-05-10T17:33:30+08:00');
    $sitemap->add($item);

    $sitemap->build();

} catch (SitemapException $e) {

    echo $e->getMessage();
}
```
<a name="block4.3.2"></a>
#### Output
```xml
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  <url>
    <loc>http://www.example.com/</loc>
    <lastmod>2014-05-10T17:33:30+08:00</lastmod>    
    <changefreq>daily</changefreq>    
    <priority>1.0</priority>
  </url>
  <url>
    <loc>http://www.example.com/blog</loc>
    <lastmod>2014-05-10T17:33:30+08:00</lastmod>    
    <changefreq>monthly</changefreq>
    <priority>0.9</priority>    
  </url>
  <url>
    <loc>http://www.example.com/contact</loc>
    <lastmod>2014-05-10T17:33:30+08:00</lastmod>    
    <changefreq>never</changefreq>
    <priority>0.8</priority>
  </url>    
</urlset>
```

<a name="block4.4"></a>
### 4.4 - Build a Sitemap with Images

<a name="block4.4.1"></a>
#### Creation
```php
use NilPortugues\Sitemap\ImageSitemap;
use NilPortugues\Sitemap\Item\Image\ImageItem;
use NilPortugues\Sitemap\SitemapException;

try {
    $sitemap = new ImageSitemap('path/to/folder','sitemap.image.xml');

    $item = new ImageItem('http://www.example.com/logo.png');
    $item->setTitle('Example.com logo'); //Optional
    $sitemap->add($item,'http://www.example.com/');

    $item = new ImageItem('http://www.example.com/main.png');
    $item->setTitle('Main image'); //Optional
    $sitemap->add($item,'http://www.example.com/');

    $sitemap->build();

} catch (SitemapException $e) {

    echo $e->getMessage();
}
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
use NilPortugues\Sitemap\VideoSitemap;
use NilPortugues\Sitemap\Item\Video\VideoItem;
use NilPortugues\Sitemap\SitemapException;

try {
    $sitemap = new VideoSitemap('path/to/folder','sitemap.video.xml');

    $item = new VideoItem(
        'Grilling steaks for summer', //Title
        'http://www.example.com/video123.flv', //URL
        'http://www.example.com/videoplayer.swf?video=123', //Player URL
        'yes', //Optional
        'ap=1' //Optional
    );

    //Optional Values
    $item->setDescription('Alkis shows you how to get perfectly done steaks everytime');
    $item->setThumbnailLoc('http://www.example.com/thumbs/123.jpg');
    $item->setDuration(600);
    $item->setExpirationDate('2009-11-05T19:20:30+08:00');
    $item->setRating(4.2);
    $item->setViewCount(12345);
    $item->setPublicationDate('2007-11-05T19:20:30+08:00');
    $item->setFamilyFriendly('yes');
    $item->setRestriction('IE GB US CA', 'allow');
    $item->setGalleryLoc('http://cooking.example.com', 'Cooking Videos');
    $item->setPrice('0.99','EUR','rent','HD');
    $item->setPrice('0.75','EUR','rent','SD');
    $item->setCategory('cooking');
    $item->setTag(array('action','drama','entrepreneur'));
    $item->setRequiresSubscription('yes');
    $item->setUploader('GrillyMcGrillerson', 'http://www.example.com/users/grillymcgrillerson');
    $item->setPlatform('web mobile tv', 'allow');
    $item->setLive('no');

    $sitemap->add($item,'http://www.example.com/');

    $files = $sitemap->build();

} catch (SitemapException $e) {
    echo $e->getMessage();
}
```
<a name="block4.5.2"></a>
#### Output
```xml
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:video="http://www.google.com/schemas/sitemap-video/1.1">
	<url>
		<loc>http://www.example.com/</loc>
		<video:video>
			<video:thumbnail_loc><![CDATA[http://www.example.com/thumbs/123.jpg]]></video:thumbnail_loc>
			<video:title><![CDATA[Grilling steaks for summer]]></video:title>
			<video:description><![CDATA[Alkis shows you how to get perfectly done steaks everytime]]></video:description>
			<video:content_loc><![CDATA[http://www.example.com/video123.flv]]></video:content_loc>
			<video:duration><![CDATA[600]]></video:duration>
			<video:expiration_date><![CDATA[2009-11-05T19:20:30+08:00]]></video:expiration_date>
			<video:publication_date><![CDATA[2007-11-05T19:20:30+08:00]]></video:publication_date>
			<video:restriction relationship="allow">IE GB US CA</video:restriction>
			<video:gallery_loc title="Cooking Videos">http://cooking.example.com</video:gallery_loc>
			<video:price currency="EUR" type="rent" resolution="HD" >0.99</video:price>
			<video:price currency="EUR" type="rent" resolution="SD" >0.75</video:price>
			<video:tag>action</video:tag>
			<video:tag>drama</video:tag>
			<video:tag>entrepreneur</video:tag>
			<video:requires_subscription><![CDATA[yes]]></video:requires_subscription>
			<video:uploader>GrillyMcGrillerson</video:uploader>
			<video:platform relationship="allow">web mobile tv</video:platform>
			<video:live><![CDATA[no]]></video:live>
		</video:video>
	</url>
</urlset>
```

<a name="block4.6"></a>
### 4.6 - Build a Media Sitemap (mRSS feed as a Sitemap)

<a name="block4.6.1"></a>
#### Creation
```php
use NilPortugues\Sitemap\MediaSitemap;
use NilPortugues\Sitemap\Item\Media\MediaItem;
use NilPortugues\Sitemap\SitemapException;

try {
    $sitemap = new MediaSitemap('path/to/folder','sitemap.media.xml');

    $sitemap->setTitle('Media RSS de ejemplo');
    $sitemap->setLink('http://www.example.com/ejemplos/mrss/');
    $sitemap->setDescription('Ejemplo de MRSS');

    $item = new MediaItem('http://www.example.com/examples/mrss/example1.html');

    //Optional
    $item->setContent('video/x-flv', 120);
    $item->setPlayer('http://www.example.com/shows/example/video.swf?flash_params');
    $item->setTitle('Barbacoas en verano');
    $item->setDescription('Consigue que los filetes queden perfectamente hechos siempre');
    $item->setThumbnail('http://www.example.com/examples/mrss/example1.png', 120, 160);

    $sitemap->add($item);

    $item = new MediaItem('http://www.example.com/examples/mrss/example2.html');
    $item->setContent('video/x-flv', 120);
    $item->setPlayer('http://www.example.com/shows/example/video.swf?flash_params');
    $item->setTitle('Barbacoas en invierno');
    $item->setDescription('Consigue unos filetes frios');
    $item->setThumbnail('http://www.example.com/examples/mrss/example2.png', 120, 160);
    $sitemap->add($item);

    $sitemap->build();

} catch (SitemapException $e) {

    echo $e->getMessage();
}
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
use NilPortugues\Sitemap\NewsSitemap;
use NilPortugues\Sitemap\Item\News\NewsItem;
use NilPortugues\Sitemap\SitemapException;

try {
    $sitemap = new NewsSitemap('path/to/folder','sitemap.news.xml');

    $item = new NewsItem(
        'http://www.example.org/business/article55.html', //URL
        'Companies A, B in Merger Talks', //Title
        '2008-12-23', //Publication Date
        'The Example Times', //Publication Name
        'en' //locale
    );

    //Optional Values
    $item->setAccess('Subscription');
    $item->setKeywords('business, merger, acquisition, A, B');
    $item->setStockTickers('NASDAQ:A, NASDAQ:B');
    $item->setGenres('PressRelease, Blog');

    $sitemap->add($item);
    $sitemap->build();

} catch (SitemapException $e) {
    echo $e->getMessage();
}
```
<a name="block4.7.2"></a>
#### Output
```xml
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:news="http://www.google.com/schemas/sitemap-news/0.9">
  <url>
    <loc>http://www.example.org/business/article55.html</loc>
    <news:news>
      <news:publication>
        <news:name>The Example Times</news:name>
        <news:language>en</news:language>
      </news:publication>
      <news:access>Subscription</news:access>
      <news:genres>PressRelease, Blog</news:genres>
      <news:publication_date>2008-12-23</news:publication_date>
      <news:title>Companies A, B in Merger Talks</news:title>
      <news:keywords>business, merger, acquisition, A, B</news:keywords>
      <news:stock_tickers>NASDAQ:A, NASDAQ:B</news:stock_tickers>
    </news:news>
  </url>
</urlset>
```

---

<a name="block5"></a>
## 5. Fully tested.
Testing has been done using PHPUnit and [Travis-CI](https://travis-ci.org). All code has been tested to be compatible from PHP 5.4 up to PHP 5.6 and [Facebook's HHVM](http://hhvm.com/).

---
<a name="block6"></a>
## 6. Questions?

Drop me an e-mail or get in touch with me using [![Gitter](https://badges.gitter.im/Join%20Chat.svg)](https://gitter.im/nilportugues/sitemap-component?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge)


--

<a name="block7"></a>
## 7. Author
Nil Portugués Calderó
 - <contact@nilportugues.com>
 - http://nilportugues.com
