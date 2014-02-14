<?php
/*
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Sonrisa\Component\Sitemap;

use Sonrisa\Component\Sitemap\Items\ImageItem;
use Sonrisa\Component\Sitemap\Validators\ImageValidator;

/**
 * Class ImageSitemap
 * @package Sonrisa\Component\Sitemap
 */
class ImageSitemap extends AbstractSitemap
{
    /**
     *
     */
    public function __construct()
    {
        $this->validator = new ImageValidator();
    }

    /**
     * @param $data
     * @return $this
     */
    public function add($data)
    {

    }

    /**
     * @return array
     */
    public function build()
    {
        $item = new ImageItem($this->validator);
        return self::buildFiles($item);
    }
}