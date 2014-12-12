<?php
/*
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace NilPortugues\Sitemap\Item\News;

use NilPortugues\Sitemap\Item\AbstractItem;

/**
 * Class NewsItem
 * @package NilPortugues\Sitemap\Items
 */
class NewsItem extends AbstractItem
{
    /**
     * @var NewsItemValidator
     */
    protected $validator;

    /**
     * @var string
     */
    protected $exception = 'NilPortugues\Sitemap\Item\News\NewsItemException';

    /**
     * @param $loc
     * @param $title
     * @param $publicationDate
     * @param $name
     * @param $language
     */
    public function __construct($loc, $title, $publicationDate, $name, $language)
    {
        $this->validator = NewsItemValidator::getInstance();
        $this->xml       = $this->reset();
        $this->setLoc($loc);
        $this->setTitle($title);
        $this->setPublicationDate($publicationDate);
        $this->setPublication($name, $language);
    }

    /**
     * Resets the data structure used to represent the item as XML.
     *
     * @return array
     */
    protected function reset()
    {
        return [
            "\t".'<url>',
            'loc'              => '',
            "\t\t".'<news:news>',
            'name'             => '',
            'access'           => '',
            'genres'           => '',
            'publication_date' => '',
            'title'            => '',
            'keywords'         => '',
            'stock_tickers'    => '',
            "\t\t".'</news:news>',
            "\t".'</url>',
        ];
    }

    /**
     * @param $loc
     *
     * @throws NewsItemException
     * @return $this
     */
    protected function setLoc($loc)
    {
        $this->writeFullTag(
            $loc,
            'loc',
            false,
            'loc',
            $this->validator,
            'validateLoc',
            $this->exception,
            'Provided URL is not a valid value.'
        );

        return $this;
    }

    /**
     * @param $title
     *
     * @throws NewsItemException
     * @return $this
     */
    protected function setTitle($title)
    {
        $this->writeFullTag(
            $title,
            'title',
            false,
            'news:title',
            $this->validator,
            'validateTitle',
            $this->exception,
            'Provided title is not a valid value.'
        );

        return $this;
    }

    /**
     * @param $date
     *
     * @throws NewsItemException
     * @return $this
     */
    protected function setPublicationDate($date)
    {
        $this->writeFullTag(
            $date,
            'publication_date',
            false,
            'news:publication_date',
            $this->validator,
            'validatePublicationDate',
            $this->exception,
            'Provided publication date is not a valid value.'
        );

        return $this;
    }

    /**
     * @param $name
     * @param $language
     *
     * @return $this
     */
    protected function setPublication($name, $language)
    {
        $this->xml['name'] = "\t\t\t".'<news:publication>'."\n";
        $this->setPublicationName($name);
        $this->setPublicationLanguage($language);
        $this->xml['name'] .= "\t\t\t".'</news:publication>'."\n";

        return $this;
    }

    /**
     * @param $name
     *
     * @throws NewsItemException
     * @return $this
     */
    protected function setPublicationName($name)
    {
        $this->writeFullTag(
            $name,
            'name',
            false,
            'news:name',
            $this->validator,
            'validateName',
            $this->exception,
            'Provided publication name is not a valid value.'
        );

        return $this;
    }

    /**
     * @param $language
     *
     * @throws NewsItemException
     * @return $this
     */
    protected function setPublicationLanguage($language)
    {
        $this->writeFullTag(
            $language,
            'name',
            false,
            'news:language',
            $this->validator,
            'validateLanguage',
            $this->exception,
            'Provided publication language is not a valid value.'
        );

        return $this;
    }

    /**
     * @return string
     */
    public static function getHeader()
    {
        return '<?xml version="1.0" encoding="UTF-8"?>'."\n".
        '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" '.
        'xmlns:news="http://www.google.com/schemas/sitemap-news/0.9">'."\n";
    }

    /**
     * @return string
     */
    public static function getFooter()
    {
        return "</urlset>";
    }

    /**
     * @param $access
     *
     * @throws NewsItemException
     * @return $this
     */
    public function setAccess($access)
    {
        $this->writeFullTag(
            $access,
            'access',
            false,
            'news:access',
            $this->validator,
            'validateAccess',
            $this->exception,
            'Provided access date is not a valid value.'
        );

        return $this;
    }

    /**
     * @param $genres
     *
     * @return $this
     * @throws NewsItemException
     */
    public function setGenres($genres)
    {
        $this->writeFullTag(
            $genres,
            'genres',
            false,
            'news:genres',
            $this->validator,
            'validateGenres',
            $this->exception,
            'Provided genres list is not a valid value.'
        );

        return $this;
    }

    /**
     * @param $keywords
     *
     * @return $this
     * @throws NewsItemException
     */
    public function setKeywords($keywords)
    {
        $this->writeFullTag(
            $keywords,
            'keywords',
            false,
            'news:keywords',
            $this->validator,
            'validateKeywords',
            $this->exception,
            'Provided keyword list is not a valid value.'
        );

        return $this;
    }

    /**
     * @param $stockTickers
     *
     * @throws NewsItemException
     * @return $this
     */
    public function setStockTickers($stockTickers)
    {
        $this->writeFullTag(
            $stockTickers,
            'stock_tickers',
            false,
            'news:stock_tickers',
            $this->validator,
            'validateStockTickers',
            $this->exception,
            'Provided stock tickers is not a valid value.'
        );

        return $this;
    }
}
