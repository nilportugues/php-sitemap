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

use NilPortugues\Sitemap\Item\Image\ImageItem;

/**
 * Class ImageSitemap
 * @package NilPortugues\Sitemap\Item
 */
class ImageSitemap extends AbstractSitemap
{
    /**
     * Adds a new sitemap item.
     *
     * @param ImageItem $item
     *
     * @return mixed
     */
    public function add($item)
    {
        // TODO: Implement add() method.
    }

    /**
     * @param ImageItem $item
     *
     * @throws SitemapException
     */
    protected function validateItemClassType($item)
    {
        if (!($item instanceof ImageItem)) {
            throw new SitemapException(
                "Provided \$item is not instance of \\NilPortugues\\Sitemap\\Item\\Image\\ImageItem."
            );
        }
    }

    /**
     * @return string
     */
    protected function getHeader()
    {
        return '<?xml version="1.0" encoding="UTF-8"?>' . "\n" .
        '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" ' .
        'xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">' . "\n";
    }

    /**
     * @return string
     */
    protected function getFooter()
    {
        return "</urlset>";
    }
}
