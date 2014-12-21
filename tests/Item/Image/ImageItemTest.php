<?php

namespace Tests\NilPortugues\Sitemap\Item\Image;

use NilPortugues\Sitemap\Item\Image\ImageItem;

/**
 * Class ImageItemTest
 * @package Tests\NilPortugues\Sitemap\Item\Image
 */
class ImageItemTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ImageItem
     */
    protected $item;

    /**
     * @var string
     */
    protected $loc = 'http://www.example.com/logo.png';

    /**
     * @var string
     */
    protected $exception = 'NilPortugues\Sitemap\Item\Image\ImageItemException';

    /**
     *
     */
    protected function setUp()
    {
        $this->item = new ImageItem($this->loc);
    }

    /**
     * @test
     */
    public function itShouldHaveLoc()
    {
        $this->item->setTitle('Example.com 1 logo');

        $this->assertContains(
            '<image:loc>http://www.example.com/logo.png</image:loc>',
            $this->item->build()
        );
    }

    /**
     * @test
     */
    public function itShouldHaveTitle()
    {
        $this->item->setTitle('Example.com 1 logo');

        $this->assertContains(
            '<image:title><![CDATA[Example.com 1 logo]]></image:title>',
            $this->item->build()
        );
    }

    /**
     * @test
     */
    public function itShouldHaveGeolocation()
    {
        $this->item->setGeoLocation('Limerick, Ireland');
        $this->assertContains(
            '<image:geolocation><![CDATA[Limerick, Ireland]]></image:geolocation>',
            $this->item->build()
        );
    }

    /**
     * @test
     */
    public function itShouldHaveLicense()
    {
        $this->item->setLicense('MIT');

        $this->assertContains(
            '<image:license><![CDATA[MIT]]></image:license>',
            $this->item->build()
        );
    }

    /**
     * @test
     */
    public function itShouldHaveCaption()
    {
        $this->item->setCaption('This place is called Limerick, Ireland');

        $this->assertContains(
            '<image:caption><![CDATA[This place is called Limerick, Ireland]]></image:caption>',
            $this->item->build()
        );
    }

    /**
     * @test
     */
    public function itShouldOutputLocAndThrowException()
    {
        $this->setExpectedException($this->exception);
        new ImageItem('aaaa');
    }

    /**
     * @test
     */
    public function itShouldValidateGeolocationInvalidInput()
    {
        $this->setExpectedException($this->exception);
        $geolocation = new \StdClass();
        $result      = $this->item->setGeoLocation($geolocation);
        $this->assertFalse($result);
    }

    /**
     * @test
     */
    public function itShouldValidateLicense()
    {
        $this->setExpectedException($this->exception);
        $license = new \StdClass();
        $result  = $this->item->setLicense($license);
        $this->assertFalse($result);
    }

    /**
     * @test
     */
    public function itShouldValidateCaptionInvalidInput()
    {
        $this->setExpectedException($this->exception);
        $caption = new \StdClass();
        $result  = $this->item->setCaption($caption);
        $this->assertFalse($result);
    }

    /**
     * @test
     */
    public function itShouldValidateTitleInvalidInput()
    {
        $this->setExpectedException($this->exception);
        $title  = new \StdClass();
        $result = $this->item->setTitle($title);
        $this->assertFalse($result);
    }
}
