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

use NilPortugues\Sitemap\Item\ValidatorTrait;

/**
 * Class ImageItemValidator
 * @package NilPortugues\Sitemap\Items
 */
class ImageItemValidator
{
    use ValidatorTrait;

    /**
     * @param $title
     *
     * @return string|false
     */
    public function validateTitle($title)
    {
        return $this->validateString($title);
    }

    /**
     * @param $caption
     *
     * @return string|false
     */
    public function validateCaption($caption)
    {
        return $this->validateString($caption);
    }

    /**
     * @param $geolocation
     *
     * @return string|false
     */
    public function validateGeolocation($geolocation)
    {
        return $this->validateString($geolocation);
    }

    /**
     * @param $license
     *
     * @return string|false
     */
    public function validateLicense($license)
    {
        return $this->validateString($license);
    }
}
