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
 * Class PriceTypeValidator
 * @package NilPortugues\Sitemap\Item\Video\Validator
 */
final class PriceTypeValidator
{
    /**
     * @param string $type
     *
     * @return string|false
     */
    public static function validate($type)
    {
        $lowercaseType = strtolower($type);
        if ('own' === $lowercaseType || 'rent' === $lowercaseType) {
            return $lowercaseType;
        }

        return false;
    }
}
