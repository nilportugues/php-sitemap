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
        'images' => array(),
        'videos' => array(),
        'url'   => array(),
    );

    protected $recordUrls = array();

    /**
     * @var array
     */
    protected $changeFreqValid = array("always","hourly","daily","weekly","monthly","yearly","never");

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
                'loc'           => $url,
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
     * XML Schema for the Image Sitemap extension.
     * Help Center documentation for the Image Sitemap extension: http://www.google.com/support/webmasters/bin/answer.py?answer=178636
     *
     * @param string $url URL is used to append to the <url> the imageData added by $imageData
     * @param array $imageData
     *
     * @return $this
     */
    public function addImage($url,array $imageData)
    {
        $imageLoc = NULL;

        //Make sure the mandatory values are valid.
        $url = $this->validateUrlLoc($url);
        if(!empty($imageData['loc']))
        {
            $imageLoc = $this->validateUrlLoc($imageData['loc']);
        }

        if ( !empty($url) && !empty($imageLoc) )
        {
            $dataSet = array
            (
                'loc'             => $imageLoc,
                'title'           => (!empty($imageData['title']))? $imageData['title']               : '',
                'caption'         => (!empty($imageData['caption']))? $imageData['caption']           : '',
                'geolocation'     => (!empty($imageData['geolocation']))? $imageData['geolocation']   : '',
                'license'         => (!empty($imageData['license']))? $imageData['license']           : '',
            );

            //Remove empty fields
            $dataSet = array_filter($dataSet);

            if(empty($this->data['images'][$url]))
            {
                $this->data['images'][$url] = array();
            }
            // Check if there are less than 1001 images for this url
            if(count($this->data['images'][$url]) <= $this->max_images_per_url)
            {
                //Let the data array know that for a URL there are images
                $this->data['images'][$url][$imageLoc] = $dataSet;
            }
        }
        return $this;
    }


    /**
     * @param string $url URL is used to append to the <url> the videoData added by $videoData
     * @param array $videoData
     *
     * @return $this
     */
    public function addVideo($url,array $videoData)
    {
        //Must be valid: video:player_loc, video:content_loc
        return $this;
    }


    /**
     * @return mixed
     */
    public function build()
    {
        $files = array();

        $generatedFiles = $this->buildUrlSetCollection();

        $xmlImages='';
        if(!empty($this->data['images']))
        {
            $xmlImages.=' xmlns:image="http://www.google.com/schemas/sitemap-image/1.1"';
        }

        if(!empty($this->data['videos']))
        {
            $xmlImages.=' xmlns:video="http://www.google.com/schemas/sitemap-video/1.1"';
        }

        if (!empty($generatedFiles)) {
            foreach ($generatedFiles as $fileNumber => $urlSet) {
                $xml =  '<?xml version="1.0" encoding="UTF-8"?>'."\n".
                        '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"'.$xmlImages.'>'."\n".
                        $urlSet."\n".
                        '</urlset>';

                $files[$fileNumber] = $xml;
            }
        } else {
            $xml =  '<?xml version="1.0" encoding="UTF-8"?>'."\n".
                    '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"'.$xmlImages.'>'."\n".
                    '</urlset>';

            $files[0] = $xml;
        }

        //Save files array and empty url buffer
        $this->files = $files;

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

                    //Append images if any
                    $xml[] = $this->buildUrlImageCollection($urlData['loc']);

                    //Append videos if any
                    $xml[] = $this->buildUrlVideoCollection($urlData['loc']);

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

    /**
     * Builds the XML for the image data.
     * @param $url
     * @return string
     */
    protected function buildUrlImageCollection($url)
    {
        if(!empty( $this->data['images'][$url]))
        {
            $images = array();

            foreach( $this->data['images'][$url] as $imageData )
            {
                $xml = array();

                $xml[] = "\t\t".'<image:image>';

                $xml[] = (!empty($imageData['loc']))         ? "\t\t\t".'<image:loc><![CDATA['.$imageData['loc'].']]></image:loc>' : '';
                $xml[] = (!empty($imageData['title']))       ? "\t\t\t".'<image:title><![CDATA['.$imageData['title'].']]></image:title>' : '';
                $xml[] = (!empty($imageData['caption']))     ? "\t\t\t".'<image:caption><![CDATA['.$imageData['caption'].']]></image:caption>' : '';
                $xml[] = (!empty($imageData['geolocation'])) ? "\t\t\t".'<image:geolocation><![CDATA['.$imageData['geolocation'].']]></image:geolocation>' : '';
                $xml[] = (!empty($imageData['license']))     ? "\t\t\t".'<image:license><![CDATA['.$imageData['license'].']]></image:license>' : '';

                $xml[] = "\t\t".'</image:image>';

                //Remove empty fields
                $xml = array_filter($xml);

                //Build string
                $images[] = implode("\n",$xml);
            }
            return implode("\n",$images);
        }
        return '';
    }


    /**
     * Builds the XML for the video data.
     * @param $url
     * @return string
     */
    protected function buildUrlVideoCollection($url)
    {

    }


    /**
     * @param string $value
     *
     * @return string
     */
    protected function validateUrlChangeFreq($value)
    {
        if ( in_array(trim(strtolower($value)),$this->changeFreqValid,true) ) {
            return $value;
        }

        return '';
    }

    /**
     * The priority of a particular URL relative to other pages on the same site.
     * The value for this element is a number between 0.0 and 1.0 where 0.0 identifies the lowest priority page(s).
     * The default priority of a page is 0.5. Priority is used to select between pages on your site.
     * Setting a priority of 1.0 for all URLs will not help you, as the relative priority of pages on your site is what will be considered.
     *
     * @param string $value
     *
     * @return string
     */
    protected function validateUrlPriority($value)
    {
        preg_match('/([0-9].[0-9])/', $value, $matches);

        if (!empty($matches[0]) && ($matches[0]<1.1) && ($matches[0]>0.0) ) {
            return $matches[1];
        } else {
            return 0.5;
        }
    }
}
