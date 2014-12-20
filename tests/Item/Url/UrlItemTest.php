<?php

namespace Tests\NilPortugues\Sitemap\Item\Url;

use NilPortugues\Sitemap\Item\Url\UrlItem;

/**
 * Class UrlItemTest
 * @package Tests\NilPortugues\Sitemap\Item\Url\UrlItem
 */
class UrlItemTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var string
     */
    protected $exception = '\NilPortugues\Sitemap\Item\Url\UrlItemException';

    /**
     * @var string
     */
    protected $loc = 'http://google.com';

    /**
     * @var string
     */
    protected $lastmod = '2014-05-10T17:33:30+08:00';

    /**
     * @var UrlItem
     */
    protected $item;

    /**
     * @test
     */
    public function itShouldOutputChangeFreqAlways()
    {
        $this->item->setChangeFreq('always');
        $this->assertContains('<changefreq>always</changefreq>', $this->item->build());
    }

    /**
     * @test
     */
    public function itShouldOutputChangeFreqNever()
    {
        $this->item->setChangeFreq('never');
        $this->assertContains('<changefreq>never</changefreq>', $this->item->build());
    }

    /**
     * @test
     */
    public function itShouldOutputChangeFreqHourly()
    {
        $this->item->setChangeFreq('hourly');
        $this->assertContains('<changefreq>hourly</changefreq>', $this->item->build());
    }

    /**
     * @test
     */
    public function itShouldOutputChangeFreqDaily()
    {
        $this->item->setChangeFreq('daily');
        $this->assertContains('<changefreq>daily</changefreq>', $this->item->build());
    }

    /**
     * @test
     */
    public function itShouldOutputChangeFreqMonthly()
    {
        $this->item->setChangeFreq('monthly');
        $this->assertContains('<changefreq>monthly</changefreq>', $this->item->build());
    }

    /**
     * @test
     */
    public function itShouldOutputChangeFreqYearly()
    {
        $this->item->setChangeFreq('yearly');
        $this->assertContains('<changefreq>yearly</changefreq>', $this->item->build());
    }

    /**
     * @test
     */
    public function itShouldOutputChangeFreqAndThrowException()
    {
        $this->setExpectedException($this->exception);
        $this->item->setChangeFreq('aaaaa');
    }

    /**
     * @test
     */
    public function itShouldOutputPriorityValid1()
    {
        $this->item->setPriority(0.1);
        $this->assertContains('<priority>0.1</priority>', $this->item->build());
    }

    /**
     * @test
     */
    public function itShouldOutputPriorityValid2()
    {
        $this->item->setPriority(0.9);
        $this->assertContains('<priority>0.9</priority>', $this->item->build());
    }

    /**
     * @test
     */
    public function itShouldOutputPriorityAndThrowException1()
    {
        $this->setExpectedException($this->exception);
        $this->item->setPriority(10.5);
    }

    /**
     * @test
     */
    public function itShouldOutputPriorityAndThrowException2()
    {
        $this->setExpectedException($this->exception);
        $this->item->setPriority(-0.1);
    }

    /**
     * @test
     */
    public function itShouldOutputPriorityAndNotPrintPriority()
    {
        $this->item->setPriority(1.0);
        $this->assertNotContains('<priority>1</priority>', $this->item->build());
        $this->assertNotContains('<priority>1.0</priority>', $this->item->build());
    }

    /**
     * @test
     */
    public function itShouldOutputLastMod()
    {
        $this->item->setLastMod($this->lastmod);
        $this->assertContains('<lastmod>' . $this->lastmod . '</lastmod>', $this->item->build());
    }

    /**
     * @test
     */
    public function itShouldOutputLastModAndThrowException()
    {
        $this->setExpectedException($this->exception);
        $this->item->setLastMod('a');
    }

    /**
     * @test
     */
    public function itShouldOutputLocAndThrowException()
    {
        $this->setExpectedException($this->exception);
        new UrlItem('aaaa');
    }

    /**
     *
     */
    protected function setUp()
    {
        $this->item = new UrlItem($this->loc);
    }
}
