<?php
namespace Tests\NilPortugues\Sitemap\Item\News;

use NilPortugues\Sitemap\Item\News\NewsItem;

/**
 * Class NewsItemTest
 * @package Tests\NilPortugues\Sitemap\Item\News
 */
class NewsItemTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var string
     */
    protected $language = 'en';

    /**
     * @var string
     */
    protected $name = 'The Example Times';

    /**
     * @var string
     */
    protected $date = '2008-12-23';

    /**
     * @var string
     */
    protected $title = 'Companies A, B in Merger Talks';

    /**
     * @var string
     */
    protected $loc = 'http://www.example.org/business/article55.html';

    /**
     * @var NewsItem
     */
    protected $item;

    /**
     * @var string
     */
    protected $exception = 'NilPortugues\Sitemap\Item\News\NewsItemException';

    /**
     * @test
     */
    public function itShouldThrowExceptionForLoc()
    {
        $this->setExpectedException($this->exception);
        $this->item = new NewsItem(
            null,
            $this->title,
            $this->date,
            $this->name,
            $this->language
        );
    }

    /**
     * @test
     */
    public function itShouldThrowExceptionForTitle()
    {
        $this->setExpectedException($this->exception);
        $this->item = new NewsItem(
            $this->loc,
            null,
            $this->date,
            $this->name,
            $this->language
        );
    }

    /**
     * @test
     */
    public function itShouldThrowExceptionForDate()
    {
        $this->setExpectedException($this->exception);
        $this->item = new NewsItem(
            $this->loc,
            $this->title,
            null,
            $this->name,
            $this->language
        );
    }

    /**
     * @test
     */
    public function itShouldThrowExceptionForPublicationName()
    {
        $this->setExpectedException($this->exception);
        $this->item = new NewsItem(
            $this->loc,
            $this->title,
            $this->date,
            null,
            $this->language
        );
    }

    /**
     * @test
     */
    public function itShouldThrowExceptionForLanguage()
    {
        $this->setExpectedException($this->exception);
        $this->item = new NewsItem(
            $this->loc,
            $this->title,
            $this->date,
            $this->title,
            null
        );
    }

    /**
     * @test
     */
    public function itShouldHaveAccess()
    {
        $this->item->setAccess('Subscription');
        $this->assertContains(
            '<news:access>Subscription</news:access>',
            $this->item->build()
        );

        $this->item->setAccess('Registration');
        $this->assertContains(
            '<news:access>Registration</news:access>',
            $this->item->build()
        );
    }

    /**
     * @test
     */
    public function itShouldHaveAccessAndThrowException()
    {
        $this->setExpectedException($this->exception);
        $this->item->setAccess(null);
    }

    /**
     * @test
     */
    public function itShouldHaveKeywords()
    {
        $this->item->setKeywords('business, merger, acquisition, A, B');
        $this->assertContains(
            '<news:keywords>business, merger, acquisition, A, B</news:keywords>',
            $this->item->build()
        );
    }

    /**
     * @test
     */
    public function itShouldHaveKeywordsAndThrowException()
    {
        $this->setExpectedException($this->exception);
        $this->item->setKeywords(null);
    }

    /**
     * @test
     */
    public function itShouldHaveStockTickers()
    {
        $this->item->setStockTickers('NASDAQ:A, NASDAQ:B');
        $this->assertContains(
            '<news:stock_tickers>NASDAQ:A, NASDAQ:B</news:stock_tickers>',
            $this->item->build()
        );
    }

    /**
     * @test
     */
    public function itShouldHaveStockTickersAndThrowException()
    {
        $this->setExpectedException($this->exception);
        $this->item->setStockTickers(null);
    }

    /**
     * @test
     */
    public function itShouldHaveGenres()
    {
        $this->item->setGenres('PressRelease, Blog');
        $this->assertContains(
            '<news:genres>PressRelease, Blog</news:genres>',
            $this->item->build()
        );
    }

    /**
     * @test
     */
    public function itShouldHaveGenresAndThrowException()
    {
        $this->setExpectedException($this->exception);
        $this->item->setGenres(null);
    }

    /**
     *
     */
    protected function setUp()
    {
        $this->item = new NewsItem(
            $this->loc,
            $this->title,
            $this->date,
            $this->name,
            $this->language
        );
    }
}
