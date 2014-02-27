<?php
/*
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Sonrisa\Component\Sitemap;
use Sonrisa\Component\Sitemap\Collections\ItemCollectionInterface;
use Sonrisa\Component\Sitemap\Exceptions\SitemapException;
use Sonrisa\Component\Sitemap\Items\AbstractItem;
use Sonrisa\Component\Sitemap\Items\ItemInterface;

/**
 * Class AbstractSitemap
 * @package Sonrisa\Component\Sitemap
 */
abstract class AbstractSitemap implements SitemapInterface
{
    /**
     * @var array
     */
    protected $data = array();

    /**
     * @var Validators\AbstractValidator
     */
    protected $validator;

    /**
     * @var Items\AbstractItem
     */
    protected $item;

    /**
     * Variable holding the items added to a file.
     *
     * @var int
     */
    protected $total_items = 0;

    /**
     * @var array
     */
    protected $items = array();

    /**
     * Array holding the files created by this class.
     *
     * @var array
     */
    protected $files = array();

    /**
     * Variable holding the number of files created by this class.
     *
     * @var int
     */
    protected $total_files = 1;

    /**
     * @var int
     */
    protected $current_file_byte_size = 0;

    /**
     * Keep a track of the used URLs.
     *
     * @var array
     */
    protected $used_urls = array();

    /**
     * Maximum amount of URLs elements per sitemap file.
     *
     * @var int
     */
    protected $max_items_per_sitemap = 50000;

    /**
     * @var int
     */
    protected $max_filesize = 52428800; // 50 MB


    /**
     * @param AbstractItem $item
     * @return array
     */
    protected function buildFiles(AbstractItem $item)
    {
        $output = array();
        if (!empty($this->files)) {
            foreach ($this->files as $file) {
                if ( str_replace(array("\n","\t"),'',$file) != '' ) {
                    $output[] = $item->getHeader()."\n".$file."\n".$item->getFooter();
                }
            }
        }
        $this->output = $output;

        return $output;
    }

    /**
     * @param $filepath
     * @param $filename
     * @param  bool                        $gzip
     * @return bool
     * @throws Exceptions\SitemapException
     */
    public function write($filepath,$filename,$gzip=false)
    {
        if (empty($this->output)) {
            throw new SitemapException('Will not write to directory. Use build() method first.');
        }

        $success = false;
        if ( is_dir($filepath) && is_writable($filepath)) {
            $filepath = realpath($filepath);

            $path_parts = pathinfo($filename);
            $basename = $path_parts['filename'];
            $extension = $path_parts['extension'];

            //Write all generated sitemaps to files: sitemap1.xml, sitemap2.xml, etc..
            foreach ($this->output as $fileNumber => $sitemap) {
                $i = ($fileNumber == 0) ? '' : $fileNumber;
                $sitemapPath = $filepath.DIRECTORY_SEPARATOR."{$basename}{$i}.{$extension}";

                //Writes files to disk
                if ($gzip == true) {
                    $success = $this->writeGzipFile($sitemapPath.".gz",$sitemap);
                } else {
                    $success = $this->writePlainFile($sitemapPath,$sitemap);
                }
            }
        } else {
            throw new SitemapException('Cannot write to directory: '.$filepath);
        }

        return $success;
    }

    /**
     * @param $filepath
     * @param $contents
     * @return bool
     */
    protected function writePlainFile($filepath,$contents)
    {
        return file_put_contents($filepath,$contents);
    }

    /**
     * @param $filepath
     * @param $contents
     * @return bool
     */
    protected function writeGzipFile($filepath,$contents)
    {
        $status = false;
        $fp = gzopen ($filepath, 'w9');

        if ($fp !== false) {
            gzwrite ($fp, $contents);
            $status = gzclose($fp);
        }

        return $status;

    }
}
