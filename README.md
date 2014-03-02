[![Build Status](https://travis-ci.org/sonrisa/sitemap-component.png)](https://travis-ci.org/sonrisa/sitemap-component) Sitemap Component
=================

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/efe392af-cc7c-4a4f-9ec8-817de3b80f6e/mini.png)](https://insight.sensiolabs.com/projects/efe392af-cc7c-4a4f-9ec8-817de3b80f6e)

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

---

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
use Sonrisa\Component\Sitemap\SubmitSitemap;

// $status = array('google' => true, 'bing' => true); if everything went OK.
$status = SubmitSitemap::send('http://example.com/sitemap-index.xml');
```

<a name="block4.2"></a>
### 4.2 - Build a Sitemap Index

In order to use a Sitemap Index, you need to build sitemap files first. Check out 4.3, 4.4 and 4.5.

<a name="block4.2.1"></a>
#### Creation
```php
<?php
include 'vendor/autoload.php';
use \Sonrisa\Component\Sitemap\IndexSitemap;
use \Sonrisa\Component\Sitemap\Items\IndexItem;
use \Sonrisa\Component\Sitemap\Exceptions\SitemapException;

try {
	$sitemap = new IndexSitemap();
	
	$item = new IndexItem();
	$item->setLoc('http://www.example.com/sitemap.content.xml'); //Mandatory
	$item->setLastMod('2005-05-10T17:33:30+08:00'); //Optional
	$sitemap->add($item);
	
	$item = new IndexItem();
	$item->setLoc('http://www.example.com/sitemap.media.xml'); //Mandatory
	$item->setLastMod('2005-05-10T17:33:30+08:00'); //Optional
	$sitemap->add($item);
	
	//var_dump($files) should be an array holding the sitemap files created.
	$files = $sitemap->build();
	$sitemap->write('path/to/public/www','sitemap.index.xml');
	
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
<?php
include 'vendor/autoload.php';
use \Sonrisa\Component\Sitemap\Sitemap;
use \Sonrisa\Component\Sitemap\Items\UrlItem;
use \Sonrisa\Component\Sitemap\Exceptions\SitemapException;

try {
	$sitemap = new Sitemap();
	
	$item = new UrlItem();
	$item->setLoc('http://www.example.com/');  //Mandatory
	$item->setPriority('1.0'); //Optional
	$item->setChangeFreq('daily'); //Optional
	$item->setLastMod('2014-05-10T17:33:30+08:00'); //Optional
	
	$sitemap->add($item);
	
	$item = new UrlItem();
	$item->setLoc('http://www.example.com/blog');  //Mandatory
	$item->setPriority('0.9'); //Optional
	$item->setChangeFreq('monthly'); //Optional
	$item->setLastMod('2014-05-10T17:33:30+08:00'); //Optional
	
	$sitemap->add($item);
	
	$item = new UrlItem();
	$item->setLoc('http://www.example.com/contact');  //Mandatory
	$item->setPriority('0.8'); //Optional
	$item->setChangeFreq('never'); //Optional
	$item->setLastMod('2014-05-10T17:33:30+08:00'); //Optional
	
	$sitemap->add($item);
	
	//var_dump($files) should be an array holding the sitemap files created.
	$files = $sitemap->build();
	$sitemap->write('path/to/public/www','sitemap.index.xml');
   
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
<?php
include 'vendor/autoload.php';
use \Sonrisa\Component\Sitemap\ImageSitemap;
use \Sonrisa\Component\Sitemap\Items\ImageItem;
use \Sonrisa\Component\Sitemap\Exceptions\SitemapException;

try {
	$sitemap = new ImageSitemap();
	
	$item = new ImageItem();
	$item->setLoc('http://www.example.com/logo.png'); //Mandatory
	$item->setTitle('Example.com logo'); //Optional
	
	$sitemap->add($item,'http://www.example.com/');
	
	$item = new ImageItem();
	$item->setLoc('http://www.example.com/main.png'); //Mandatory
	$item->setTitle('Main image'); //Optional
	
	$sitemap->add($item,'http://www.example.com/');
	
	//var_dump($files) should be an array holding the sitemap files created.
	$files = $sitemap->build();
	$sitemap->write('path/to/public/www','sitemap.image.xml');
   
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
<?php
$sitemap = new \Sonrisa\Component\Sitemap\VideoSitemap();

$data = array
(
    //Mandatory values
    'title'                     => 'Grilling steaks for summer',
    'content_loc'               => 'http://www.example.com/video123.flv',
    'player_loc'                => 'http://www.example.com/videoplayer.swf?video=123',

    //Optional
    'thumbnail_loc'             => 'http://www.example.com/thumbs/123.jpg', 
    'description'               => 'Alkis shows you how to get perfectly done steaks everytime',
    'allow_embed'               => 'yes',
    'autoplay'                  => 'ap=1',
    'duration'                  => '600',
    'expiration_date'           => '2009-11-05T19:20:30+08:00',
    'rating'                    => '4.2',
    'view_count'                => '12345',
    'publication_date'          => '2007-11-05T19:20:30+08:00',
    'family_friendly'           => 'yes',
    'restriction'               => 'IE GB US CA',
    'restriction_relationship'  => 'allow',
    'gallery_loc'               => 'http://cooking.example.com',
    'gallery_loc_title'         => 'Cooking Videos',
    'price' => array
    (
        array
        (
            'price'             => '0.99',
            'price_currency'    => 'EUR',
            'resolution'        => 'HD',
            'type'              => 'rent',
        ),
        array
        (
            'price'             => '0.75',
            'price_currency'    => 'EUR',
            'resolution'        => 'SD',
            'type'              => 'rent',
        ),

    ),
    'category'                  => 'cooking',
    'tag'                       => array('action','drama','entrepreneur'),
    'requires_subscription'     => 'yes',
    'uploader'                  => 'GrillyMcGrillerson',
    'uploader_info'             => 'http://www.example.com/users/grillymcgrillerson',
    'platform'                  => 'web mobile tv',
    'platform_relationship'     => 'allow',
    'live'                      => 'no',
);

$sitemap->add($data,'http://www.example.com/');
$files = $sitemap->build();
$sitemap->write('path/to/public/www','sitemap.videos.xml');
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
<?php
use Sonrisa\Component\Sitemap\MediaSitemap;

$sitemap = new MediaSitemap();
$sitemap->setTitle('Media RSS de ejemplo');
$sitemap->setLink('http://www.example.com/ejemplos/mrss/');
$sitemap->setDescription('Ejemplo de MRSS');

$sitemap->add(array
(
    //Mandatory values
    'link'          =>  'http://www.example.com/examples/mrss/example1.html',

    //Optional
    'mimetype'      =>  'video/x-flv',
    'player'        =>  'http://www.example.com/shows/example/video.swf?flash_params',
    'duration'      =>  120,
    'title'         =>  'Barbacoas en verano',
    'description'   =>  'Consigue que los filetes queden perfectamente hechos siempre',
    'thumbnail'     =>  'http://www.example.com/examples/mrss/example1.png',
    'height'        =>  120,
    'width'         =>  160,
));

$sitemap->add(array
(
    //Mandatory values
    'link'          =>  'http://www.example.com/examples/mrss/example2.html',

    //Optional
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
$files = $sitemap->build();
$sitemap->write('path/to/public/www','sitemap.media.xml');
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
$sitemap = new NewsSitemap();

$sitemap->add(
    array
    (
        //Mandatory values
        'loc'               => 'http://www.example.org/business/article55.html',
        'title'             => 'Companies A, B in Merger Talks',
        'publication_date'  => '2008-12-23',
        'name'              => 'The Example Times',
        'language'          => 'en',

        //Optional
        'access'            => 'Subscription',
        'keywords'          => 'business, merger, acquisition, A, B',
        'stock_tickers'     => 'NASDAQ:A, NASDAQ:B',
        'genres'            => 'PressRelease, Blog'
    )
);

$files = $sitemap->build();
$sitemap->write('path/to/public/www','sitemap.news.xml');
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
Testing has been done using PHPUnit and [Travis-CI](https://travis-ci.org). All code has been tested to be compatible from PHP 5.3 up to PHP 5.6 and [Facebook's PHP Virtual Machine: HipHop](http://hiphop-php.com).

---

<a name="block6"></a>
## 6. Author
Nil Portugués Calderó
 - <contact@nilportugues.com>
 - http://nilportugues.com
