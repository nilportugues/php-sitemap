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

use NilPortugues\Sitemap\Sitemap;

/**
 * Class SitemapTest
 */
class SitemapTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Sitemap
     */
    protected $siteMap;

    /**
     *
     */
    protected function setUp()
    {
        $this->siteMap = new Sitemap('.', 'sitemaptest.xml', false);
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


    /**
     * @test
     */
    public function itShouldCreateOneSiteMapFile()
    {
    }

    /**
     * @test
     */
    public function itShouldCreateTwoSiteMapFiles()
    {
    }
}
