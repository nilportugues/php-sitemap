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

}