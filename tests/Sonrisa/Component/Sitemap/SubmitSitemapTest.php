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
class SubmitSitemap extends \PHPUnit_Framework_TestCase
{
    /**
     * @var string
     */
    protected $url;

    /**
     * @var object
     */
    private $provider;

    /**
     *
     */
    public function setUp()
    {
        date_default_timezone_set('Europe/Madrid');
        $this->url = 'http://elmundo.feedsportal.com/elmundo/rss/portada.xml';
    }


    /**
     *
     */
    public function testSubmitValidSitemapUrl()
    {
        $result = \Sonrisa\Component\Sitemap\SubmitSitemap::send($this->url);

        $expected = array( 'google' => true, 'bing' => true);

        $this->assertNotEmpty($result);
        $this->assertEquals($expected,$result);
    }

    /**
     *
     */
    public function testSubmitValidSitemapNonExisitingUrl()
    {
        $this->setExpectedException("\\Sonrisa\\Component\\Sitemap\\Exceptions\\SitemapException");
        \Sonrisa\Component\Sitemap\SubmitSitemap::send('http://example.com/sitemap/'.rand(1,10000).'.xml');
    }

    /**
     *
     */
    public function testSubmitValidSitemapNonValidUrl()
    {
        $this->setExpectedException("\\Sonrisa\\Component\\Sitemap\\Exceptions\\SitemapException");
        \Sonrisa\Component\Sitemap\SubmitSitemap::send('not a valid url');
    }

}
