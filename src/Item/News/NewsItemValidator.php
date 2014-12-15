<?php
/**
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 * Date: 12/10/14
 * Time: 1:59 AM
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace NilPortugues\Sitemap\Item\News;

use NilPortugues\Sitemap\Item\News\Validator\AccessValidator;
use NilPortugues\Sitemap\Item\News\Validator\GenresValidator;
use NilPortugues\Sitemap\Item\News\Validator\LanguageValidator;
use NilPortugues\Sitemap\Item\ValidatorTrait;

/**
 * Class NewsItemValidator
 * @package NilPortugues\Sitemap\Items
 */
class NewsItemValidator
{
    use ValidatorTrait;

    /**
     * @param $name
     *
     * @return string|false
     */
    public function validateName($name)
    {
        return self::validateString($name);
    }

    /**
     * @param $language
     *
     * @return string|false
     */
    public function validateLanguage($language)
    {
        return LanguageValidator::validate($language);
    }

    /**
     * @param $access
     *
     * @return string|false
     */
    public function validateAccess($access)
    {
        return AccessValidator::validate($access);
    }

    /**
     * @param $genres
     *
     * @return string|false
     */
    public function validateGenres($genres)
    {
        return GenresValidator::validate($genres);
    }

    /**
     * @param $publicationDate
     *
     * @return string|false
     */
    public function validatePublicationDate($publicationDate)
    {
        return self::validateDate($publicationDate);
    }

    /**
     * @param $title
     *
     * @return string|false
     */
    public function validateTitle($title)
    {
        return self::validateString($title);
    }

    /**
     * @param $keywords
     *
     * @return string|false
     */
    public function validateKeywords($keywords)
    {
        return self::validateString($keywords);
    }

    /**
     * @param $stock
     *
     * @return string|false
     */
    public function validateStockTickers($stock)
    {
        return self::validateString($stock);
    }
}
