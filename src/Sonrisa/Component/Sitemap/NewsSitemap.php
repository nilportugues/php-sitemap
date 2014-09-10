<?php
/*
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Sonrisa\Component\Sitemap;

use Sonrisa\Component\Sitemap\Items\NewsItem;

/**
 * @package Sonrisa\Component\Sitemap
 *
 * When creating your News Sitemap, please keep in mind the following:
 *
 *  -   Your News Sitemap should contain only URLs for your articles published in the last two days.
 *
 *  -    You're encouraged to update your News Sitemap continually with fresh articles as they're published.
 *      Google News crawls News Sitemaps as often as it crawls the rest of your site.
 *
 *  -   A News Sitemap can contain no more than 1,000 URLs. If you want to include more, you can break these URLs
 *      into multiple Sitemaps, and use a Sitemap index file to manage them. Use the XML format provided in the
 *      Sitemap protocol.
 *
 *  Once you've created your Sitemap, upload it to the highest-level directory that contains your news articles.
 *
 */
class NewsSitemap extends AbstractSitemap implements SitemapInterface
{
    /**
     * @var int
     */
    protected $maxItemsPerSitemap = 1000;

    /**
     * @var NewsItem
     */
    protected $lastItem;

    /**
     * @param  NewsItem $item
     * @return $this
     */
    public function add(NewsItem $item)
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
