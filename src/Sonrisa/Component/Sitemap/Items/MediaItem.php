<?php
/*
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sonrisa\Component\Sitemap\Items;

/**
 * Class MediaItem
 * @package Sonrisa\Component\Sitemap\Items
 */
class MediaItem extends AbstractItem
{
    /**
     * @return string
     */
    public function getHeader()
    {
        return '<?xml version="1.0" encoding="UTF-8"?>'."\n".
                '<rss version="2.0" xmlns:media="http://search.yahoo.com/mrss/" xmlns:dcterms="http://purl.org/dc/terms/">'."\n".
                '<channel>';
    }

    /**
     * @return string
     */
    public function getFooter()
    {
        return "</channel>";
    }


    /**
     * Collapses the item to its string XML representation.
     *
     * @return string
     */
    public function buildItem()
    {
        //Create item ONLY if all mandatory data is present.
        if(!empty($this->data['link']))
        {
            $xml = array();

            $xml[] = "\t".'<item xmlns:media="http://search.yahoo.com/mrss/" xmlns:dcterms="http://purl.org/dc/terms/">';
            $xml[] = (!empty($this->data['link']))?         "\t\t<link>{$this->data['link']}</link>"                      : '';


            if(!empty($this->data['duration']) && !empty($this->data['mimetype']))
            {
                $xml[] = "\t\t<media:content type=\"{$this->data['mimetype']}\" duration=\"{$this->data['duration']}\">";
            }
            elseif( empty($this->data['duration']) && !empty($this->data['mimetype']))
            {
                $xml[] = "\t\t<media:content type=\"{$this->data['mimetype']}\">";
            }
            elseif( !empty($this->data['duration']) && empty($this->data['mimetype']))
            {
                $xml[] = "\t\t<media:content duration=\"{$this->data['duration']}\">";
            }

            $xml[] = (!empty($this->data['player']))?       "\t\t\t<media:player url=\"{$this->data['player']}\" />"                     : '';
            $xml[] = (!empty($this->data['title']))?        "\t\t\t<media:title>{$this->data['title']}</media:title>"                    : '';
            $xml[] = (!empty($this->data['description']))?  "\t\t\t<media:description>{$this->data['description']}</media:description>"  : '';


            if( !empty($this->data['thumbnail']) && !empty($this->data['height']) && !empty($this->data['width']) )
            {
                $xml[] = "\t\t\t<media:thumbnail url=\"{$this->data['thumbnail']}\" height=\"{$this->data['height']}\" width=\"{$this->data['width']}\"/>";
            }
            elseif( !empty($this->data['thumbnail']) && !empty($this->data['height']) )
            {
                $xml[] = "\t\t\t<media:thumbnail url=\"{$this->data['thumbnail']}\" height=\"{$this->data['height']}\"/>";
            }
            elseif( !empty($this->data['thumbnail']) && !empty($this->data['width']) )
            {
                $xml[] = "\t\t\t<media:thumbnail url=\"{$this->data['thumbnail']}\" width=\"{$this->data['width']}\"/>";
            }
            elseif( !empty($this->data['thumbnail']) )
            {
                $xml[] = "\t\t\t<media:thumbnail url=\"{$this->data['thumbnail']}\"/>";
            }

            $xml[] = "\t\t".'</media:content>';
            $xml[] = "\t".'</item>';

            //Remove empty fields
            $xml = array_filter($xml);

            return implode("\n",$xml);
        }
        return '';
    }
}