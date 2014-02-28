<?php
/*
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Sonrisa\Component\Sitemap;

use Sonrisa\Component\Sitemap\Items\NewsItem;
use Sonrisa\Component\Sitemap\Validators\NewsValidator;

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
    protected $max_items_per_sitemap = 1000;

    /**
     * @var ImageItem
     */
    protected $lastItem;

    /**
     *
     */
    public function __construct()
    {
        $this->validator = new NewsValidator();
    }

    /**
     * @param NewsItem $item
     * @return $this
     */
    public function add(NewsItem $item)
    {
        $loc = $item->getLoc();

        if (!empty($loc) && !in_array($loc,$this->used_urls,true)) {

            //Mark URL as used.
            $this->used_urls[] = $loc;

            //Check constrains
            $current = $this->current_file_byte_size + $item->getHeaderSize() + $item->getFooterSize();

            //Check if new file is needed or not. ONLY create a new file if the constrains are met.
            if ( ($current <= $this->max_filesize) && ( $this->total_items <= $this->max_items_per_sitemap) ) {

                //add bytes to total
                $this->current_file_byte_size = $item->getItemSize();

                //add item to the item array
                $built = $item->build();
                if (!empty($built)) {

                    $this->items[] = $built;

                    $this->files[$this->total_files] = implode("\n",$this->items);

                    $this->total_items++;
                }

            } else {
                //reset count
                $this->current_file_byte_size = 0;

                //copy items to the files array.
                $this->total_files=$this->total_files+1;
                $this->files[$this->total_files] = implode("\n",$this->items);

                //reset the item count by inserting the first new item
                $this->items = array($item);
                $this->total_items=1;
            }
            $this->lastItem = $item;
        }
        
        return $this;
    }


    /**
     * @param NewsCollection $collection
     * @return $this
     */
    public function addCollection(NewsCollection $collection)
    {
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
