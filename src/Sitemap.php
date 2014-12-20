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
     * @param UrlItem $item
     *
     * @return $this
     * @throws SitemapException
     */
    public function add($item)
    {
        $this->validateItemClassType($item);

        if (null === $this->filePointer) {
            $this->filePointer = fopen($this->getFullFilePath(), 'w');
        }

        if (0 === $this->totalItems) {
            $this->createNewFilePointer();
        }

        if (false === $this->isNewFileIsRequired()) {
            $this->appendToFile($item->build());
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