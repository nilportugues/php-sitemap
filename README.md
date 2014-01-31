Sitemap Component
=================

## 1.Installation
Add the following to your `composer.json` file :

```
"sonrisa/sitemap-component":"dev-master"
```

Builds sitemaps for pages, images and media files and provides a class to submit them to search engines.

## 2. Build your sitemaps
This component builds sitemaps supported by the main search engines, Google and Bing, in xml and gzip formats.

The **Sitemap Component** is able of building the following types of sitemaps:

- **sitemap.xml**: Text content sitemaps, the most common type of sitemap found around the Internet.
- **images.xml**: Image sitemaps, image resources that can be shared with image search engines.
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

### 4.2 - Build a Sitemap
```php
<?php
use Sonrisa\Component\Sitemap\XMLSitemap;

// Get sitemap as an array of data splitted in files,
// each containing a max. of 50.000 <url> elements per sitemap file.
$array = $sitemap
            ->addUrl('http://www.example.com/','1.0','daily','2014-05-10T17:33:30+08:00')
            ->addUrl('http://www.example.com/blog','0.9','monthly','2014-05-10T17:33:30+08:00')
            ->addUrl('http://www.example.com/contact','0.8','never','2014-05-10T17:33:30+08:00')
            ->build()
            ->getAsArray();



```
### 4.3 - Build a Image Sitemap

```php
<?php
use Sonrisa\Component\Sitemap\ImageSitemap;


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
