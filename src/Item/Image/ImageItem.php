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
        $loc = $this->validator->validateLoc($loc);
        if (false === $loc) {
            throw new ImageItemException(
                sprintf('Provided URL \'%s\' is not a valid value.', $loc)
            );
        }

        $this->xml['loc'] = "\t\t<loc>".$loc."</loc>";

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
        $title = $this->validator->validateTitle($title);
        if (false === $title) {
            throw new ImageItemException(
                sprintf('Provided title \'%s\' is not a valid value.', $title)
            );
        }

        $this->xml['title'] = "\t\t\t".'<image:title><![CDATA['.$title.']]></image:title>';

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
        $caption = $this->validator->validateCaption($caption);

        if (false === $caption) {
            throw new ImageItemException(
                sprintf('Provided caption \'%s\' is not a valid value.', $caption)
            );
        }
        $this->xml['caption'] = "\t\t\t".'<image:caption><![CDATA['.$caption.']]></image:caption>';

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
        $geolocation = $this->validator->validateGeolocation($geolocation);

        if (false === $geolocation) {
            throw new ImageItemException(
                sprintf('Provided geolocation \'%s\' is not a valid value.', $geolocation)
            );
        }
        $this->xml['geolocation'] = "\t\t\t".'<image:geolocation><![CDATA['.$geolocation.']]></image:geolocation>';

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
        $license = $this->validator->validateLicense($license);

        if (false === $license) {
            throw new ImageItemException(
                sprintf('Provided license \'%s\' is not a valid value.', $license)
            );
        }

        $this->xml['license'] = "\t\t\t".'<image:license><![CDATA['.$license.']]></image:license>';

        return $this;
    }
}
