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

    public function itShouldThrowExceptionOnNewInstanceNoContentUrl()
    {
        $this->setExpectedException($this->exception);
        new VideoItem(
            'Grilling steaks for summer',
            null,
            'http://www.example.com/videoplayer.swf?video=123'
        );
    }

    public function itShouldThrowExceptionOnNewInstanceNoPlayerLoc()
    {
        $this->setExpectedException($this->exception);
        new VideoItem(
            'Grilling steaks for summer',
            'http://www.example.com/video123.flv',
            null
        );
    }
}
