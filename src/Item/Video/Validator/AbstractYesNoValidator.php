<?php
/**
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 * Date: 12/20/14
 * Time: 5:45 PM
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace NilPortugues\Sitemap\Item\Video\Validator;

/**
 * Class AbstractYesNoValidator
 * @package NilPortugues\Sitemap\Item\Video\Validator
 */
abstract class AbstractYesNoValidator
{
    /**
     * @param string $confirmation
     * @param string $positive
     * @param string $negative
     *
     * @return string|false
     */
    public static function validateMethod($confirmation, $positive, $negative)
    {
        $lowercase = strtolower($confirmation);
        if ($positive === $lowercase || $negative === $lowercase) {
            return $lowercase;
        }

        return false;
    }
}
