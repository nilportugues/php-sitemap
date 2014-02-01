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
     * Returns sitemap generated in an array.
     *
     * @return array
     */
    public function get()
    {
        return $this->files;
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
