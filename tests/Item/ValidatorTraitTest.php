<?php

namespace itShoulds\NilPortugues\Sitemap\Item;

use NilPortugues\Sitemap\Item\ValidatorTrait;

/**
 * Class ValidatorTraititShould
 * @package itShoulds\NilPortugues\Sitemap\Item
 */
class ValidatorTraitTest extends \PHPUnit_Framework_TestCase
{
    use ValidatorTrait;

    public function __construct()
    {
    }

    /**
     * @test
     */
    public function itShouldValidateLoc()
    {
        $result = $this->validateLoc('http://google.com/news');
        $this->assertEquals('http://google.com/news', $result);
    }

    /**
     * @test
     */
    public function itShouldNotValidateLoc()
    {
        $result = $this->validateLoc('not-a-url');
        $this->assertEquals(false, $result);
    }

    /**
     * @test
     */
    public function itShouldValidateDateValidFormat1()
    {
        $date   = new \DateTime('now');
        $date   = $date->format('c');
        $result = $this->validateDate($date);

        $this->assertEquals($date, $result);
    }

    /**
     * @test
     */
    public function itShouldValidateDateValidFormat2()
    {
        $date   = new \DateTime('now');
        $date   = $date->format('Y-m-d\TH:i:sP');
        $result = $this->validateDate($date);

        $this->assertEquals($date, $result);
    }

    /**
     * @test
     */
    public function itShouldValidateDateValidFormat3()
    {
        $date   = new \DateTime('now');
        $date   = $date->format('Y-m-d');
        $result = $this->validateDate($date);

        $this->assertEquals($date, $result);
    }

    /**
     * @test
     */
    public function itShouldValidateDateInvalidFormat()
    {
        $date   = '2A-13-03';
        $result = $this->validateDate($date);

        $this->assertEquals(false, $result);
    }
}
