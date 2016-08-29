<?php

namespace itShoulds\NilPortugues\Sitemap\Item;

use NilPortugues\Sitemap\Item\ValidatorTrait;

/**
 * Class ValidatorTraititShould.
 */
class ValidatorTraitTest extends \PHPUnit_Framework_TestCase
{
    use ValidatorTrait;

    protected $testLocs = [
        [
            'http://example.com/product/Sombrano-Ø-350-cmc',
            'http://example.com/product/Sombrano-%C3%98-350-cmc'
        ],
        [
            'https://www.example.com/foo/bär/index.php?query=string#anchor',
            'https://www.example.com/foo/b%C3%A4r/index.php?query=string#anchor',
        ],
        [
            'https://www.example.com/foo/bär/index.php#anchor',
            'https://www.example.com/foo/b%C3%A4r/index.php#anchor',
        ],
        [
            'https://www.example.com/foo/bär/index.php',
            'https://www.example.com/foo/b%C3%A4r/index.php'
        ],
        [
            'https://www.example.com',
            'https://www.example.com'
        ],
        [
            'http://www.example.com/ümlaut?query=param&foo=bar#anchor',
            'http://www.example.com/%C3%BCmlaut?query=param&amp;foo=bar#anchor',
        ],
        [
            'http://www.example.com:8080/ümlaut?query=param&foo=bar',
            'http://www.example.com:8080/%C3%BCmlaut?query=param&amp;foo=bar',
        ],
        [
            'http://127.0.0.1:8080/ümlaut?query=param&foo=bar',
            'http://127.0.0.1:8080/%C3%BCmlaut?query=param&amp;foo=bar',
        ],
        [
            'http://xn--exmple-cua.com:8080/ümlaut?query=param&foo=bar',
            'http://xn--exmple-cua.com:8080/%C3%BCmlaut?query=param&amp;foo=bar',
        ],
        [
            'http://[2001:0db8:85a3:08d3:1319:8a2e:0370:7344]:8080/ümlaut?query=param&foo=bar',
            'http://[2001:0db8:85a3:08d3:1319:8a2e:0370:7344]:8080/%C3%BCmlaut?query=param&amp;foo=bar',
        ]

    ];

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
    public function itShouldValidateTestLocs()
    {
        foreach ($this->testLocs as $test) {
            $result = $this->validateLoc($test[0]);
            $this->assertEquals($test[1], $result);
        }
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
        $date = new \DateTime('now');
        $date = $date->format('c');
        $result = $this->validateDate($date);

        $this->assertEquals($date, $result);
    }

    /**
     * @test
     */
    public function itShouldValidateDateValidFormat2()
    {
        $date = new \DateTime('now');
        $date = $date->format('Y-m-d\TH:i:sP');
        $result = $this->validateDate($date);

        $this->assertEquals($date, $result);
    }

    /**
     * @test
     */
    public function itShouldValidateDateValidFormat3()
    {
        $date = new \DateTime('now');
        $date = $date->format('Y-m-d');
        $result = $this->validateDate($date);

        $this->assertEquals($date, $result);
    }

    /**
     * @test
     */
    public function itShouldValidateDateInvalidFormat()
    {
        $date = '2A-13-03';
        $result = $this->validateDate($date);

        $this->assertEquals(false, $result);
    }
}
