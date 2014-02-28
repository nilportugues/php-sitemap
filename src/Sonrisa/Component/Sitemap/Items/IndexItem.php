<?php
/*
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Sonrisa\Component\Sitemap\Items;

/**
 * Class IndexItem
 * @package Sonrisa\Component\Sitemap\Items
 */
class IndexItem extends AbstractItem implements ItemInterface
{
    /**
     * @return string
     */
    public function getHeader()
    {
        return  '<?xml version="1.0" encoding="UTF-8"?>'."\n".
                '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
    }

    /**
     * @return string
     */
    public function getFooter()
    {
        return "</sitemapindex>";
    }


    /**
     * @return string
     */
    public function getLoc()
    {
        return (!empty($this->data['loc'])) ? $this->data['loc'] : '';
    }

    /**
     * @param $loc
     * @return $this
     */
    public function setLoc($loc)
    {
        return $this->setField('loc',$loc);
    }    

    /**
     * @param $lastmod
     * @return $this
     */
    public function setLastMod($lastmod)
    {
        return $this->setField('lastmod',$lastmod);
    }       

    /**
     * Collapses the item to its string XML representation.
     *
     * @return string
     */
    public function build()
    {
        $data = '';
        
        //Create item ONLY if all mandatory data is present.
        if (!empty($this->data['loc'])) {
            $xml = array();

            $xml[] = "\t".'<sitemap>';
            $xml[] = (!empty($this->data['loc']))?         "\t\t<loc>{$this->data['loc']}</loc>"                      : '';
            $xml[] = (!empty($this->data['lastmod']))?     "\t\t<lastmod>{$this->data['lastmod']}</lastmod>"          : '';
            $xml[] = "\t".'</sitemap>';

            $xml = array_filter($xml);

            if (!empty($xml)) {
                $data = implode("\n",$xml);
            }

        }

        return $data;
    }
}
