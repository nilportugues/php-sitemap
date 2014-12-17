<?php

namespace Tests\NilPortugues\Sitemap\Item\Video;

use NilPortugues\Sitemap\Item\Video\VideoItem;

/**
 * Class VideoItemTest
 * @package Tests\NilPortugues\Sitemap\Item\Video
 */
class VideoItemTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var VideoItem
     */
    protected $item;

    /**
     * @var string
     */
    protected $exception = 'NilPortugues\Sitemap\Item\Video\VideoItemException';

    /**
     *
     */
    protected function setUp()
    {
        $this->item = new VideoItem(
            'Grilling steaks for summer',
            'http://www.example.com/video123.flv',
            'http://www.example.com/videoplayer.swf?video=123'
        );
    }

    /**
     * @test
     */
    public function itShouldThrowExceptionOnNewInstanceNoLoc()
    {
        $this->setExpectedException($this->exception);
        new VideoItem(
            null,
            'http://www.example.com/video123.flv',
            'http://www.example.com/videoplayer.swf?video=123'
        );
    }

    /**
     * @test
     */
    public function itShouldThrowExceptionOnNewInstanceNoContentUrl()
    {
        $this->setExpectedException($this->exception);
        new VideoItem(
            'Grilling steaks for summer',
            null,
            'http://www.example.com/videoplayer.swf?video=123'
        );
    }

    /**
     * @test
     */
    public function itShouldThrowExceptionOnNewInstanceNoPlayerLoc()
    {
        $this->setExpectedException($this->exception);
        new VideoItem(
            'Grilling steaks for summer',
            'http://www.example.com/video123.flv',
            null
        );
    }

    /**
     * @test
     */
    public function itShouldOutputHeader()
    {
        $this->assertSame(
            '<?xml version="1.0" encoding="UTF-8"?>'."\n"
            .'<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"'
            .' xmlns:video="http://www.google.com/schemas/sitemap-video/1.1">'."\n",
            $this->item->getHeader()
        );
    }

    /**
     * @test
     */
    public function itShouldOutputFooter()
    {
        $this->assertSame('</urlset>', $this->item->getFooter());
    }

    /**
     * @test
     */
    public function itShouldHaveThumbnailLoc()
    {
        $this->item->setThumbnailLoc('http://www.example.com/thumbs/123.jpg');
        $this->assertContains(
            '<video:thumbnail_loc><![CDATA[http://www.example.com/thumbs/123.jpg]]></video:thumbnail_loc>',
            $this->item->build()
        );
    }

    /**
     * @test
     */
    public function itShouldHaveDescription()
    {
        $this->item->setDescription('Alkis shows you how to get perfectly done steaks everytime');
        $this->assertContains(
            '<video:description><![CDATA[Alkis shows you how to get perfectly done steaks everytime]]></video:description>',
            $this->item->build()
        );
    }

    /**
     * @test
     */
    public function itShouldHaveExpirationDate()
    {
        $this->item->setExpirationDate('2009-11-05T19:20:30+08:00');

        $this->assertContains(
            '<video:expiration_date><![CDATA[2009-11-05T19:20:30+08:00]]></video:expiration_date>',
            $this->item->build()
        );
    }

    /**
     * @test
     */
    public function itShouldHaveDuration()
    {
        $this->item->setDuration('600');

        $this->assertContains(
            '<video:duration><![CDATA[600]]></video:duration>',
            $this->item->build()
        );
    }

    /**
     * @test
     */
    public function itShouldHaveRating()
    {
        $this->item->setRating(4.2);
        $this->assertContains(
            '<video:rating><![CDATA[4.2]]></video:rating>',
            $this->item->build()
        );
    }

    /**
     * @test
     */
    public function itShouldHaveViewCount()
    {
        $this->item->setViewCount(12345);

        $this->assertContains(
            '<video:view_count><![CDATA[12345]]></video:view_count>',
            $this->item->build()
        );
    }

    /**
     * @test
     */
    public function itShouldHavePublicationDate()
    {
        $this->item->setPublicationDate('2007-11-05T19:20:30+08:00');

        $this->assertContains(
            '<video:publication_date><![CDATA[2007-11-05T19:20:30+08:00]]></video:publication_date>',
            $this->item->build()
        );
    }

    /**
     * @test
     */
    public function itShouldHaveFamilyFriendly()
    {
        $this->item->setFamilyFriendly('no');

        $this->assertContains(
            '<video:family_friendly><![CDATA[No]]></video:family_friendly>',
            $this->item->build()
        );
    }

    /**
     * @test
     */
    public function itShouldHaveRestriction()
    {
        $this->item->setRestriction('IE GB US CA');

        $this->assertContains(
            '<video:restriction>IE GB US CA</video:restriction>',
            $this->item->build()
        );

        $this->item->setRestriction('IE GB US CA', 'allow');
        $this->assertContains(
            '<video:restriction relationship="allow">IE GB US CA</video:restriction>',
            $this->item->build()
        );
    }

    /**
     * @test
     */
    public function itShouldHaveGalleryLoc()
    {
        $this->item->setGalleryLoc('http://cooking.example.com');

        $this->assertContains(
            '<video:gallery_loc>http://cooking.example.com</video:gallery_loc>',
            $this->item->build()
        );

        $this->item->setGalleryLoc('http://cooking.example.com', 'Cooking Videos');
        $this->assertContains(
            '<video:gallery_loc title="Cooking Videos">http://cooking.example.com</video:gallery_loc>',
            $this->item->build()
        );
    }

    /**
     * @test
     */
    public function itShouldHavePrice()
    {
        $this->item->setPrice(0.99, 'EUR');
        $this->item->setPrice(0.75, 'EUR');
        $this->assertContains('<video:price currency="EUR">0.99</video:price>', $this->item->build());
        $this->assertContains('<video:price currency="EUR">0.75</video:price>', $this->item->build());

        $this->item->setPrice(0.99, 'EUR', 'rent');
        $this->item->setPrice(0.75, 'EUR', 'rent');
        $this->assertContains('<video:price currency="EUR" type="rent">0.99</video:price>', $this->item->build());
        $this->assertContains('<video:price currency="EUR" type="rent">0.75</video:price>', $this->item->build());

        $this->item->setPrice(0.99, 'EUR', 'rent', 'HD');
        $this->item->setPrice(0.75, 'EUR', 'rent', 'SD');
        $this->assertContains(
            '<video:price currency="EUR" type="rent" resolution="HD">0.99</video:price>', $this->item->build()
        );
        $this->assertContains(
            '<video:price currency="EUR" type="rent" resolution="SD">0.75</video:price>', $this->item->build()
        );
    }
/**
 * @test

 public function itShouldHave()
 {
 $expected = <<<XML
 <video:player_loc allow_embed="yes" autoplay="ap=1">http://www.example.com/videoplayer.swf?video=123</video:player_loc>
 <video:tag>action</video:tag>
 <video:tag>drama</video:tag>
 <video:tag>entrepreneur</video:tag>
 <video:requires_subscription><![CDATA[yes]]></video:requires_subscription>
 <video:uploader info="http://www.example.com/users/grillymcgrillerson">GrillyMcGrillerson</video:uploader>
 <video:platform relationship="allow">web mobile tv</video:platform>
 <video:live><![CDATA[no]]></video:live>
 XML;




 $this->item->setGalleryLoc('http://cooking.example.com');
 $this->item->setGalleryLoc('http://cooking.example.com', 'Cooking Videos');
 *
 $this->item->setCategory('cooking');
 $this->item->setTag(array('action', 'drama', 'entrepreneur'));

 $this->item->setRequiresSubscription('yes');

 $this->item->setUploader('GrillyMcGrillerson');
 $this->item->setUploader('GrillyMcGrillerson', 'http://www.example.com/users/grillymcgrillerson');

 $this->item->setPlatform('web mobile tv');
 $this->item->setPlatform('web mobile tv', 'allow');

 $this->item->setLive('no');

 }*/
}
