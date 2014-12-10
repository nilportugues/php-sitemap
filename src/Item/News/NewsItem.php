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
        $loc = $this->validator->validateLoc($loc);
        if (false === $loc) {
            throw new NewsItemException(
                sprintf('Provided URL \'%s\' is not a valid value.', $loc)
            );
        }

        $this->xml['loc'] = "\t\t<loc>".$loc."</loc>";

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
        $title = $this->validator->validateTitle($title);
        if (false === $title) {
            throw new NewsItemException(
                sprintf('Provided title \'%s\' is not a valid value.', $title)
            );
        }
        $this->xml['title'] = "\t\t\t".'<news:title>'.$title.'</news:title>';

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
        $date = $this->validator->validatePublicationDate($date);
        if (false === $date) {
            throw new NewsItemException(
                sprintf('Provided publication date \'%s\' is not a valid value.', $date)
            );
        }
        $this->xml['publication_date'] = "\t\t\t".'<news:publication_date>'.$date.'</news:publication_date>';

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
        $name = $this->validator->validateName($name);
        if (false === $name) {
            throw new NewsItemException(
                sprintf('Provided publication name \'%s\' is not a valid value.', $name)
            );
        }

        $this->xml['name'] .= "\t\t\t\t".'<news:name>'.$name.'</news:name>'."\n";

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
        $language = $this->validator->validateLanguage($language);
        if (false === $language) {
            throw new NewsItemException(
                sprintf('Provided publication language \'%s\' is not a valid value.', $language)
            );
        }
        $this->xml['name'] .= "\t\t\t\t".'<news:language>'.$language.'</news:language>'."\n";

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
        $access = $this->validator->validateAccess($access);
        if (false === $access) {
            throw new NewsItemException(
                sprintf('Provided access \'%s\' is not a valid value.', $access)
            );
        }
        $this->xml['access'] = "\t\t\t".'<news:access>'.$access.'</news:access>';

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
        $genres = $this->validator->validateGenres($genres);
        if (false === $genres) {
            throw new NewsItemException(
                sprintf('Provided genres list \'%s\' is not a valid value.', $genres)
            );
        }
        $this->xml['genres'] = "\t\t\t".'<news:genres>'.$genres.'</news:genres>';

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
        $keywords = $this->validator->validateKeywords($keywords);
        if (false === $keywords) {
            throw new NewsItemException(
                sprintf('Provided keyword list \'%s\' is not a valid value.', $keywords)
            );
        }
        $this->xml['keywords'] = "\t\t\t".'<news:keywords>'.$keywords.'</news:keywords>';

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
        $stockTickers = $this->validator->validateKeywords($stockTickers);
        if (false === $stockTickers) {
            throw new NewsItemException(
                sprintf('Provided stock tickers \'%s\' are not a valid value.', $stockTickers)
            );
        }
        $this->xml['stock_tickers'] = "\t\t\t".'<news:stock_tickers>'.$stockTickers.'</news:stock_tickers>';

        return $this;
    }
}
