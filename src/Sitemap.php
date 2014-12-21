<?php
/**
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 * Date: 12/20/14
 * Time: 7:45 PM
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace NilPortugues\Sitemap;

use NilPortugues\Sitemap\Item\Url\UrlItem;

/**
 * Class Sitemap
 * @package NilPortugues\Sitemap
 */
class Sitemap extends AbstractSitemap
{
    /**
     * Adds a new sitemap item.
     *
     * @param $item
     * @param string  $url
     *
     * @return $this
     */
    public function add($item, $url = '')
    {
        $this->validateItemClassType($item);
        $this->createSitemapFile();

        $xmlData = $item->build();
        if (false === $this->isNewFileIsRequired() && false === $this->isSurpassingFileSizeLimit($xmlData)) {
            $this->appendToFile($xmlData);
            $this->totalItems++;
            return $this;
        }

        $this->createAdditionalSitemapFile($item);

        return $this;
    }

    /**
     * @param $item
     *
     * @throws SitemapException
     */
    protected function validateItemClassType($item)
    {
        if (!($item instanceof UrlItem)) {
            throw new SitemapException(
                "Provided \$item is not instance of \\NilPortugues\\Sitemap\\Item\\Url\\UrlItem."
            );
        }
    }

    /**
     * @return string
     */
    protected function getHeader()
    {
        return '<?xml version="1.0" encoding="UTF-8"?>' . "\n" .
        '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
    }

    /**
     * @return string
     */
    protected function getFooter()
    {
        return "</urlset>";
    }
}
