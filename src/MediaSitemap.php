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

/**
 * Class MediaSitemap
 * @package NilPortugues\Sitemap
 */
class MediaSitemap extends AbstractSitemap
{
    /**
     * Adds a new sitemap item.
     *
     * @param MediaItem $item
     *
     * @return mixed
     */
    public function add($item)
    {
        // TODO: Implement add() method.
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
        . "\n" . '<channel>' . "\n";
    }

    /**
     * @return string
     */
    protected function getFooter()
    {
        return "</channel>\n</rss>";
    }
}
