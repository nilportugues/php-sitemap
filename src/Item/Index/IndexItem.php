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
            '<sitemap>',
            'loc'     => '',
            'lastmod' => '',
            '</sitemap>',
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
