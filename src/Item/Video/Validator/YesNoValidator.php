<?php
/**
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 * Date: 12/12/14
 * Time: 5:14 PM
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace NilPortugues\Sitemap\Item\Video\Validator;

/**
 * Class YesNoValidator
 * @package NilPortugues\Sitemap\Item\Video\Validator
 */
final class YesNoValidator
{
    /**
     * @param string $confirmation
     *
     * @return string|false
     */
    public static function validate($confirmation)
    {
        $lowercase = strtolower($confirmation);
        if ('yes' === $lowercase || 'no' === $lowercase) {
            return $lowercase;
        }

        return false;
    }
}
