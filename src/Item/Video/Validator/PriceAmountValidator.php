<?php
/**
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 * Date: 12/20/14
 * Time: 7:10 PM
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace NilPortugues\Sitemap\Item\Video\Validator;

/**
 * Class PriceAmountValidator
 * @package NilPortugues\Sitemap\Item\Video\Validator
 */
final class PriceAmountValidator
{
    /**
     * @param $price
     *
     * @return bool
     */
    public static function validate($price)
    {
        if (
            (filter_var($price, FILTER_VALIDATE_FLOAT) || filter_var($price, FILTER_VALIDATE_INT))
            && $price >= 0
        ) {
            return $price;
        }

        return false;
    }
}
