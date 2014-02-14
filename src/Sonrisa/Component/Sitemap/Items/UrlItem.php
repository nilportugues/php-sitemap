<?php
/*
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Sonrisa\Component\Sitemap\Items;


class UrlItem extends AbstractItem
{

    /**
     * Collapses the item to its string XML representation.
     *
     * @return string
     */
    public function buildItem()
    {
        //Create item ONLY if all mandatory data is present.
        if(!empty($this->data['loc']))
        {
            $xml = array();

            $xml[] = "\t".'<url>';
            $xml[] = (!empty($this->data['loc']))?         "\t\t<loc>{$this->data['loc']}</loc>"                      : '';
            $xml[] = (!empty($this->data['lastmod']))?     "\t\t<lastmod>{$this->data['lastmod']}</lastmod>"          : '';
            $xml[] = (!empty($this->data['changefreq']))?  "\t\t<changefreq>{$this->data['changefreq']}</changefreq>" : '';
            $xml[] = (!empty($this->data['priority']))?    "\t\t<priority>{$this->data['priority']}</priority>"       : '';
            $xml[] = "\t".'</url>';

            $xml = array_filter($xml);

            return implode("\n",$xml);
        }
        return '';
    }
}