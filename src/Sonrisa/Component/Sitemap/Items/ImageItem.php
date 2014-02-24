<?php
/*
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Sonrisa\Component\Sitemap\Items;

/**
 * Class ImageItem
 * @package Sonrisa\Component\Sitemap\Items
 */
class ImageItem extends AbstractItem
{
    /**
     * @return string
     */
    public function getHeader()
    {
        return '<?xml version="1.0" encoding="UTF-8"?>'."\n".
        '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">';
    }

    /**
     * @return string
     */
    public function getFooter()
    {
        return "</urlset>";
    }

    /**
     * Collapses the item to its string XML representation.
     *
     * @return string
     */
    public function buildItem()
    {
        $data = '';
        //Create item ONLY if all mandatory data is present.
        if(!empty($this->data['loc']))
        {
            $xml = array();

            $xml[] = "\t\t".'<image:image>';
            $xml[] = (!empty($this->data['loc']))         ? "\t\t\t".'<image:loc><![CDATA['.$this->data['loc'].']]></image:loc>' : '';
            $xml[] = (!empty($this->data['title']))       ? "\t\t\t".'<image:title><![CDATA['.$this->data['title'].']]></image:title>' : '';
            $xml[] = (!empty($this->data['caption']))     ? "\t\t\t".'<image:caption><![CDATA['.$this->data['caption'].']]></image:caption>' : '';
            $xml[] = (!empty($this->data['geolocation'])) ? "\t\t\t".'<image:geolocation><![CDATA['.$this->data['geolocation'].']]></image:geolocation>' : '';
            $xml[] = (!empty($this->data['license']))     ? "\t\t\t".'<image:license><![CDATA['.$this->data['license'].']]></image:license>' : '';
            $xml[] = "\t\t".'</image:image>';
            $xml = array_filter($xml);

            $data = implode("\n",$xml);
        }
        return $data;
    }
}