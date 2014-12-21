<?php
/**
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 * Date: 12/12/14
 * Time: 4:25 PM
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace NilPortugues\Sitemap\Item\News\Validator;

/**
 * Class GenresValidator
 * @package NilPortugues\Sitemap\Item\News\Validator
 */
final class GenresValidator
{
    /**
     * https://support.google.com/news/publisher/answer/93992
     *
     * @var array
     */
    protected static $genres = array(
        'PressRelease',
        'Satire',
        'Blog',
        'OpEd',
        'Opinion',
        'UserGenerated',
    );

    /**
     * @param $genres
     *
     * @return string|false
     */
    public static function validate($genres)
    {
        $data = array();
        if (is_string($genres)) {
            $genres = str_replace(",", " ", $genres);
            $genres = explode(" ", $genres);
            $genres = array_filter($genres);
        }

        if (is_array($genres)) {
            foreach ($genres as $genre) {
                if (in_array($genre, self::$genres, true)) {
                    $data[] = $genre;
                }
            }
        }

        $data = implode(", ", $data);

        return (strlen($data) > 0) ? $data : false;
    }
}
