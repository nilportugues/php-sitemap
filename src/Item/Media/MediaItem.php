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
        self::$xml       = $this->reset();
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
            '<item xmlns:media="http://search.yahoo.com/mrss/" xmlns:dcterms="http://purl.org/dc/terms/">',
            'content'        => '',
            'link'        => '',
            'duration'    => '',
            'player'      => '',
            'title'       => '',
            'description' => '',
            'thumbnail'   => '',
            '</media:content>',
            '</item>',
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
        self::writeFullTag(
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
     * @param      $mimeType
     * @param null $duration
     *
     * @return MediaItem
     */
    public function setContent($mimeType, $duration = null)
    {
        self::$xml['content'] = "<media:content";
        $this->setContentMimeType($mimeType);
        $this->setContentDuration($duration);
        self::$xml['content'] .= ">";

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
        self::$xml['player'] = "<media:player";

        $this->writeAttribute(
            $player,
            'player',
            'url',
            $this->validator,
            'validatePlayer',
            $this->exception,
            'Provided player URL is not a valid value.'
        );

        self::$xml['player'] .= " />";

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
        self::writeFullTag(
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
        self::writeFullTag(
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
        self::$xml['thumbnail'] = "<media:thumbnail";
        $this->setThumbnailUrl($thumbnail);

        if (null !== $height) {
            $this->setThumbnailHeight($height);
        }

        if (null !== $weight) {
            $this->setThumbnailWidth($weight);
        }

        self::$xml['thumbnail'] .= "/>";

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
