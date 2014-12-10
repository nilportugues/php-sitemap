<?php
/**
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 * Date: 12/10/14
 * Time: 1:59 AM
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace NilPortugues\Sitemap\Item\Media;

use NilPortugues\Sitemap\Item\SingletonTrait;
use NilPortugues\Sitemap\Item\ValidatorTrait;

/**
 * Class MediaItemValidator
 * @package NilPortugues\Sitemap\Items
 */
class MediaItemValidator
{
    use SingletonTrait;
    use ValidatorTrait;

    /**
     * @param $title
     *
     * @return bool|string
     */
    public function validateTitle($title)
    {
        if (is_string($title) && strlen($title)>0) {
            return $title;
        }

        return false;
    }

    /**
     * @param $mimeType
     *
     * @return bool|string
     */
    public function validateMimeType($mimeType)
    {
        if (is_string($mimeType) && strlen($mimeType)>0) {
            return $mimeType;
        }

        return false;
    }

    /**
     * @param $link
     *
     * @return bool|string
     */
    public function validateLink($link)
    {
        return $this->validateLoc($link);
    }

    /**
     * @param $player
     *
     * @return bool|string
     */
    public function validatePlayer($player)
    {
        return $this->validateLoc($player);
    }

    /**
     * @param $duration
     *
     * @return bool|integer
     */
    public function validateDuration($duration)
    {
        if (filter_var($duration, FILTER_SANITIZE_NUMBER_INT) && $duration>0) {
            return $duration;
        }

        return false;
    }

    /**
     * @param $description
     *
     * @return bool|string
     */
    public function validateDescription($description)
    {
        if (is_string($description) && strlen($description)>0) {
            return $description;
        }

        return false;
    }

    /**
     * @param $thumbnail
     *
     * @return bool|string
     */
    public function validateThumbnail($thumbnail)
    {
        return $this->validateLoc($thumbnail);
    }

    /**
     * @param $height
     *
     * @return bool|integer
     */
    public function validateHeight($height)
    {
        if (filter_var($height, FILTER_SANITIZE_NUMBER_INT) && $height>0) {
            return $height;
        }

        return false;
    }

    /**
     * @param $width
     *
     * @return bool|integer
     */
    public function validateWidth($width)
    {
        if (filter_var($width, FILTER_SANITIZE_NUMBER_INT) && $width>0) {
            return $width;
        }

        return false;
    }
}
