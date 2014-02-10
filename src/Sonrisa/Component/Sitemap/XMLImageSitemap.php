<?php
/*
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Sonrisa\Component\Sitemap;

class XMLImageSitemap extends XMLSitemap
{
    /**
     * @var array
     */
    protected $data = array
    (
        'images' => array(),
        'url'   => array(),
    );
    /**
     * @return mixed
     */
    public function build()
    {
        $files = array();
        $xmlImages='';
        $generatedFiles = $this->buildUrlSetCollection();

        if(!empty($this->data['images']))
        {
            $xmlImages.=' xmlns:image="http://www.google.com/schemas/sitemap-image/1.1"';
        }

        if (!empty($generatedFiles)) {
            foreach ($generatedFiles as $fileNumber => $urlSet) {
                $xml =  '<?xml version="1.0" encoding="UTF-8"?>'."\n".
                        '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"'.$xmlImages.'>'."\n".
                        $urlSet."\n".
                        '</urlset>';

                $files[$fileNumber] = $xml;
            }
        }
        else
        {
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

            if ( !empty($url) && !empty($imageLoc) )
            {
                $dataSet = array
                (
                    'loc'             => $imageLoc,
                    'title'           => (!empty($imageData['title']))? htmlentities($imageData['title'])               : '',
                    'caption'         => (!empty($imageData['caption']))? htmlentities($imageData['caption'])           : '',
                    'geolocation'     => (!empty($imageData['geolocation']))? htmlentities($imageData['geolocation'])   : '',
                    'license'         => (!empty($imageData['license']))? htmlentities($imageData['license'])           : '',
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
        }
        return $this;
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
}