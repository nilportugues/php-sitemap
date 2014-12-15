<?php
/**
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 * Date: 12/12/14
 * Time: 3:55 PM
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace NilPortugues\Sitemap\Item\Video\Validator;

/**
 * Class PriceResolutionValidator
 * @package NilPortugues\Sitemap\Item\Video\Validator
 */
final class PriceResolutionValidator
{
    /**
     * @param string $resolution
     *
     * @return string|false
     */
    public static function validate($resolution)
    {
        $uppercaseResolution = strtoupper($resolution);
        if ('HD' === $uppercaseResolution || 'SD' === $uppercaseResolution) {
            return $uppercaseResolution;
        }

        return false;
    }
}
