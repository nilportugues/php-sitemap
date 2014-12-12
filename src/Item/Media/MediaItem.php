<?php
/*
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace NilPortugues\Sitemap\Item\Media;

use NilPortugues\Sitemap\Item\AbstractItem;

/**
 * Class MediaItem
 * @package NilPortugues\Sitemap\Items
 */
class MediaItem extends AbstractItem
{
    /**
     * @var MediaItemValidator
     */
    protected $validator;

    /**
     * @var string
     */
    protected $exception = 'NilPortugues\Sitemap\Item\Media\MediaItemException';

    /**
     *
     */
    public function __construct($link)
    {
        $this->validator = MediaItemValidator::getInstance();
        $this->xml       = $this->reset();
        $this->setLink($link);
    }

    /**
     * Resets the data structure used to represent the item as XML.
     *
     * @return array
     */
    protected function reset()
    {
        return [
            "\t".'<item xmlns:media="http://search.yahoo.com/mrss/" xmlns:dcterms="http://purl.org/dc/terms/">',
            'link'        => '',
            'duration'    => '',
            'player'      => '',
            'title'       => '',
            'description' => '',
            'thumbnail'   => '',
            "\t\t".'</media:content>',
            "\t".'</item>',
        ];
    }

    /**
     * @param $link
     *
     * @throws MediaItemException
     * @return $this
     */
    protected function setLink($link)
    {
        $this->writeFullTag(
            $link,
            'link',
            false,
            'link',
            $this->validator,
            'validateLink',
            $this->exception,
            'Provided link is not a valid value.'
        );

        return $this;
    }

    /**
     * @return string
     */
    public static function getHeader()
    {
        return '<?xml version="1.0" encoding="UTF-8"?>'."\n".
        '<rss version="2.0" xmlns:media="http://search.yahoo.com/mrss/" xmlns:dcterms="http://purl.org/dc/terms/">'
        ."\n".'<channel>'."\n";
    }

    /**
     * @return string
     */
    public static function getFooter()
    {
        return "</channel>\n</rss>";
    }

    /**
     * @param      $mimeType
     * @param null $duration
     *
     * @return MediaItem
     */
    public function setContent($mimeType, $duration = null)
    {
        $this->xml['content'] = "\t\t<media:content";
        $this->setContentMimeType($mimeType);
        $this->setContentDuration($duration);
        $this->xml['content'] .= ">";

        return $this;
    }

    /**
     * @param $mimeType
     *
     * @throws MediaItemException
     */
    protected function setContentMimeType($mimeType)
    {
        $this->writeAttribute(
            $mimeType,
            'content',
            'type',
            $this->validator,
            'validateMimeType',
            $this->exception,
            'Provided mime-type is not a valid value.'
        );
    }

    /**
     * @param $duration
     *
     * @throws MediaItemException
     */
    protected function setContentDuration($duration)
    {
        if (null !== $duration) {
            $this->writeAttribute(
                $duration,
                'content',
                'duration',
                $this->validator,
                'validateDuration',
                $this->exception,
                'Provided duration is not a valid value.'
            );
        }
    }

    /**
     * @param $player
     *
     * @throws MediaItemException
     * @return $this
     */
    public function setPlayer($player)
    {
        $this->xml['player'] = "\t\t\t<media:player";

        $this->writeAttribute(
            $player,
            'player',
            'url',
            $this->validator,
            'validatePlayer',
            $this->exception,
            'Provided player URL is not a valid value.'
        );

        $this->xml['player'] .= " />";

        return $this;
    }

    /**
     * @param $title
     *
     * @throws MediaItemException
     * @return $this
     */
    public function setTitle($title)
    {
        $this->writeFullTag(
            $title,
            'title',
            false,
            'media:title',
            $this->validator,
            'validateTitle',
            $this->exception,
            'Provided title is not a valid value.'
        );

        return $this;
    }

    /**
     * @param $description
     *
     * @throws MediaItemException
     * @return $this
     */
    public function setDescription($description)
    {
        $this->writeFullTag(
            $description,
            'description',
            false,
            'media:description',
            $this->validator,
            'validateDescription',
            $this->exception,
            'Provided description is not a valid value.'
        );

        return $this;
    }

    /**
     * @param      $thumbnail
     * @param null $height
     * @param null $weight
     *
     * @return $this
     */
    public function setThumbnail($thumbnail, $height = null, $weight = null)
    {
        $this->xml['thumbnail'] = "\t\t\t<media:thumbnail";
        $this->setThumbnailUrl($thumbnail);

        if (null !== $height) {
            $this->setThumbnailHeight($height);
        }

        if (null !== $weight) {
            $this->setThumbnailWidth($weight);
        }

        $this->xml['thumbnail'] .= "/>";

        return $this;
    }

    /**
     * @param $url
     *
     * @throws MediaItemException
     * @return $this
     */
    protected function setThumbnailUrl($url)
    {
        $this->writeAttribute(
            $url,
            'thumbnail',
            'url',
            $this->validator,
            'validateThumbnail',
            $this->exception,
            'Provided thumbnail URL is not a valid value.'
        );

        return $this;
    }

    /**
     * @param $height
     *
     * @throws MediaItemException
     * @return $this
     */
    protected function setThumbnailHeight($height)
    {
        $this->writeAttribute(
            $height,
            'thumbnail',
            'height',
            $this->validator,
            'validateHeight',
            $this->exception,
            'Provided height is not a valid value.'
        );

        return $this;
    }

    /**
     * @param $width
     *
     * @throws MediaItemException
     * @return $this
     */
    protected function setThumbnailWidth($width)
    {
        $this->writeAttribute(
            $width,
            'thumbnail',
            'width',
            $this->validator,
            'validateWidth',
            $this->exception,
            'Provided width is not a valid value.'
        );

        return $this;
    }
}
