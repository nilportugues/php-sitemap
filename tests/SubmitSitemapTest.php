<?php
/**
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 * Date: 12/21/14
 * Time: 8:27 PM
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\NilPortugues\Sitemap;

use NilPortugues\Sitemap\SubmitSitemap;

/**
 * Class SubmitSitemapTest
 * @package Tests\NilPortugues\Sitemap
 */
class SubmitSitemapTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var string
     */
    protected $url = 'http://elmundo.feedsportal.com/elmundo/rss/portada.xml';

    /**
     * @var string
     */
    protected $exception = 'NilPortugues\Sitemap\SitemapException';

    /**
     * @test
     */
    public function itShouldSubmitValidSitemapUrl()
    {
        $result = SubmitSitemap::send($this->url);
        $expected = ['google' => true, 'bing' => true];

        $this->assertNotEmpty($result);
        $this->assertEquals($expected, $result);
    }

    /**
     * @test
     */
    public function itShouldSubmitValidSitemapNonValidUrl()
    {
        $this->setExpectedException($this->exception);
        SubmitSitemap::send('not a valid url');
    }
}
