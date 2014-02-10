<?php
/*
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Sonrisa\Component\Sitemap;

use \Sonrisa\Component\Sitemap\Interfaces\AbstractSitemap as AbstractSitemap;

class XMLIndexSitemap extends AbstractSitemap
{


    /**
     * Generates sitemap documents and stores them in $this->data, an array holding as many positions
     * as total links divided by the $this->max_items_per_sitemap value.
     */
    public function build()
    {
        $files = array();
        $generatedFiles = $this->buildSitemapSetCollection();


        if (!empty($generatedFiles)) {
            foreach ($generatedFiles as $fileNumber => $sitemapSet) {

                $xml =  '<?xml version="1.0" encoding="UTF-8"?>'."\n".
                        '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'."\n".
                        $sitemapSet."\n".
                        '</sitemapindex>';

                $files[$fileNumber] = $xml;
            }
        } else {
            $xml =  '<?xml version="1.0" encoding="UTF-8"?>'."\n".
                    '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'."\n"
                    .'</sitemapindex>';

            $files[0] = $xml;
        }

        //Save files array and empty url buffer
        $this->files = $files;

        return $this;
    }

    /**
     * @param  string $url
     * @param  string $lastmod
     * @param  string $lastmodformat
     *
     * @return $this
     */
    public function addSitemap($url,$lastmod='',$lastmodformat='Y-m-d\TH:i:sP')
    {
        //Make sure the mandatory value is valid.
        $url = $this->validateUrlLoc($url);

        //Make sure we won't be adding a valid but duplicated URL to the sitemap.
        if (!empty($url) && !in_array($url,$this->recordUrls,true)) {

            $this->recordUrls[] = $url;

            $dataSet = array
            (
                'loc'           => htmlentities($url),
                'lastmod'       => $this->validateUrlLastMod($lastmod,$lastmodformat),
            );

            //Remove empty fields
            $dataSet = array_filter($dataSet);

            //Append data to existing structure if not empty
            if (!empty($dataSet))
            {
                $this->data[] = $dataSet;
            }
        }

        return $this;
    }

    /**
     * Loop through $this->data and build sitemap-index.xml file
     * taking into account each <sitemap> can hold a max of 50.000 url elements
     *
     * @return array
     */
    protected function buildSitemapSetCollection()
    {
        $files = array(0 => '');
        if ( !empty($this->data) )
        {
            $i = 0;
            $url = 0;

            foreach($this->data as $sitemapSet)
            {
                $xml = array();

                $xml[] = "\t".'<sitemap>';
                $xml[] = (!empty($sitemapSet['loc']))?         "\t\t<loc>{$sitemapSet['loc']}</loc>"                      : '';
                $xml[] = (!empty($sitemapSet['lastmod']))?     "\t\t<lastmod>{$sitemapSet['lastmod']}</lastmod>"          : '';
                $xml[] = "\t".'</sitemap>';
                //Remove empty fields
                $xml = array_filter($xml);

                //Build string
                $files[$i][] = implode("\n",$xml);

                //If amount of $url added is above the limit, increment the file counter.
                if ($url > $this->max_items_per_sitemap) {
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
}