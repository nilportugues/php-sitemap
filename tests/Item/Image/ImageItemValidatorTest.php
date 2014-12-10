<?php

namespace Tests\NilPortugues\Sitemap\Item\Image;

use NilPortugues\Sitemap\Item\Image\ImageItemValidator;

/**
 * Class ImageItemValidatorTest
 * @package Tests\NilPortugues\Sitemap\Item\Image
 */
class ImageItemValidatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ImageItemValidator
     */
    protected $validator;

    /**
     *
     */
    public function setUp()
    {
        $this->validator = ImageItemValidator::getInstance();
    }

    /**
     * @test
     */
    public function itShouldValidateTitleValidInput()
    {
        $title = 'This is the image title';
        $result = $this->validator->validateTitle($title);
        $this->assertEquals($title, $result);
    }

    /**
     * @test
     */
    public function itShouldValidateTitleInvalidInput()
    {
        $title = new \StdClass();
        $result = $this->validator->validateTitle($title);
        $this->assertFalse($result);
    }

    /**
     * @test
     */
    public function itShouldValidateCaptionValidInput()
    {
        $caption = 'This is the caption of the image';
        $result = $this->validator->validateCaption($caption);
        $this->assertEquals($caption, $result);
    }

    /**
     * @test
     */
    public function itShouldValidateCaptionInvalidInput()
    {
        $caption = new \StdClass();
        $result = $this->validator->validateCaption($caption);
        $this->assertFalse($result);
    }

    /**
     * @test
     */
    public function itShouldValidateGeolocationValidInput()
    {
        $geolocation = 'Limerick, Ireland';
        $result = $this->validator->validateGeolocation($geolocation);
        $this->assertEquals($geolocation, $result);
    }

    /**
     * @test
     */
    public function itShouldValidateGeolocationInvalidInput()
    {
        $geolocation = new \StdClass();
        $result = $this->validator->validateGeolocation($geolocation);
        $this->assertFalse($result);
    }

    /**
     * @test
     */
    public function itShouldValidateLicenseValidInput()
    {
        $license = 'MIT';
        $result = $this->validator->validateLicense($license);
        $this->assertEquals($license, $result);
    }

    /**
     * @test
     */
    public function itShouldValidateLicense()
    {
        $license = new \StdClass();
        $result = $this->validator->validateLicense($license);
        $this->assertFalse($result);
    }
}
