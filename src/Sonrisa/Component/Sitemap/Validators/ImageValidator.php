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
class ImageValidator extends AbstractValidator
{

    /**
     * @param $title
     * @return mixed
     */
    public static function validateTitle($title)
    {
        if(is_string($title)){
            return $title;
        }
        return '';
    }

    /**
     * @param $caption
     * @return mixed
     */
    public static function validateCaption($caption)
    {
        if(is_string($caption))
        {
            return $caption;
        }
        return '';
    }

    /**
     * @param $geolocation
     * @return mixed
     */
    public static function validateGeolocation($geolocation)
    {
        if(is_string($geolocation)){
            return $geolocation;
        }

        return '';
    }

    /**
     * @param $license
     * @return mixed
     */
    public static function validateLicense($license)
    {
        if(is_string($license)){
            return $license;
        }
        return '';
    }
}