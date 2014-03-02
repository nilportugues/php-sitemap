<?php
/*
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
use \Sonrisa\Component\Sitemap\Items\VideoItem;

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
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:video="http://www.google.com/schemas/sitemap-video/1.1">
\t<url>
\t\t<loc>http://www.example.com/</loc>
\t\t<video:video>
\t\t\t<video:thumbnail_loc><![CDATA[http://www.example.com/thumbs/123.jpg]]></video:thumbnail_loc>
\t\t\t<video:title><![CDATA[Grilling steaks for summer]]></video:title>
\t\t\t<video:description><![CDATA[Alkis shows you how to get perfectly done steaks everytime]]></video:description>
\t\t\t<video:content_loc><![CDATA[http://www.example.com/video123.flv]]></video:content_loc>
\t\t\t<video:player_loc allow_embed="yes" autoplay="ap=1">http://www.example.com/videoplayer.swf?video=123</video:player_loc>
\t\t\t<video:duration><![CDATA[600]]></video:duration>
\t\t\t<video:expiration_date><![CDATA[2009-11-05T19:20:30+08:00]]></video:expiration_date>
\t\t\t<video:rating><![CDATA[4.2]]></video:rating>
\t\t\t<video:view_count><![CDATA[12345]]></video:view_count>
\t\t\t<video:publication_date><![CDATA[2007-11-05T19:20:30+08:00]]></video:publication_date>
\t\t\t<video:restriction relationship="allow">IE GB US CA</video:restriction>
\t\t\t<video:gallery_loc title="Cooking Videos">http://cooking.example.com</video:gallery_loc>
\t\t\t<video:price currency="EUR" type="rent" resolution="HD">0.99</video:price>
\t\t\t<video:price currency="EUR" type="rent" resolution="SD">0.75</video:price>
\t\t\t<video:tag>action</video:tag>
\t\t\t<video:tag>drama</video:tag>
\t\t\t<video:tag>entrepreneur</video:tag>
\t\t\t<video:requires_subscription><![CDATA[yes]]></video:requires_subscription>
\t\t\t<video:uploader info="http://www.example.com/users/grillymcgrillerson">GrillyMcGrillerson</video:uploader>
\t\t\t<video:platform relationship="allow">web mobile tv</video:platform>
\t\t\t<video:live><![CDATA[no]]></video:live>
\t\t</video:video>
\t</url>
</urlset>
XML;

        $item = new VideoItem();
        $item->setThumbnailLoc('http://www.example.com/thumbs/123.jpg');
        $item->setTitle('Grilling steaks for summer');
        $item->setDescription('Alkis shows you how to get perfectly done steaks everytime');
        $item->setContentLoc('http://www.example.com/video123.flv');
        $item->setPlayerLoc('http://www.example.com/videoplayer.swf?video=123');
        $item->setPlayerLocAllowEmbedded('yes');
        $item->setPlayerLocAutoplay('ap=1');
        $item->setDuration(600);
        $item->setExpirationDate('2009-11-05T19:20:30+08:00');
        $item->setRating(4.2);
        $item->setViewCount(12345);
        $item->setPublicationDate('2007-11-05T19:20:30+08:00');
        $item->setFamilyFriendly('yes');
        $item->setRestriction('IE GB US CA');
        $item->setRestrictionRelationship('allow');
        $item->setGalleryLoc('http://cooking.example.com');
        $item->setGalleryTitle('Cooking Videos');
        $item->setPrice('0.99','EUR','rent','HD');
        $item->setPrice('0.75','EUR','rent','SD');
        $item->setCategory('cooking');
        $item->setTag(array('action','drama','entrepreneur'));
        $item->setRequiresSubscription('yes');
        $item->setUploader('GrillyMcGrillerson');
        $item->setUploaderInfo('http://www.example.com/users/grillymcgrillerson');
        $item->setPlatform('web mobile tv');
        $item->setPlatformRelationship('allow');
        $item->setLive('no');


        $this->sitemap->add($item,'http://www.example.com/');

        $files = $this->sitemap->build();
        $this->assertEquals($expected,$files[0]);
    }

    public function testAddVideoWithAllFields2()
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
\t\t\t<video:player_loc allow_embed="yes" autoplay="ap=1">http://www.example.com/videoplayer.swf?video=123</video:player_loc>
\t\t\t<video:duration><![CDATA[600]]></video:duration>
\t\t\t<video:expiration_date><![CDATA[2009-11-05T19:20:30+08:00]]></video:expiration_date>
\t\t\t<video:rating><![CDATA[4.2]]></video:rating>
\t\t\t<video:view_count><![CDATA[12345]]></video:view_count>
\t\t\t<video:publication_date><![CDATA[2007-11-05T19:20:30+08:00]]></video:publication_date>
\t\t\t<video:family_friendly><![CDATA[No]]></video:family_friendly>
\t\t\t<video:restriction relationship="allow">IE GB US CA</video:restriction>
\t\t\t<video:gallery_loc title="Cooking Videos">http://cooking.example.com</video:gallery_loc>
\t\t\t<video:price currency="EUR" type="rent" resolution="HD">0.99</video:price>
\t\t\t<video:price currency="EUR" type="rent" resolution="SD">0.75</video:price>
\t\t\t<video:tag>action</video:tag>
\t\t\t<video:tag>drama</video:tag>
\t\t\t<video:tag>entrepreneur</video:tag>
\t\t\t<video:requires_subscription><![CDATA[yes]]></video:requires_subscription>
\t\t\t<video:uploader info="http://www.example.com/users/grillymcgrillerson">GrillyMcGrillerson</video:uploader>
\t\t\t<video:platform relationship="allow">web mobile tv</video:platform>
\t\t\t<video:live><![CDATA[no]]></video:live>
\t\t</video:video>
\t</url>
</urlset>
XML;

        $item = new VideoItem();
        $item->setThumbnailLoc('http://www.example.com/thumbs/123.jpg');
        $item->setTitle('Grilling steaks for summer');
        $item->setDescription('Alkis shows you how to get perfectly done steaks everytime');
        $item->setContentLoc('http://www.example.com/video123.flv');
        $item->setPlayerLoc('http://www.example.com/videoplayer.swf?video=123');
        $item->setPlayerLocAllowEmbedded('yes');
        $item->setPlayerLocAutoplay('ap=1');
        $item->setDuration(600);
        $item->setExpirationDate('2009-11-05T19:20:30+08:00');
        $item->setRating(4.2);
        $item->setViewCount(12345);
        $item->setPublicationDate('2007-11-05T19:20:30+08:00');
        $item->setFamilyFriendly('no');
        $item->setRestriction('IE GB US CA');
        $item->setRestrictionRelationship('allow');
        $item->setGalleryLoc('http://cooking.example.com');
        $item->setGalleryTitle('Cooking Videos');
        $item->setPrice('0.99','EUR','rent','HD');
        $item->setPrice('0.75','EUR','rent','SD');
        $item->setCategory('cooking');
        $item->setTag(array('action','drama','entrepreneur'));
        $item->setRequiresSubscription('yes');
        $item->setUploader('GrillyMcGrillerson');
        $item->setUploaderInfo('http://www.example.com/users/grillymcgrillerson');
        $item->setPlatform('web mobile tv');
        $item->setPlatformRelationship('allow');
        $item->setLive('no');


        $this->sitemap->add($item,'http://www.example.com/');

        $files = $this->sitemap->build();
        $this->assertEquals($expected,$files[0]);
    }

    public function testAddVideoWithAllFieldsExceptAllowEmbeddedAttribute()
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
\t\t\t<video:player_loc autoplay="ap=1">http://www.example.com/videoplayer.swf?video=123</video:player_loc>
\t\t\t<video:duration><![CDATA[600]]></video:duration>
\t\t\t<video:expiration_date><![CDATA[2009-11-05T19:20:30+08:00]]></video:expiration_date>
\t\t\t<video:rating><![CDATA[4.2]]></video:rating>
\t\t\t<video:view_count><![CDATA[12345]]></video:view_count>
\t\t\t<video:publication_date><![CDATA[2007-11-05T19:20:30+08:00]]></video:publication_date>
\t\t\t<video:restriction relationship="allow">IE GB US CA</video:restriction>
\t\t\t<video:gallery_loc title="Cooking Videos">http://cooking.example.com</video:gallery_loc>
\t\t\t<video:price currency="EUR" type="rent" resolution="HD">0.99</video:price>
\t\t\t<video:price currency="EUR" type="rent" resolution="SD">0.75</video:price>
\t\t\t<video:tag>action</video:tag>
\t\t\t<video:tag>drama</video:tag>
\t\t\t<video:tag>entrepreneur</video:tag>
\t\t\t<video:requires_subscription><![CDATA[yes]]></video:requires_subscription>
\t\t\t<video:uploader info="http://www.example.com/users/grillymcgrillerson">GrillyMcGrillerson</video:uploader>
\t\t\t<video:platform relationship="allow">web mobile tv</video:platform>
\t\t\t<video:live><![CDATA[no]]></video:live>
\t\t</video:video>
\t</url>
</urlset>
XML;
        $item = new VideoItem();
        $item->setThumbnailLoc('http://www.example.com/thumbs/123.jpg');
        $item->setTitle('Grilling steaks for summer');
        $item->setDescription('Alkis shows you how to get perfectly done steaks everytime');
        $item->setContentLoc('http://www.example.com/video123.flv');
        $item->setPlayerLoc('http://www.example.com/videoplayer.swf?video=123');
        $item->setPlayerLocAutoplay('ap=1');
        $item->setDuration(600);
        $item->setExpirationDate('2009-11-05T19:20:30+08:00');
        $item->setRating(4.2);
        $item->setViewCount(12345);
        $item->setPublicationDate('2007-11-05T19:20:30+08:00');
        $item->setFamilyFriendly('yes');
        $item->setRestriction('IE GB US CA');
        $item->setRestrictionRelationship('allow');
        $item->setGalleryLoc('http://cooking.example.com');
        $item->setGalleryTitle('Cooking Videos');
        $item->setPrice('0.99','EUR','rent','HD');
        $item->setPrice('0.75','EUR','rent','SD');
        $item->setCategory('cooking');
        $item->setTag(array('action','drama','entrepreneur'));
        $item->setRequiresSubscription('yes');
        $item->setUploader('GrillyMcGrillerson');
        $item->setUploaderInfo('http://www.example.com/users/grillymcgrillerson');
        $item->setPlatform('web mobile tv');
        $item->setPlatformRelationship('allow');
        $item->setLive('no');


        $this->sitemap->add($item,'http://www.example.com/');

        $files = $this->sitemap->build();
        $this->assertEquals($expected,$files[0]);
    }


    public function testAddVideoWithAllFieldsExceptAutoplayAttribute()
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
\t\t\t<video:player_loc allow_embed="yes">http://www.example.com/videoplayer.swf?video=123</video:player_loc>
\t\t\t<video:duration><![CDATA[600]]></video:duration>
\t\t\t<video:expiration_date><![CDATA[2009-11-05T19:20:30+08:00]]></video:expiration_date>
\t\t\t<video:rating><![CDATA[4.2]]></video:rating>
\t\t\t<video:view_count><![CDATA[12345]]></video:view_count>
\t\t\t<video:publication_date><![CDATA[2007-11-05T19:20:30+08:00]]></video:publication_date>
\t\t\t<video:restriction relationship="allow">IE GB US CA</video:restriction>
\t\t\t<video:gallery_loc title="Cooking Videos">http://cooking.example.com</video:gallery_loc>
\t\t\t<video:price currency="EUR" type="rent" resolution="HD">0.99</video:price>
\t\t\t<video:price currency="EUR" type="rent" resolution="SD">0.75</video:price>
\t\t\t<video:tag>action</video:tag>
\t\t\t<video:tag>drama</video:tag>
\t\t\t<video:tag>entrepreneur</video:tag>
\t\t\t<video:requires_subscription><![CDATA[yes]]></video:requires_subscription>
\t\t\t<video:uploader info="http://www.example.com/users/grillymcgrillerson">GrillyMcGrillerson</video:uploader>
\t\t\t<video:platform relationship="allow">web mobile tv</video:platform>
\t\t\t<video:live><![CDATA[no]]></video:live>
\t\t</video:video>
\t</url>
</urlset>
XML;
        $item = new VideoItem();
        $item->setThumbnailLoc('http://www.example.com/thumbs/123.jpg');
        $item->setTitle('Grilling steaks for summer');
        $item->setDescription('Alkis shows you how to get perfectly done steaks everytime');
        $item->setContentLoc('http://www.example.com/video123.flv');
        $item->setPlayerLoc('http://www.example.com/videoplayer.swf?video=123');
        $item->setPlayerLocAllowEmbedded('yes');
        $item->setDuration(600);
        $item->setExpirationDate('2009-11-05T19:20:30+08:00');
        $item->setRating(4.2);
        $item->setViewCount(12345);
        $item->setPublicationDate('2007-11-05T19:20:30+08:00');
        $item->setFamilyFriendly('yes');
        $item->setRestriction('IE GB US CA');
        $item->setRestrictionRelationship('allow');
        $item->setGalleryLoc('http://cooking.example.com');
        $item->setGalleryTitle('Cooking Videos');
        $item->setPrice('0.99','EUR','rent','HD');
        $item->setPrice('0.75','EUR','rent','SD');
        $item->setCategory('cooking');
        $item->setTag(array('action','drama','entrepreneur'));
        $item->setRequiresSubscription('yes');
        $item->setUploader('GrillyMcGrillerson');
        $item->setUploaderInfo('http://www.example.com/users/grillymcgrillerson');
        $item->setPlatform('web mobile tv');
        $item->setPlatformRelationship('allow');
        $item->setLive('no');


        $this->sitemap->add($item,'http://www.example.com/');
        $files = $this->sitemap->build();

        $this->assertEquals($expected,$files[0]);
    }


    public function testAddVideoWithoutRestrictionRelationship()
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
\t\t\t<video:player_loc allow_embed="yes" autoplay="ap=1">http://www.example.com/videoplayer.swf?video=123</video:player_loc>
\t\t\t<video:duration><![CDATA[600]]></video:duration>
\t\t\t<video:expiration_date><![CDATA[2009-11-05T19:20:30+08:00]]></video:expiration_date>
\t\t\t<video:rating><![CDATA[4.2]]></video:rating>
\t\t\t<video:view_count><![CDATA[12345]]></video:view_count>
\t\t\t<video:publication_date><![CDATA[2007-11-05T19:20:30+08:00]]></video:publication_date>
\t\t\t<video:restriction>IE GB US CA</video:restriction>
\t\t\t<video:gallery_loc title="Cooking Videos">http://cooking.example.com</video:gallery_loc>
\t\t\t<video:price currency="EUR" type="rent" resolution="HD">0.99</video:price>
\t\t\t<video:price currency="EUR" type="rent" resolution="SD">0.75</video:price>
\t\t\t<video:tag>action</video:tag>
\t\t\t<video:tag>drama</video:tag>
\t\t\t<video:tag>entrepreneur</video:tag>
\t\t\t<video:requires_subscription><![CDATA[yes]]></video:requires_subscription>
\t\t\t<video:uploader info="http://www.example.com/users/grillymcgrillerson">GrillyMcGrillerson</video:uploader>
\t\t\t<video:platform relationship="allow">web mobile tv</video:platform>
\t\t\t<video:live><![CDATA[no]]></video:live>
\t\t</video:video>
\t</url>
</urlset>
XML;
         $item = new VideoItem();
        $item->setThumbnailLoc('http://www.example.com/thumbs/123.jpg');
        $item->setTitle('Grilling steaks for summer');
        $item->setDescription('Alkis shows you how to get perfectly done steaks everytime');
        $item->setContentLoc('http://www.example.com/video123.flv');
        $item->setPlayerLoc('http://www.example.com/videoplayer.swf?video=123');
        $item->setPlayerLocAllowEmbedded('yes');
        $item->setPlayerLocAutoplay('ap=1');
        $item->setDuration(600);
        $item->setExpirationDate('2009-11-05T19:20:30+08:00');
        $item->setRating(4.2);
        $item->setViewCount(12345);
        $item->setPublicationDate('2007-11-05T19:20:30+08:00');
        $item->setFamilyFriendly('yes');
        $item->setRestriction('IE GB US CA');
        $item->setGalleryLoc('http://cooking.example.com');
        $item->setGalleryTitle('Cooking Videos');
        $item->setPrice('0.99','EUR','rent','HD');
        $item->setPrice('0.75','EUR','rent','SD');
        $item->setCategory('cooking');
        $item->setTag(array('action','drama','entrepreneur'));
        $item->setRequiresSubscription('yes');
        $item->setUploader('GrillyMcGrillerson');
        $item->setUploaderInfo('http://www.example.com/users/grillymcgrillerson');
        $item->setPlatform('web mobile tv');
        $item->setPlatformRelationship('allow');
        $item->setLive('no');

        $this->sitemap->add($item,'http://www.example.com/');

        $files = $this->sitemap->build();
        $this->assertEquals($expected,$files[0]);
    }




    public function testAddVideoWithoutGalleryLocTitle()
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
\t\t\t<video:player_loc allow_embed="yes" autoplay="ap=1">http://www.example.com/videoplayer.swf?video=123</video:player_loc>
\t\t\t<video:duration><![CDATA[600]]></video:duration>
\t\t\t<video:expiration_date><![CDATA[2009-11-05T19:20:30+08:00]]></video:expiration_date>
\t\t\t<video:rating><![CDATA[4.2]]></video:rating>
\t\t\t<video:view_count><![CDATA[12345]]></video:view_count>
\t\t\t<video:publication_date><![CDATA[2007-11-05T19:20:30+08:00]]></video:publication_date>
\t\t\t<video:restriction relationship="allow">IE GB US CA</video:restriction>
\t\t\t<video:gallery_loc>http://cooking.example.com</video:gallery_loc>
\t\t\t<video:price currency="EUR" type="rent" resolution="HD">0.99</video:price>
\t\t\t<video:price currency="EUR" type="rent" resolution="SD">0.75</video:price>
\t\t\t<video:tag>action</video:tag>
\t\t\t<video:tag>drama</video:tag>
\t\t\t<video:tag>entrepreneur</video:tag>
\t\t\t<video:requires_subscription><![CDATA[yes]]></video:requires_subscription>
\t\t\t<video:uploader info="http://www.example.com/users/grillymcgrillerson">GrillyMcGrillerson</video:uploader>
\t\t\t<video:platform relationship="allow">web mobile tv</video:platform>
\t\t\t<video:live><![CDATA[no]]></video:live>
\t\t</video:video>
\t</url>
</urlset>
XML;
         $item = new VideoItem();
        $item->setThumbnailLoc('http://www.example.com/thumbs/123.jpg');
        $item->setTitle('Grilling steaks for summer');
        $item->setDescription('Alkis shows you how to get perfectly done steaks everytime');
        $item->setContentLoc('http://www.example.com/video123.flv');
        $item->setPlayerLoc('http://www.example.com/videoplayer.swf?video=123');
        $item->setPlayerLocAllowEmbedded('yes');
        $item->setPlayerLocAutoplay('ap=1');
        $item->setDuration(600);
        $item->setExpirationDate('2009-11-05T19:20:30+08:00');
        $item->setRating(4.2);
        $item->setViewCount(12345);
        $item->setPublicationDate('2007-11-05T19:20:30+08:00');
        $item->setFamilyFriendly('yes');
        $item->setRestriction('IE GB US CA');
        $item->setRestrictionRelationship('allow');
        $item->setGalleryLoc('http://cooking.example.com');
        $item->setPrice('0.99','EUR','rent','HD');
        $item->setPrice('0.75','EUR','rent','SD');
        $item->setCategory('cooking');
        $item->setTag(array('action','drama','entrepreneur'));
        $item->setRequiresSubscription('yes');
        $item->setUploader('GrillyMcGrillerson');
        $item->setUploaderInfo('http://www.example.com/users/grillymcgrillerson');
        $item->setPlatform('web mobile tv');
        $item->setPlatformRelationship('allow');
        $item->setLive('no');


        $this->sitemap->add($item,'http://www.example.com/');

        $files = $this->sitemap->build();
        $this->assertEquals($expected,$files[0]);
    }


    public function testAddVideoWithoutPlatformRelationship()
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
\t\t\t<video:player_loc allow_embed="yes" autoplay="ap=1">http://www.example.com/videoplayer.swf?video=123</video:player_loc>
\t\t\t<video:duration><![CDATA[600]]></video:duration>
\t\t\t<video:expiration_date><![CDATA[2009-11-05T19:20:30+08:00]]></video:expiration_date>
\t\t\t<video:rating><![CDATA[4.2]]></video:rating>
\t\t\t<video:view_count><![CDATA[12345]]></video:view_count>
\t\t\t<video:publication_date><![CDATA[2007-11-05T19:20:30+08:00]]></video:publication_date>
\t\t\t<video:restriction relationship="allow">IE GB US CA</video:restriction>
\t\t\t<video:gallery_loc title="Cooking Videos">http://cooking.example.com</video:gallery_loc>
\t\t\t<video:price currency="EUR" type="rent" resolution="HD">0.99</video:price>
\t\t\t<video:price currency="EUR" type="rent" resolution="SD">0.75</video:price>
\t\t\t<video:tag>action</video:tag>
\t\t\t<video:tag>drama</video:tag>
\t\t\t<video:tag>entrepreneur</video:tag>
\t\t\t<video:requires_subscription><![CDATA[yes]]></video:requires_subscription>
\t\t\t<video:uploader info="http://www.example.com/users/grillymcgrillerson">GrillyMcGrillerson</video:uploader>
\t\t\t<video:platform>web mobile tv</video:platform>
\t\t\t<video:live><![CDATA[no]]></video:live>
\t\t</video:video>
\t</url>
</urlset>
XML;
        $item = new VideoItem();
        $item->setThumbnailLoc('http://www.example.com/thumbs/123.jpg');
        $item->setTitle('Grilling steaks for summer');
        $item->setDescription('Alkis shows you how to get perfectly done steaks everytime');
        $item->setContentLoc('http://www.example.com/video123.flv');
        $item->setPlayerLoc('http://www.example.com/videoplayer.swf?video=123');
        $item->setPlayerLocAllowEmbedded('yes');
        $item->setPlayerLocAutoplay('ap=1');
        $item->setDuration(600);
        $item->setExpirationDate('2009-11-05T19:20:30+08:00');
        $item->setRating(4.2);
        $item->setViewCount(12345);
        $item->setPublicationDate('2007-11-05T19:20:30+08:00');
        $item->setFamilyFriendly('yes');
        $item->setRestriction('IE GB US CA');
        $item->setRestrictionRelationship('allow');
        $item->setGalleryLoc('http://cooking.example.com');
        $item->setGalleryTitle('Cooking Videos');
        $item->setPrice('0.99','EUR','rent','HD');
        $item->setPrice('0.75','EUR','rent','SD');
        $item->setCategory('cooking');
        $item->setTag(array('action','drama','entrepreneur'));
        $item->setRequiresSubscription('yes');
        $item->setUploader('GrillyMcGrillerson');
        $item->setUploaderInfo('http://www.example.com/users/grillymcgrillerson');
        $item->setPlatform('web mobile tv');
        $item->setLive('no');


        $this->sitemap->add($item,'http://www.example.com/');
        $files = $this->sitemap->build();
        $this->assertEquals($expected,$files[0]);
    }



    public function testAddVideoWithoutUploaderInfo()
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
\t\t\t<video:player_loc allow_embed="yes" autoplay="ap=1">http://www.example.com/videoplayer.swf?video=123</video:player_loc>
\t\t\t<video:duration><![CDATA[600]]></video:duration>
\t\t\t<video:expiration_date><![CDATA[2009-11-05T19:20:30+08:00]]></video:expiration_date>
\t\t\t<video:rating><![CDATA[4.2]]></video:rating>
\t\t\t<video:view_count><![CDATA[12345]]></video:view_count>
\t\t\t<video:publication_date><![CDATA[2007-11-05T19:20:30+08:00]]></video:publication_date>
\t\t\t<video:restriction relationship="allow">IE GB US CA</video:restriction>
\t\t\t<video:gallery_loc title="Cooking Videos">http://cooking.example.com</video:gallery_loc>
\t\t\t<video:price currency="EUR" type="rent" resolution="HD">0.99</video:price>
\t\t\t<video:price currency="EUR" type="rent" resolution="SD">0.75</video:price>
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

        $item = new VideoItem();
        $item->setThumbnailLoc('http://www.example.com/thumbs/123.jpg');
        $item->setTitle('Grilling steaks for summer');
        $item->setDescription('Alkis shows you how to get perfectly done steaks everytime');
        $item->setContentLoc('http://www.example.com/video123.flv');
        $item->setPlayerLoc('http://www.example.com/videoplayer.swf?video=123');
        $item->setPlayerLocAllowEmbedded('yes');
        $item->setPlayerLocAutoplay('ap=1');
        $item->setDuration(600);
        $item->setExpirationDate('2009-11-05T19:20:30+08:00');
        $item->setRating(4.2);
        $item->setViewCount(12345);
        $item->setPublicationDate('2007-11-05T19:20:30+08:00');
        $item->setFamilyFriendly('yes');
        $item->setRestriction('IE GB US CA');
        $item->setRestrictionRelationship('allow');
        $item->setGalleryLoc('http://cooking.example.com');
        $item->setGalleryTitle('Cooking Videos');
        $item->setPrice('0.99','EUR','rent','HD');
        $item->setPrice('0.75','EUR','rent','SD');
        $item->setCategory('cooking');
        $item->setTag(array('action','drama','entrepreneur'));
        $item->setRequiresSubscription('yes');
        $item->setUploader('GrillyMcGrillerson');
        $item->setPlatform('web mobile tv');
        $item->setPlatformRelationship('allow');
        $item->setLive('no');


        $this->sitemap->add($item,'http://www.example.com/');

        $files = $this->sitemap->build();
        $this->assertEquals($expected,$files[0]);
    }



    public function testAddVideoWithoutType()
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
\t\t\t<video:player_loc allow_embed="yes" autoplay="ap=1">http://www.example.com/videoplayer.swf?video=123</video:player_loc>
\t\t\t<video:duration><![CDATA[600]]></video:duration>
\t\t\t<video:expiration_date><![CDATA[2009-11-05T19:20:30+08:00]]></video:expiration_date>
\t\t\t<video:rating><![CDATA[4.2]]></video:rating>
\t\t\t<video:view_count><![CDATA[12345]]></video:view_count>
\t\t\t<video:publication_date><![CDATA[2007-11-05T19:20:30+08:00]]></video:publication_date>
\t\t\t<video:restriction relationship="allow">IE GB US CA</video:restriction>
\t\t\t<video:gallery_loc title="Cooking Videos">http://cooking.example.com</video:gallery_loc>
\t\t\t<video:price currency="EUR" resolution="HD">0.99</video:price>
\t\t\t<video:price currency="EUR" resolution="SD">0.75</video:price>
\t\t\t<video:tag>action</video:tag>
\t\t\t<video:tag>drama</video:tag>
\t\t\t<video:tag>entrepreneur</video:tag>
\t\t\t<video:requires_subscription><![CDATA[yes]]></video:requires_subscription>
\t\t\t<video:uploader info="http://www.example.com/users/grillymcgrillerson">GrillyMcGrillerson</video:uploader>
\t\t\t<video:platform relationship="allow">web mobile tv</video:platform>
\t\t\t<video:live><![CDATA[no]]></video:live>
\t\t</video:video>
\t</url>
</urlset>
XML;

        $item = new VideoItem();
        $item->setThumbnailLoc('http://www.example.com/thumbs/123.jpg');
        $item->setTitle('Grilling steaks for summer');
        $item->setDescription('Alkis shows you how to get perfectly done steaks everytime');
        $item->setContentLoc('http://www.example.com/video123.flv');
        $item->setPlayerLoc('http://www.example.com/videoplayer.swf?video=123');
        $item->setPlayerLocAllowEmbedded('yes');
        $item->setPlayerLocAutoplay('ap=1');
        $item->setDuration(600);
        $item->setExpirationDate('2009-11-05T19:20:30+08:00');
        $item->setRating(4.2);
        $item->setViewCount(12345);
        $item->setPublicationDate('2007-11-05T19:20:30+08:00');
        $item->setFamilyFriendly('yes');
        $item->setRestriction('IE GB US CA');
        $item->setRestrictionRelationship('allow');
        $item->setGalleryLoc('http://cooking.example.com');
        $item->setGalleryTitle('Cooking Videos');
        $item->setPrice('0.99','EUR','','HD');
        $item->setPrice('0.75','EUR','','SD');
        $item->setCategory('cooking');
        $item->setTag(array('action','drama','entrepreneur'));
        $item->setRequiresSubscription('yes');
        $item->setUploader('GrillyMcGrillerson');
        $item->setUploaderInfo('http://www.example.com/users/grillymcgrillerson');
        $item->setPlatform('web mobile tv');
        $item->setPlatformRelationship('allow');
        $item->setLive('no');


        $this->sitemap->add($item,'http://www.example.com/');

        $files = $this->sitemap->build();
        $this->assertEquals($expected,$files[0]);
    }



    public function testAddVideoWithoutResolution()
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
\t\t\t<video:player_loc allow_embed="yes" autoplay="ap=1">http://www.example.com/videoplayer.swf?video=123</video:player_loc>
\t\t\t<video:duration><![CDATA[600]]></video:duration>
\t\t\t<video:expiration_date><![CDATA[2009-11-05T19:20:30+08:00]]></video:expiration_date>
\t\t\t<video:rating><![CDATA[4.2]]></video:rating>
\t\t\t<video:view_count><![CDATA[12345]]></video:view_count>
\t\t\t<video:publication_date><![CDATA[2007-11-05T19:20:30+08:00]]></video:publication_date>
\t\t\t<video:restriction relationship="allow">IE GB US CA</video:restriction>
\t\t\t<video:gallery_loc title="Cooking Videos">http://cooking.example.com</video:gallery_loc>
\t\t\t<video:price currency="EUR" type="rent">0.99</video:price>
\t\t\t<video:price currency="USD" type="rent">0.75</video:price>
\t\t\t<video:tag>action</video:tag>
\t\t\t<video:tag>drama</video:tag>
\t\t\t<video:tag>entrepreneur</video:tag>
\t\t\t<video:requires_subscription><![CDATA[yes]]></video:requires_subscription>
\t\t\t<video:uploader info="http://www.example.com/users/grillymcgrillerson">GrillyMcGrillerson</video:uploader>
\t\t\t<video:platform relationship="allow">web mobile tv</video:platform>
\t\t\t<video:live><![CDATA[no]]></video:live>
\t\t</video:video>
\t</url>
</urlset>
XML;

        $item = new VideoItem();
        $item->setThumbnailLoc('http://www.example.com/thumbs/123.jpg');
        $item->setTitle('Grilling steaks for summer');
        $item->setDescription('Alkis shows you how to get perfectly done steaks everytime');
        $item->setContentLoc('http://www.example.com/video123.flv');
        $item->setPlayerLoc('http://www.example.com/videoplayer.swf?video=123');
        $item->setPlayerLocAllowEmbedded('yes');
        $item->setPlayerLocAutoplay('ap=1');
        $item->setDuration(600);
        $item->setExpirationDate('2009-11-05T19:20:30+08:00');
        $item->setRating(4.2);
        $item->setViewCount(12345);
        $item->setPublicationDate('2007-11-05T19:20:30+08:00');
        $item->setFamilyFriendly('yes');
        $item->setRestriction('IE GB US CA');
        $item->setRestrictionRelationship('allow');
        $item->setGalleryLoc('http://cooking.example.com');
        $item->setGalleryTitle('Cooking Videos');
        $item->setPrice('0.99','EUR','rent');
        $item->setPrice('0.75','USD','rent');
        $item->setCategory('cooking');
        $item->setTag(array('action','drama','entrepreneur'));
        $item->setRequiresSubscription('yes');
        $item->setUploader('GrillyMcGrillerson');
        $item->setUploaderInfo('http://www.example.com/users/grillymcgrillerson');
        $item->setPlatform('web mobile tv');
        $item->setPlatformRelationship('allow');
        $item->setLive('no');

        $this->sitemap->add($item,'http://www.example.com/');

        $files = $this->sitemap->build();
        $this->assertEquals($expected,$files[0]);
    }


    public function testAddVideoWithoutResolutionAndType()
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
\t\t\t<video:player_loc allow_embed="yes" autoplay="ap=1">http://www.example.com/videoplayer.swf?video=123</video:player_loc>
\t\t\t<video:duration><![CDATA[600]]></video:duration>
\t\t\t<video:expiration_date><![CDATA[2009-11-05T19:20:30+08:00]]></video:expiration_date>
\t\t\t<video:rating><![CDATA[4.2]]></video:rating>
\t\t\t<video:view_count><![CDATA[12345]]></video:view_count>
\t\t\t<video:publication_date><![CDATA[2007-11-05T19:20:30+08:00]]></video:publication_date>
\t\t\t<video:restriction relationship="allow">IE GB US CA</video:restriction>
\t\t\t<video:gallery_loc title="Cooking Videos">http://cooking.example.com</video:gallery_loc>
\t\t\t<video:price currency="EUR">0.99</video:price>
\t\t\t<video:price currency="USD">0.75</video:price>
\t\t\t<video:tag>action</video:tag>
\t\t\t<video:tag>drama</video:tag>
\t\t\t<video:tag>entrepreneur</video:tag>
\t\t\t<video:requires_subscription><![CDATA[yes]]></video:requires_subscription>
\t\t\t<video:uploader info="http://www.example.com/users/grillymcgrillerson">GrillyMcGrillerson</video:uploader>
\t\t\t<video:platform relationship="allow">web mobile tv</video:platform>
\t\t\t<video:live><![CDATA[no]]></video:live>
\t\t</video:video>
\t</url>
</urlset>
XML;
        $item = new VideoItem();
        $item->setThumbnailLoc('http://www.example.com/thumbs/123.jpg');
        $item->setTitle('Grilling steaks for summer');
        $item->setDescription('Alkis shows you how to get perfectly done steaks everytime');
        $item->setContentLoc('http://www.example.com/video123.flv');
        $item->setPlayerLoc('http://www.example.com/videoplayer.swf?video=123');
        $item->setPlayerLocAllowEmbedded('yes');
        $item->setPlayerLocAutoplay('ap=1');
        $item->setDuration(600);
        $item->setExpirationDate('2009-11-05T19:20:30+08:00');
        $item->setRating(4.2);
        $item->setViewCount(12345);
        $item->setPublicationDate('2007-11-05T19:20:30+08:00');
        $item->setFamilyFriendly('yes');
        $item->setRestriction('IE GB US CA');
        $item->setRestrictionRelationship('allow');
        $item->setGalleryLoc('http://cooking.example.com');
        $item->setGalleryTitle('Cooking Videos');
        $item->setPrice('0.99','EUR');
        $item->setPrice('0.75','USD');
        $item->setCategory('cooking');
        $item->setTag(array('action','drama','entrepreneur'));
        $item->setRequiresSubscription('yes');
        $item->setUploader('GrillyMcGrillerson');
        $item->setUploaderInfo('http://www.example.com/users/grillymcgrillerson');
        $item->setPlatform('web mobile tv');
        $item->setPlatformRelationship('allow');
        $item->setLive('no');

        $this->sitemap->add($item,'http://www.example.com/');

        $files = $this->sitemap->build();
        $files = $this->sitemap->build();
        $this->assertEquals($expected,$files[0]);
    }


    public function testAddUrlAbovetheSitemapMaxUrlElementLimit()
    {
        //For testing purposes reduce the real limit to 1000 instead of 50000
        $reflectionClass = new \ReflectionClass('Sonrisa\\Component\\Sitemap\\VideoSitemap');
        $property = $reflectionClass->getProperty('max_items_per_sitemap');
        $property->setAccessible(true);
        $property->setValue($this->sitemap,'1000');

        //Test limit
        for ($i=1;$i<=2000; $i++) {

            $item = new VideoItem();
            $item->setThumbnailLoc('http://www.example.com/thumbs/'.$i.'.jpg');
            $item->setTitle('Title '.$i);
            $item->setDescription('Alkis shows you how to get perfectly done steaks everytime');
            $item->setContentLoc('http://www.example.com/video'.$i.'.flv');
            $item->setPlayerLoc('http://www.example.com/videoplayer.swf?video='.$i);
            $item->setPlayerLocAutoplay('ap=1');
            $item->setDuration(600);
            $item->setExpirationDate('2009-11-05T19:20:30+08:00');
            $item->setRating(4.2);
            $item->setViewCount(12345);
            $item->setPublicationDate('2007-11-05T19:20:30+08:00');
            $item->setFamilyFriendly('yes');
            $item->setRestriction('IE GB US CA');
            $item->setRestrictionRelationship('allow');
            $item->setGalleryLoc('http://cooking.example.com');
            $item->setGalleryTitle('Cooking Videos');
            $item->setPrice('0.99','EUR','rent','HD');
            $item->setPrice('0.75','EUR','rent','SD');
            $item->setCategory('cooking');
            $item->setTag(array('action','drama','entrepreneur'));
            $item->setRequiresSubscription('yes');
            $item->setUploader('GrillyMcGrillerson');
            $item->setUploaderInfo('http://www.example.com/users/grillymcgrillerson');
            $item->setPlatform('web mobile tv');
            $item->setPlatformRelationship('allow');
            $item->setLive('no');

            $this->sitemap->add($item,'http://www.example.com/'.$i.'.html');

        }
        $files = $this->sitemap->build();

        $this->assertArrayHasKey('0',$files);
        $this->assertArrayHasKey('1',$files);
    }



}
