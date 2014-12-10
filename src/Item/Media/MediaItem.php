<?php
/*
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace NilPortugues\Sitemap\Item;

use NilPortugues\Sitemap\Validators\MediaValidator;

/**
 * Class MediaItem
 * @package NilPortugues\Sitemap\Items
 */
class MediaItem extends AbstractItem implements ItemInterface
{
    /**
     * @var \NilPortugues\Sitemap\Validators\MediaValidator
     */
    protected $validator;

    /**
     *
     */
    public function __construct()
    {
        $this->validator = MediaValidator::getInstance();
    }

    /**
     * @return string
     */
    public function getHeader()
    {
        return '<?xml version="1.0" encoding="UTF-8"?>' . "\n" .
        '<rss version="2.0" xmlns:media="http://search.yahoo.com/mrss/" xmlns:dcterms="http://purl.org/dc/terms/">' . "\n" .
        '<channel>';
    }

    /**
     * @return string
     */
    public function getFooter()
    {
        return "</channel>\n</rss>";
    }

    /**
     * @return string
     */
    public function getLink()
    {
        return (!empty($this->data['link'])) ? $this->data['link'] : '';
    }

    /**
     * @param $link
     *
     * @return $this
     */
    public function setLink($link)
    {
        return $this->setField('link', $link);
    }

    /**
     * @param $duration
     *
     * @return $this
     */
    public function setContentDuration($duration)
    {
        return $this->setField('duration', $duration);
    }

    /**
     * @param $mimetype
     *
     * @return $this
     */
    public function setContentMimeType($mimetype)
    {
        return $this->setField('mimetype', $mimetype);
    }

    /**
     * @param $player
     *
     * @return $this
     */
    public function setPlayer($player)
    {
        return $this->setField('player', $player);
    }

    /**
     * @param $title
     *
     * @return $this
     */
    public function setTitle($title)
    {
        return $this->setField('title', $title);
    }

    /**
     * @param $description
     *
     * @return $this
     */
    public function setDescription($description)
    {
        return $this->setField('description', $description);
    }

    /**
     * @param $url
     *
     * @return $this
     */
    public function setThumbnailUrl($url)
    {
        return $this->setField('thumbnail', $url);
    }

    /**
     * @param $height
     *
     * @return $this
     */
    public function setThumbnailHeight($height)
    {
        return $this->setField('height', $height);
    }

    /**
     * @param $width
     *
     * @return $this
     */
    public function setThumbnailWidth($width)
    {
        return $this->setField('width', $width);
    }

    /**
     * Collapses the item to its string XML representation.
     *
     * @return string
     */
    public function build()
    {
        $data = '';
        //Create item ONLY if all mandatory data is present.
        if (!empty($this->data['link'])) {
            $xml = array();

            $xml[] = "\t" . '<item xmlns:media="http://search.yahoo.com/mrss/" xmlns:dcterms="http://purl.org/dc/terms/">';
            $xml[] = (!empty($this->data['link'])) ? "\t\t<link>{$this->data['link']}</link>" : '';

            if (!empty($this->data['duration']) && !empty($this->data['mimetype'])) {
                $xml[] = "\t\t<media:content type=\"{$this->data['mimetype']}\" duration=\"{$this->data['duration']}\">";
            } elseif (empty($this->data['duration']) && !empty($this->data['mimetype'])) {
                $xml[] = "\t\t<media:content type=\"{$this->data['mimetype']}\">";
            } elseif (!empty($this->data['duration']) && empty($this->data['mimetype'])) {
                $xml[] = "\t\t<media:content duration=\"{$this->data['duration']}\">";
            }

            $xml[] = (!empty($this->data['player'])) ? "\t\t\t<media:player url=\"{$this->data['player']}\" />" : '';
            $xml[] = (!empty($this->data['title'])) ? "\t\t\t<media:title>{$this->data['title']}</media:title>" : '';
            $xml[] = (!empty($this->data['description'])) ? "\t\t\t<media:description>{$this->data['description']}</media:description>" : '';

            if (!empty($this->data['thumbnail']) && !empty($this->data['height']) && !empty($this->data['width'])) {
                $xml[] = "\t\t\t<media:thumbnail url=\"{$this->data['thumbnail']}\" height=\"{$this->data['height']}\" width=\"{$this->data['width']}\"/>";
            } elseif (!empty($this->data['thumbnail']) && !empty($this->data['height'])) {
                $xml[] = "\t\t\t<media:thumbnail url=\"{$this->data['thumbnail']}\" height=\"{$this->data['height']}\"/>";
            } elseif (!empty($this->data['thumbnail']) && !empty($this->data['width'])) {
                $xml[] = "\t\t\t<media:thumbnail url=\"{$this->data['thumbnail']}\" width=\"{$this->data['width']}\"/>";
            } elseif (!empty($this->data['thumbnail'])) {
                $xml[] = "\t\t\t<media:thumbnail url=\"{$this->data['thumbnail']}\"/>";
            }

            $xml[] = "\t\t" . '</media:content>';
            $xml[] = "\t" . '</item>';

            //Remove empty fields
            $xml = array_filter($xml);

            $data = implode("\n", $xml);
        }

        return $data;
    }
}
