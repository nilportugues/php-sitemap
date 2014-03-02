<?php
/*
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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
        $this->sitemap->add(array( 'loc' => 'http://www.example.com/', 'priority' => '0.8', 'changefreq' => 'monthly','lastmod' =>'2005-05-10T17:33:30+08:00'));
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

        $this->sitemap->add(array( 'loc' => 'http://www.example.com/', 'priority' => '0.8', 'changefreq' => 'monthly','lastmod' =>'2005-05-10T17:33:30+08:00'));
        $this->sitemap->add(array( 'loc' => 'http://www.example.com/', 'priority' => '0.8', 'changefreq' => 'monthly','lastmod' =>'2005-05-10T17:33:30+08:00'));

        $files = $this->sitemap->build();

        $this->assertEquals($expected,$files[0]);

    }


    public function testAddUrlWithInvalidUrlWontGetAdded()
    {
        $this->sitemap->add(array( 'loc' => 'not/valid/url', 'priority' => '0.8', 'changefreq' => 'monthly','lastmod' =>'2005-05-10T17:33:30+08:00'));
        $files = $this->sitemap->build();

        $this->assertEmpty($files);

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
        $this->sitemap->add(array( 'loc' => 'http://www.example.com/', 'lastmod' =>'2005-05-10T17:33:30+08:00'));
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

        $this->sitemap->add(array('loc' => 'http://www.example.com/', 'changefreq' => 'always'));
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

        $this->sitemap->add(array('loc' => 'http://www.example.com/', 'changefreq' => 'hourly'));
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

        $this->sitemap->add(array('loc' => 'http://www.example.com/','changefreq' => 'daily'));
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

        $this->sitemap->add(array('loc' => 'http://www.example.com/','changefreq' => 'weekly'));
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

        $this->sitemap->add(array('loc' => 'http://www.example.com/','changefreq' => 'monthly'));
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

        $this->sitemap->add(array('loc' => 'http://www.example.com/','changefreq' => 'yearly'));
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

        $this->sitemap->add(array('loc' => 'http://www.example.com/','changefreq' => 'never'));
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

        $this->sitemap->add(array('loc' => 'http://www.example.com/', 'priority' => '0.8'));
        $files = $this->sitemap->build();

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

        $this->sitemap->add(array('loc' => 'http://www.example.com/','priority'=>'0.8', 'changefreq' => 'monthly','lastmod' => 'AAAAA'));
        $files = $this->sitemap->build();

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

        $this->sitemap->add(array('loc' => 'http://www.example.com/','priority'=>'0.8','changefreq' => 'AAAAA','lastmod' => '2005-05-10T17:33:30+08:00'));
        $files = $this->sitemap->build();

        $this->assertEquals($expected,$files[0]);
    }

    public function testAddUrlWithValidUrlWithInvalidPriority1()
    {
        $expected=<<<XML
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
\t<url>
\t\t<loc>http://www.example.com/</loc>
\t</url>
</urlset>
XML;
        $this->sitemap->add(array('loc' => 'http://www.example.com/','priority' => '6'));
        $files = $this->sitemap->build();

        $this->assertEquals($expected,$files[0]);
    }

    public function testAddUrlWithValidUrlWithInvalidPriority2()
    {
        $expected=<<<XML
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
\t<url>
\t\t<loc>http://www.example.com/</loc>
\t</url>
</urlset>
XML;

        $this->sitemap->add(array('loc' => 'http://www.example.com/','priority' => 'AAAAA'));
        $files = $this->sitemap->build();

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

        $this->sitemap->add(array('loc' => 'http://www.example.com/','priority' => '0.88'));
        $files = $this->sitemap->build();

        $this->assertEquals($expected,$files[0]);
    }

    public function testAddUrlWithValidUrlWithInvalidPriority4()
    {
        $expected=<<<XML
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
\t<url>
\t\t<loc>http://www.example.com/</loc>
\t</url>
</urlset>
XML;

        $this->sitemap->add(array('loc' => 'http://www.example.com/','priority' => '1.88'));
        $files = $this->sitemap->build();

        $this->assertEquals($expected,$files[0]);
    }

    public function testAddUrlWithValidUrlWithInvalidPriority5()
    {
        $expected=<<<XML
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
\t<url>
\t\t<loc>http://www.example.com/</loc>
\t</url>
</urlset>
XML;

        $this->sitemap->add(array('loc' => 'http://www.example.com/','priority' => -3.14));
        $files = $this->sitemap->build();

        $this->assertEquals($expected,$files[0]);
    }

    public function testAddUrlWithValidUrlWithAllFieldsInvalid()
    {
$expected=<<<XML
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
\t<url>
\t\t<loc>http://www.example.com/</loc>
\t</url>
</urlset>
XML;
        $this->sitemap->add(array('loc' => 'http://www.example.com/','priority' => 'AAAAAA', 'changefreq' => 'AAAAA', 'lastmod' => 'AAAAAA'));
        $files = $this->sitemap->build();

        $this->assertEquals($expected,$files[0]);
    }

    public function testAddUrlAbovetheSitemapMaxUrlElementLimit()
    {
        //For testing purposes reduce the real limit to 1000 instead of 50000
        $reflectionClass = new \ReflectionClass('Sonrisa\\Component\\Sitemap\\Sitemap');
        $property = $reflectionClass->getProperty('max_items_per_sitemap');
        $property->setAccessible(true);
        $property->setValue($this->sitemap,'1000');

        //Test limit
        for ($i=1;$i<=2000; $i++) {
            $this->sitemap->add(array('loc' => 'http://www.example.com/page-'.$i.'.html'));
        }
        $files = $this->sitemap->build();

        $this->assertArrayHasKey('0',$files);
        $this->assertArrayHasKey('1',$files);

        $this->sitemap->build();

    }

    public function testwriteWithoutBuild()
    {
        $this->sitemap->add(array( 'loc' => 'http://www.example.com/', 'priority' => '0.8', 'changefreq' => 'monthly','lastmod' =>'2005-05-10T17:33:30+08:00'));

        $this->setExpectedException('\\Sonrisa\\Component\\Sitemap\\Exceptions\\SitemapException');
        $this->sitemap->write('./','sitemap.xml',false);
    }

    public function testWritePlainFile()
    {
        $this->sitemap->add(array( 'loc' => 'http://www.example.com/', 'priority' => '0.8', 'changefreq' => 'monthly','lastmod' =>'2005-05-10T17:33:30+08:00'));

        $this->sitemap->build();
        $this->sitemap->write('./','sitemap.xml',false);
        $this->assertFileExists('sitemap.xml');
    }

    public function testWritePlainFileThrowException()
    {
        $this->sitemap->add(array( 'loc' => 'http://www.example.com/', 'priority' => '0.8', 'changefreq' => 'monthly','lastmod' =>'2005-05-10T17:33:30+08:00'));

        $this->sitemap->build();

        $this->setExpectedException('\\Sonrisa\\Component\\Sitemap\\Exceptions\\SitemapException');
        $this->sitemap->write('./fake/path','sitemap.xml',false);
    }

    public function testWriteGZipFile()
    {
        $this->sitemap->add(array( 'loc' => 'http://www.example.com/', 'priority' => '0.8', 'changefreq' => 'monthly','lastmod' =>'2005-05-10T17:33:30+08:00'));

        $this->sitemap->build();
        $this->sitemap->write('./','sitemap.xml',true);
        $this->assertFileExists('sitemap.xml.gz');
    }

    public function testWriteGZipFileThrowException()
    {
        $this->sitemap->add(array( 'loc' => 'http://www.example.com/', 'priority' => '0.8', 'changefreq' => 'monthly','lastmod' =>'2005-05-10T17:33:30+08:00'));

        $this->sitemap->build();

        $this->setExpectedException('\\Sonrisa\\Component\\Sitemap\\Exceptions\\SitemapException');
        $this->sitemap->write('./fake/path','sitemap.xml',true);
    }
}
