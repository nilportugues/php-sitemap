<?php

namespace Tests\NilPortugues\Sitemap\Item\Index;

use NilPortugues\Sitemap\Item\Index\IndexItem;

/**
 * Class IndexItemTest
 * @package Tests\NilPortugues\Sitemap\Item\Index
 */
class IndexItemTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var string
     */
    protected $exception = '\NilPortugues\Sitemap\Item\Index\IndexItemException';

    /**
     * @var string
     */
    protected $loc = 'http://google.com';

    /**
     * @var string
     */
    protected $lastmod = '2014-05-10T17:33:30+08:00';

    /**
     * @var IndexItem
     */
    protected $item;

    /**
     * @test
     */
    public function itShouldThrowExceptionOnChangeFreq()
    {
        $this->setExpectedException($this->exception);
        $this->item->setChangeFreq('always');
    }

    /**
     * @test
     */
    public function itShouldThrowExceptionOnPriority()
    {
        $this->setExpectedException($this->exception);
        $this->item->setPriority(0.1);
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
        new IndexItem('aaaa');
    }

    /**
     *
     */
    protected function setUp()
    {
        $this->item = new IndexItem($this->loc);
    }
}
