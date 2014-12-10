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
     * @return string
     */
    public function validateTitle($title)
    {
        return $title;
    }

    /**
     * @param $mimetype
     * @return string
     */
    public function validateMimetype($mimetype)
    {
        return $mimetype;
    }

    /**
     * @param $link
     * @return string
     */
    public function validateLink($link)
    {
        return $this->validateLoc($link);
    }

    /**
     * @param $player
     * @return string
     */
    public function validatePlayer($player)
    {
        return $this->validateLoc($player);
    }

    /**
     * @param $duration
     * @return integer
     */
    public function validateDuration($duration)
    {
        $data = '';
        if (filter_var($duration, FILTER_SANITIZE_NUMBER_INT)) {
            $data = $duration;
        }

        return $data;
    }

    /**
     * @param $description
     * @return string
     */
    public function validateDescription($description)
    {
        return $description;
    }

    /**
     * @param $thumbnail
     * @return string
     */
    public function validateThumbnail($thumbnail)
    {
        return $this->validateLoc($thumbnail);
    }

    /**
     * @param $height
     * @return integer
     */
    public function validateHeight($height)
    {
        $data = '';
        if (filter_var($height, FILTER_SANITIZE_NUMBER_INT)) {
            $data = $height;
        }

        return $data;
    }

    /**
     * @param $width
     * @return integer
     */
    public function validateWidth($width)
    {
        $data = '';
        if (filter_var($width, FILTER_SANITIZE_NUMBER_INT)) {
            $data = $width;
        }

        return $data;
    }
}
