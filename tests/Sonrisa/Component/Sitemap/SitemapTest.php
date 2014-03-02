<?php
/*
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use \Sonrisa\Component\Sitemap\Items\UrlItem;

/**
 * Class SitemapTest
 */
class SitemapTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var array
     */
    protected $files = array();

    /**
     * @var \Sonrisa\Component\Sitemap\Sitemap
     */
    protected $sitemap;

    public function setUp()
    {
        date_default_timezone_set('Europe/Madrid');
        $this->sitemap = new \Sonrisa\Component\Sitemap\Sitemap();
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
        $item = new UrlItem();
        $item->setLoc('http://www.example.com/');
        $item->setPriority('0.8');
        $item->setChangeFreq('monthly');
        $item->setLastMod('2005-05-10T17:33:30+08:00');
        $this->sitemap->add($item);

        $files = $this->sitemap->build();

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

        $item = new UrlItem();
        $item->setLoc('http://www.example.com/');
        $item->setPriority('0.8');
        $item->setChangeFreq('monthly');
        $item->setLastMod('2005-05-10T17:33:30+08:00');
        $this->sitemap->add($item);

        $item = new UrlItem();
        $item->setLoc('http://www.example.com/');
        $item->setPriority('0.8');
        $item->setChangeFreq('monthly');
        $item->setLastMod('2005-05-10T17:33:30+08:00');
        $this->sitemap->add($item);

        $files = $this->sitemap->build();

        $this->assertEquals($expected,$files[0]);

    }


    public function testAddUrlWithInvalidUrlThrowsException()
    {
        $this->setExpectedException("Sonrisa\\Component\\Sitemap\\Exceptions\\SitemapException");

        $item = new UrlItem();
        $item->setLoc('not/valid/url');
        $item->setPriority('0.8');
        $item->setChangeFreq('monthly');
        $item->setLastMod('2005-05-10T17:33:30+08:00');

        $this->sitemap->add($item);

    }

    public function testAddUrlWithValidUrlWithLastModAndWithDefaultPriority()
    {
        $expected=<<<XML
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
\t<url>
\t\t<loc>http://www.example.com/</loc>
\t\t<lastmod>2005-05-10T17:33:30+08:00</lastmod>
\t</url>
</urlset>
XML;
        $item = new UrlItem();
        $item->setLoc('http://www.example.com/');
        $item->setLastMod('2005-05-10T17:33:30+08:00');
        $this->sitemap->add($item);

        $files = $this->sitemap->build();

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
\t</url>
</urlset>
XML;
        $item = new UrlItem();
        $item->setLoc('http://www.example.com/');
        $item->setChangeFreq('always');
        $this->sitemap->add($item);

        $files = $this->sitemap->build();

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
\t</url>
</urlset>
XML;
        $item = new UrlItem();
        $item->setLoc('http://www.example.com/');
        $item->setChangeFreq('hourly');
        $this->sitemap->add($item);

        $files = $this->sitemap->build();

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
\t</url>
</urlset>
XML;
        $item = new UrlItem();
        $item->setLoc('http://www.example.com/');
        $item->setChangeFreq('daily');
        $this->sitemap->add($item);

        $files = $this->sitemap->build();

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
\t</url>
</urlset>
XML;

        $item = new UrlItem();
        $item->setLoc('http://www.example.com/');
        $item->setChangeFreq('weekly');
        $this->sitemap->add($item);

        $files = $this->sitemap->build();

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
\t</url>
</urlset>
XML;
        $item = new UrlItem();
        $item->setLoc('http://www.example.com/');
        $item->setChangeFreq('monthly');
        $this->sitemap->add($item);

        $files = $this->sitemap->build();

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
\t</url>
</urlset>
XML;
        $item = new UrlItem();
        $item->setLoc('http://www.example.com/');
        $item->setChangeFreq('yearly');
        $this->sitemap->add($item);

        $files = $this->sitemap->build();

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
\t</url>
</urlset>
XML;
        $item = new UrlItem();
        $item->setLoc('http://www.example.com/');
        $item->setChangeFreq('never');
        $this->sitemap->add($item);

        $files = $this->sitemap->build();

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
        $item = new UrlItem();
        $item->setLoc('http://www.example.com/');
        $item->setPriority('0.8');
        $this->sitemap->add($item);

        $files = $this->sitemap->build();

        $this->assertEquals($expected,$files[0]);
    }

    public function testAddUrlWithValidUrlWithInvalidLastModValue()
    {
        $this->setExpectedException("Sonrisa\\Component\\Sitemap\\Exceptions\\SitemapException");

        $item = new UrlItem();
        $item->setLoc('http://www.example.com/');
        $item->setPriority('0.8');
        $item->setChangeFreq('monthly');
        $item->setLastMod('AAAA');
        $this->sitemap->add($item);

        $this->sitemap->build();
    }

    public function testAddUrlWithValidUrlWithInvalidChangeFreq()
    {
        $this->setExpectedException("Sonrisa\\Component\\Sitemap\\Exceptions\\SitemapException");

        $item = new UrlItem();
        $item->setLoc('http://www.example.com/');
        $item->setPriority('0.8');
        $item->setChangeFreq('AAAAA');
        $item->setLastMod('2005-05-10T17:33:30+08:00');
        $this->sitemap->add($item);

        $this->sitemap->build();
    }

    public function testAddUrlWithValidUrlWithInvalidPriority1()
    {
        $this->setExpectedException("Sonrisa\\Component\\Sitemap\\Exceptions\\SitemapException");

        $item = new UrlItem();
        $item->setLoc('http://www.example.com/');
        $item->setPriority('6');
        $this->sitemap->add($item);

        $this->sitemap->build();
    }

    public function testAddUrlWithValidUrlWithInvalidPriority2()
    {
        $this->setExpectedException("Sonrisa\\Component\\Sitemap\\Exceptions\\SitemapException");

        $item = new UrlItem();
        $item->setLoc('http://www.example.com/');
        $item->setPriority('AAAAAAAA');
        $this->sitemap->add($item);

        $this->sitemap->build();
    }

    public function testAddUrlWithValidUrlWithInvalidPriority3()
    {
        $this->setExpectedException("Sonrisa\\Component\\Sitemap\\Exceptions\\SitemapException");

        $item = new UrlItem();
        $item->setLoc('http://www.example.com/');
        $item->setPriority('0.88');
        $this->sitemap->add($item);

        $this->sitemap->build();
    }

    public function testAddUrlWithValidUrlWithInvalidPriority4()
    {
        $this->setExpectedException("Sonrisa\\Component\\Sitemap\\Exceptions\\SitemapException");

        $item = new UrlItem();
        $item->setLoc('http://www.example.com/');
        $item->setPriority('1.88');
        $this->sitemap->add($item);

        $this->sitemap->build();
    }

    public function testAddUrlWithValidUrlWithInvalidPriority5()
    {
        $this->setExpectedException("Sonrisa\\Component\\Sitemap\\Exceptions\\SitemapException");

        $item = new UrlItem();
        $item->setLoc('http://www.example.com/');
        $item->setPriority(-3.14);
        $this->sitemap->add($item);

        $this->sitemap->build();
    }


    public function testAddUrlWithValidUrlAndInvalidChangeFreq()
    {
        $this->setExpectedException("Sonrisa\\Component\\Sitemap\\Exceptions\\SitemapException");

        $item = new UrlItem();
        $item->setLoc('http://www.example.com/');
        $item->setChangeFreq('AAAAA');
        $this->sitemap->add($item);

        $this->sitemap->build();
    }


    public function testAddUrlWithValidUrlAndInvalidLastmMod()
    {
        $this->setExpectedException("Sonrisa\\Component\\Sitemap\\Exceptions\\SitemapException");

        $item = new UrlItem();
        $item->setLoc('http://www.example.com/');
        $item->setLastMod('AAAAA');
        $this->sitemap->add($item);

        $this->sitemap->build();
    }


    public function testAddUrlAbovetheSitemapMaxUrlElementLimit()
    {
        //For testing purposes reduce the real limit to 1000 instead of 50000
        $reflectionClass = new \ReflectionClass('Sonrisa\\Component\\Sitemap\\Sitemap');
        $property = $reflectionClass->getProperty('max_items_per_sitemap');
        $property->setAccessible(true);
        $property->setValue($this->sitemap,'1000');

        //Test limit
        for ($i=1;$i<=2000; $i++)
        {
            $item = new UrlItem();
            $item->setLoc('http://www.example.com/page-'.$i.'.html');
            $this->sitemap->add($item);
        }

        $files = $this->sitemap->build();

        $this->assertArrayHasKey('0',$files);
        $this->assertArrayHasKey('1',$files);

        $this->sitemap->build();

    }

    public function testwriteWithoutBuild()
    {
        $item = new UrlItem();
        $item->setLoc('http://www.example.com/');
        $item->setPriority('0.8');
        $item->setChangeFreq('monthly');
        $item->setLastMod('2005-05-10T17:33:30+08:00');
        $this->sitemap->add($item);


        $this->setExpectedException('\\Sonrisa\\Component\\Sitemap\\Exceptions\\SitemapException');
        $this->sitemap->write('./','sitemap.xml',false);
    }

    public function testWritePlainFile()
    {
        $item = new UrlItem();
        $item->setLoc('http://www.example.com/');
        $item->setPriority('0.8');
        $item->setChangeFreq('monthly');
        $item->setLastMod('2005-05-10T17:33:30+08:00');
        $this->sitemap->add($item);


        $this->sitemap->build();
        $this->sitemap->write('./','sitemap.xml',false);
        $this->assertFileExists('sitemap.xml');
    }

    public function testWritePlainFileThrowException()
    {
        $item = new UrlItem();
        $item->setLoc('http://www.example.com/');
        $item->setPriority('0.8');
        $item->setChangeFreq('monthly');
        $item->setLastMod('2005-05-10T17:33:30+08:00');
        $this->sitemap->add($item);


        $this->sitemap->build();

        $this->setExpectedException('\\Sonrisa\\Component\\Sitemap\\Exceptions\\SitemapException');
        $this->sitemap->write('./fake/path','sitemap.xml',false);
    }

    public function testWriteGZipFile()
    {
        $item = new UrlItem();
        $item->setLoc('http://www.example.com/');
        $item->setPriority('0.8');
        $item->setChangeFreq('monthly');
        $item->setLastMod('2005-05-10T17:33:30+08:00');
        $this->sitemap->add($item);


        $this->sitemap->build();
        $this->sitemap->write('./','sitemap.xml',true);
        $this->assertFileExists('sitemap.xml.gz');
    }

    public function testWriteGZipFileThrowException()
    {
        $item = new UrlItem();
        $item->setLoc('http://www.example.com/');
        $item->setPriority('0.8');
        $item->setChangeFreq('monthly');
        $item->setLastMod('2005-05-10T17:33:30+08:00');
        $this->sitemap->add($item);

        $this->sitemap->build();

        $this->setExpectedException('\\Sonrisa\\Component\\Sitemap\\Exceptions\\SitemapException');
        $this->sitemap->write('./fake/path','sitemap.xml',true);
    }
}
