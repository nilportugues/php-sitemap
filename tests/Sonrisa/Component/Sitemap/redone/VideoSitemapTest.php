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
        $this->sitemap = new \Sonrisa\Component\Sitemap\VideoSitemap();
    }

    public function testAddVideoWithAllFields()
    {
        $expected=<<<XML
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:video="http://www.google.com/schemas/sitemap-video/1.1">
\t<url>
\t\t<loc>http://www.example.com/</loc>
\t\t<video:video>
\t\t\t<video:thumbnail_loc><![CDATA[http://www.example.com/thumbs/123.jpg]]></video:thumbnail_loc>
\t\t\t<video:title><![CDATA[Grilling steaks for summer]]></video:title>
\t\t\t<video:description><![CDATA[Alkis shows you how to get perfectly done steaks everytime]]></video:description>
\t\t\t<video:content_loc><![CDATA[http://www.example.com/video123.flv]]></video:content_loc>
\t\t\t<video:duration><![CDATA[600]]></video:duration>
\t\t\t<video:expiration_date><![CDATA[2009-11-05T19:20:30+08:00]]></video:expiration_date>
\t\t\t<video:publication_date><![CDATA[2007-11-05T19:20:30+08:00]]></video:publication_date>
\t\t\t<video:restriction relationship="allow">IE GB US CA</video:restriction>
\t\t\t<video:gallery_loc title="Cooking Videos">http://cooking.example.com</video:gallery_loc>
\t\t\t<video:price currency="EUR" type="rent" resolution="HD" >0.99</video:price>
\t\t\t<video:price currency="EUR" type="rent" resolution="SD" >0.75</video:price>
\t\t\t<video:tag>action</video:tag>
\t\t\t<video:tag>drama</video:tag>
\t\t\t<video:tag>entrepreneur</video:tag>
\t\t\t<video:requires_subscription><![CDATA[yes]]></video:requires_subscription>
\t\t\t<video:uploader>GrillyMcGrillerson</video:uploader>
\t\t\t<video:platform relationship="allow">web mobile tv</video:platform>
\t\t\t<video:live><![CDATA[no]]></video:live>
\t\t</video:video>
\t</url>
</urlset>
XML;
        $data = array
        (
            'thumbnail_loc'             => 'http://www.example.com/thumbs/123.jpg',
            'title'                     => 'Grilling steaks for summer',
            'description'               => 'Alkis shows you how to get perfectly done steaks everytime',
            'content_loc'               => 'http://www.example.com/video123.flv',
            'player_loc'                => 'http://www.example.com/videoplayer.swf?video=123',
            'allow_embed'               => 'yes',
            'autoplay'                  => 'ap=1',
            'duration'                  => '600',
            'expiration_date'           => '2009-11-05T19:20:30+08:00',
            'rating'                    => '4.2',
            'view_count'                => '12345',
            'publication_date'          => '2007-11-05T19:20:30+08:00',
            'family_friendly'           => 'yes',
            'restriction'               => 'IE GB US CA',
            'restriction_relationship'  => 'allow',
            'gallery_loc'               => 'http://cooking.example.com',
            'gallery_loc_title'         => 'Cooking Videos',
            'price' => array
            (
                array
                (
                    'price'             => '0.99',
                    'price_currency'    => 'EUR',
                    'resolution'        => 'HD',
                    'type'              => 'rent',
                ),
                array
                (
                    'price'             => '0.75',
                    'price_currency'    => 'EUR',
                    'resolution'        => 'SD',
                    'type'              => 'rent',
                ),

            ),
            'category'                  => 'cooking',
            'tag'                       => array('action','drama','entrepreneur'),
            'requires_subscription'     => 'yes',
            'uploader'                  => 'GrillyMcGrillerson',
            'uploader_info'             => 'http://www.example.com/users/grillymcgrillerson',
            'platform'                  => 'web mobile tv',
            'platform_relationship'     => 'allow',
            'live'                      => 'no',
        );


        $this->sitemap->add($data,'http://www.example.com/');
        $files = $this->sitemap->build();
        $this->assertEquals($expected,$files[0]);

    }
}
