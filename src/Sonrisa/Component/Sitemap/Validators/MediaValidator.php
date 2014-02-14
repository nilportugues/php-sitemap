<?php
/*
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Sonrisa\Component\Sitemap\Validators;

/**
 * Class MediaValidator
 * @package Sonrisa\Component\Sitemap\Validators
 */
class MediaValidator extends AbstractValidator
{
    /**
     * @param $mimetype
     * @return string
     */
    public static function validateMimetype($mimetype)
    {
        return $mimetype;
    }

    /**
     * @param $player
     * @return string
     */
    public static function validatePlayer($player)
    {
        return self::validateLoc($player);
    }

    /**
     * @param $duration
     * @return integer
     */
    public static function validateDuration($duration)
    {
        if( filter_var($duration,FILTER_SANITIZE_NUMBER_INT))
        {
            return $duration;
        }
        return '';
    }

    /**
     * @param $description
     * @return string
     */
    public static function validateDescription($description)
    {
        return $description;
    }

    /**
     * @param $thumbnail
     * @return string
     */
    public static function validateThumbnail($thumbnail)
    {
        return self::validateLoc($thumbnail);
    }

    /**
     * @param $height
     * @return integer
     */
    public static function validateHeight($height)
    {
        if( filter_var($height,FILTER_SANITIZE_NUMBER_INT))
        {
            return $height;
        }
        return '';
    }

    /**
     * @param $width
     * @return integer
     */
    public static function validateWidth($width)
    {
        if( filter_var($width,FILTER_SANITIZE_NUMBER_INT))
        {
            return $width;
        }
        return '';
    }
}