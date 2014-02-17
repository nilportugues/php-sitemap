<?php
/*
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Sonrisa\Component\Sitemap;

use Sonrisa\Component\Sitemap\Items\VideoItem;
use Sonrisa\Component\Sitemap\Validators\AbstractValidator;
use Sonrisa\Component\Sitemap\Validators\VideoValidator;

/**
 * Class VideoSitemap
 * @package Sonrisa\Component\Sitemap
 */
class VideoSitemap extends AbstractSitemap
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
     *
     */
    public function __construct()
    {
        $this->validator = new VideoValidator();
    }

    /**
     * @param $data
     * @return $this
     */
    /**
     * @param array $data
     * @param string $url
     * @return $this
     */
    public function add($data,$url='')
    {
        $url = AbstractValidator::validateLoc($url);
        if( empty($this->used_videos[$url]) )
        {
            $this->used_videos[$url] = array();
        }

        if
        (
            !empty($url) && !empty($data['title']) &&
            (!empty($data['player_loc']) || !empty($data['content_loc'])) &&
            (!in_array($data['player_loc'],$this->used_videos[$url],true) || !in_array($data['content_loc'],$this->used_videos[$url],true))
        )
        {
            //Mark URL as used.
            $this->used_urls[] = $url;
            $this->used_videos[$url][] = $data['player_loc'];
            $this->used_videos[$url][] = $data['content_loc'];

            $this->items[$url] = array();

            $item = new VideoItem($this->validator);

            //Populate the item with the given data.
            foreach($data as $key => $value)
            {
                $item->setField($key,$value);
            }

            //Check constrains
            $current =  $this->current_file_byte_size + $item->getHeaderSize() +  $item->getFooterSize() +
                        (count($this->items[$url])*( mb_strlen($this->urlHeader,'UTF-8')+mb_strlen($this->urlFooter,'UTF-8')));

            //Check if new file is needed or not. ONLY create a new file if the constrains are met.
            if( ($current <= $this->max_filesize) && ( $this->total_items <= $this->max_items_per_sitemap))
            {
                //add bytes to total
                $this->current_file_byte_size = $item->getItemSize();

                //add item to the item array
                $built = $item->buildItem();
                if(!empty($built))
                {
                    $this->items[$url][] = $built;

                    $this->files[$this->total_files][$url][] = implode("\n",$this->items[$url]);

                    $this->total_items++;
                }
            }
            else
            {
                //reset count
                $this->current_file_byte_size = 0;

                //copy items to the files array.
                $this->total_files=$this->total_files+1;
                $this->files[$this->total_files][$url][] = implode("\n",$this->items[$url]);

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
        $item = new VideoItem($this->validator);
        $output = array();

        if(!empty($this->files))
        {
            foreach($this->files as $file)
            {
                $fileData = array();
                $fileData[] = $item->getHeader();

                foreach($file as $url => $urlImages)
                {
                    if(!empty($urlImages) && !empty($url))
                    {
                        $fileData[] = $this->urlHeader;
                        $fileData[] = "\t\t<loc>".$url."</loc>";
                        $fileData[] = implode("\n",$urlImages);
                        $fileData[] = $this->urlFooter;
                    }
                }

                $fileData[] = $item->getFooter();

                $output[] = implode("\n",$fileData);
            }
        }
        return $output;
    }
}