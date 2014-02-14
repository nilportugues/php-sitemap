<?php
/*
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Sonrisa\Component\Sitemap;

use \Sonrisa\Component\Sitemap\Interfaces\AbstractSitemap as AbstractSitemap;

class XMLMediaSitemap extends AbstractSitemap
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
     * @param $url
     * @param array $media
     *
     * @return $this
     */
    public function addItem($url,array $media)
    {
        //Make sure the mandatory value is valid.
        $url = $this->validateUrlLoc($url);

        //Make sure we won't be adding a valid but duplicated URL to the sitemap.
        if (!empty($url) && !in_array($url,$this->recordUrls,true))
        {
            $this->recordUrls[] = $url;

            $dataSet = array
            (
                'link'          =>  $url,
                'player'        =>  ( !empty($media['player']) && ( $player = $this->validateUrlLoc($media['player']))!=false ) ? htmlentities($player) : '',
                'duration'      =>  ( !empty($media['duration']) && filter_var($media['duration'],FILTER_SANITIZE_NUMBER_INT))? htmlentities($media['duration']) : '',
                'title'         =>  ( !empty($media['title']) )? htmlentities($media['title']) : '',
                'mimetype'      =>  ( !empty($media['mimetype']) )? htmlentities($media['mimetype']) : '',
                'description'   =>  ( !empty($media['description']) )? htmlentities($media['description']) : '',
                'thumbnail'     =>  ( !empty($media['thumbnail']) && ( $thumbnail = $this->validateUrlLoc($media['thumbnail']))!=false ) ? htmlentities($thumbnail) : '',
                'height'        =>  ( !empty($media['height']) && filter_var($media['height'],FILTER_SANITIZE_NUMBER_INT))? htmlentities($media['height']) : '',
                'width'         =>  ( !empty($media['width']) && filter_var($media['width'],FILTER_SANITIZE_NUMBER_INT))? htmlentities($media['width']) : '',
            );

            //Remove empty fields
            $dataSet = array_filter($dataSet);

            //Append data to existing structure if not empty
            if (!empty($dataSet)) {
                $this->data[] = $dataSet;
            }

        }
        return $this;
    }

    /**
     * @return $this
     */
    public function build()
    {
        $files = array();

        $rssHeader = $this->buildRssHeader();
        $generatedFiles = $this->buildItemCollection();

        if (!empty($generatedFiles))
        {
            foreach ($generatedFiles as $fileNumber => $itemSet) {
                $xml =  '<?xml version="1.0" encoding="UTF-8"?>'."\n".
                        '<rss version="2.0" xmlns:media="http://search.yahoo.com/mrss/" xmlns:dcterms="http://purl.org/dc/terms/">'."\n".
                        '<channel>'."\n".
                        $rssHeader."\n".
                        $itemSet."\n".
                        '</channel>'."\n".
                        '</rss>';

                $files[$fileNumber] = $xml;
            }
        }
        else
        {
            $xml =  '<?xml version="1.0" encoding="UTF-8"?>'."\n".
                    '<rss version="2.0" xmlns:media="http://search.yahoo.com/mrss/" xmlns:dcterms="http://purl.org/dc/terms/">'."\n".
                    '<channel></channel>'."\n".
                    '</rss>';

            $files[0] = $xml;
        }

        //Save files array and empty url buffer
        $this->files = $files;

        return $this;
    }

    /**
     * @return array
     */
    protected function buildItemCollection()
    {
        $files = array(0 => '');

        if (!empty($this->data))
        {
            $i = 0;
            $url = 0;

            foreach ($this->data as $itemData)
            {
                $xml = array();

                //Open <item>
                $xml[] = "\t".'<item xmlns:media="http://search.yahoo.com/mrss/" xmlns:dcterms="http://purl.org/dc/terms/">';
                $xml[] = (!empty($itemData['link']))?         "\t\t<link>{$itemData['link']}</link>"                      : '';

                $mimetype = '';

                //Open <media:content>
                if(!empty($itemData['duration']) && !empty($itemData['mimetype']))
                {
                    $xml[] = "\t\t<media:content type=\"{$itemData['mimetype']}\" duration=\"{$itemData['duration']}\">";
                }
                elseif( empty($itemData['duration']) && !empty($itemData['mimetype']))
                {
                    $xml[] = "\t\t<media:content type=\"{$itemData['mimetype']}\">";
                }
                elseif( !empty($itemData['duration']) && empty($itemData['mimetype']))
                {
                    $xml[] = "\t\t<media:content duration=\"{$itemData['duration']}\">";
                }

                $xml[] = (!empty($itemData['player']))?       "\t\t\t<media:player url=\"{$itemData['player']}\" />"                     : '';
                $xml[] = (!empty($itemData['title']))?        "\t\t\t<media:title>{$itemData['title']}</media:title>"                    : '';
                $xml[] = (!empty($itemData['description']))?  "\t\t\t<media:description>{$itemData['description']}</media:description>"  : '';


                if( !empty($itemData['thumbnail']) && !empty($itemData['height']) && !empty($itemData['width']) )
                {
                    $xml[] = "\t\t\t<media:thumbnail url=\"{$itemData['thumbnail']}\" height=\"{$itemData['height']}\" width=\"{$itemData['width']}\"/>";
                }
                elseif( !empty($itemData['thumbnail']) && !empty($itemData['height']) )
                {
                    $xml[] = "\t\t\t<media:thumbnail url=\"{$itemData['thumbnail']}\" height=\"{$itemData['height']}\"/>";
                }
                elseif( !empty($itemData['thumbnail']) && !empty($itemData['width']) )
                {
                    $xml[] = "\t\t\t<media:thumbnail url=\"{$itemData['thumbnail']}\" width=\"{$itemData['width']}\"/>";
                }
                elseif( !empty($itemData['thumbnail']) )
                {
                    $xml[] = "\t\t\t<media:thumbnail url=\"{$itemData['thumbnail']}\"/>";
                }

                //Close <media:content>
                $xml[] = "\t\t".'</media:content>';
                //Close <item>
                $xml[] = "\t".'</item>';

                //Remove empty fields
                $xml = array_filter($xml);

                //Build string
                $files[$i][] = implode("\n",$xml);

                //If amount of $url added is above the limit, increment the file counter.
                if ($url > $this->max_items_per_sitemap)
                {
                    $files[$i] = implode("\n",$files[$i]);
                    $i++;
                    $url=0;
                }
                $url++;
            }
            $files[$i] = implode("\n",$files[$i]);

            return $files;
        }
        return '';
    }

    /**
     * Builds the title, link and description tags.
     * @return string
     */
    protected function buildRssHeader()
    {
        $data = array();

        if(!empty($this->title))
        {
            $data[] = "\t<title>{$this->title}</title>";
        }

        if(!empty($this->link))
        {
            $data[] = "\t<link>{$this->link}</link>";
        }

        if(!empty($this->description))
        {
            $data[] = "\t<description>{$this->description}</description>";
        }

        if(!empty($data))
        {
            return implode("\n",$data);
        }
    }

}
