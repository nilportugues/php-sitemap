<?php
/*
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Sonrisa\Component\Sitemap;

use Sonrisa\Component\Sitemap\Exceptions\SitemapException;
use Sonrisa\Component\Sitemap\Items\MediaItem;
use Sonrisa\Component\Sitemap\Validators\SharedValidator;

/**
 * Class MediaSitemap
 * @package Sonrisa\Component\Sitemap
 */
class MediaSitemap extends AbstractSitemap implements SitemapInterface
{
    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $link;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var MediaItem
     */
    protected $lastItem;

    /**
     * @param $title
     *
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @param $link
     *
     * @throws Exceptions\SitemapException
     * @return $this
     */
    public function setLink($link)
    {
        $this->link = SharedValidator::validateLoc($link);

        if (empty($this->link)) {
            throw new SitemapException('Value for setLink is not a valid URL');
        }

        return $this;
    }

    /**
     * @param $description
     *
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @param  MediaItem $item
     * @return $this
     */
    public function add(MediaItem $item)
    {
        $itemLink = $item->getLink();

        if (!empty($itemLink)) {
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
        $output = array();
        if (!empty($this->files)) {
            if (!empty($this->title)) {
                $this->title = "\t<title>{$this->title}</title>\n";
            }

            if (!empty($this->link)) {
                $this->link = "\t<link>{$this->link}</link>\n";
            }

            if (!empty($this->description)) {
                $this->description = "\t<description>{$this->description}</description>\n";
            }

            foreach ($this->files as $file) {
                if (str_replace(array("\n", "\t"), '', $file) != '') {
                    $output[] = $this->lastItem->getHeader()."\n"
                        .$this->title.$this->link.$this->description.$file."\n"
                        .$this->lastItem->getFooter();
                }
            }
        }

        return $output;
    }
}
