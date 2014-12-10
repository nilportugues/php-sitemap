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
     *
     * @return string|bool
     */
    public function validateTitle($title)
    {
        if (is_string($title)) {
            return $title;
        }

        return false;
    }

    /**
     * @param $caption
     *
     * @return string|bool
     */
    public function validateCaption($caption)
    {
        if (is_string($caption)) {
            return $caption;
        }

        return false;
    }

    /**
     * @param $geolocation
     *
     * @return string|bool
     */
    public function validateGeolocation($geolocation)
    {
        if (is_string($geolocation)) {
            return $geolocation;
        }

        return false;
    }

    /**
     * @param $license
     *
     * @return string|bool
     */
    public function validateLicense($license)
    {
        if (is_string($license)) {
            return $license;
        }

        return false;
    }
}
