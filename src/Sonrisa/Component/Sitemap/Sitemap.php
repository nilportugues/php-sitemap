<?php
/*
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Sonrisa\Component\Sitemap;

use Sonrisa\Component\Sitemap\Items\UrlItem;

/**
 * Class Sitemap
 * @package Sonrisa\Component\Sitemap
 */
class Sitemap extends AbstractSitemap implements SitemapInterface
{
    /**
     * @var UrlItem
     */
    protected $lastItem;

    /**
     * @param  UrlItem $item
     * @return $this
     */
    public function add(UrlItem $item)
    {
        $loc = $item->getLoc();

        if (!empty($loc) && !in_array($loc, $this->usedUrls, true)) {

            //Mark URL as used.
            $this->usedUrls[] = $loc;

            //Check constrains
            $current = $this->currentFileByteSize + $item->getHeaderSize() + $item->getFooterSize();

            //Check if new file is needed or not. ONLY create a new file if the constrains are met.
            if (($current <= $this->maxFilesize) && ($this->totalItems <= $this->maxItemsPerSitemap)) {
                //add bytes to total
                $this->currentFileByteSize = $item->getItemSize();

                //add item to the item array
                $built = $item->build();
                if (!empty($built)) {
                    $this->items[] = $built;

                    $this->files[$this->totalFiles] = implode("\n", $this->items);

                    $this->totalItems++;
                }
            } else {
                //reset count
                $this->currentFileByteSize = 0;

                //copy items to the files array.
                $this->totalFiles = $this->totalFiles + 1;
                $this->files[$this->totalFiles] = implode("\n", $this->items);

                //reset the item count by inserting the first new item
                $this->items = array($item);
                $this->totalItems = 1;
            }
            $this->lastItem = $item;
        }

        return $this;
    }

    /**
     * @return array
     */
    public function build()
    {
        return self::buildFiles($this->lastItem);
    }
}
