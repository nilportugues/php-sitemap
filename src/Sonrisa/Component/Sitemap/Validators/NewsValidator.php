<?php
/*
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Sonrisa\Component\Sitemap\Validators;

/**
 * Class NewsValidator.
 * Based on the data provided by Google:
 *
 *  - https://support.google.com/webmasters/answer/74288?hl=en
 *  - https://support.google.com/news/publisher/answer/93992
 *
 * @package Sonrisa\Component\Sitemap\Validators
 */
class NewsValidator extends AbstractValidator
{
    /**
     * @param $name
     * @return string
     */
    public static function validatePublicationName($name)
    {
        return $name;
    }

    /**
     * @param $language
     * @return string
     */
    public static function validatePublicationLanguage($language)
    {
        return $language;
    }

    /**
     * @param $access
     * @return string
     */
    public static function validateAccess($access)
    {
        return $access;
    }

    /**
     * @param $genres
     * @return mixed
     */
    public static function validateGenres($genres)
    {
        return $genres;
    }

    /**
     * @param $publicationDate
     * @return string
     */
    public static function validatePublicationDate($publicationDate)
    {
        return self::validateDate($publicationDate);
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
     * @param $keywords
     * @return mixed
     */
    public static function validateKeywords($keywords)
    {
        return $keywords;
    }

    /**
     * @param $stock
     * @return mixed
     */
    public static function validateStockTickers($stock)
    {
        return $stock;
    }
} 