<?php
/*
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace NilPortugues\Sitemap\Item\Url;

use NilPortugues\Sitemap\Item\AbstractItem;

/**
 * Class UrlItem
 * @package NilPortugues\Sitemap\Items
 */
class UrlItem extends AbstractItem
{
    /**
     * @var UrlItemValidator
     */
    private $validator;

    /**
     * @var string
     */
    private $exception = '\NilPortugues\Sitemap\Item\Url\UrlItemException';

    /**
     * @param $loc
     */
    public function __construct($loc)
    {
        $this->validator = UrlItemValidator::getInstance();
        self::$xml       = $this->reset();
        $this->setLoc($loc);
    }

    /**
     * Resets the data structure used to represent the item as XML.
     *
     * @return array
     */
    protected function reset()
    {
        return [
            "<url>",
            'loc'        => '',
            'lastmod'    => '',
            'changefreq' => '',
            'priority'   => '',
            "</url>"
        ];
    }

    /**
     * @param $loc
     *
     * @throws UrlItemException
     * @return $this
     */
    protected function setLoc($loc)
    {
        self::writeFullTag(
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
     * @param $lastmod
     *
     * @throws UrlItemException
     * @return $this
     */
    public function setLastMod($lastmod)
    {
        self::writeFullTag(
            $lastmod,
            'lastmod',
            false,
            'lastmod',
            $this->validator,
            'validateLastmod',
            $this->exception,
            'Provided modification date is not a valid value.'
        );

        return $this;
    }

    /**
     * @param $changeFreq
     *
     * @throws UrlItemException
     * @return $this
     */
    public function setChangeFreq($changeFreq)
    {
        self::writeFullTag(
            $changeFreq,
            'changefreq',
            false,
            'changefreq',
            $this->validator,
            'validateChangeFreq',
            $this->exception,
            'Provided change frequency is not a valid value.'
        );

        return $this;
    }

    /**
     * @param $priority
     *
     * @throws UrlItemException
     * @return $this
     */
    public function setPriority($priority)
    {
        self::writeFullTag(
            $priority,
            'priority',
            false,
            'priority',
            $this->validator,
            'validatePriority',
            $this->exception,
            'Provided priority is not a valid value.'
        );

        return $this;
    }
}
