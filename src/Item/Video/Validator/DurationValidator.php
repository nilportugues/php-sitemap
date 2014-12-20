<?php
/**
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 * Date: 12/20/14
 * Time: 7:12 PM
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace NilPortugues\Sitemap\Item\Video\Validator;

/**
 * Class DurationValidator
 * @package NilPortugues\Sitemap\Item\Video\Validator
 */
final class DurationValidator
{
    /**
     * The duration of the video in seconds. Value must be between 0 and 28800 (8 hours).
     *
     * @param $seconds
     *
     * @return bool|string
     */
    public static function validate($seconds)
    {
        if ($seconds <= 28800 && $seconds >= 0) {
            return $seconds;
        }

        return false;
    }
}
