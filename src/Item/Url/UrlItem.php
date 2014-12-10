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
     * @var array
     */
    protected $xml = [];

    /**
     * @var UrlItemValidator
     */
    private $validator;

    /**
     * @param $loc
     */
    public function __construct($loc)
    {
        $this->validator = UrlItemValidator::getInstance();
        $this->xml = $this->reset();
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
            "\t<url>",
            'loc' => '',
            'lastmod' => '',
            'changefreq' => '',
            'priority' => '',
            "\t</url>"
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
        $loc = $this->validator->validateLoc($loc);
        if (false === $loc) {
            throw new UrlItemException(
                sprintf('Provided URL \'%s\' is not a valid value.', $loc)
            );
        }

        $this->xml['loc'] = "\t\t<loc>".$loc."</loc>";

        return $this;
    }

    /**
     * @return string
     */
    public static function getHeader()
    {
        return '<?xml version="1.0" encoding="UTF-8"?>'."\n".
        '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'."\n";
    }

    /**
     * @return string
     */
    public static function getFooter()
    {
        return "</urlset>";
    }

    /**
     * @param $lastmod
     *
     * @throws UrlItemException
     * @return $this
     */
    public function setLastMod($lastmod)
    {
        $lastmod = $this->validator->validateLastmod($lastmod);
        if (false === $lastmod) {
            throw new UrlItemException(
                sprintf('Provided modification date \'%s\' is not a valid value.', $lastmod)
            );
        }

        $this->xml['lastmod'] = "\t\t<lastmod>".$lastmod."</lastmod>";

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
        $changeFreq = $this->validator->validateChangeFreq($changeFreq);
        if (false === $changeFreq) {
            throw new UrlItemException(
                sprintf('Provided change frequency \'%s\' is not a valid value.', $changeFreq)
            );
        }

        $this->xml['changefreq'] = "\t\t<changefreq>".$changeFreq."</changefreq>";

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
        $priority = $this->validator->validatePriority($priority);
        if (false === $priority) {
            throw new UrlItemException(
                sprintf('Provided priority \'%s\' is not a valid value.', $priority)
            );
        }

        if ($priority) {
            $this->xml['priority'] = "\t\t<priority>".$priority."</priority>";
        }

        return $this;
    }
}
