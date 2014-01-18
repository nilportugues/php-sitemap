<?php

namespace Sonrisa\Component\Sitemap;

use \Sonrisa\Component\Sitemap\Interfaces\AbstractSitemap as AbstractSitemap;
use \Sonrisa\Component\Sitemap\Exceptions\SitemapException as SitemapException;

/*
 *	https://support.google.com/webmasters/answer/178636?hl=es
 */

class ImageSitemap extends AbstractSitemap
{
	protected $max_image_tags_per_item = 1000;
}