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

use NilPortugues\Sitemap\Item\Media\MediaItem;
use NilPortugues\Sitemap\MediaSitemap;

/**
 * Class MediaSitemapTest
 */
class MediaSitemapTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var MediaSitemap
     */
    protected $siteMap;

    /**
     * @var string
     */
    protected $exception = 'NilPortugues\Sitemap\SitemapException';

    /**
     * @test
     */
    public function itShouldThrowExceptionIfItemIsNotOfMediaItem()
    {
        $this->setExpectedException($this->exception);
        $item = 'not a valid item';
        $this->siteMap->add($item);
    }

    /**
     * @test
     */
    public function itShouldThrowExceptionSitemapChannelDescriptionIsNotValid()
    {
        $this->setExpectedException($this->exception);
        $this->siteMap->setDescription('');
    }

    /**
     * @test
     */
    public function itShouldThrowExceptionSitemapChannelTitleIsNotValid()
    {
        $this->setExpectedException($this->exception);
        $this->siteMap->setTitle('');
    }

    /**
     * @test
     */
    public function itShouldThrowExceptionSitemapChannelLinkIsNotValid()
    {
        $this->setExpectedException($this->exception);
        $this->siteMap->setLink('');
    }

    /**
     * @test
     */
    public function itShouldCreateOneSiteMapFile()
    {
        $this->siteMap->setDescription('This is a description');
        $this->siteMap->setTitle('This is a title');
        $this->siteMap->setLink('http://example.com/channel');

        for ($i = 0; $i < 20; $i++) {
            $item = new MediaItem('http://www.example.com/'.$i);
            $this->siteMap->add($item);
        }
        $this->siteMap->build();

        $this->assertFileExists('sitemaptest.xml');
        $sitemap = file_get_contents('sitemaptest.xml');

        $this->assertContains('<description>This is a description</description>', $sitemap);
        $this->assertContains('<title>This is a title</title>', $sitemap);
        $this->assertContains('<link>http://example.com/channel</link>', $sitemap);
        $this->assertContains('http://www.example.com/0', $sitemap);
        $this->assertContains('http://www.example.com/19', $sitemap);
        $this->assertContains(
            '<?xml version="1.0" encoding="UTF-8"?>' . "\n" .
            '<rss version="2.0" xmlns:media="http://search.yahoo.com/mrss/" xmlns:dcterms="http://purl.org/dc/terms/">'
            . "\n" . '<channel>',
            $sitemap
        );
        $this->assertContains('</channel>', $sitemap);
        $this->assertContains('</rss>', $sitemap);
    }

    /**
     *
     */
    protected function setUp()
    {
        $this->tearDown();
        $this->siteMap = new MediaSitemap('.', 'sitemaptest.xml', false);
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
