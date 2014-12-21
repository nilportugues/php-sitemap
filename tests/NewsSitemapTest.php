<?php
/**
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 * Date: 12/21/14
 * Time: 11:39 AM
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\NilPortugues\Sitemap;

use NilPortugues\Sitemap\Item\News\NewsItem;
use NilPortugues\Sitemap\NewsSitemap;

/**
 * Class NewsSitemapTest
 */
class NewsSitemapTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var NewsSitemap
     */
    protected $siteMap;

    /**
     * @var string
     */
    protected $exception = 'NilPortugues\Sitemap\SitemapException';

    /**
     * @test
     */
    public function itShouldThrowExceptionIfItemIsNotOfNewsItem()
    {
        $this->setExpectedException($this->exception);
        $item = 'not a valid item';
        $this->siteMap->add($item);
    }

    /**
     * @test
     */
    public function itShouldCreateOneSiteMapFile()
    {
        for ($i = 0; $i < 20; $i++) {
            $item = new NewsItem(
                'http://www.example.com/'.$i,
                'Companies A, B in Merger Talks',
                '2008-12-23',
                'The Example Times',
                'en'
            );

            $this->siteMap->add($item);
        }
        $this->siteMap->build();

        $this->assertFileExists('sitemaptest.xml');
        $sitemap = file_get_contents('sitemaptest.xml');

        $this->assertContains('http://www.example.com/0', $sitemap);
        $this->assertContains('http://www.example.com/19', $sitemap);
        $this->assertContains(
            '<?xml version="1.0" encoding="UTF-8"?>' . "\n" .
            '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" ' .
            'xmlns:news="http://www.google.com/schemas/sitemap-news/0.9">' . "\n",
            $sitemap
        );
        $this->assertContains('</urlset>', $sitemap);
    }

    /**
     *
     */
    protected function setUp()
    {
        $this->tearDown();
        $this->siteMap = new NewsSitemap('.', 'sitemaptest.xml', false);
    }

    /**
     *
     */
    protected function tearDown()
    {
        $fileNames = ['sitemaptest.xml'];

        foreach ($fileNames as $fileName) {
            if (file_exists($fileName)) {
                unlink($fileName);
            }
        }
    }
}
