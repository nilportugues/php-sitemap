<?php
/*
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Sonrisa\Component\Sitemap;
use Sonrisa\Component\Sitemap\Collections\ItemCollectionInterface;
use Sonrisa\Component\Sitemap\Items\ItemInterface;

/**
 * Interface SitemapInterface
 * @package Sonrisa\Component\Sitemap
 */
interface SitemapInterface
{
    /**
     * Generates sitemap documents and stores them in $this->data, an array holding as many positions
     * as total links divided by the $this->max_items_per_sitemap value.
     */
    public function build();

    /**
     * @param $filepath
     * @param $filename
     * @param bool $gzip
     * @return mixed
     */
    public function write($filepath,$filename,$gzip=false);
}