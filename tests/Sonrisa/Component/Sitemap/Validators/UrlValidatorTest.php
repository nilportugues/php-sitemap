<?php
/*
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Validators;

use Sonrisa\Component\Sitemap\Validators\UrlValidator;

/**
 * Class UrlValidatorTest
 * @package Validators
 */
class UrlValidatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Sonrisa\Component\Sitemap\Validators\UrlValidator
     */
    protected $validator;

    public function setUp()
    {
        $this->validator = UrlValidator::getInstance();
    }

    public function testValidateChangefreqAlways()
    {
        $result = $this->validator->validateChangefreq('always');
        $this->assertEquals('always', $result);
    }

    public function testValidateChangefreqNever()
    {
        $result = $this->validator->validateChangefreq('never');
        $this->assertEquals('never', $result);
    }

    public function testValidateChangefreqHourly()
    {
        $result = $this->validator->validateChangefreq('hourly');
        $this->assertEquals('hourly', $result);
    }

    public function testValidateChangefreqDaily()
    {
        $result = $this->validator->validateChangefreq('daily');
        $this->assertEquals('daily', $result);
    }

    public function testValidateChangefreqMonthly()
    {
        $result = $this->validator->validateChangefreq('monthly');
        $this->assertEquals('monthly', $result);
    }

    public function testValidateChangefreqYearly()
    {
        $result = $this->validator->validateChangefreq('yearly');
        $this->assertEquals('yearly', $result);
    }

    public function testValidateLastmodValidFormat1()
    {
        $date = new \DateTime('now');
        $date = $date->format('c');
        $result = $this->validator->validateLastmod($date);

        $this->assertEquals($date, $result);

    }

    public function testValidateLastmodValidFormat2()
    {
        $date = new \DateTime('now');
        $date = $date->format('Y-m-d\TH:i:sP');
        $result = $this->validator->validateLastmod($date);

        $this->assertEquals($date, $result);

    }

    public function testValidateLastmodValidFormat3()
    {
        $date = new \DateTime('now');
        $date = $date->format('Y-m-d');

        $result = $this->validator->validateLastmod($date);

        $this->assertEquals($date, $result);
    }

    public function testValidateLastmodInvalidFormat()
    {
        $date = '2A-13-03';

        $result = $this->validator->validateLastmod($date);

        $this->assertEquals('', $result);
    }

    public function testValidatePriorityValid1()
    {
        $result = $this->validator->validatePriority(0.1);
        $this->assertEquals(0.1, $result);
    }

    public function testValidatePriorityValid2()
    {
        $result = $this->validator->validatePriority(0.9);
        $this->assertEquals(0.9, $result);
    }

    public function testValidatePriorityInvalid1()
    {
        $result = $this->validator->validatePriority(10.5);
        $this->assertEquals('', $result);
    }

    public function testValidatePriorityInvalid2()
    {
        $result = $this->validator->validatePriority(-0.1);
        $this->assertEquals('', $result);
    }

}
