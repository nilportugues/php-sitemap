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
     * @test
     */
    public function itShouldThrowExceptionOnNewInstanceNoLoc()
    {
        $this->setExpectedException($this->exception);
        new VideoItem(
            '',
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
            '',
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
            ''
        );
    }

    /**
     * @test
     */
    public function itShouldThrowExceptionOnNewInstanceNoValidPlayerEmbedded()
    {
        $this->setExpectedException($this->exception);
        $this->item = new VideoItem(
            'Grilling steaks for summer',
            'http://www.example.com/video123.flv',
            'http://www.example.com/videoplayer.swf?video=123',
            ''
        );
    }

    /**
     * @test
     */
    public function itShouldThrowExceptionOnNewInstanceNoValidPlayerAutoPlay()
    {
        $this->setExpectedException($this->exception);
        $this->item = new VideoItem(
            'Grilling steaks for summer',
            'http://www.example.com/video123.flv',
            'http://www.example.com/videoplayer.swf?video=123',
            'yes',
            ''
        );
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
    public function itShouldHaveThumbnailLocAndThrowException()
    {
        $this->setExpectedException($this->exception);
        $this->item->setThumbnailLoc('');
    }

    /**
     * @test
     */
    public function itShouldHaveDescription()
    {
        $this->item->setDescription('Alkis shows you how to get perfectly done steaks');
        $this->assertContains(
            '<video:description><![CDATA[Alkis shows you how to get perfectly done steaks]]></video:description>',
            $this->item->build()
        );

        $this->setExpectedException($this->exception);
        $this->item->setDescription('');
    }

    /**
     * @test
     */
    public function itShouldHaveDescriptionAndThrowException()
    {
        $this->setExpectedException($this->exception);
        $this->item->setDescription('');
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
    public function itShouldHaveExpirationDateAndThrowException()
    {
        $this->setExpectedException($this->exception);
        $this->item->setExpirationDate('');
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
    public function itShouldHaveDurationAndThrowException()
    {
        $this->setExpectedException($this->exception);
        $this->item->setDuration(-1);
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
    public function itShouldHaveRatingAndThrowException()
    {
        $this->setExpectedException($this->exception);
        $this->item->setRating(-1);
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
    public function itShouldHaveViewCountAndThrowException()
    {
        $this->setExpectedException($this->exception);
        $this->item->setViewCount(-1);
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
    public function itShouldHavePublicationDateAndThrowException()
    {
        $this->setExpectedException($this->exception);
        $this->item->setPublicationDate('');
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
    public function itShouldHaveFamilyFriendlyAndThrowException()
    {
        $this->setExpectedException($this->exception);
        $this->item->setFamilyFriendly('');
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
    }

    /**
     * @test
     */
    public function itShouldHaveRestrictionAndThrowException()
    {
        $this->setExpectedException($this->exception);
        $this->item->setRestriction('AAA');
    }

    /**
     * @test
     */
    public function itShouldHaveRestrictionRelationship()
    {
        $this->item->setRestriction('IE GB US CA', 'allow');
        $this->assertContains(
            '<video:restriction relationship="allow">IE GB US CA</video:restriction>',
            $this->item->build()
        );
    }

    /**
     * @test
     */
    public function itShouldHaveRestrictionRelationshipAndThrowException()
    {
        $this->setExpectedException($this->exception);
        $this->item->setRestriction('IE GB US CA', '');
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
    public function itShouldHaveGalleryLocAndThrowException()
    {
        $this->setExpectedException($this->exception);
        $this->item->setGalleryLoc('');

        $this->setExpectedException($this->exception);
        $this->item->setGalleryLoc('http://cooking.example.com', '');
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
    }

    /**
     * @test
     */
    public function itShouldHavePriceAndThrowException()
    {
        $this->setExpectedException($this->exception);
        $this->item->setPrice(-0.99, 'EUR');
    }

    /**
     * @test
     */
    public function itShouldHavePriceCurrencyAndThrowException()
    {
        $this->setExpectedException($this->exception);
        $this->item->setPrice(0.99, 'AAAA');
    }

    /**
     * @test
     */
    public function itShouldHavePriceType()
    {
        $this->item->setPrice(0.99, 'EUR', 'rent');
        $this->item->setPrice(0.75, 'EUR', 'rent');
        $this->assertContains('<video:price currency="EUR" type="rent">0.99</video:price>', $this->item->build());
        $this->assertContains('<video:price currency="EUR" type="rent">0.75</video:price>', $this->item->build());
    }

    /**
     * @test
     */
    public function itShouldHavePriceTypeAndThrowException()
    {
        $this->setExpectedException($this->exception);
        $this->item->setPrice(0.75, 'EUR', 'AAAAA');
    }

    /**
     * @test
     */
    public function itShouldHavePriceResolution()
    {
        $this->item->setPrice(0.99, 'EUR', 'rent', 'HD');
        $this->item->setPrice(0.75, 'EUR', 'rent', 'SD');
        $this->assertContains(
            '<video:price currency="EUR" type="rent" resolution="HD">0.99</video:price>',
            $this->item->build()
        );
        $this->assertContains(
            '<video:price currency="EUR" type="rent" resolution="SD">0.75</video:price>',
            $this->item->build()
        );
    }

    /**
     * @test
     */
    public function itShouldHavePriceResolutionAndThrowException()
    {
        $this->setExpectedException($this->exception, 'Provided price resolution is not a valid value.');
        $this->item->setPrice(0.99, 'EUR', 'rent', 'AAAA');
    }

    /**
     * @test
     */
    public function itShouldHaveCategory()
    {
        $this->item->setCategory('cooking');
        $this->assertContains('<video:category><![CDATA[cooking]]></video:category>', $this->item->build());
    }

    /**
     * @test
     */
    public function itShouldHaveCategoryAndThrowException()
    {
        $this->setExpectedException($this->exception);
        $this->item->setCategory('');
    }

    /**
     * @test
     */
    public function itShouldHaveTags()
    {
        $this->item->setTag(array('action', 'drama', 'entrepreneur'));
        $this->assertContains('<video:tag>drama</video:tag>', $this->item->build());
        $this->assertContains('<video:tag>action</video:tag>', $this->item->build());
        $this->assertContains('<video:tag>entrepreneur</video:tag>', $this->item->build());
    }

    /**
     * @test
     */
    public function itShouldHaveTagsAndThrowException()
    {
        $this->setExpectedException($this->exception);
        $this->item->setTag([]);
    }

    /**
     * @test
     */
    public function itShouldHaveRequiresSubscription()
    {
        $this->item->setRequiresSubscription('yes');
        $this->assertContains(
            '<video:requires_subscription><![CDATA[yes]]></video:requires_subscription>',
            $this->item->build()
        );
    }

    /**
     * @test
     */
    public function itShouldHaveRequiresSubscriptionAndThrowException()
    {
        $this->setExpectedException($this->exception);
        $this->item->setRequiresSubscription('');
    }

    /**
     * @test
     */
    public function itShouldHaveLive()
    {
        $this->item->setLive('no');
        $this->assertContains('<video:live><![CDATA[no]]></video:live>', $this->item->build());
    }

    /**
     * @test
     */
    public function itShouldHaveLiveAndThrowException()
    {
        $this->setExpectedException($this->exception);
        $this->item->setLive('');
    }

    /**
     * @test
     */
    public function itShouldHaveUploader()
    {
        $this->item->setUploader('GrillyMcGrillerson');
        $this->assertContains('<video:uploader>GrillyMcGrillerson</video:uploader>', $this->item->build());
    }

    /**
     * @test
     */
    public function itShouldHaveUploaderAndThrowException()
    {
        $this->setExpectedException($this->exception);
        $this->item->setUploader('');
    }

    /**
     * @test
     */
    public function itShouldHaveUploaderInfo()
    {
        $this->item->setUploader('GrillyMcGrillerson', 'http://www.example.com/grillymcgrillerson');
        $this->assertContains(
            '<video:uploader info="http://www.example.com/grillymcgrillerson">GrillyMcGrillerson</video:uploader>',
            $this->item->build()
        );
    }

    /**
     * @test
     */
    public function itShouldHaveUploaderInfoAndThrowException()
    {
        $this->setExpectedException($this->exception);
        $this->item->setUploader('GrillyMcGrillerson', '');
    }

    /**
     * @test
     */
    public function itShouldHavePlatform()
    {
        $this->item->setPlatform('web mobile tv');
        $this->assertContains('<video:platform>web mobile tv</video:platform>', $this->item->build());
    }

    /**
     * @test
     */
    public function itShouldHavePlatformAndThrowException()
    {
        $this->setExpectedException($this->exception);
        $this->item->setPlatform('aaaa');
    }

    /**
     * @test
     */
    public function itShouldHavePlatformRelationship()
    {
        $this->item->setPlatform('web mobile tv', 'allow');
        $this->assertContains(
            '<video:platform relationship="allow">web mobile tv</video:platform>',
            $this->item->build()
        );
    }

    /**
     * @test
     */
    public function itShouldHavePlatformRelationshipAndThrowException()
    {
        $this->setExpectedException($this->exception);
        $this->item->setPlatform('web mobile tv', 'AAAAAA');
    }

    /**
     *
     */
    protected function setUp()
    {
        $this->item = new VideoItem(
            'Grilling steaks for summer',
            'http://www.example.com/video123.flv',
            'http://www.example.com/videoplayer.swf?video=123',
            'yes',
            'ap=1'
        );
    }
}
