<?php
/*
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Validators;


use Sonrisa\Component\Sitemap\Validators\MediaValidator;

/**
 * Class MediaValidatorTest
 * @package Validators
 */
class MediaValidatorTest  extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Sonrisa\Component\Sitemap\Validators\MediaValidator
     */
    protected $validator;

    public function setUp()
    {
        $this->validator = new MediaValidator();
    }

    public function testValidateTitle()
    {
        $result = $this->validator->validateTitle('Some Title text here');
        $this->assertEquals('Some Title text here',$result);
    }

    public function testValidateTitleEmptyString()
    {
        $result = $this->validator->validateTitle('');
        $this->assertEquals('',$result);
    }

    public function testValidateLinkValid()
    {
        $result = $this->validator->validateLink('http://google.com/audio.mp3');
        $this->assertEquals('http://google.com/audio.mp3',$result);
    }

    public function testValidateLinkInvalid()
    {
        $result = $this->validator->validateLink('not-a-valid-url');
        $this->assertEquals('',$result);
    }

    public function testValidatePlayerValid()
    {
        $result = $this->validator->validatePlayer('http://google.com/player.swf');
        $this->assertEquals('http://google.com/player.swf',$result);
    }

    public function testValidatePlayerInvalid()
    {
        $result = $this->validator->validatePlayer('not-a-valid-url');
        $this->assertEquals('',$result);
    }

    public function testValidateDescription()
    {
        $result = $this->validator->validateDescription('Some description text here');
        $this->assertEquals('Some description text here',$result);
    }

    public function testValidateDescriptionEmptyString()
    {
        $result = $this->validator->validateDescription('');
        $this->assertEquals('',$result);
    }

    public function testValidateThumbnailValid()
    {
        $result = $this->validator->validateThumbnail('http://google.com/thumb.jpg');
        $this->assertEquals('http://google.com/thumb.jpg',$result);
    }

    public function testValidateThumbnailInvalid()
    {
        $result = $this->validator->validateThumbnail('not-a-valid-url');
        $this->assertEquals('',$result);
    }


    public function testValidateWidthValid()
    {
        $result = $this->validator->validateWidth(300);
        $this->assertEquals(300,$result);
    }

    public function testValidateWidthInvalid()
    {
        $result = $this->validator->validateWidth('A');
        $this->assertEquals('',$result);
    }

    public function testValidateHeightValid()
    {
        $result = $this->validator->validateHeight(300);
        $this->assertEquals(300,$result);
    }

    public function testValidateHeightInvalid()
    {
        $result = $this->validator->validateHeight('A');
        $this->assertEquals('',$result);
    }
} 