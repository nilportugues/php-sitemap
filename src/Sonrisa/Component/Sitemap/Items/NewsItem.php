<?php
/*
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Sonrisa\Component\Sitemap\Items;

/**
 * Class NewsItem
 * @package Sonrisa\Component\Sitemap\Items
 */
class NewsItem extends AbstractItem
{
    /**
     * @return string
     */
    public function getHeader()
    {
        return '<?xml version="1.0" encoding="UTF-8"?>'."\n".
               '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:news="http://www.google.com/schemas/sitemap-news/0.9">';
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
        if
        (
            !empty($this->data['loc'])
            && !empty($this->data['title'])
           // && !empty($this->data['publication_date'])
           // && !empty($this->data['name'])
           // && !empty($this->data['language'])
        )
        {

            $xml = array();
            $xml[] = "\t".'<url>';
            $xml[] = "\t\t".'<loc>'.$this->data['loc'].'</loc>';

            $xml[] = "\t\t".'<news:news>';

            if(!empty($this->data['name']) && !empty($this->data['language']) )
            {
                $xml[] = "\t\t\t".'<news:publication>';
                $xml[] = (!empty($this->data['name']))     ? "\t\t\t\t".'<news:name>'.$this->data['name'].'</news:name>' : '';
                $xml[] = (!empty($this->data['language'])) ? "\t\t\t\t".'<news:language>'.$this->data['language'].'</news:language>' : '';
                $xml[] = "\t\t\t".'</news:publication>';
            }

            $xml[] = (!empty($this->data['access']))            ? "\t\t\t".'<news:access>'.$this->data['access'].'</news:access>' : '';
            $xml[] = (!empty($this->data['genres']))            ? "\t\t\t".'<news:genres>'.$this->data['genres'].'</news:genres>' : '';
            $xml[] = (!empty($this->data['publication_date']))  ? "\t\t\t".'<news:publication_date>'.$this->data['publication_date'].'</news:publication_date>' : '';
            $xml[] = (!empty($this->data['title']))             ? "\t\t\t".'<news:title>'.$this->data['title'].'</news:title>' : '';
            $xml[] = (!empty($this->data['keywords']))           ? "\t\t\t".'<news:keywords>'.$this->data['keywords'].'</news:keywords>' : '';
            $xml[] = (!empty($this->data['stock_tickers']))     ? "\t\t\t".'<news:stock_tickers>'.$this->data['stock_tickers'].'</news:stock_tickers>' : '';

            $xml[] = "\t\t".'</news:news>';
            $xml[] = "\t".'</url>';
            $xml = array_filter($xml);

            $data = implode("\n",$xml);
        }
        return $data;
    }
}