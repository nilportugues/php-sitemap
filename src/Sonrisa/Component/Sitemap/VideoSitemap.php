<?php
/*
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Sonrisa\Component\Sitemap;

use Sonrisa\Component\Sitemap\Items\VideoItem;
use Sonrisa\Component\Sitemap\Validators\SharedValidator;

/**
 * Class VideoSitemap
 * @package Sonrisa\Component\Sitemap
 */
class VideoSitemap extends AbstractSitemap implements SitemapInterface
{
    /**
     * @var string
     */
    protected $urlHeader = "\t<url>";

    /**
     * @var string
     */
    protected $urlFooter = "\t</url>";

    /**
     * @var array
     */
    protected $used_videos = array();

    /**
     * @var VideoItem
     */
    protected $lastItem;

    /**
     * @param  VideoItem   $item
     * @param  string      $url
     * @return VideoSitemap
     */
    public function add(VideoItem $item,$url='')
    {
        $url = SharedValidator::validateLoc($url);
        if ( empty($this->used_videos[$url]) ) {
            $this->used_videos[$url] = array();

        }

        $title = $item->getTitle();
        $player_loc = $item->getPlayerLoc();
        $content_loc = $item->getContentLoc();

        if
        (
            !empty($url) && !empty($title) &&
            (!empty($player_loc) || !empty($content_loc)) &&
            (!in_array($player_loc,$this->used_videos[$url],true) || !in_array($content_loc,$this->used_videos[$url],true))
        )
        {

            //Mark URL as used.
            $this->used_urls[] = $url;
            $this->used_videos[$url][] = $player_loc;
            $this->used_videos[$url][] = $content_loc;

            $this->items[$url] = array();

            //Check constrains
            $current = $this->calculateSize($item,$url);

            //Check if new file is needed or not. ONLY create a new file if the constrains are met.
            if ( ($current <= $this->max_filesize) && ( $this->total_items <= $this->max_items_per_sitemap)) {
                //add bytes to total
                $this->current_file_byte_size = $item->getItemSize();

                //add item to the item array
                $built = $item->build();
                if (!empty($built)) {
                    $this->items[$url][] = $built;

                    $this->files[$this->total_files][$url][] = implode("\n",$this->items[$url]);

                    $this->total_items++;
                }
            } else {
                //reset count
                $this->current_file_byte_size = 0;

                //copy items to the files array.
                $this->total_files=$this->total_files+1;
                $this->files[$this->total_files][$url][] = implode("\n",$this->items[$url]);

                //reset the item count by inserting the first new item
                $this->items = array($item);
                $this->total_items=1;
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
        $output = array();

        if (!empty($this->files) && !empty($this->lastItem)) {
            foreach ($this->files as $file) {
                $fileData = array();
                $fileData[] = $this->lastItem->getHeader();

                foreach ($file as $url => $urlImages) {
                    if (!empty($urlImages) && !empty($url)) {
                        $fileData[] = $this->urlHeader;
                        $fileData[] = "\t\t<loc>".$url."</loc>";
                        $fileData[] = implode("\n",$urlImages);
                        $fileData[] = $this->urlFooter;
                    }
                }

                $fileData[] = $this->lastItem->getFooter();

                $output[] = implode("\n",$fileData);
            }
        }

        return $output;
    }
}
