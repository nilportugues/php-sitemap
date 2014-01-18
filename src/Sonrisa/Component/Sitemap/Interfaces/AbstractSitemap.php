<?php

namespace Sonrisa\Component\Sitemap\Interfaces;

abstract class AbstractSitemap
{
  	/**
     * Quantity of URLs per single sitemap file. According to specification max value is 50.000.
     */
     * @var int
     */
    protected $max_items_per_sitemap = 50000;

    protected $max_filesize = 52428800; // 50 MB

	/**
     * @var string
     */
    protected $base_sitemap_url;

	/**
     * Generates document with all sitemap items from Sitemap array
	 *
	 * Returns an array holding as many positions as total links divided by the $max_items_per_sitemap value.
	 */
	public function output()
	{
		
	}

	public function writeFile()
	{

	}

	public function writeGzipFile()
	{

	}
}