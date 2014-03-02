<?php
/*
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use \Sonrisa\Component\Sitemap\Items\IndexItem;

/**
 * Class IndexSitemapTest
 */
class IndexSitemapTest extends \PHPUnit_Framework_TestCase
{
    protected $sitemap;

    public function setUp()
    {
        date_default_timezone_set('Europe/Madrid');
        $this->sitemap = new \Sonrisa\Component\Sitemap\IndexSitemap();
    }

    public function testAddUrlWithValidUrlWithAllFields()
    {
        $expected=<<<XML
<?xml version="1.0" encoding="UTF-8"?>
<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
\t<sitemap>
\t\t<loc>http://www.example.com/sitemap.xml</loc>
\t\t<lastmod>2005-05-10T17:33:30+08:00</lastmod>
\t</sitemap>
\t<sitemap>
\t\t<loc>http://www.example.com/sitemap.media.xml</loc>
\t\t<lastmod>2005-05-10T17:33:30+08:00</lastmod>
\t</sitemap>
</sitemapindex>
XML;

        $item = new IndexItem();
        $item->setLoc('http://www.example.com/sitemap.xml');
        $item->setLastMod('2005-05-10T17:33:30+08:00');
        $this->sitemap->add($item);

        $item = new IndexItem();
        $item->setLoc('http://www.example.com/sitemap.media.xml');
        $item->setLastMod('2005-05-10T17:33:30+08:00');
        $this->sitemap->add($item);

        $files = $this->sitemap->build();

        $this->assertEquals($expected,$files[0]);
    }

    public function testAddUrlWithValidUrlWithLoc()
    {
        $expected=<<<XML
<?xml version="1.0" encoding="UTF-8"?>
<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
\t<sitemap>
\t\t<loc>http://www.example.com/sitemap.xml</loc>
\t</sitemap>
\t<sitemap>
\t\t<loc>http://www.example.com/sitemap.media.xml</loc>
\t</sitemap>
</sitemapindex>
XML;

        $item = new IndexItem();
        $item->setLoc('http://www.example.com/sitemap.xml');
        $this->sitemap->add($item);

        $item = new IndexItem();
        $item->setLoc('http://www.example.com/sitemap.media.xml');
        $this->sitemap->add($item);

        $files = $this->sitemap->build();

        $this->assertEquals($expected,$files[0]);
    }

    public function testAddUrlWithValidUrlWithInvalidLoc()
    {
        $this->setExpectedException("Sonrisa\\Component\\Sitemap\\Exceptions\\SitemapException");

        $item = new IndexItem();
        $item->setLoc('no/a/real/path/www.example.com/sitemap.xml');
        $this->sitemap->add($item);
    }

    public function testAddUrlWithValidUrlWithInvalidDate()
    {
        $this->setExpectedException("Sonrisa\\Component\\Sitemap\\Exceptions\\SitemapException");

        $item = new IndexItem();
        $item->setLoc('http://www.example.com/sitemap.xml');
        $item->setLastMod('AAAAAAA');
        $this->sitemap->add($item);

        $this->sitemap->build();
    }

    public function testAddUrlAbovetheSitemapMaxSitemapElementLimit()
    {
        //For testing purposes reduce the real limit to 1000 instead of 50000
        $reflectionClass = new \ReflectionClass('Sonrisa\\Component\\Sitemap\\IndexSitemap');
        $property = $reflectionClass->getProperty('max_items_per_sitemap');
        $property->setAccessible(true);
        $property->setValue($this->sitemap,'1000');

        //Test limit
        for ($i=1;$i<=2000; $i++) {
            $item = new IndexItem();
            $item->setLoc('http://www.example.com/sitemap.'.$i.'.xml');
            $this->sitemap->add($item);
        }
        $files = $this->sitemap->build();

        $this->assertArrayHasKey('0',$files);
        $this->assertArrayHasKey('1',$files);
    }
}
