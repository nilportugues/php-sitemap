<?php
/*
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Sonrisa\Component\Sitemap\Interfaces;

abstract class AbstractSitemap
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
     * Maximum amount of URLs elements per sitemap file.
     *
     * @var int
     */
    protected $max_items_per_sitemap = 50000;

    /**
     * Maximum amount of <image:loc> elements per <url> element.
     *
     * @var int
     */
    protected $max_images_per_url = 1000;

    /**
     * @var int
     */
    protected $max_filesize = 52428800; // 50 MB

    /**
     * @var array
     */
    protected $files = array();

    /**
     * Generates sitemap documents and stores them in $this->data, an array holding as many positions
     * as total links divided by the $this->max_items_per_sitemap value.
     */
    abstract public function build();

    /**
     * @todo: Returns sitemap generated in an array.
     *
     * @return array
     */
    public function get()
    {
        return $this->files;
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
        if ( filter_var( $value, FILTER_VALIDATE_URL, array('options' => array('flags' => FILTER_FLAG_PATH_REQUIRED)) ) ) {
            return htmlentities($value);
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
        if ( ($date = \DateTime::createFromFormat( $format, $value )) !== false ) {
            return htmlentities($date->format( 'c' ));
        }
        if ( ($date = \DateTime::createFromFormat( 'Y-m-d', $value )) !== false ) {
            return htmlentities($date->format( 'c' ));
        } else {
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
        if ( in_array(trim(strtolower($value)),$this->changeFreqValid,true) ) {
            return htmlentities($value);
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

    /**
     * @param $filepath
     * @param $filename
     */
    public function write($filepath,$filename)
    {

        //Write to disk.
        if(!empty($array[0]) && count($array) > 1)
        {
            //Write all generated sitemaps to files: sitemap1.xml, sitemap2.xml, etc..
            $id = 1;
            foreach($array as $fileNumber => $sitemap)
            {
                // Would be nice to use writeGzipFile instead ;)

                $i = ($fileNumber == 0) ? 1  : $id;
                file_put_contents("file/to/{$baseFilename}-{$i}.xml",$sitemap);
                $id++;
            }

            // While not mandatory, it is wise to generated sitemap.xml file containing
            // the urls to the other sitemap files when more than one file is produced.
        }
        else
        {
            file_put_contents("file/to/sitemap{$i}.xml",$array[0]);
        }
    }

    protected function writeGzipFile($filepath)
    {

    }
}
