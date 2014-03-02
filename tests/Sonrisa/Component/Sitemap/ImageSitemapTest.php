<?php
/*
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Class ImageSitemapTest
 */
class ImageSitemapTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Sonrisa\Component\Sitemap\ImageSitemap
     */
    protected $sitemap;


    /**
     *
     */
    public function setUp()
    {
        date_default_timezone_set('Europe/Madrid');
        $this->sitemap = new \Sonrisa\Component\Sitemap\ImageSitemap();
    }

    /**
     *
     */
    public function testAddUrlAndImagesWithValidDuplicatedData()
    {
        $expected=<<<XML
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
\t<url>
\t\t<loc>http://www.example.com/</loc>
\t\t<image:image>
\t\t\t<image:loc><![CDATA[http://www.example.com/logo.png]]></image:loc>
\t\t\t<image:title><![CDATA[Example.com 1 logo]]></image:title>
\t\t</image:image>
\t</url>
</urlset>
XML;
        $item = new \Sonrisa\Component\Sitemap\Items\ImageItem();
        $item->setLoc('http://www.example.com/logo.png');
        $item->setTitle('Example.com 1 logo');
        $this->sitemap->add($item,'http://www.example.com/');

        $item = new \Sonrisa\Component\Sitemap\Items\ImageItem();
        $item->setLoc('http://www.example.com/logo.png');
        $item->setTitle('Example.com 2 logo');
        $this->sitemap->add($item,'http://www.example.com/');

        $item = new \Sonrisa\Component\Sitemap\Items\ImageItem();
        $item->setLoc('http://www.example.com/logo.png');
        $item->setTitle('Example.com 3 logo');
        $this->sitemap->add($item,'http://www.example.com/');

        $item = new \Sonrisa\Component\Sitemap\Items\ImageItem();
        $item->setLoc('http://www.example.com/logo.png');
        $item->setTitle('Example.com 4 logo');
        $this->sitemap->add($item,'http://www.example.com/');

        $item = new \Sonrisa\Component\Sitemap\Items\ImageItem();
        $item->setLoc('http://www.example.com/logo.png');
        $item->setTitle('Example.com 5 logo');
        $this->sitemap->add($item,'http://www.example.com/');

        $files = $this->sitemap->build();

        $this->assertEquals($expected,$files[0]);
    }


    public function testAddUrlWithImagesWithValidUrlWithAllFieldsInvalid()
    {
        $expected=<<<XML
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
\t<url>
\t\t<loc>http://www.example.com/</loc>
\t\t<image:image>
\t\t\t<image:loc><![CDATA[http://www.example.com/logo.png]]></image:loc>
\t\t\t<image:title><![CDATA[Example.com logo]]></image:title>
\t\t</image:image>
\t\t<image:image>
\t\t\t<image:loc><![CDATA[http://www.example.com/main.png]]></image:loc>
\t\t\t<image:title><![CDATA[Main image]]></image:title>
\t\t</image:image>
\t</url>
</urlset>
XML;

        $item = new \Sonrisa\Component\Sitemap\Items\ImageItem();
        $item->setLoc('http://www.example.com/logo.png');
        $item->setTitle('Example.com logo');
        $this->sitemap->add($item,'http://www.example.com/');

        $item = new \Sonrisa\Component\Sitemap\Items\ImageItem();
        $item->setLoc('http://www.example.com/main.png');
        $item->setTitle('Main image');
        $this->sitemap->add($item,'http://www.example.com/');

        $files = $this->sitemap->build();

        $this->assertEquals($expected,$files[0]);
    }

    public function testAddUrlWithImagesAbovetheSitemapMaxUrlElementLimit()
    {
        //For testing purposes reduce the real limit to 1000 instead of 50000
        $reflectionClass = new \ReflectionClass('Sonrisa\\Component\\Sitemap\\ImageSitemap');
        $property = $reflectionClass->getProperty('max_items_per_sitemap');
        $property->setAccessible(true);
        $property->setValue($this->sitemap,'1000');


        //Test limit
        for ($i=1;$i<=2000; $i++) {

            for ($j=1;$j<=10; $j++) {

                $item = new \Sonrisa\Component\Sitemap\Items\ImageItem();
                $item->setLoc('http://www.example.com/image_'.$j.'.png');
                $item->setTitle('Main image'.$j );
                $this->sitemap->add($item,'http://www.example.com/page-'.$i.'.html');
            }
        }

        $files = $this->sitemap->build();

        $this->assertArrayHasKey('0',$files);
        $this->assertArrayHasKey('1',$files);
    }


    public function testAddUrlAndImagesWithValidUrlForImages()
    {
        $this->setExpectedException("Sonrisa\\Component\\Sitemap\\Exceptions\\SitemapException");

        $item = new \Sonrisa\Component\Sitemap\Items\ImageItem();
        $item->setLoc('no/a/proper/url');
        $item->setTitle('Example.com logo');
        $this->sitemap->add($item,'http://www.example.com/');

        $files = $this->sitemap->build();
        $this->assertEmpty($files);
    }

    public function testAddUrlAndImagesWithNoUrlForImages()
    {
        $this->setExpectedException("Sonrisa\\Component\\Sitemap\\Exceptions\\SitemapException");

        $item = new \Sonrisa\Component\Sitemap\Items\ImageItem();
        $item->setTitle('Example.com logo');
        $this->sitemap->add($item,'http://www.example.com/');

        $files = $this->sitemap->build();
        $this->assertEmpty($files);
    }


    public function testAddUrlAndImagesWithValidUrlForImagesAndOtherImageDataPassedIsEmpty()
    {
        $this->setExpectedException("Sonrisa\\Component\\Sitemap\\Exceptions\\SitemapException");
        $item = new \Sonrisa\Component\Sitemap\Items\ImageItem();
        $item->setLoc('http://www.example.com/logo.png');
        $item->setTitle('');
        $item->setGeolocation('');
        $item->setLicense('');
        $item->setCaption('');
        $this->sitemap->add($item,'http://www.example.com/');

        $files = $this->sitemap->build();
    }


    public function testAddUrlAndImagesWithValidUrlAndGeolocationForImages()
    {
        $expected=<<<XML
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
\t<url>
\t\t<loc>http://www.example.com/</loc>
\t\t<image:image>
\t\t\t<image:loc><![CDATA[http://www.example.com/logo.png]]></image:loc>
\t\t\t<image:geolocation><![CDATA[Limerick, Ireland]]></image:geolocation>
\t\t</image:image>
\t</url>
</urlset>
XML;

        $item = new \Sonrisa\Component\Sitemap\Items\ImageItem();
        $item->setLoc('http://www.example.com/logo.png');
        $item->setGeolocation('Limerick, Ireland');
        $this->sitemap->add($item,'http://www.example.com/');

        $files = $this->sitemap->build();
        $this->assertEquals($expected,$files[0]);
    }


    public function testAddUrlAndImagesWithValidUrlAndLicenseForImages()
    {
        $expected=<<<XML
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
\t<url>
\t\t<loc>http://www.example.com/</loc>
\t\t<image:image>
\t\t\t<image:loc><![CDATA[http://www.example.com/logo.png]]></image:loc>
\t\t\t<image:license><![CDATA[MIT]]></image:license>
\t\t</image:image>
\t</url>
</urlset>
XML;
        $item = new \Sonrisa\Component\Sitemap\Items\ImageItem();
        $item->setLoc('http://www.example.com/logo.png');
        $item->setLicense('MIT');
        $this->sitemap->add($item,'http://www.example.com/');


        $files = $this->sitemap->build();
        $this->assertEquals($expected,$files[0]);
    }


    public function testAddUrlAndImagesWithValidUrlAndCaptionForImages()
    {
        $expected=<<<XML
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
\t<url>
\t\t<loc>http://www.example.com/</loc>
\t\t<image:image>
\t\t\t<image:loc><![CDATA[http://www.example.com/logo.png]]></image:loc>
\t\t\t<image:caption><![CDATA[This place is called Limerick, Ireland]]></image:caption>
\t\t</image:image>
\t</url>
</urlset>
XML;
        $item = new \Sonrisa\Component\Sitemap\Items\ImageItem();
        $item->setLoc('http://www.example.com/logo.png');
        $item->setCaption('This place is called Limerick, Ireland');
        $this->sitemap->add($item,'http://www.example.com/');

        $files = $this->sitemap->build();
        $this->assertEquals($expected,$files[0]);
    }
}
