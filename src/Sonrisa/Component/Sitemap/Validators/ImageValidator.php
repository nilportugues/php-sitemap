<?php
/*
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Sonrisa\Component\Sitemap\Validators;

/**
 * Class ImageValidator
 * @package Sonrisa\Component\Sitemap\Validators
 */
class ImageValidator extends SharedValidator
{

    /**
     * @var \Sonrisa\Component\Sitemap\Validators\ImageValidator
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
    public static function validateCaption($caption)
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
    public static function validateGeolocation($geolocation)
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
    public static function validateLicense($license)
    {
        $data = '';
        if (is_string($license)) {
            $data = $license;
        }

        return $data;
    }
}
