<?php
/**
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 * Date: 12/20/14
 * Time: 7:11 PM
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace NilPortugues\Sitemap\Item\Video\Validator;

/**
 * Class FamilyFriendlyValidator
 * @package NilPortugues\Sitemap\Item\Video\Validator
 */
final class FamilyFriendlyValidator
{
    /**
     * @param $familyFriendly
     *
     * @return string|false
     */
    public static function validate($familyFriendly)
    {
        if (false !== ($familyFriendly = YesNoValidator::validate($familyFriendly))) {
            return ucfirst($familyFriendly);
        }

        return false;
    }
}
