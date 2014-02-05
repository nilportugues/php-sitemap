<?php
/*
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Sonrisa\Component\Sitemap\XMLSitemap;

class XMLSitemapTest extends \PHPUnit_Framework_TestCase
{
    protected $sitemap;

    public function setUp()
    {
        $this->sitemap = new XMLSitemap();
    }

    public function testAddUrlWithValidUrlWithAllFields()
    {
        $expected=<<<XML
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
\t<url>
\t\t<loc>http://www.example.com/</loc>
\t\t<lastmod>2005-05-10T17:33:30+08:00</lastmod>
\t\t<changefreq>monthly</changefreq>
\t\t<priority>0.8</priority>
\t</url>
</urlset>
XML;
        $this->sitemap->addUrl('http://www.example.com/','0.8','monthly','2005-05-10T17:33:30+08:00');
        $files = $this->sitemap->build()->get();

        $this->assertEquals($expected,$files[0]);
    }

    public function testAddUrlWithValidUrlWithAllFieldsCustomDate()
    {
        $expected=<<<XML
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
\t<url>
\t\t<loc>http://www.example.com/</loc>
\t\t<lastmod>2012-07-05T10:43:00+02:00</lastmod>
\t\t<changefreq>monthly</changefreq>
\t\t<priority>0.8</priority>
\t</url>
</urlset>
XML;
        date_default_timezone_set('Europe/Madrid');
        $this->sitemap->addUrl('http://www.example.com/','0.8','monthly','2012-07-05 10:43AM',"Y-m-d h:iA");
        $files = $this->sitemap->build()->get();

        $this->assertEquals($expected,$files[0]);
    }

    public function testAddUrlWithValidDuplicateUrlWithAllFields()
    {
        $expected=<<<XML
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
\t<url>
\t\t<loc>http://www.example.com/</loc>
\t\t<lastmod>2005-05-10T17:33:30+08:00</lastmod>
\t\t<changefreq>monthly</changefreq>
\t\t<priority>0.8</priority>
\t</url>
</urlset>
XML;
        $this->sitemap->addUrl('http://www.example.com/','0.8','monthly','2005-05-10T17:33:30+08:00');
        $this->sitemap->addUrl('http://www.example.com/','0.7','weekly','2005-05-10T17:33:30+08:00');
        $this->sitemap->addUrl('http://www.example.com/','0.6','weekly','2005-05-10T17:33:30+08:00');
        $this->sitemap->addUrl('http://www.example.com/','0.5','weekly','2005-05-10T17:33:30+08:00');
        $this->sitemap->addUrl('http://www.example.com/','0.4','daily','2005-05-10T17:33:30+08:00');
        $this->sitemap->addUrl('http://www.example.com/','0.3','never','2005-05-10T17:33:30+08:00');

        $files = $this->sitemap->build()->get();

        $this->assertEquals($expected,$files[0]);

    }


    public function testAddUrlWithInvalidUrlWontGetAdded()
    {
        $expected=<<<XML
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
</urlset>
XML;
        $this->sitemap->addUrl('not/valid/url','0.8','monthly','2005-05-10T17:33:30+08:00');
        $files = $this->sitemap->build()->get();

        $this->assertEquals($expected,$files[0]);

    }

    public function testAddUrlWithValidUrlWithLastModAndWithDefaultPriority()
    {
        $expected=<<<XML
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
\t<url>
\t\t<loc>http://www.example.com/</loc>
\t\t<lastmod>2005-05-10T17:33:30+08:00</lastmod>
\t\t<priority>0.5</priority>
\t</url>
</urlset>
XML;

        $this->sitemap->addUrl('http://www.example.com/','','','2005-05-10T17:33:30+08:00');
        $files = $this->sitemap->build()->get();

        $this->assertEquals($expected,$files[0]);
    }

    public function testAddUrlWithValidUrlWithChangeFreqAlwaysAndWithDefaultPriority()
    {
        $expected=<<<XML
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
\t<url>
\t\t<loc>http://www.example.com/</loc>
\t\t<changefreq>always</changefreq>
\t\t<priority>0.5</priority>
\t</url>
</urlset>
XML;

        $this->sitemap->addUrl('http://www.example.com/','','always');
        $files = $this->sitemap->build()->get();

        $this->assertEquals($expected,$files[0]);
    }


    public function testAddUrlWithValidUrlWithChangeFreqHourlyAndWithDefaultPriority()
    {

        $expected=<<<XML
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
\t<url>
\t\t<loc>http://www.example.com/</loc>
\t\t<changefreq>hourly</changefreq>
\t\t<priority>0.5</priority>
\t</url>
</urlset>
XML;

        $this->sitemap->addUrl('http://www.example.com/','','hourly');
        $files = $this->sitemap->build()->get();

        $this->assertEquals($expected,$files[0]);
    }

    public function testAddUrlWithValidUrlWithChangeFreqDailyAndWithDefaultPriority()
    {


        $expected=<<<XML
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
\t<url>
\t\t<loc>http://www.example.com/</loc>
\t\t<changefreq>daily</changefreq>
\t\t<priority>0.5</priority>
\t</url>
</urlset>
XML;

        $this->sitemap->addUrl('http://www.example.com/','','daily');
        $files = $this->sitemap->build()->get();

        $this->assertEquals($expected,$files[0]);

    }

    public function testAddUrlWithValidUrlWithChangeFreqWeeklyAndWithDefaultPriority()
    {

        $expected=<<<XML
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
\t<url>
\t\t<loc>http://www.example.com/</loc>
\t\t<changefreq>weekly</changefreq>
\t\t<priority>0.5</priority>
\t</url>
</urlset>
XML;

        $this->sitemap->addUrl('http://www.example.com/','','weekly');
        $files = $this->sitemap->build()->get();

        $this->assertEquals($expected,$files[0]);

    }

    public function testAddUrlWithValidUrlWithChangeFreqMonthlyAndWithDefaultPriority()
    {

        $expected=<<<XML
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
\t<url>
\t\t<loc>http://www.example.com/</loc>
\t\t<changefreq>monthly</changefreq>
\t\t<priority>0.5</priority>
\t</url>
</urlset>
XML;

        $this->sitemap->addUrl('http://www.example.com/','','monthly');
        $files = $this->sitemap->build()->get();

        $this->assertEquals($expected,$files[0]);

    }

    public function testAddUrlWithValidUrlWithChangeFreqYearlyAndWithDefaultPriority()
    {

        $expected=<<<XML
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
\t<url>
\t\t<loc>http://www.example.com/</loc>
\t\t<changefreq>yearly</changefreq>
\t\t<priority>0.5</priority>
\t</url>
</urlset>
XML;

        $this->sitemap->addUrl('http://www.example.com/','','yearly');
        $files = $this->sitemap->build()->get();

        $this->assertEquals($expected,$files[0]);

    }

    public function testAddUrlWithValidUrlWithChangeFreqNeverAndWithDefaultPriority()
    {

        $expected=<<<XML
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
\t<url>
\t\t<loc>http://www.example.com/</loc>
\t\t<changefreq>never</changefreq>
\t\t<priority>0.5</priority>
\t</url>
</urlset>
XML;

        $this->sitemap->addUrl('http://www.example.com/','','never');
        $files = $this->sitemap->build()->get();

        $this->assertEquals($expected,$files[0]);
    }




    public function testAddUrlWithValidUrlWithPriority()
    {
        $expected=<<<XML
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
\t<url>
\t\t<loc>http://www.example.com/</loc>
\t\t<priority>0.8</priority>
\t</url>
</urlset>
XML;

        $this->sitemap->addUrl('http://www.example.com/','0.8');
        $files = $this->sitemap->build()->get();

        $this->assertEquals($expected,$files[0]);
    }

    public function testAddUrlWithValidUrlWithInvalidLastModValue()
    {
        $expected=<<<XML
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
\t<url>
\t\t<loc>http://www.example.com/</loc>
\t\t<changefreq>monthly</changefreq>
\t\t<priority>0.8</priority>
\t</url>
</urlset>
XML;

        $this->sitemap->addUrl('http://www.example.com/','0.8','monthly','AAAAA');
        $files = $this->sitemap->build()->get();

        $this->assertEquals($expected,$files[0]);
    }

    public function testAddUrlWithValidUrlWithInvalidChangeFreq()
    {
        $expected=<<<XML
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
\t<url>
\t\t<loc>http://www.example.com/</loc>
\t\t<lastmod>2005-05-10T17:33:30+08:00</lastmod>
\t\t<priority>0.8</priority>
\t</url>
</urlset>
XML;

        $this->sitemap->addUrl('http://www.example.com/','0.8','AAAAA','2005-05-10T17:33:30+08:00');
        $files = $this->sitemap->build()->get();

        $this->assertEquals($expected,$files[0]);
    }

    public function testAddUrlWithValidUrlWithInvalidPriority1()
    {
        $expected=<<<XML
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
\t<url>
\t\t<loc>http://www.example.com/</loc>
\t\t<priority>0.5</priority>
\t</url>
</urlset>
XML;

        $this->sitemap->addUrl('http://www.example.com/','6');
        $files = $this->sitemap->build()->get();

        $this->assertEquals($expected,$files[0]);
    }

    public function testAddUrlWithValidUrlWithInvalidPriority2()
    {
        $expected=<<<XML
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
\t<url>
\t\t<loc>http://www.example.com/</loc>
\t\t<priority>0.5</priority>
\t</url>
</urlset>
XML;

        $this->sitemap->addUrl('http://www.example.com/','AAAAA');
        $files = $this->sitemap->build()->get();

        $this->assertEquals($expected,$files[0]);
    }

    public function testAddUrlWithValidUrlWithInvalidPriority3()
    {
        $expected=<<<XML
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
\t<url>
\t\t<loc>http://www.example.com/</loc>
\t\t<priority>0.8</priority>
\t</url>
</urlset>
XML;

        $this->sitemap->addUrl('http://www.example.com/','0.88');
        $files = $this->sitemap->build()->get();

        $this->assertEquals($expected,$files[0]);
    }

    public function testAddUrlWithValidUrlWithInvalidPriority4()
    {
        $expected=<<<XML
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
\t<url>
\t\t<loc>http://www.example.com/</loc>
\t\t<priority>0.5</priority>
\t</url>
</urlset>
XML;

        $this->sitemap->addUrl('http://www.example.com/','1.88');
        $files = $this->sitemap->build()->get();

        $this->assertEquals($expected,$files[0]);
    }

    public function testAddUrlWithValidUrlWithInvalidPriority5()
    {
        $expected=<<<XML
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
\t<url>
\t\t<loc>http://www.example.com/</loc>
\t\t<priority>0.5</priority>
\t</url>
</urlset>
XML;

        $this->sitemap->addUrl('http://www.example.com/',-3.14);
        $files = $this->sitemap->build()->get();

        $this->assertEquals($expected,$files[0]);
    }

    public function testAddUrlWithValidUrlWithAllFieldsInvalid()
    {
$expected=<<<XML
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
\t<url>
\t\t<loc>http://www.example.com/</loc>
\t\t<priority>0.5</priority>
\t</url>
</urlset>
XML;
        $this->sitemap->addUrl('http://www.example.com/','AAAAAA','AAAAA','AAAAAA');
        $files = $this->sitemap->build()->get();

        $this->assertEquals($expected,$files[0]);
    }

    public function testAddUrlAbovetheSitemapMaxUrlElementLimit()
    {
        //For testing purposes reduce the real limit to 1000 instead of 50000
        $reflectionClass = new \ReflectionClass('Sonrisa\\Component\\Sitemap\\XMLSitemap');
        $property = $reflectionClass->getProperty('max_items_per_sitemap');
        $property->setAccessible(true);
        $property->setValue($this->sitemap,'1000');

        //Test limit
        for ($i=1;$i<=2000; $i++) {
            $this->sitemap->addUrl('http://www.example.com/page-'.$i.'.html');
        }
        $files = $this->sitemap->build()->get();

        $this->assertArrayHasKey('0',$files);
        $this->assertArrayHasKey('1',$files);
    }


    /**-------------------------------------------------------------------------
     *    SITEMAP WITH BASIC IMAGE FUNCTIONALITY
     *-------------------------------------------------------------------------*/

    public function testAddUrlAndImagesWithValidUrlWithAllFields()
    {
        $expected=<<<XML
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
\t<url>
\t\t<loc>http://www.example.com/</loc>
\t\t<lastmod>2005-05-10T17:33:30+08:00</lastmod>
\t\t<changefreq>monthly</changefreq>
\t\t<priority>0.8</priority>
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
        $this->sitemap->addUrl('http://www.example.com/','0.8','monthly','2005-05-10T17:33:30+08:00');

        $this->sitemap->addImage('http://www.example.com/',array('loc' => 'http://www.example.com/logo.png', 'title' => 'Example.com logo' ));
        $this->sitemap->addImage('http://www.example.com/',array('loc' => 'http://www.example.com/main.png', 'title' => 'Main image' ));

        $files = $this->sitemap->build()->get();

        $this->assertEquals($expected,$files[0]);
    }

    public function testAddUrlAndImagesWithValidUrlWithAllFieldsCustomDate()
    {
        $expected=<<<XML
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
\t<url>
\t\t<loc>http://www.example.com/</loc>
\t\t<lastmod>2012-07-05T10:43:00+02:00</lastmod>
\t\t<changefreq>monthly</changefreq>
\t\t<priority>0.8</priority>
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
        date_default_timezone_set('Europe/Madrid');
        $this->sitemap->addUrl('http://www.example.com/','0.8','monthly','2012-07-05 10:43AM',"Y-m-d h:iA");

        $this->sitemap->addImage('http://www.example.com/',array('loc' => 'http://www.example.com/logo.png', 'title' => 'Example.com logo' ));
        $this->sitemap->addImage('http://www.example.com/',array('loc' => 'http://www.example.com/main.png', 'title' => 'Main image' ));

        $files = $this->sitemap->build()->get();

        $this->assertEquals($expected,$files[0]);
    }


    public function testAddUrlWithImagesWithValidDuplicateUrlWithAllFields()
    {
        $expected=<<<XML
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
\t<url>
\t\t<loc>http://www.example.com/</loc>
\t\t<lastmod>2005-05-10T17:33:30+08:00</lastmod>
\t\t<changefreq>monthly</changefreq>
\t\t<priority>0.8</priority>
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
        $this->sitemap->addUrl('http://www.example.com/','0.8','monthly','2005-05-10T17:33:30+08:00');
        $this->sitemap->addUrl('http://www.example.com/','0.7','weekly','2005-05-10T17:33:30+08:00');
        $this->sitemap->addUrl('http://www.example.com/','0.6','weekly','2005-05-10T17:33:30+08:00');
        $this->sitemap->addUrl('http://www.example.com/','0.5','weekly','2005-05-10T17:33:30+08:00');
        $this->sitemap->addUrl('http://www.example.com/','0.4','daily','2005-05-10T17:33:30+08:00');
        $this->sitemap->addUrl('http://www.example.com/','0.3','never','2005-05-10T17:33:30+08:00');


        $this->sitemap->addImage('http://www.example.com/',array('loc' => 'http://www.example.com/logo.png', 'title' => 'Example.com logo' ));
        $this->sitemap->addImage('http://www.example.com/',array('loc' => 'http://www.example.com/main.png', 'title' => 'Main image' ));

        $files = $this->sitemap->build()->get();

        $this->assertEquals($expected,$files[0]);

    }


    public function testAddUrlWithImagesWithInvalidUrlWontGetAdded()
    {
        $expected=<<<XML
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
</urlset>
XML;
        $this->sitemap->addUrl('not/valid/url','0.8','monthly','2005-05-10T17:33:30+08:00');

        $this->sitemap->addImage('http://www.example.com/',array('loc' => 'http://www.example.com/logo.png', 'title' => 'Example.com logo' ));
        $this->sitemap->addImage('http://www.example.com/',array('loc' => 'http://www.example.com/main.png', 'title' => 'Main image' ));

        $files = $this->sitemap->build()->get();

        $this->assertEquals($expected,$files[0]);

    }

    public function testAddUrlWithImagesWithValidUrlWithLastModAndWithDefaultPriority()
    {
        $expected=<<<XML
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
\t<url>
\t\t<loc>http://www.example.com/</loc>
\t\t<lastmod>2005-05-10T17:33:30+08:00</lastmod>
\t\t<priority>0.5</priority>
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

        $this->sitemap->addUrl('http://www.example.com/','','','2005-05-10T17:33:30+08:00');

        $this->sitemap->addImage('http://www.example.com/',array('loc' => 'http://www.example.com/logo.png', 'title' => 'Example.com logo' ));
        $this->sitemap->addImage('http://www.example.com/',array('loc' => 'http://www.example.com/main.png', 'title' => 'Main image' ));

        $files = $this->sitemap->build()->get();

        $this->assertEquals($expected,$files[0]);
    }

    public function testAddUrlWithImagesWithValidUrlWithChangeFreqAlwaysAndWithDefaultPriority()
    {
        $expected=<<<XML
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
\t<url>
\t\t<loc>http://www.example.com/</loc>
\t\t<changefreq>always</changefreq>
\t\t<priority>0.5</priority>
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

        $this->sitemap->addUrl('http://www.example.com/','','always');

        $this->sitemap->addImage('http://www.example.com/',array('loc' => 'http://www.example.com/logo.png', 'title' => 'Example.com logo' ));
        $this->sitemap->addImage('http://www.example.com/',array('loc' => 'http://www.example.com/main.png', 'title' => 'Main image' ));

        $files = $this->sitemap->build()->get();

        $this->assertEquals($expected,$files[0]);
    }


    public function testAddUrlWithImagesWithValidUrlWithChangeFreqHourlyAndWithDefaultPriority()
    {

        $expected=<<<XML
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
\t<url>
\t\t<loc>http://www.example.com/</loc>
\t\t<changefreq>hourly</changefreq>
\t\t<priority>0.5</priority>
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

        $this->sitemap->addUrl('http://www.example.com/','','hourly');

        $this->sitemap->addImage('http://www.example.com/',array('loc' => 'http://www.example.com/logo.png', 'title' => 'Example.com logo' ));
        $this->sitemap->addImage('http://www.example.com/',array('loc' => 'http://www.example.com/main.png', 'title' => 'Main image' ));

        $files = $this->sitemap->build()->get();

        $this->assertEquals($expected,$files[0]);
    }

    public function testAddUrlWithImagesWithValidUrlWithChangeFreqDailyAndWithDefaultPriority()
    {


        $expected=<<<XML
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
\t<url>
\t\t<loc>http://www.example.com/</loc>
\t\t<changefreq>daily</changefreq>
\t\t<priority>0.5</priority>
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

        $this->sitemap->addUrl('http://www.example.com/','','daily');

        $this->sitemap->addImage('http://www.example.com/',array('loc' => 'http://www.example.com/logo.png', 'title' => 'Example.com logo' ));
        $this->sitemap->addImage('http://www.example.com/',array('loc' => 'http://www.example.com/main.png', 'title' => 'Main image' ));

        $files = $this->sitemap->build()->get();

        $this->assertEquals($expected,$files[0]);

    }

    public function testAddUrlWithImagesWithValidUrlWithChangeFreqWeeklyAndWithDefaultPriority()
    {

        $expected=<<<XML
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
\t<url>
\t\t<loc>http://www.example.com/</loc>
\t\t<changefreq>weekly</changefreq>
\t\t<priority>0.5</priority>
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

        $this->sitemap->addUrl('http://www.example.com/','','weekly');

        $this->sitemap->addImage('http://www.example.com/',array('loc' => 'http://www.example.com/logo.png', 'title' => 'Example.com logo' ));
        $this->sitemap->addImage('http://www.example.com/',array('loc' => 'http://www.example.com/main.png', 'title' => 'Main image' ));

        $files = $this->sitemap->build()->get();

        $this->assertEquals($expected,$files[0]);

    }

    public function testAddUrlWithImagesWithValidUrlWithChangeFreqMonthlyAndWithDefaultPriority()
    {

        $expected=<<<XML
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
\t<url>
\t\t<loc>http://www.example.com/</loc>
\t\t<changefreq>monthly</changefreq>
\t\t<priority>0.5</priority>
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

        $this->sitemap->addUrl('http://www.example.com/','','monthly');

        $this->sitemap->addImage('http://www.example.com/',array('loc' => 'http://www.example.com/logo.png', 'title' => 'Example.com logo' ));
        $this->sitemap->addImage('http://www.example.com/',array('loc' => 'http://www.example.com/main.png', 'title' => 'Main image' ));

        $files = $this->sitemap->build()->get();

        $this->assertEquals($expected,$files[0]);

    }

    public function testAddUrlWithImagesWithValidUrlWithChangeFreqYearlyAndWithDefaultPriority()
    {

        $expected=<<<XML
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
\t<url>
\t\t<loc>http://www.example.com/</loc>
\t\t<changefreq>yearly</changefreq>
\t\t<priority>0.5</priority>
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

        $this->sitemap->addUrl('http://www.example.com/','','yearly');

        $this->sitemap->addImage('http://www.example.com/',array('loc' => 'http://www.example.com/logo.png', 'title' => 'Example.com logo' ));
        $this->sitemap->addImage('http://www.example.com/',array('loc' => 'http://www.example.com/main.png', 'title' => 'Main image' ));

        $files = $this->sitemap->build()->get();

        $this->assertEquals($expected,$files[0]);

    }

    public function testAddUrlWithImagesWithValidUrlWithChangeFreqNeverAndWithDefaultPriority()
    {

        $expected=<<<XML
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
\t<url>
\t\t<loc>http://www.example.com/</loc>
\t\t<changefreq>never</changefreq>
\t\t<priority>0.5</priority>
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

        $this->sitemap->addUrl('http://www.example.com/','','never');

        $this->sitemap->addImage('http://www.example.com/',array('loc' => 'http://www.example.com/logo.png', 'title' => 'Example.com logo' ));
        $this->sitemap->addImage('http://www.example.com/',array('loc' => 'http://www.example.com/main.png', 'title' => 'Main image' ));

        $files = $this->sitemap->build()->get();

        $this->assertEquals($expected,$files[0]);
    }




    public function testAddUrlWithImagesWithValidUrlWithPriority()
    {
        $expected=<<<XML
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
\t<url>
\t\t<loc>http://www.example.com/</loc>
\t\t<priority>0.8</priority>
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

        $this->sitemap->addUrl('http://www.example.com/','0.8');

        $this->sitemap->addImage('http://www.example.com/',array('loc' => 'http://www.example.com/logo.png', 'title' => 'Example.com logo' ));
        $this->sitemap->addImage('http://www.example.com/',array('loc' => 'http://www.example.com/main.png', 'title' => 'Main image' ));

        $files = $this->sitemap->build()->get();

        $this->assertEquals($expected,$files[0]);
    }

    public function testAddUrlWithImagesWithValidUrlWithInvalidLastModValue()
    {
        $expected=<<<XML
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
\t<url>
\t\t<loc>http://www.example.com/</loc>
\t\t<changefreq>monthly</changefreq>
\t\t<priority>0.8</priority>
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

        $this->sitemap->addUrl('http://www.example.com/','0.8','monthly','AAAAA');

        $this->sitemap->addImage('http://www.example.com/',array('loc' => 'http://www.example.com/logo.png', 'title' => 'Example.com logo' ));
        $this->sitemap->addImage('http://www.example.com/',array('loc' => 'http://www.example.com/main.png', 'title' => 'Main image' ));

        $files = $this->sitemap->build()->get();

        $this->assertEquals($expected,$files[0]);
    }

    public function testAddUrlWithImagesWithValidUrlWithInvalidChangeFreq()
    {
        $expected=<<<XML
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
\t<url>
\t\t<loc>http://www.example.com/</loc>
\t\t<lastmod>2005-05-10T17:33:30+08:00</lastmod>
\t\t<priority>0.8</priority>
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

        $this->sitemap->addUrl('http://www.example.com/','0.8','AAAAA','2005-05-10T17:33:30+08:00');

        $this->sitemap->addImage('http://www.example.com/',array('loc' => 'http://www.example.com/logo.png', 'title' => 'Example.com logo' ));
        $this->sitemap->addImage('http://www.example.com/',array('loc' => 'http://www.example.com/main.png', 'title' => 'Main image' ));

        $files = $this->sitemap->build()->get();

        $this->assertEquals($expected,$files[0]);
    }

    public function testAddUrlWithImagesWithValidUrlWithInvalidPriority1()
    {
        $expected=<<<XML
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
\t<url>
\t\t<loc>http://www.example.com/</loc>
\t\t<priority>0.5</priority>
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

        $this->sitemap->addUrl('http://www.example.com/','6');

        $this->sitemap->addImage('http://www.example.com/',array('loc' => 'http://www.example.com/logo.png', 'title' => 'Example.com logo' ));
        $this->sitemap->addImage('http://www.example.com/',array('loc' => 'http://www.example.com/main.png', 'title' => 'Main image' ));

        $files = $this->sitemap->build()->get();

        $this->assertEquals($expected,$files[0]);
    }

    public function testAddUrlWithImagesWithValidUrlWithInvalidPriority2()
    {
        $expected=<<<XML
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
\t<url>
\t\t<loc>http://www.example.com/</loc>
\t\t<priority>0.5</priority>
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

        $this->sitemap->addUrl('http://www.example.com/','AAAAA');

        $this->sitemap->addImage('http://www.example.com/',array('loc' => 'http://www.example.com/logo.png', 'title' => 'Example.com logo' ));
        $this->sitemap->addImage('http://www.example.com/',array('loc' => 'http://www.example.com/main.png', 'title' => 'Main image' ));

        $files = $this->sitemap->build()->get();

        $this->assertEquals($expected,$files[0]);
    }

    public function testAddUrlWithImagesWithValidUrlWithInvalidPriority3()
    {
        $expected=<<<XML
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
\t<url>
\t\t<loc>http://www.example.com/</loc>
\t\t<priority>0.8</priority>
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

        $this->sitemap->addUrl('http://www.example.com/','0.88');

        $this->sitemap->addImage('http://www.example.com/',array('loc' => 'http://www.example.com/logo.png', 'title' => 'Example.com logo' ));
        $this->sitemap->addImage('http://www.example.com/',array('loc' => 'http://www.example.com/main.png', 'title' => 'Main image' ));

        $files = $this->sitemap->build()->get();

        $this->assertEquals($expected,$files[0]);
    }

    public function testAddUrlWithImagesWithValidUrlWithInvalidPriority4()
    {
        $expected=<<<XML
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
\t<url>
\t\t<loc>http://www.example.com/</loc>
\t\t<priority>0.5</priority>
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

        $this->sitemap->addUrl('http://www.example.com/','1.88');

        $this->sitemap->addImage('http://www.example.com/',array('loc' => 'http://www.example.com/logo.png', 'title' => 'Example.com logo' ));
        $this->sitemap->addImage('http://www.example.com/',array('loc' => 'http://www.example.com/main.png', 'title' => 'Main image' ));

        $files = $this->sitemap->build()->get();

        $this->assertEquals($expected,$files[0]);
    }

    public function testAddUrlWithImagesWithValidUrlWithInvalidPriority5()
    {
        $expected=<<<XML
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
\t<url>
\t\t<loc>http://www.example.com/</loc>
\t\t<priority>0.5</priority>
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

        $this->sitemap->addUrl('http://www.example.com/',-3.14);

        $this->sitemap->addImage('http://www.example.com/',array('loc' => 'http://www.example.com/logo.png', 'title' => 'Example.com logo' ));
        $this->sitemap->addImage('http://www.example.com/',array('loc' => 'http://www.example.com/main.png', 'title' => 'Main image' ));

        $files = $this->sitemap->build()->get();

        $this->assertEquals($expected,$files[0]);
    }

    public function testAddUrlWithImagesWithValidUrlWithAllFieldsInvalid()
    {
        $expected=<<<XML
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
\t<url>
\t\t<loc>http://www.example.com/</loc>
\t\t<priority>0.5</priority>
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
        $this->sitemap->addUrl('http://www.example.com/','AAAAAA','AAAAA','AAAAAA');

        $this->sitemap->addImage('http://www.example.com/',array('loc' => 'http://www.example.com/logo.png', 'title' => 'Example.com logo' ));
        $this->sitemap->addImage('http://www.example.com/',array('loc' => 'http://www.example.com/main.png', 'title' => 'Main image' ));

        $files = $this->sitemap->build()->get();

        $this->assertEquals($expected,$files[0]);
    }

    public function testAddUrlWithImagesAbovetheSitemapMaxUrlElementLimit()
    {
        //For testing purposes reduce the real limit to 1000 instead of 50000
        $reflectionClass = new \ReflectionClass('Sonrisa\\Component\\Sitemap\\XMLSitemap');
        $property = $reflectionClass->getProperty('max_items_per_sitemap');
        $property->setAccessible(true);
        $property->setValue($this->sitemap,'1000');

        //For testing purposes reduce the real limit to 10 instead of 5000
        $property = $reflectionClass->getProperty('max_images_per_url');
        $property->setAccessible(true);
        $property->setValue($this->sitemap,'10');

        //Test limit
        for ($i=1;$i<=2000; $i++) {
            $this->sitemap->addUrl('http://www.example.com/page-'.$i.'.html');

            for ($j=1;$j<=10; $j++)
            {
                $this->sitemap->addImage('http://www.example.com/page-'.$i.'.html',array('loc' => 'http://www.example.com/image_'.$j.'.png', 'title' => 'Main image '.$j ));
            }
        }

        $files = $this->sitemap->build()->get();

        $this->assertArrayHasKey('0',$files);
        $this->assertArrayHasKey('1',$files);
    }

    /**-------------------------------------------------------------------------
     *    SITEMAP WITH MISFORMATTED IMAGE DATA
     *-------------------------------------------------------------------------*/




    public function testAddUrlAndImagesWithValidUrlForImages()
    {
        $expected=<<<XML
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
\t<url>
\t\t<loc>http://www.example.com/</loc>
\t\t<lastmod>2005-05-10T17:33:30+08:00</lastmod>
\t\t<changefreq>monthly</changefreq>
\t\t<priority>0.8</priority>
\t</url>
</urlset>
XML;
        $this->sitemap->addUrl('http://www.example.com/','0.8','monthly','2005-05-10T17:33:30+08:00');
        $this->sitemap->addImage('http://www.example.com/',array('loc' => 'no/a/proper/url', 'title' => 'Example.com logo' ));
        $files = $this->sitemap->build()->get();
        $this->assertEquals($expected,$files[0]);
    }

    public function testAddUrlAndImagesWithNoUrlForImages()
    {
        $expected=<<<XML
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
\t<url>
\t\t<loc>http://www.example.com/</loc>
\t\t<lastmod>2005-05-10T17:33:30+08:00</lastmod>
\t\t<changefreq>monthly</changefreq>
\t\t<priority>0.8</priority>
\t</url>
</urlset>
XML;
        $this->sitemap->addUrl('http://www.example.com/','0.8','monthly','2005-05-10T17:33:30+08:00');
        $this->sitemap->addImage('http://www.example.com/',array('title' => 'Example.com logo' ));
        $files = $this->sitemap->build()->get();
        $this->assertEquals($expected,$files[0]);
    }

    public function testAddUrlAndImagesWithValidUrlForImagesAndOtherImageDataPassedIsEmpty()
    {
        $expected=<<<XML
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
\t<url>
\t\t<loc>http://www.example.com/</loc>
\t\t<lastmod>2005-05-10T17:33:30+08:00</lastmod>
\t\t<changefreq>monthly</changefreq>
\t\t<priority>0.8</priority>
\t\t<image:image>
\t\t\t<image:loc><![CDATA[http://www.example.com/logo.png]]></image:loc>
\t\t</image:image>
\t</url>
</urlset>
XML;
        $this->sitemap->addUrl('http://www.example.com/','0.8','monthly','2005-05-10T17:33:30+08:00');
        $this->sitemap->addImage('http://www.example.com/',array('loc' => 'http://www.example.com/logo.png', 'title' => '', 'geolocation' => '', 'license' => '', 'caption' =>'' ));
        $files = $this->sitemap->build()->get();
        $this->assertEquals($expected,$files[0]);
    }

    public function testAddUrlAndImagesWithValidUrlAndGeolocationForImages()
    {
        $expected=<<<XML
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
\t<url>
\t\t<loc>http://www.example.com/</loc>
\t\t<lastmod>2005-05-10T17:33:30+08:00</lastmod>
\t\t<changefreq>monthly</changefreq>
\t\t<priority>0.8</priority>
\t\t<image:image>
\t\t\t<image:loc><![CDATA[http://www.example.com/logo.png]]></image:loc>
\t\t\t<image:geolocation><![CDATA[Limerick, Ireland]]></image:geolocation>
\t\t</image:image>
\t</url>
</urlset>
XML;
        $this->sitemap->addUrl('http://www.example.com/','0.8','monthly','2005-05-10T17:33:30+08:00');
        $this->sitemap->addImage('http://www.example.com/',array('loc' => 'http://www.example.com/logo.png', 'geolocation' => 'Limerick, Ireland' ));
        $files = $this->sitemap->build()->get();
        $this->assertEquals($expected,$files[0]);
    }   

    public function testAddUrlAndImagesWithValidUrlAndLicenseForImages()
    {
        $expected=<<<XML
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
\t<url>
\t\t<loc>http://www.example.com/</loc>
\t\t<lastmod>2005-05-10T17:33:30+08:00</lastmod>
\t\t<changefreq>monthly</changefreq>
\t\t<priority>0.8</priority>
\t\t<image:image>
\t\t\t<image:loc><![CDATA[http://www.example.com/logo.png]]></image:loc>
\t\t\t<image:license><![CDATA[MIT]]></image:license>
\t\t</image:image>
\t</url>
</urlset>
XML;
        $this->sitemap->addUrl('http://www.example.com/','0.8','monthly','2005-05-10T17:33:30+08:00');
        $this->sitemap->addImage('http://www.example.com/',array('loc' => 'http://www.example.com/logo.png', 'license' => 'MIT' ));
        $files = $this->sitemap->build()->get();
        $this->assertEquals($expected,$files[0]);
    }   
    public function testAddUrlAndImagesWithValidUrlAndCaptionForImages()
    {
        $expected=<<<XML
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
\t<url>
\t\t<loc>http://www.example.com/</loc>
\t\t<lastmod>2005-05-10T17:33:30+08:00</lastmod>
\t\t<changefreq>monthly</changefreq>
\t\t<priority>0.8</priority>
\t\t<image:image>
\t\t\t<image:loc><![CDATA[http://www.example.com/logo.png]]></image:loc>
\t\t\t<image:caption><![CDATA[This place is called Limerick, Ireland]]></image:caption>
\t\t</image:image>
\t</url>
</urlset>
XML;
        $this->sitemap->addUrl('http://www.example.com/','0.8','monthly','2005-05-10T17:33:30+08:00');
        $this->sitemap->addImage('http://www.example.com/',array('loc' => 'http://www.example.com/logo.png', 'caption' => 'This place is called Limerick, Ireland' ));
        $files = $this->sitemap->build()->get();
        $this->assertEquals($expected,$files[0]);
    }   
}
