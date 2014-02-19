<?php
/*
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Sonrisa\Component\Sitemap;

use Sonrisa\Component\Sitemap\Items\MediaItem;
use Sonrisa\Component\Sitemap\Validators\MediaValidator;

/**
 * Class MediaSitemap
 * @package Sonrisa\Component\Sitemap
 */
class MediaSitemap extends AbstractSitemap
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
     *
     */
    public function __construct()
    {
        $this->validator = new MediaValidator();
    }

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
     * @return $this
     */
    public function setLink($link)
    {
        $this->link = $link;
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
     * @param $data
     * @return $this
     */
    public function add($data)
    {
        if(!empty($data['link']))
        {

            $item = new MediaItem($this->validator);

            //Populate the item with the given data.
            foreach($data as $key => $value)
            {
                $item->setField($key,$value);
            }

            //Check constrains
            $current = $this->current_file_byte_size + $item->getHeaderSize() + $item->getFooterSize();

            //Check if new file is needed or not. ONLY create a new file if the constrains are met.
            if( ($current <= $this->max_filesize) && ( $this->total_items <= $this->max_items_per_sitemap) )
            {
                //add bytes to total
                $this->current_file_byte_size = $item->getItemSize();

                //add item to the item array
                $built = $item->buildItem();
                if(!empty($built))
                {
                    $this->items[] = $built;

                    $this->files[$this->total_files] = implode("\n",$this->items);

                    $this->total_items++;
                }

            }
            else
            {
                //reset count
                $this->current_file_byte_size = 0;

                //copy items to the files array.
                $this->total_files=$this->total_files+1;
                $this->files[$this->total_files] = implode("\n",$this->items);

                //reset the item count by inserting the first new item
                $this->items = array($item);
                $this->total_items=1;
            }
        }
        return $this;
    }

    /**
     * @return array
     */
    public function build()
    {
        $item = new MediaItem($this->validator);

        $output = array();
        if(!empty($this->files))
        {
            if(!empty($this->title))
            {
                $this->title = "\t<title>{$this->title}</title>\n";
            }

            if(!empty($this->link))
            {
                $this->link = "\t<link>{$this->link}</link>\n";
            }

            if(!empty($this->description))
            {
                $this->description = "\t<description>{$this->description}</description>\n";
            }

            foreach($this->files as $file)
            {
                if( str_replace(array("\n","\t"),'',$file) != '' )
                {
                    $output[] = $item->getHeader()."\n".$this->title.$this->link.$this->description.$file."\n".$item->getFooter();
                }
            }
        }
        return $output;
    }

}
