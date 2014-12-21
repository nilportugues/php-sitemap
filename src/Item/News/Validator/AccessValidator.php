<?php
/**
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 * Date: 12/12/14
 * Time: 4:25 PM
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace NilPortugues\Sitemap\Item\News\Validator;

/**
 * Class AccessValidator
 * @package NilPortugues\Sitemap\Item\News\Validator
 */
final class AccessValidator
{
    /**
     * @param $access
     *
     * @return string|false
     */
    public static function validate($access)
    {
        $lowercaseAccess = strtolower($access);

        if ('subscription' === $lowercaseAccess || 'registration' === $lowercaseAccess) {
            return ucfirst($lowercaseAccess);
        }

        return false;
    }
}
