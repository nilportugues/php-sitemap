<?php
/*
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace NilPortugues\Sitemap\Item;

use NilPortugues\Sitemap\Validators\NewsValidator;

/**
 * Class NewsItem
 * @package NilPortugues\Sitemap\Items
 */
class NewsItem extends AbstractItem implements ItemInterface
{
    /**
     * @var \NilPortugues\Sitemap\Validators\NewsValidator
     */
    protected $validator;

    /**
     *
     */
    public function __construct()
    {
        $this->validator = NewsValidator::getInstance();
    }

    /**
     * @return string
     */
    public function getHeader()
    {
        return '<?xml version="1.0" encoding="UTF-8"?>'."\n".
        '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:news="http://www.google.com/schemas/sitemap-news/0.9">';
    }

    /**
     * @return string
     */
    public function getFooter()
    {
        return "</urlset>";
    }

    /**
     * @return string
     */
    public function getLoc()
    {
        return (!empty($this->data['loc'])) ? $this->data['loc'] : '';
    }

    /**
     * @param $loc
     *
     * @return $this
     */
    public function setLoc($loc)
    {
        return $this->setField('loc', $loc);
    }

    /**
     * @param $title
     *
     * @return $this
     */
    public function setTitle($title)
    {
        return $this->setField('title', $title);
    }

    /**
     * @param $date
     *
     * @return $this
     */
    public function setPublicationDate($date)
    {
        return $this->setField('publication_date', $date);
    }

    /**
     * @param $name
     *
     * @return $this
     */
    public function setPublicationName($name)
    {
        return $this->setField('name', $name);
    }

    /**
     * @param $language
     *
     * @return $this
     */
    public function setPublicationLanguage($language)
    {
        return $this->setField('language', $language);
    }

    /**
     * @param $access
     *
     * @return $this
     */
    public function setAccess($access)
    {
        return $this->setField('access', $access);
    }

    /**
     * @param $genres
     *
     * @return $this
     */
    public function setGenres($genres)
    {
        return $this->setField('genres', $genres);
    }

    /**
     * @param $keywords
     *
     * @return $this
     */
    public function setKeywords($keywords)
    {
        return $this->setField('keywords', $keywords);
    }

    /**
     * @param $stock_tickers
     *
     * @return $this
     */
    public function setStockTickers($stock_tickers)
    {
        return $this->setField('stock_tickers', $stock_tickers);
    }

    /**
     * Collapses the item to its string XML representation.
     *
     * @return string
     */
    public function build()
    {
        $data = '';
        //Create item ONLY if all mandatory data is present.
        if (
            !empty($this->data['loc'])
            && !empty($this->data['title'])
            && !empty($this->data['publication_date'])
            && !empty($this->data['name'])
            && !empty($this->data['language'])
        ) {
            $xml = array();
            $xml[] = "\t".'<url>';
            $xml[] = "\t\t".'<loc>'.$this->data['loc'].'</loc>';

            $xml[] = "\t\t".'<news:news>';

            if (!empty($this->data['name']) && !empty($this->data['language'])) {
                $xml[] = "\t\t\t".'<news:publication>';
                $xml[] = (!empty($this->data['name'])) ? "\t\t\t\t".'<news:name>'.$this->data['name'].'</news:name>' : '';
                $xml[] = (!empty($this->data['language'])) ? "\t\t\t\t".'<news:language>'.$this->data['language'].'</news:language>' : '';
                $xml[] = "\t\t\t".'</news:publication>';
            }

            $xml[] = (!empty($this->data['access'])) ? "\t\t\t".'<news:access>'.$this->data['access'].'</news:access>' : '';
            $xml[] = (!empty($this->data['genres'])) ? "\t\t\t".'<news:genres>'.$this->data['genres'].'</news:genres>' : '';
            $xml[] = (!empty($this->data['publication_date'])) ? "\t\t\t".'<news:publication_date>'.$this->data['publication_date'].'</news:publication_date>' : '';
            $xml[] = (!empty($this->data['title'])) ? "\t\t\t".'<news:title>'.$this->data['title'].'</news:title>' : '';
            $xml[] = (!empty($this->data['keywords'])) ? "\t\t\t".'<news:keywords>'.$this->data['keywords'].'</news:keywords>' : '';
            $xml[] = (!empty($this->data['stock_tickers'])) ? "\t\t\t".'<news:stock_tickers>'.$this->data['stock_tickers'].'</news:stock_tickers>' : '';

            $xml[] = "\t\t".'</news:news>';
            $xml[] = "\t".'</url>';
            $xml = array_filter($xml);

            $data = implode("\n", $xml);
        }

        return $data;
    }
}
