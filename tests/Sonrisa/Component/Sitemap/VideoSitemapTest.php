<?php
/*
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Class VideoSitemapTest
 */
class VideoSitemapTest extends \PHPUnit_Framework_TestCase
{
    protected $sitemap;

    public function setUp()
    {
        date_default_timezone_set('Europe/Madrid');
        $this->sitemap = new \Sonrisa\Component\Sitemap\VideoSitemap();
    }

    public function testAddVideoWithAllFields()
    {
        $expected=<<<XML
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-video/1.1">
\t<url>
\t\t<loc>http://www.example.com/</loc>
\t\t<video:video>


\t\t</video:video>
\t</url>
</urlset>
XML;
        $data = array
        (
            'thumbnail_loc'         => '',
            'title'                 => '',
            'description'           => '',
            'content_loc'           => '',
            'player_loc'            => '',
            'duration'              => '',
            'expiration_date'       => $expiration_date,
            'rating'                => '',
            'view_count'            => '',
            'publication_date'      => $publication_date,
            'family_friendly'       => '',
            'restriction'           => '',
            'restriction_access'    => '',
            'gallery_loc'           => '',
            'requires_subscription' => '',
            'uploader'              => '',
            'uploader_loc'          => '',
            'platform'              => '',
            'platform_access'       => '',
            'live'                  => '',

            //are arrays
            'tag'                   => array(),
            'price'                 => array(),
        );


        $this->sitemap->add('http://www.example.com/',$data);
        $files = $this->sitemap->build()->get();


        $this->assertEquals($expected,$files[0]);
    }
}
