[![Build Status](https://travis-ci.org/sonrisa/sitemap-component.png)](https://travis-ci.org/sonrisa/sitemap-component) Sitemap Component
=================

## 1.Installation
Add the following to your `composer.json` file :

```js
"sonrisa/sitemap-component":"dev-master"
```

Builds sitemaps for pages, images and media files and provides a class to submit them to search engines.

## 2. Build your sitemaps
This component builds sitemaps supported by the main search engines, Google and Bing, in xml and gzip formats.

The **Sitemap Component** is able of building the following types of sitemaps:

- **sitemap.xml**: Text content sitemaps, the most common type of sitemap found around the Internet.
- **media.xml**: Media sitemaps, videos files belong here. Usually used as for podcasts.
 
## 3. Automatic sitemap submission

This component also provides a method to submit the generated sitemaps to the following search engines:
- Google
- Bing

## 4. Usage

### 4.1 - Submit to search engines
```php
<?php
use Sonrisa\Component\Sitemap\Sitemap;

// $status = array('google' => true, 'bing' => true); if everything went OK.
$status = Sitemap::submit('http://example.com/sitemap.xml');

```

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
### 4.3 - Build a Sitemap with Images

```php
<?php
use Sonrisa\Component\Sitemap\XMLSitemap;

$sitemap = new XMLSitemap();

$this->sitemap->addUrl('http://www.example.com/','0.8','monthly','2005-05-10T17:33:30+08:00');

//Add images to the sitemap by relating them to a Url.
$this->sitemap->addImage('http://www.example.com/',array('loc' => 'http://www.example.com/logo.png', 'title' => 'Example.com logo' ));
$this->sitemap->addImage('http://www.example.com/',array('loc' => 'http://www.example.com/main.png', 'title' => 'Main image' ));

//Now just do Option 1 or Option 2, as before

```
### 4.4 - Build a Media Sitemap

```php
<?php
use Sonrisa\Component\Sitemap\MediaSitemap;


```

## 5. Fully tested.
Testing has been done using PHPUnit and [Travis-CI](https://travis-ci.org). All code has been tested to be compatible from PHP 5.3 up to PHP 5.5 and [Facebook's PHP Virtual Machine: HipHop](http://hiphop-php.com).


## 6. Author
Nil Portugués Calderó
 - <contact@nilportugues.com>
 - http://nilportugues.com
