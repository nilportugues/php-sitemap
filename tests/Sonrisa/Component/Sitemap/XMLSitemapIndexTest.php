<?php
/*
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class XMLSitemapIndexTest extends \PHPUnit_Framework_TestCase
{
    protected $sitemap;

    public function setUp()
    {
        date_default_timezone_set('Europe/Madrid');
        $this->sitemap = new \Sonrisa\Component\Sitemap\XMLSitemapIndex();
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
        $this->sitemap->addSitemap('http://www.example.com/sitemap.xml','2005-05-10T17:33:30+08:00');
        $this->sitemap->addSitemap('http://www.example.com/sitemap.media.xml','2005-05-10T17:33:30+08:00');
        $files = $this->sitemap->build()->get();

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
        $this->sitemap->addSitemap('http://www.example.com/sitemap.xml');
        $this->sitemap->addSitemap('http://www.example.com/sitemap.media.xml');
        $files = $this->sitemap->build()->get();

        $this->assertEquals($expected,$files[0]);
    }

    public function testAddUrlWithValidUrlWithInvalidLoc()
    {
        $expected=<<<XML
<?xml version="1.0" encoding="UTF-8"?>
<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
</sitemapindex>
XML;
        $this->sitemap->addSitemap('no/a/real/path/www.example.com/sitemap.xml');
        $this->sitemap->addSitemap('no/a/real/path/sitemap.media.xml');
        $files = $this->sitemap->build()->get();

        $this->assertEquals($expected,$files[0]);
    }

    public function testAddUrlWithValidUrlWithInvalidDate()
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
        $this->sitemap->addSitemap('http://www.example.com/sitemap.xml','AAAAAAA');
        $this->sitemap->addSitemap('http://www.example.com/sitemap.media.xml','AAAAAAA');
        $files = $this->sitemap->build()->get();

        $this->assertEquals($expected,$files[0]);
    }

    public function testAddUrlWithValidUrlWithInvalidDateFormat()
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
        $this->sitemap->addSitemap('http://www.example.com/sitemap.xml','2005-05-10T17:33:30+08:00','AAAAAAA');
        $this->sitemap->addSitemap('http://www.example.com/sitemap.media.xml','2005-05-10T17:33:30+08:00','AAAAAAA');
        $files = $this->sitemap->build()->get();

        $this->assertEquals($expected,$files[0]);
    }


    public function testAddUrlAbovetheSitemapMaxSitemapElementLimit()
    {
        //For testing purposes reduce the real limit to 1000 instead of 50000
        $reflectionClass = new \ReflectionClass('Sonrisa\\Component\\Sitemap\\XMLSitemapIndex');
        $property = $reflectionClass->getProperty('max_items_per_sitemap');
        $property->setAccessible(true);
        $property->setValue($this->sitemap,'1000');

        //Test limit
        for ($i=1;$i<=2000; $i++)
        {
            $this->sitemap->addSitemap('http://www.example.com/sitemap-'.$i.'.xml');
        }
        $files = $this->sitemap->build()->get();

        $this->assertArrayHasKey('0',$files);
        $this->assertArrayHasKey('1',$files);
    }
}