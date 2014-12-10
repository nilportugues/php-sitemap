<?php

namespace Tests\NilPortugues\Sitemap\Item\Url;

use NilPortugues\Sitemap\Item\Url\UrlItemValidator;

/**
 * Class UrlItemValidatorTest
 * @package Tests\NilPortugues\Sitemap\Item\Url
 */
class UrlItemValidatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var UrlItemValidator
     */
    protected $validator;

    /**
     *
     */
    public function setUp()
    {
        $this->validator = UrlItemValidator::getInstance();
    }

    /**
     * @test
     */
    public function itShouldValidateLastmod()
    {
        $result = $this->validator->validatePriority('2014-05-10T17:33:30+08:00');
        $this->assertEmpty($result);
    }

    /**
     * @test
     */
    public function itShouldValidateLastmodInvalid()
    {
        $result = $this->validator->validateLastmod('aaa');
        $this->assertFalse($result);
    }

    /**
     * @test
     */
    public function itShouldValidateChangeFreqInvalid()
    {
        $result = $this->validator->validateChangeFreq('NOT VALID');
        $this->assertFalse($result);
    }

    /**
     * @test
     */
    public function itShouldValidateChangeFreqAlways()
    {
        $result = $this->validator->validateChangeFreq('always');
        $this->assertEquals('always', $result);
    }

    /**
     * @test
     */
    public function itShouldValidateChangeFreqNever()
    {
        $result = $this->validator->validateChangeFreq('never');
        $this->assertEquals('never', $result);
    }

    /**
     * @test
     */
    public function itShouldValidateChangeFreqHourly()
    {
        $result = $this->validator->validateChangeFreq('hourly');
        $this->assertEquals('hourly', $result);
    }

    /**
     * @test
     */
    public function itShouldValidateChangeFreqDaily()
    {
        $result = $this->validator->validateChangeFreq('daily');
        $this->assertEquals('daily', $result);
    }

    /**
     * @test
     */
    public function itShouldValidateChangeFreqMonthly()
    {
        $result = $this->validator->validateChangeFreq('monthly');
        $this->assertEquals('monthly', $result);
    }

    /**
     * @test
     */
    public function itShouldValidateChangeFreqYearly()
    {
        $result = $this->validator->validateChangeFreq('yearly');
        $this->assertEquals('yearly', $result);
    }

    /**
     * @test
     */
    public function itShouldValidatePriorityValid1()
    {
        $result = $this->validator->validatePriority(0.1);
        $this->assertEquals(0.1, $result);
    }

    /**
     * @test
     */
    public function itShouldValidatePriorityValid2()
    {
        $result = $this->validator->validatePriority(0.9);
        $this->assertEquals(0.9, $result);
    }

    /**
     * @test
     */
    public function itShouldValidatePriorityInvalid1()
    {
        $result = $this->validator->validatePriority(10.5);
        $this->assertFalse($result);
    }

    /**
     * @test
     */
    public function itShouldValidatePriorityInvalid2()
    {
        $result = $this->validator->validatePriority(-0.1);
        $this->assertFalse($result);
    }

    /**
     * @test
     */
    public function itShouldValidatePriorityInvalid3()
    {
        $result = $this->validator->validatePriority(1.0);
        $this->assertEmpty($result);
    }
}
