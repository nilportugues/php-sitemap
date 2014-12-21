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
class ImageSitemap extends Sitemap
{
    /**
     * @var int
     */
    protected $imageCount = 0;

    /**
     * Adds a new sitemap item.
     *
     * @param ImageItem $item
     * @param string    $url
     *
     * @return $this
     * @throws SitemapException
     *
     */
    public function add($item, $url = '')
    {
        return $this->delayedAdd($item, $url);
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
     * @return mixed
     */
    public function build()
    {
        foreach ($this->items as $url => $itemArray) {
            $this->createSitemapFile();

            $appendData = "<url>\n<loc>{$url}</loc>\n";
            if (false === $this->isNewFileIsRequired() && false === $this->isSurpassingFileSizeLimit($appendData)) {
                $this->appendToFile($appendData);
            }

            $this->writeXmlBody($itemArray, $url);
        }

        return parent::build();
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
     * @return bool
     */
    protected function isNewFileIsRequired()
    {
        return parent::isNewFileIsRequired() || 1000 === $this->imageCount;
    }

    /**
     * @param array  $itemArray
     * @param string $url
     */
    protected function writeXmlBody(array &$itemArray, $url)
    {
        $this->imageCount = 0;
        foreach ($itemArray as &$item) {
            if (false === $this->isNewFileIsRequired()
                && false === $this->isSurpassingFileSizeLimit($item."</url>\n")
            ) {
                $this->appendToFile($item);
                $this->totalItems++;
            } else {
                $this->createAdditionalSitemapFile($item, $url);
            }

            $this->imageCount++;
        }

        if (false === $this->isNewFileIsRequired()) {
            $this->appendToFile("</url>\n");
        }
    }

    /**
     * @param        $item
     * @param string $url
     */
    protected function createAdditionalSitemapFile($item, $url = '')
    {
        $this->appendToFile("</url>\n");
        parent::build();
        $this->totalFiles++;

        $this->createNewFilePointer();
        $this->appendToFile(
            $this->getHeader()
            . "<url>\n<loc>{$url}</loc>\n"
            . $item
        );
        $this->totalItems = 1;
        $this->imageCount = 0;
    }

    /**
     * @return string
     */
    protected function getFooter()
    {
        return "</urlset>";
    }
}
