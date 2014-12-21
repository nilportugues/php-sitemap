<?php
/**
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 * Date: 12/21/14
 * Time: 12:16 AM
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\NilPortugues\Sitemap;

use NilPortugues\Sitemap\Item\Url\UrlItem;
use NilPortugues\Sitemap\Item\Video\VideoItem;
use NilPortugues\Sitemap\Sitemap;
use NilPortugues\Sitemap\VideoSitemap;

/**
 * Class VideoSitemapTest
 * @package Tests\NilPortugues\Sitemap
 */
class VideoSitemapTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var VideoSitemap
     */
    protected $siteMap;

    /**
     * @var string
     */
    protected $exception = 'NilPortugues\Sitemap\SitemapException';

    /**
     * @test
     */
    public function itShouldThrowExceptionIfItemIsNotOfVideoItem()
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
            $this->addToSiteMap($i);
        }
        $this->siteMap->build();

        $this->assertFileExists('sitemaptest.xml');
        $sitemap = file_get_contents('sitemaptest.xml');

        $this->assertContains('http://www.example.com/gallery-', $sitemap);
        $this->assertContains('http://www.example.com/video0.flv', $sitemap);
        $this->assertContains('http://www.example.com/video19.flv', $sitemap);
        $this->assertContains(
            '<?xml version="1.0" encoding="UTF-8"?>' . "\n"
            . '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"'
            . ' xmlns:video="http://www.google.com/schemas/sitemap-video/1.1">' . "\n",
            $sitemap
        );
        $this->assertContains('</urlset>', $sitemap);
    }

    /**
     * @param $i
     */
    protected function addToSiteMap($i)
    {
        $item = new VideoItem(
            'Video '.$i,
            'http://www.example.com/video'.$i.'.flv',
            'http://www.example.com/videoplayer.swf?video='.$i
        );

        $this->siteMap->add($item, 'http://www.example.com/gallery-1.html');
    }

    /**
     * @test
     */
    public function itShouldCreateTwoSiteMapFiles()
    {
        for ($i = 0; $i < 50020; $i++) {
            $this->addToSiteMap($i);
        }
        $this->siteMap->build();

        $this->assertFileExists('sitemaptest.xml');
        $sitemap1 = file_get_contents('sitemaptest.xml');
        $this->assertContains('http://www.example.com/video0.flv', $sitemap1);
        $this->assertContains('http://www.example.com/video49999.flv', $sitemap1);

        $this->assertFileExists('sitemaptest1.xml');
        $sitemap2 = file_get_contents('sitemaptest1.xml');
        $this->assertContains('http://www.example.com/video50000.flv', $sitemap2);
        $this->assertContains('http://www.example.com/video50019.flv', $sitemap2);
    }

    /**
     *
     */
    protected function setUp()
    {
        $this->tearDown();
        $this->siteMap = new VideoSitemap('.', 'sitemaptest.xml', false);
    }

    /**
     *
     */
    protected function tearDown()
    {
        $fileNames = ['sitemaptest.xml', 'sitemaptest1.xml'];

        foreach ($fileNames as $fileName) {
            if (file_exists($fileName)) {
                unlink($fileName);
            }
        }
    }
}
