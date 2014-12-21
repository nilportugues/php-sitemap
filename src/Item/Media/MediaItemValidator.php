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
        return self::validateString($title);
    }

    /**
     * @param $mimeType
     *
     * @return string|false
     */
    public function validateMimeType($mimeType)
    {
        return self::validateString($mimeType);
    }

    /**
     * @param $link
     *
     * @return string|false
     */
    public function validateLink($link)
    {
        return self::validateLoc($link);
    }

    /**
     * @param $player
     *
     * @return string|false
     */
    public function validatePlayer($player)
    {
        return self::validateLoc($player);
    }

    /**
     * @param $duration
     *
     * @return bool|integer
     */
    public function validateDuration($duration)
    {
        return self::validateInteger($duration);
    }

    /**
     * @param $description
     *
     * @return string|false
     */
    public function validateDescription($description)
    {
        return self::validateString($description);
    }

    /**
     * @param $thumbnail
     *
     * @return string|false
     */
    public function validateThumbnail($thumbnail)
    {
        return self::validateLoc($thumbnail);
    }

    /**
     * @param $height
     *
     * @return bool|integer
     */
    public function validateHeight($height)
    {
        return self::validateInteger($height);
    }

    /**
     * @param $width
     *
     * @return bool|integer
     */
    public function validateWidth($width)
    {
        return self::validateInteger($width);
    }
}
