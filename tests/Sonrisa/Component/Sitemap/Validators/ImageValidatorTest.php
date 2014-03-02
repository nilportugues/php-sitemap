<?php
/*
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Validators;

use Sonrisa\Component\Sitemap\Validators\ImageValidator;

/**
 * Class ImageValidatorTest
 * @package Validators
 */
class ImageValidatorTest  extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Sonrisa\Component\Sitemap\Validators\ImageValidator
     */
    protected $validator;

    public function setUp()
    {
        $this->validator = ImageValidator::getInstance();
    }

    public function testValidateTitleValidInput()
    {
        $title = 'This is the image title';
        $result = $this->validator->validateTitle($title);

        $this->assertEquals($title,$result);
    }

    public function testValidateTitleInvalidInput()
    {
        $title = new \StdClass();
        $result = $this->validator->validateTitle($title);

        $this->assertEquals('',$result);
    }

    public function testValidateCaptionValidInput()
    {
        $caption = 'This is the caption of the image';
        $result = $this->validator->validateCaption($caption);

        $this->assertEquals($caption,$result);
    }

    public function testValidateCaptionInvalidInput()
    {
        $caption = new \StdClass();
        $result = $this->validator->validateCaption($caption);

        $this->assertEquals('',$result);
    }

    public function validateGeolocationValidInput()
    {
        $geolocation = 'Limerick, Ireland';
        $result = $this->validator->validateGeolocation($geolocation);

        $this->assertEquals($geolocation,$result);
    }

    public function validateGeolocationInvalidInput()
    {
        $geolocation = new \StdClass();
        $result = $this->validator->validateGeolocation($geolocation);

        $this->assertEquals('',$result);
    }

    public function validateLicenseValidInput()
    {
        $license = 'MIT';
        $result = $this->validator->validateLicense($license);

        $this->assertEquals($license,$result);
    }

    public function validateLicense()
    {
        $license =  new \StdClass();
        $result = $this->validator->validateLicense($license);

        $this->assertEquals('',$result);
    }
}
