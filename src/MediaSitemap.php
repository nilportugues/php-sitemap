<?php
/**
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 * Date: 12/20/14
 * Time: 7:44 PM
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace NilPortugues\Sitemap;

use NilPortugues\Sitemap\Item\Media\MediaItem;
use NilPortugues\Sitemap\Item\ValidatorTrait;

/**
 * Class MediaSitemap
 * @package NilPortugues\Sitemap
 */
class MediaSitemap extends Sitemap
{
    /**
     * @var string
     */
    protected $title = '';

    /**
     * @var string
     */
    protected $link = '';

    /**
     * @var string
     */
    protected $description = '';

    /**
     * @param $title
     *
     * @throws SitemapException
     * @return $this
     */
    public function setTitle($title)
    {
        if (false === ValidatorTrait::validateString($title)) {
            throw new SitemapException('Value for setTitle is not valid');
        }

        $this->title = "<title>{$title}</title>";

        return $this;
    }

    /**
     * @param $link
     *
     * @return $this
     * @throws SitemapException
     */
    public function setLink($link)
    {
        if (false === ValidatorTrait::validateLoc($link)) {
            throw new SitemapException('Value for setLink is not a valid URL');
        }

        $this->link = $this->link = "<link>{$link}</link>";

        return $this;
    }

    /**
     * @param $description
     *
     * @throws SitemapException
     * @return $this
     */
    public function setDescription($description)
    {
        if (false === ValidatorTrait::validateString($description)) {
            throw new SitemapException('Value for setDescription is not valid');
        }

        $this->description = "<description>{$description}</description>";

        return $this;
    }

    /**
     * Adds a new sitemap item.
     *
     * @param MediaItem $item
     * @param string    $url
     *
     * @return $this
     * @throws SitemapException
     */
    public function add($item, $url = '')
    {
        return parent::add($item);
    }

    /**
     * @param MediaItem $item
     *
     * @throws SitemapException
     */
    protected function validateItemClassType($item)
    {
        if (!($item instanceof MediaItem)) {
            throw new SitemapException(
                "Provided \$item is not instance of \\NilPortugues\\Sitemap\\Item\\Media\\MediaItem."
            );
        }
    }

    /**
     * @return string
     */
    protected function getHeader()
    {
        return '<?xml version="1.0" encoding="UTF-8"?>' . "\n" .
        '<rss version="2.0" xmlns:media="http://search.yahoo.com/mrss/" xmlns:dcterms="http://purl.org/dc/terms/">'
        . "\n" . '<channel>' . "\n" . $this->title . $this->link . $this->description;
    }

    /**
     * @return string
     */
    protected function getFooter()
    {
        return "</channel>\n</rss>";
    }
}
