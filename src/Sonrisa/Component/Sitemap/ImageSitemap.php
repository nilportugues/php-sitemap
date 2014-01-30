<?php
/*
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Sonrisa\Component\Sitemap;

use \Sonrisa\Component\Sitemap\Interfaces\AbstractSitemap as AbstractSitemap;

/*
 *	https://support.google.com/webmasters/answer/178636?hl=es
 */

class ImageSitemap extends AbstractSitemap
{
    protected $max_image_tags_per_item = 1000;
}
