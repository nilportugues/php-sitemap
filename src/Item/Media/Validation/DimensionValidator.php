<?php
/**
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 * Date: 12/12/14
 * Time: 4:48 PM
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace NilPortugues\Sitemap\Item\Media\Validation;

/**
 * Class DimensionValidator
 * @package NilPortugues\Sitemap\Item\Media\Validation
 */
final class DimensionValidator
{
    public static function validate($dimension)
    {
        if (filter_var($dimension, FILTER_SANITIZE_NUMBER_INT) && $dimension>0) {
            return $dimension;
        }

        return false;
    }
}
