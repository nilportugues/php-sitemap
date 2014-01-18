<?php

namespace Sonrisa\Component\Sitemap;

use \Sonrisa\Component\Sitemap\Interfaces\AbstractSitemap as AbstractSitemap;

/*
 *	https://support.google.com/webmasters/answer/178636?hl=es
 */

class ImageSitemap extends AbstractSitemap
{
    protected $max_image_tags_per_item = 1000;
}
