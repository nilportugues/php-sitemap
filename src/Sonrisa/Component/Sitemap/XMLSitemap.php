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
    public function addUrl($url,$priority='',$changefreq='',$lastmod='',$lastmodformat='Y-m-d H:i:s')
    {
        //Make sure the mandatory value is valid.
        $url = $this->validateUrlLoc($url);

        if(!empty($url))
        {
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
     * The location URI of a document. The URI must conform to RFC 2396 (http://www.ietf.org/rfc/rfc2396.txt)
     *
     * @param string $value
     *
     * @return string
     */
    protected function validateUrlLoc($value)
    {
        if( filter_var( $value, FILTER_VALIDATE_URL, array('options' => array('flags' => FILTER_FLAG_PATH_REQUIRED)) )===true )
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
            return $date->format('Y-m-d\TH:i:sP');
        }
        if ( ($date = \DateTime::createFromFormat( 'Y-m-d', $value )) !== false )
        {
            return $date->format('Y-m-d\TH:i:sP');
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
