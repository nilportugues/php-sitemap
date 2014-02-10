<?php
/*
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Sonrisa\Component\Sitemap;

use \Sonrisa\Component\Sitemap\Interfaces\AbstractSitemap as AbstractSitemap;

class XMLSitemapIndex extends AbstractSitemap
{
    /**
     * @var array
     */
    protected $data = array();

    /**
     * @var array
     */
    protected $recordUrls = array();

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
                        '<sitemapindex xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/siteindex.xsd" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'."\n".
                        $sitemapSet."\n".
                        '</sitemapindex>';

                $files[$fileNumber] = $xml;
            }
        } else {
            $xml =  '<?xml version="1.0" encoding="UTF-8"?>'."\n".
                    '<sitemapindex xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/siteindex.xsd" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'."\n"
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
                'loc'           => $url,
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

    }
}