<?php
/*
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Sonrisa\Component\Sitemap\Items\NewsItem;
use Sonrisa\Component\Sitemap\NewsSitemap;

/**
 * Class NewsSitemapTest
 */
class NewsSitemapTest extends \PHPUnit_Framework_TestCase
{
    protected $sitemap;

    public function setUp()
    {
        date_default_timezone_set('Europe/Madrid');
        $this->sitemap = new NewsSitemap();
    }

    public function testAllMandatoryValidFieldsOnly()
    {
        $expected = <<<EOF
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:news="http://www.google.com/schemas/sitemap-news/0.9">
\t<url>
\t\t<loc>http://www.example.org/business/article55.html</loc>
\t\t<news:news>
\t\t\t<news:publication>
\t\t\t\t<news:name>The Example Times</news:name>
\t\t\t\t<news:language>en</news:language>
\t\t\t</news:publication>
\t\t\t<news:publication_date>2008-12-23</news:publication_date>
\t\t\t<news:title>Companies A, B in Merger Talks</news:title>
\t\t</news:news>
\t</url>
</urlset>
EOF;

        $item = new NewsItem();
        $item->setLoc('http://www.example.org/business/article55.html');
        $item->setTitle('Companies A, B in Merger Talks');
        $item->setPublicationDate('2008-12-23');
        $item->setPublicationName('The Example Times');
        $item->setPublicationLanguage('en');
        $this->sitemap->add($item);

        $files = $this->sitemap->build();

        $this->assertEquals($expected, $files[0]);
    }

    public function testAllValidFields()
    {
        $expected = <<<EOF
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:news="http://www.google.com/schemas/sitemap-news/0.9">
\t<url>
\t\t<loc>http://www.example.org/business/article55.html</loc>
\t\t<news:news>
\t\t\t<news:publication>
\t\t\t\t<news:name>The Example Times</news:name>
\t\t\t\t<news:language>en</news:language>
\t\t\t</news:publication>
\t\t\t<news:access>Subscription</news:access>
\t\t\t<news:genres>PressRelease, Blog</news:genres>
\t\t\t<news:publication_date>2008-12-23</news:publication_date>
\t\t\t<news:title>Companies A, B in Merger Talks</news:title>
\t\t\t<news:keywords>business, merger, acquisition, A, B</news:keywords>
\t\t\t<news:stock_tickers>NASDAQ:A, NASDAQ:B</news:stock_tickers>
\t\t</news:news>
\t</url>
</urlset>
EOF;

        $item = new NewsItem();
        $item->setLoc('http://www.example.org/business/article55.html');
        $item->setTitle('Companies A, B in Merger Talks');
        $item->setPublicationDate('2008-12-23');
        $item->setPublicationName('The Example Times');
        $item->setPublicationLanguage('en');
        $item->setAccess('Subscription');
        $item->setKeywords('business, merger, acquisition, A, B');
        $item->setStockTickers('NASDAQ:A, NASDAQ:B');
        $item->setGenres('PressRelease, Blog');
        $this->sitemap->add($item);

        $files = $this->sitemap->build();

        $this->assertEquals($expected, $files[0]);
    }

    public function testAddUrlAbovetheSitemapMaxUrlElementLimit()
    {
        //For testing purposes reduce the real limit to 1000 instead of 50000
        $reflectionClass = new \ReflectionClass('Sonrisa\\Component\\Sitemap\\NewsSitemap');
        $property = $reflectionClass->getProperty('maxItemsPerSitemap');
        $property->setAccessible(true);
        $property->setValue($this->sitemap, '1000');

        //Test limit
        for ($i = 1; $i <= 2000; $i++) {

            $item = new NewsItem();
            $item->setLoc('http://www.example.org/business/article-' . $i . '.html');
            $item->setTitle('Title ' . $i);
            $item->setPublicationDate('2008-12-23');
            $item->setPublicationName('The Example Times');
            $item->setPublicationLanguage('en');

            $this->sitemap->add($item);

        }

        $files = $this->sitemap->build();

        $this->assertArrayHasKey('0', $files);
        $this->assertArrayHasKey('1', $files);
    }

}
