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
     *
     */
    public function __construct($loc)
    {
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
            'loc'        => '',
            'lastmod'    => '',
            'changefreq' => '',
            'priority'   => '',
            "\t</url>"
        ];
    }

    /**
     * @param $loc
     *
     * @return $this
     */
    protected function setLoc($loc)
    {
        $this->xml['loc'] = "\t\t<loc>".$loc."</loc>";

        return $this;
    }

    /**
     * @return string
     */
    public function getHeader()
    {
        return '<?xml version="1.0" encoding="UTF-8"?>' . "\n" .
        '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
    }

    /**
     * @return string
     */
    public function getFooter()
    {
        return "</urlset>";
    }

    /**
     * @param $lastmod
     *
     * @return $this
     */
    public function setLastMod($lastmod)
    {
        $this->xml['lastmod'] = "\t\t<lastmod>".$lastmod."</lastmod>";

        return $this;
    }

    /**
     * @param $changefreq
     *
     * @return $this
     */
    public function setChangeFreq($changefreq)
    {
        $this->xml['changefreq'] = "\t\t<changefreq>".$changefreq."</changefreq>";

        return $this;
    }

    /**
     * @param $priority
     *
     * @return $this
     */
    public function setPriority($priority)
    {
        $this->xml['priority'] = "\t\t<priority>".$priority."</priority>";

        return $this;
    }
}
