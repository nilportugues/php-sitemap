<?php
/*
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace NilPortugues\Sitemap\Item\Index;

use NilPortugues\Sitemap\Item\Url\UrlItem;
use NilPortugues\Sitemap\Item\Url\UrlItemException;
use NilPortugues\Sitemap\Item\Url\UrlItemValidator;

/**
 * Class IndexItem
 * @package NilPortugues\Sitemap\Items
 */
class IndexItem extends UrlItem
{
    /**
     * @var UrlItemValidator
     */
    protected $validator;

    /**
     * @var string
     */
    protected $exceptionMessage = 'Operation not supported for Index Sitemaps';

    /**
     * Resets the data structure used to represent the item as XML.
     *
     * @return array
     */
    protected function reset()
    {
        return [
            "\t".'<sitemap>',
            'loc'     => '',
            'lastmod' => '',
            "\t".'</sitemap>',
        ];
    }

    /**
     * @param $loc
     *
     * @throws IndexItemException
     * @return $this
     */
    protected function setLoc($loc)
    {
        try {
            parent::setLoc($loc);
        } catch (UrlItemException $e) {
            throw new IndexItemException($e->getMessage());
        }

        return $this;
    }

    /**
     * @return string
     */
    public static function getHeader()
    {
        return '<?xml version="1.0" encoding="UTF-8"?>'."\n".
        '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'."\n";
    }

    /**
     * @return string
     */
    public static function getFooter()
    {
        return "</sitemapindex>";
    }

    /**
     * @param $lastmod
     *
     * @throws IndexItemException
     * @return $this
     */
    public function setLastMod($lastmod)
    {
        try {
            parent::setLastMod($lastmod);
        } catch (UrlItemException $e) {
            throw new IndexItemException($e->getMessage());
        }

        return $this;
    }

    /**
     * @param $priority
     *
     * @throws IndexItemException
     */
    public function setPriority($priority)
    {
        throw new IndexItemException($this->exceptionMessage);
    }

    /**
     * @param $priority
     *
     * @throws IndexItemException
     */
    public function setChangeFreq($changeFreq)
    {
        throw new IndexItemException($this->exceptionMessage);
    }
}
