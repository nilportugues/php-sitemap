<?php
/*
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Sonrisa\Component\Sitemap;

use \Sonrisa\Component\Sitemap\Interfaces\AbstractSitemap as AbstractSitemap;

class XMLSitemap extends AbstractSitemap
{
    /**
     * @var array
     */
    protected $data = array
    (
        'url'   => array(),
    );

    /**
     * @var array
     */
    protected $changeFreqValid = array("always","hourly","daily","weekly","monthly","yearly","never");

    /**
     * @return mixed
     */
    public function build()
    {
        $files = array();
        $generatedFiles = $this->buildUrlSetCollection();

        if (!empty($generatedFiles)) {
            foreach ($generatedFiles as $fileNumber => $urlSet) {
                $xml =  '<?xml version="1.0" encoding="UTF-8"?>'."\n".
                        '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'."\n".
                        $urlSet."\n".
                        '</urlset>';

                $files[$fileNumber] = $xml;
            }
        }
        else
        {
            $xml =  '<?xml version="1.0" encoding="UTF-8"?>'."\n".
                    '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'."\n".
                    '</urlset>';

            $files[0] = $xml;
        }

        //Save files array and empty url buffer
        $this->files = $files;

        return $this;
    }

    /**
     * @param  string $url
     * @param  string $priority
     * @param  string $changefreq
     * @param  string $lastmod
     * @param  string $lastmodformat
     * @return $this
     */
    public function addUrl($url,$priority='',$changefreq='',$lastmod='',$lastmodformat='Y-m-d\TH:i:sP')
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
                'changefreq'    => $this->validateUrlChangeFreq($changefreq),
                'priority'      => $this->validateUrlPriority($priority),
            );

            //Remove empty fields
            $dataSet = array_filter($dataSet);

            //Append data to existing structure if not empty
            if (!empty($dataSet)) {
                $this->data['url'][$dataSet['priority']][] = $dataSet;
            }
        }

        return $this;
    }



    /**
     * Loop through $this->data['url'] and build Sitemap.xml
     * taking into account each urlset can hold a max of 50.000 url elements
     *
     * @return array
     */
    protected function buildUrlSetCollection()
    {
        $files = array(0 => '');

        if (!empty($this->data['url'])) {
            $i = 0;
            $url = 0;
            foreach ($this->data['url'] as $prioritySets) {
                foreach ($prioritySets as $urlData) {
                    $xml = array();

                    //Open <url>
                    $xml[] = "\t".'<url>';
                    $xml[] = (!empty($urlData['loc']))?         "\t\t<loc>{$urlData['loc']}</loc>"                      : '';
                    $xml[] = (!empty($urlData['lastmod']))?     "\t\t<lastmod>{$urlData['lastmod']}</lastmod>"          : '';
                    $xml[] = (!empty($urlData['changefreq']))?  "\t\t<changefreq>{$urlData['changefreq']}</changefreq>" : '';
                    $xml[] = (!empty($urlData['priority']))?    "\t\t<priority>{$urlData['priority']}</priority>"       : '';

                     //Close <url>
                    $xml[] = "\t".'</url>';

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
            }

            return $files;
        }

        return '';

    }

}
