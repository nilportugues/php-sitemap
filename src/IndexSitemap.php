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

use NilPortugues\Sitemap\Item\Index\IndexItem;

/**
 * Class IndexSitemap
 * @package NilPortugues\Sitemap
 */
class IndexSitemap extends Sitemap
{
    /**
     * @param IndexItem $item
     *
     * @throws SitemapException
     */
    protected function validateItemClassType($item)
    {
        if (!($item instanceof IndexItem)) {
            throw new SitemapException(
                "Provided \$item is not instance of \\NilPortugues\\Sitemap\\Item\\Index\\IndexItem."
            );
        }
    }

    /**
     * @return string
     */
    protected function getHeader()
    {
        return '<?xml version="1.0" encoding="UTF-8"?>' . "\n" .
        '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
    }

    /**
     * @return string
     */
    protected function getFooter()
    {
        return "</sitemapindex>";
    }
}
