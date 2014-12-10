<?php
/**
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 * Date: 12/10/14
 * Time: 1:58 AM
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace NilPortugues\Sitemap\Item\Image;

use NilPortugues\Sitemap\Item\SingletonTrait;
use NilPortugues\Sitemap\Item\ValidatorTrait;

/**
 * Class ImageItemValidator
 * @package NilPortugues\Sitemap\Items
 */
class ImageItemValidator
{
    use SingletonTrait;
    use ValidatorTrait;

    /**
     * @param $title
     * @return string
     */
    public function validateTitle($title)
    {
        $data = '';
        if (is_string($title)) {
            $data = $title;
        }

        return $data;
    }

    /**
     * @param $caption
     * @return string
     */
    public function validateCaption($caption)
    {
        $data = '';
        if (is_string($caption)) {
            $data = $caption;
        }

        return $data;
    }

    /**
     * @param $geolocation
     * @return string
     */
    public function validateGeolocation($geolocation)
    {
        $data = '';
        if (is_string($geolocation)) {
            $data = $geolocation;
        }

        return $data;
    }

    /**
     * @param $license
     * @return string
     */
    public function validateLicense($license)
    {
        $data = '';
        if (is_string($license)) {
            $data = $license;
        }

        return $data;
    }
}
