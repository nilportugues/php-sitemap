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
 *  -   Your Sitemap index file shouldn't list more than 50,000 Sitemaps. These limits help ensure that your
 *      web server isn't overloaded by serving large files to Google News.
 *
 *  Once you've created your Sitemap, upload it to the highest-level directory that contains your news articles.
 *
 */
class NewsSitemap extends XMLSitemap
{
    /**
     * @var int
     */
    protected $max_news = 1000;

    /**
     * @var Validators\NewsValidator
     */
    protected $validator;

    /**
     * @var Items\NewsItem
     */
    protected $item;

    /**
     * Variable holding the items added to a file.
     *
     * @var int
     */
    protected $total_items = 0;

    /**
     * @var array
     */
    protected $items = array();

    /**
     * Array holding the files created by this class.
     *
     * @var array
     */
    protected $files = array();

    /**
     * Variable holding the number of files created by this class.
     *
     * @var int
     */
    protected $total_files = 1;

    /**
     * @var int
     */
    protected $current_file_byte_size = 0;

    /**
     * Keep a track of the used URLs.
     *
     * @var array
     */
    protected $used_urls = array();

    /**
     *
     */
    public function __construct()
    {
        $this->validator = new NewsValidator();
    }

    /**
     * @param $data
     * @return $this
     */
    public function add($data)
    {
        if(!empty($data['loc']) && !in_array($data['loc'],$this->used_urls,true)){

            //Mark URL as used.
            $this->used_urls[] = $data['loc'];

            $item = new NewsItem($this->validator);

            //Populate the item with the given data.
            foreach($data as $key => $value)
            {
                $item->setField($key,$value);
            }

            //Check constrains
            $current = $this->current_file_byte_size + $item->getHeaderSize() + $item->getFooterSize();

            //Check if new file is needed or not. ONLY create a new file if the constrains are met.
            if( ($current <= $this->max_filesize) && ( $this->total_items <= $this->max_news) )
            {
                //add bytes to total
                $this->current_file_byte_size = $item->getItemSize();

                //add item to the item array
                $this->items[] = $item->buildItem();

                $this->files[$this->total_files] = implode("\n",$this->items);

                $this->total_items++;
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

            return $this;
        }

    }

    /**
     * @return array
     */
    public function build()
    {
        $output = array();
        $item = new NewsItem($this->validator);

        if(!empty($this->files))
        {

            foreach($this->files as $file)
            {
                $output[] = $item->getHeader()."\n".
                            $file."\n".
                            $item->getFooter();
            }
        }
        return $output;
    }

} 