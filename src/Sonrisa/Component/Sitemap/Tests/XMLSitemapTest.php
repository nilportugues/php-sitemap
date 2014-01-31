<?php
/*
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Sonrisa\Component\Sitemap\Tests;

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
        $this->sitemap->addUrl('http://www.example.com/','0.8','monthly','2005-05-10T17:33:30+08:00');
        $this->sitemap->addUrl('http://www.example.com/','0.7','weekly','2005-05-10T17:33:30+08:00');
        $this->sitemap->addUrl('http://www.example.com/','0.6','weekly','2005-05-10T17:33:30+08:00');
        $this->sitemap->addUrl('http://www.example.com/','0.5','weekly','2005-05-10T17:33:30+08:00');
        $this->sitemap->addUrl('http://www.example.com/','0.4','daily','2005-05-10T17:33:30+08:00');
        $this->sitemap->addUrl('http://www.example.com/','0.3','never','2005-05-10T17:33:30+08:00');

        $files = $this->sitemap->build();

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
        $files = $this->sitemap->build();

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
\t\t<priority>0.5</priority>
\t</url>
</urlset>
XML;

        $this->sitemap->addUrl('http://www.example.com/','','always');
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
\t\t<priority>0.5</priority>
\t</url>
</urlset>
XML;

        $this->sitemap->addUrl('http://www.example.com/','','hourly');
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
\t\t<priority>0.5</priority>
\t</url>
</urlset>
XML;

        $this->sitemap->addUrl('http://www.example.com/','','daily');
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
\t\t<priority>0.5</priority>
\t</url>
</urlset>
XML;

        $this->sitemap->addUrl('http://www.example.com/','','weekly');
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
\t\t<priority>0.5</priority>
\t</url>
</urlset>
XML;

        $this->sitemap->addUrl('http://www.example.com/','','monthly');
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
\t\t<priority>0.5</priority>
\t</url>
</urlset>
XML;

        $this->sitemap->addUrl('http://www.example.com/','','yearly');
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
\t\t<priority>0.5</priority>
\t</url>
</urlset>
XML;

        $this->sitemap->addUrl('http://www.example.com/','','never');
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

        $this->sitemap->addUrl('http://www.example.com/','0.8');
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

        $this->sitemap->addUrl('http://www.example.com/','0.8','monthly','AAAAA');
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

        $this->sitemap->addUrl('http://www.example.com/','0.8','AAAAA','2005-05-10T17:33:30+08:00');
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
\t\t<priority>0.5</priority>
\t</url>
</urlset>
XML;

        $this->sitemap->addUrl('http://www.example.com/','6');
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
\t\t<priority>0.5</priority>
\t</url>
</urlset>
XML;

        $this->sitemap->addUrl('http://www.example.com/','AAAAA');
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
\t\t<priority>0.5</priority>
\t</url>
</urlset>
XML;
        $this->sitemap->addUrl('http://www.example.com/','AAAAAA','AAAAA','AAAAAA');
        $files = $this->sitemap->build();

        $this->assertEquals($expected,$files[0]);
    }

}
