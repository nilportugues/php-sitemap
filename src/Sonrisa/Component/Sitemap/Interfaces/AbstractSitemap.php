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

    protected $max_filesize = 52428800; // 50 MB

    protected $xml_output = '';

    /**
     * Generates document with all sitemap items from Sitemap array
     *
     * Returns an array holding as many positions as total links divided by the $max_items_per_sitemap value.
     */
    public function output()
    {

    }

    public function writeFile($filepath)
    {

    }

    public function writeGzipFile($filepath)
    {

    }
}
