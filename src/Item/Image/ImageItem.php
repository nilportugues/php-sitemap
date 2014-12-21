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
        self::$xml       = $this->reset();
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
            "<image:image>",
            'loc'         => '',
            'title'       => '',
            'caption'     => '',
            'geolocation' => '',
            'license'     => '',
            "</image:image>"
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
        self::writeFullTag(
            $loc,
            'loc',
            false,
            'image:loc',
            $this->validator,
            'validateLoc',
            $this->exception,
            'Provided URL is not a valid value.'
        );

        return $this;
    }


    /**
     * @param $title
     *
     * @return $this
     * @throws ImageItemException
     */
    public function setTitle($title)
    {
        self::writeFullTag(
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
        self::writeFullTag(
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
     * @param $geoLocation
     *
     * @throws ImageItemException
     * @return $this
     */
    public function setGeoLocation($geoLocation)
    {
        self::writeFullTag(
            $geoLocation,
            'geolocation',
            true,
            'image:geolocation',
            $this->validator,
            'validateGeoLocation',
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
        self::writeFullTag(
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
