<?php

namespace Tests\NilPortugues\Sitemap\Item\Media;

use NilPortugues\Sitemap\Item\Media\MediaItem;

/**
 * Class MediaItemTest
 * @package Tests\NilPortugues\Sitemap\Item\Media
 */
class MediaItemTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var string
     */
    protected $link = 'http://www.example.com/examples/mrss/example.html';

    /**
     * @var MediaItem
     */
    protected $item;

    /**
     * @var string
     */
    protected $exception = 'NilPortugues\Sitemap\Item\Media\MediaItemException';

    /**
     *
     */
    public function setUp()
    {
        $this->item = new MediaItem($this->link);
    }


    /**
     * @test
     */
    public function itShouldThrowException()
    {
        $this->setExpectedException($this->exception);
        new MediaItem('aaaa');
    }

    /**
     * @test
     */
    public function itShouldHaveContent()
    {
        $this->item->setContent('video/x-flv');

        $this->assertContains(
            '<media:content type="video/x-flv">',
            $this->item->build()
        );
    }

    /**
     * @test
     */
    public function itShouldHaveContentThrowsException()
    {
        $this->setExpectedException($this->exception);
        $this->item->setContent(null);
    }

    /**
     * @test
     */
    public function itShouldHaveContentAndDuration()
    {
        $this->item->setContent('video/x-flv', 120);

        $this->assertContains(
            '<media:content type="video/x-flv" duration="120">',
            $this->item->build()
        );
    }

    /**
     * @test
     */
    public function itShouldHaveContentAndDurationThrowsException()
    {
        $this->setExpectedException($this->exception);
        $this->item->setContent('video/x-flv', -1);
    }

    /**
     * @test
     */
    public function itShouldHavePlayer()
    {
        $this->item->setPlayer('http://www.example.com/shows/example/video.swf?flash_params');

        $this->assertContains(
            '<media:player url="http://www.example.com/shows/example/video.swf?flash_params" />',
            $this->item->build()
        );
    }

    /**
     * @test
     */
    public function itShouldHavePlayerAndThrowsException()
    {
        $this->setExpectedException($this->exception);
        $this->item->setPlayer('aaaaa');
    }

    /**
     * @test
     */
    public function itShouldHaveTitle()
    {
        $this->item->setTitle('Barbacoas en verano');

        $this->assertContains(
            '<media:title>Barbacoas en verano</media:title>',
            $this->item->build()
        );
    }

    /**
     * @test
     */
    public function itShouldHaveTitleAndThrowsException()
    {
        $this->setExpectedException($this->exception);
        $this->item->setTitle(null);
    }

    /**
     * @test
     */
    public function itShouldHaveDescription()
    {
        $this->item->setDescription('Consigue que los filetes queden perfectamente hechos siempre');

        $this->assertContains(
            '<media:description>Consigue que los filetes queden perfectamente hechos siempre</media:description>',
            $this->item->build()
        );
    }

    /**
     * @test
     */
    public function itShouldHaveDescriptionAndThrowsException()
    {
        $this->setExpectedException($this->exception);
        $this->item->setDescription(null);
    }

    /**
     * @test
     */
    public function itShouldHaveThumbnailWithUrl()
    {
        $this->item->setThumbnail('http://www.example.com/examples/mrss/example.png');

        $this->assertContains(
            '<media:thumbnail url="http://www.example.com/examples/mrss/example.png"/>',
            $this->item->build()
        );
    }

    /**
     * @test
     */
    public function itShouldHaveThumbnailWithUrlAndThrowsException()
    {
        $this->setExpectedException($this->exception);
        $this->item->setThumbnail(null);
    }

    /**
     * @test
     */
    public function itShouldHaveThumbnailWithUrlAndHeight()
    {
        $this->item->setThumbnail('http://www.example.com/examples/mrss/example.png', 120);

        $this->assertContains(
            '<media:thumbnail url="http://www.example.com/examples/mrss/example.png" height="120"/>',
            $this->item->build()
        );
    }

    /**
     * @test
     */
    public function itShouldHaveThumbnailWithUrlAndHeightThrowsException()
    {
        $this->setExpectedException($this->exception);
        $this->item->setThumbnail('http://www.example.com/examples/mrss/example.png', -120);
    }

    /**
     * @test
     */
    public function itShouldHaveThumbnailWithUrlAndWidth()
    {
        $this->item->setThumbnail('http://www.example.com/examples/mrss/example.png', 120, 120);

        $this->assertContains(
            '<media:thumbnail url="http://www.example.com/examples/mrss/example.png" height="120" width="120"/>',
            $this->item->build()
        );
    }

    /**
     * @test
     */
    public function itShouldHaveThumbnailWithUrlAndWidthThrowsException()
    {
        $this->setExpectedException($this->exception);
        $this->item->setThumbnail('http://www.example.com/examples/mrss/example.png', 120, -120);
    }
}
