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

use NilPortugues\Sitemap\Item\ValidatorTrait;

/**
 * Class MediaItemValidator
 * @package NilPortugues\Sitemap\Items
 */
class MediaItemValidator
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
     * @param $mimeType
     *
     * @return string|false
     */
    public function validateMimeType($mimeType)
    {
        return $this->validateString($mimeType);
    }

    /**
     * @param $link
     *
     * @return string|false
     */
    public function validateLink($link)
    {
        return $this->validateLoc($link);
    }

    /**
     * @param $player
     *
     * @return string|false
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
     * @return string|false
     */
    public function validateDescription($description)
    {
        return $this->validateString($description);
    }

    /**
     * @param $thumbnail
     *
     * @return string|false
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
