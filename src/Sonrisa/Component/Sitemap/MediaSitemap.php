<?php
/*
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Sonrisa\Component\Sitemap;

use \Sonrisa\Component\Sitemap\Interfaces\AbstractSitemap as AbstractSitemap;

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
     * @var array
     */
    protected $data = array();


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

        foreach ($generatedFiles as $fileNumber => $itemSet) {
            $xml =  '<?xml version="1.0" encoding="UTF-8"?>'."\n".
                    '<rss version="2.0" xmlns:media="http://search.yahoo.com/mrss/" xmlns:dcterms="http://purl.org/dc/terms/">'."\n".
                    "\t".'<channel>'."\n".
                    $rssHeader.
                    $itemSet."\n".
                    "\t".'</channel>'."\n".
                    '</rss>';

            $files[$fileNumber] = $xml;
        }

        //Save files array and empty url buffer
        $this->files = $files;

        return $this;
    }

    /**
     * @return string
     */
    protected function buildItemCollection()
    {
        return '';
    }

    /**
     * @return string
     */
    protected function buildRssHeader()
    {
        return '';
    }

}
