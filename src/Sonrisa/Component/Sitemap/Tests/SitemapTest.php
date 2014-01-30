<?php
/*
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Sonrisa\Component\Sitemap\Tests;

use \Sonrisa\Component\Sitemap\Sitemap as Sitemap;
use \Sonrisa\Component\Sitemap\Exceptions\SitemapException;

class SitemapTest extends \PHPUnit_Framework_TestCase
{
    protected $url;

    public function setUp()
    {
        $this->url = 'http://elmundo.feedsportal.com/elmundo/rss/portada.xml';
    }

    public function testSubmitValidSitemapUrl()
    {
        $result = Sitemap::submit($this->url);

        $expected = array( 'google' => true, 'bing' => true);

        $this->assertNotEmpty($result);
        $this->assertEquals($expected,$result);
    }

    public function testSubmitValidSitemapNonExisitingUrl()
    {
        $this->setExpectedException("\\Sonrisa\\Component\\Sitemap\\Exceptions\\SitemapException");
        Sitemap::submit('http://example.com/sitemap/'.rand(1,10000).'.xml');
    }


    public function testSubmitValidSitemapNonValidUrl()
    {
        $this->setExpectedException("\\Sonrisa\\Component\\Sitemap\\Exceptions\\SitemapException");
        Sitemap::submit('not a valid url');
    }


}
