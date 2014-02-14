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

    protected $files = array();

    /**
     * @return mixed
     */
    public function build()
    {
        $files = array();
        $generatedFiles = $this->buildUrlImageCollection();

        var_dump($generatedFiles); die();

        if (!empty($generatedFiles)) {
            foreach ($generatedFiles as $fileNumber => $urlSet) {
                $xml =  '<?xml version="1.0" encoding="UTF-8"?>'."\n".
                        '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1" >'."\n".
                        $urlSet."\n".
                        '</urlset>';

                $files[$fileNumber] = $xml;
            }
        }
        else
        {
            $xml =  '<?xml version="1.0" encoding="UTF-8"?>'."\n".
                    '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">'."\n".
                    '</urlset>';

            $files[0] = $xml;
        }

        //Save files array and empty url buffer
        $this->files = $files;

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
    public function add($url,array $imageData)
    {
        $imageLoc = NULL;

        //Make sure the mandatory values are valid.
        $url = $this->validateUrlLoc($url);

        if(!empty($imageData['loc']))
        {
            $imageLoc = $this->validateUrlLoc($imageData['loc']);

            if ( !empty($url) && !empty($imageLoc) )
            {
                if(empty($this->data['images'][$url]))
                {
                    $this->data['images'][$url] = array();
                    echo 1;
                }

                // Check if there are less than 1001 images for this url
                if(count($this->data['images'][$url]) <= $this->max_images_per_url)
                {
                    //Let the data array know that for a URL there are images
                    $this->data['images'][$url][$imageLoc] = $imageData;

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
    protected function buildUrlImageCollection()
    {

        if(!empty( $this->data['images']))
        {
            $images = array();


            foreach( $this->data['images'] as $dataSet )
            {
                $url = key($dataSet);

                $images[] = "\t<url>";
                $images[] = "\t\t<loc>{$url}</loc>";

                foreach($dataSet as $imageData)
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

                $images[] = "\t".'<\url>';

                //validate if size is above the max or not. If so, add to array as a new file


            }




            return implode("\n",$images);
        }
        return '';
    }
}