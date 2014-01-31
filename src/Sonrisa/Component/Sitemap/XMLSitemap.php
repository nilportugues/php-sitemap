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
    protected $data = array();

    protected $recordUrls = array();

    /**
     * @var array
     */
    protected $changeFreqValid = array("always","hourly","daily","weekly","monthly","yearly","never");

    /**
     * @param string $url
     * @param string $priority
     * @param string $changefreq
     * @param string $lastmod
     * @param string $lastmodformat
     * @return $this
     */
    public function addUrl($url,$priority='',$changefreq='',$lastmod='',$lastmodformat='Y-m-d\TH:i:sP')
    {
        //Make sure the mandatory value is valid.
        $url = $this->validateUrlLoc($url);

        //Make sure we won't be adding a valid but duplicated URL to the sitemap.
        if(!empty($url) && !in_array($url,$this->recordUrls,true))
        {

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
            if(!empty($dataSet))
            {
                $this->data['url'][$dataSet['priority']][] = $dataSet;
            }
        }
        return $this;
    }


    /**
     * @return array
     */
    public function build()
    {
        $files = array();

        $urlSetBody = $this->buildUrlSetCollection();
        if(!empty($urlSetBody))
        {
            foreach($urlSetBody as $fileNumber => $urlSet)
            {
                $xml = array();

                $xml[] = '<?xml version="1.0" encoding="UTF-8"?>';
                $xml[] = '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
                $xml[] = $urlSet;
                $xml[] = '</urlset>';

                $files[$fileNumber] = implode("\n",$xml);
            }
        }
        else
        {
            $xml = array();

            $xml[] = '<?xml version="1.0" encoding="UTF-8"?>';
            $xml[] = '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
            $xml[] = '</urlset>';
            $files[0] = implode("\n",$xml);
        }
        return $files;
    }

    /**
     * Loop through $this->data['url'] and build Sitemap.xml
     * taking into account each urlset can hold a max of 50.000 url elements
     *
     * @return array
     */
    protected function buildUrlSetCollection()
    {
        $files = array();

        if(!empty($this->data['url']))
        {
            $i = 0;
            $url =0;
            foreach( $this->data['url'] as $prioritySets )
            {
                foreach($prioritySets as $urlData)
                {
                    $xml = array();
                    $xml[] = "\t".'<url>';
                    $xml[] = (!empty($urlData['loc']))?         "\t\t<loc>{$urlData['loc']}</loc>"                      : '';
                    $xml[] = (!empty($urlData['lastmod']))?     "\t\t<lastmod>{$urlData['lastmod']}</lastmod>"          : '';
                    $xml[] = (!empty($urlData['changefreq']))?  "\t\t<changefreq>{$urlData['changefreq']}</changefreq>" : '';
                    $xml[] = (!empty($urlData['priority']))?    "\t\t<priority>{$urlData['priority']}</priority>"       : '';
                    $xml[] = "\t".'</url>';

                    //Remove empty fields
                    $xml = array_filter($xml);

                    //Build string
                    $files[$i][] = implode("\n",$xml);

                    //If amount of $url added is above the limit, increment the file counter.
                    if($url > $this->max_items_per_sitemap )
                    {
                        $i++;
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
     * The location URI of a document. The URI must conform to RFC 2396 (http://www.ietf.org/rfc/rfc2396.txt)
     *
     * @param string $value
     *
     * @return string
     */
    protected function validateUrlLoc($value)
    {
        if( filter_var( $value, FILTER_VALIDATE_URL, array('options' => array('flags' => FILTER_FLAG_PATH_REQUIRED)) ) )
        {
            return $value;
        }
        return '';
    }

    /**
     * The date must conform to the W3C DATETIME format (http://www.w3.org/TR/NOTE-datetime).
     * Example: 2005-05-10 Lastmod may also contain a timestamp or 2005-05-10T17:33:30+08:00
     *
     * @param string $value
     * @param string $format
     *
     * @return string
     */
    protected function validateUrlLastMod($value, $format)
    {
        if ( ($date = \DateTime::createFromFormat( $format, $value )) !== false )
        {
            return $date->format( 'c' );
        }
        if ( ($date = \DateTime::createFromFormat( 'Y-m-d', $value )) !== false )
        {
            return $date->format( 'c' );
        }
        else
        {
            return '';
        }
    }

    /**
     * @param string $value
     *
     * @return string
     */
    protected function validateUrlChangeFreq($value)
    {
        if( in_array(trim(strtolower($value)),$this->changeFreqValid,true) )
        {
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
        preg_match('#\d+(\.\d{1,1})?#', $value, $matches);

        if(!empty($matches[0]) && ($matches[0]<1.2) && ($matches[0]>0.0) )
        {
            return $value;
        }
        else
        {
            return 0.5;
        }
    }
}
