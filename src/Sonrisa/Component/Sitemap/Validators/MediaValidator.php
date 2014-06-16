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
class MediaValidator extends SharedValidator
{

    /**
     * @var \Sonrisa\Component\Sitemap\Validators\MediaValidator
     */
    protected static $instance;

    /**
     * @return SharedValidator
     */
    public static function getInstance()
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     *
     */
    protected function __construct()
    {
    }

    /**
     * @param $title
     * @return string
     */
    public static function validateTitle($title)
    {
        return $title;
    }

    /**
     * @param $mimetype
     * @return string
     */
    public static function validateMimetype($mimetype)
    {
        return $mimetype;
    }

    /**
     * @param $link
     * @return string
     */
    public static function validateLink($link)
    {
        return self::validateLoc($link);
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
    public static function validateWidth($width)
    {
        $data = '';
        if (filter_var($width, FILTER_SANITIZE_NUMBER_INT)) {
            $data = $width;
        }

        return $data;
    }
}
