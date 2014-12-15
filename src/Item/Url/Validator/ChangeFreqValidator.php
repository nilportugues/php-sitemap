<?php
/**
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 * Date: 12/12/14
 * Time: 4:24 PM
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace NilPortugues\Sitemap\Item\Url\Validator;

/**
 * Class ChangeFreqValidator
 * @package NilPortugues\Sitemap\Item\Url\Validator
 */
final class ChangeFreqValidator
{
    /**
     * @var array
     */
    protected static $changeFreqValid = array(
        "always",
        "hourly",
        "daily",
        "weekly",
        "monthly",
        "yearly",
        "never",
    );

    /**
     * @param $changeFreq
     *
     * @return string|false
     */
    public static function validate($changeFreq)
    {
        if (in_array(trim(strtolower($changeFreq)), self::$changeFreqValid, true)) {
            return htmlentities($changeFreq);
        }

        return false;
    }
}
