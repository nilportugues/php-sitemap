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
        $this->xml['content'] = "\t\t<media:content ";
        $this->setContentMimeType($mimeType);

        if (null !== $duration) {
            $this->setContentDuration($duration);
        }

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
        $mimeType = $this->validator->validateMimeType($mimeType);
        if (false === $mimeType) {
            throw new MediaItemException(
                sprintf('The provided mime-type \'%s\' is not a valid value.', $mimeType)
            );
        }
        $this->xml['content'] .= "type=\"{$mimeType}\"";
    }

    /**
     * @param $duration
     *
     * @throws MediaItemException
     */
    protected function setContentDuration($duration)
    {
        if (null !== $duration) {
            $duration = $this->validator->validateDuration($duration);

            if (false === $duration) {
                throw new MediaItemException(
                    sprintf('The provided duration \'%s\' is not a valid value.', $duration)
                );
            }

            $this->xml['content'] .= " duration=\"{$duration}\"";
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
        $player = $this->validator->validatePlayer($player);
        if (false === $player) {
            throw new MediaItemException(
                sprintf('Provided player is not a valid value.', $player)
            );
        }

        $this->xml['player'] = "\t\t\t<media:player url=\"{$player}\" />";

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
        $url = $this->validator->validateThumbnail($url);
        if (false === $url) {
            throw new MediaItemException(
                sprintf('The provided url \'%s\' is not a valid value.', $url)
            );
        }

        $this->xml['thumbnail'] .= " url=\"{$url}\"";

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
        $height = $this->validator->validateHeight($height);
        if (false === $height) {
            throw new MediaItemException(
                sprintf('The provided height \'%s\' is not a valid value.', $height)
            );
        }

        $this->xml['thumbnail'] .= " height=\"{$height}\"";

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
        $width = $this->validator->validateWidth($width);
        if (false === $width) {
            throw new MediaItemException(
                sprintf('The provided width \'%s\' is not a valid value.', $width)
            );
        }

        $this->xml['thumbnail'] .= " width=\"{$width}\"";

        return $this;
    }
}
