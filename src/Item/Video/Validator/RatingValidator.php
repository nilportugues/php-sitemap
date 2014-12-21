<?php
/**
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 * Date: 12/12/14
 * Time: 5:16 PM
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace NilPortugues\Sitemap\Item\Video\Validator;

/**
 * Class RatingValidator
 * @package NilPortugues\Sitemap\Item\Video\Validator
 */
final class RatingValidator
{
    /**
     * The rating of the video. Allowed values are float numbers in the range 0.0 to 5.0.
     *
     * @param $rating
     *
     * @return string|false
     */
    public static function validate($rating)
    {
        if (is_numeric($rating) && $rating > -0.01 && $rating < 5.01) {
            preg_match('/([0-9].[0-9])/', $rating, $matches);
            $matches[0] = floatval($matches[0]);

            return (!empty($matches[0]) && $matches[0] <= 5.0 && $matches[0] >= 0.0) ? $matches[0] : false;
        }

        return false;
    }
}
