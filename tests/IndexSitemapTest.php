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

use NilPortugues\Sitemap\Item\Index\IndexItem;
use NilPortugues\Sitemap\IndexSitemap;

/**
 * Class IndexSitemapTest
 */
class IndexSitemapTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var IndexSitemap
     */
    protected $siteMap;

    /**
     * @var string
     */
    protected $exception = 'NilPortugues\Sitemap\SitemapException';

    /**
     * @test
     */
    public function itShouldThrowExceptionIfItemIsNotOfIndexItem()
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
            $item = new IndexItem('http://www.example.com/'.$i);
            $this->siteMap->add($item);
        }
        $this->siteMap->build();

        $this->assertFileExists('sitemaptest.xml');
        $sitemap = file_get_contents('sitemaptest.xml');

        $this->assertContains('http://www.example.com/0', $sitemap);
        $this->assertContains('http://www.example.com/19', $sitemap);
        $this->assertContains(
            '<?xml version="1.0" encoding="UTF-8"?>' . "\n" .
            '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n",
            $sitemap
        );
        $this->assertContains('</sitemapindex>', $sitemap);
    }

    /**
     *
     */
    protected function setUp()
    {
        $this->tearDown();
        $this->siteMap = new IndexSitemap('.', 'sitemaptest.xml', false);
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
