<?php
/*
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace NilPortugues\Sitemap\Item\Image;

use NilPortugues\Sitemap\Item\AbstractItem;

/**
 * Class ImageItem
 * @package NilPortugues\Sitemap\Item\Image
 */
class ImageItem extends AbstractItem
{
    /**
     * @var ImageItemValidator
     */
    protected $validator;

    /**
     * @var string
     */
    protected $exception = 'NilPortugues\Sitemap\Item\Image\ImageItemException';

    /**
     * @param $loc
     */
    public function __construct($loc)
    {
        $this->validator = ImageItemValidator::getInstance();
        $this->xml       = $this->reset();
        $this->setLoc($loc);
    }

    /**
     * Resets the data structure used to represent the item as XML.
     *
     * @return array
     */
    protected function reset()
    {
        return [
            "\t<image:image>",
            'loc'         => '',
            'title'       => '',
            'caption'     => '',
            'geolocation' => '',
            'license'     => '',
            "\t</image:image>"
        ];
    }

    /**
     * @param $loc
     *
     * @throws ImageItemException
     * @return $this
     */
    protected function setLoc($loc)
    {
        $this->writeFullTag(
            $loc,
            'loc',
            false,
            'loc',
            $this->validator,
            'validateLoc',
            $this->exception,
            'Provided URL is not a valid value.'
        );

        return $this;
    }

    /**
     * @return string
     */
    public static function getHeader()
    {
        return '<?xml version="1.0" encoding="UTF-8"?>'."\n".
        '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" '.
        'xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">'."\n";
    }

    /**
     * @return string
     */
    public static function getFooter()
    {
        return "</urlset>";
    }

    /**
     * @param $title
     *
     * @return $this
     * @throws ImageItemException
     */
    public function setTitle($title)
    {
        $this->writeFullTag(
            $title,
            'title',
            true,
            'image:title',
            $this->validator,
            'validateTitle',
            $this->exception,
            'Provided title is not a valid value.'
        );

        return $this;
    }

    /**
     * @param $caption
     *
     * @throws ImageItemException
     * @return $this
     */
    public function setCaption($caption)
    {
        $this->writeFullTag(
            $caption,
            'caption',
            true,
            'image:caption',
            $this->validator,
            'validateCaption',
            $this->exception,
            'Provided caption is not a valid value.'
        );

        return $this;
    }

    /**
     * @param $geolocation
     *
     * @throws ImageItemException
     * @return $this
     */
    public function setGeolocation($geolocation)
    {
        $this->writeFullTag(
            $geolocation,
            'geolocation',
            true,
            'image:geolocation',
            $this->validator,
            'validateGeolocation',
            $this->exception,
            'Provided geolocation is not a valid value.'
        );

        return $this;
    }

    /**
     * @param $license
     *
     * @throws ImageItemException
     * @return $this
     */
    public function setLicense($license)
    {
        $this->writeFullTag(
            $license,
            'license',
            true,
            'image:license',
            $this->validator,
            'validateLicense',
            $this->exception,
            'Provided license is not a valid value.'
        );

        return $this;
    }
}
