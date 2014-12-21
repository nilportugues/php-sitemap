<?php
/**
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 * Date: 12/12/14
 * Time: 4:24 PM
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace NilPortugues\Sitemap\Item\Url\Validator;

/**
 * Class PriorityValidator
 * @package NilPortugues\Sitemap\Item\Url\Validator
 */
final class PriorityValidator
{
    /**
     * The priority of a particular URL relative to other pages on the same site.
     * The value for this element is a number between 0.0 and 1.0 where 0.0 identifies the lowest priority page(s).
     * The default priority of a page is 0.5. Priority is used to select between pages on your site.
     * Setting a priority of 1.0 for all URLs will not help you, as the relative priority of pages on your site is what will be considered.
     *
     * @param $priority
     *
     * @return string|false
     */
    public static function validate($priority)
    {
        $validData = null;

        if (
            is_numeric($priority)
            && $priority > -0.01 && $priority <= 1
            && (($priority * 100 % 10) == 0)
        ) {
            preg_match('/([0-9].[0-9])/', $priority, $matches);
            if (!isset($matches[0])) {
                return '';
            }

            $matches[0] = str_replace(",", ".", floatval($matches[0]));
            if (!empty($matches[0]) && $matches[0] <= 1 && $matches[0] >= 0.0) {
                $validData = $matches[0];
            }
        }

        return (null !== $validData) ? $validData : false;
    }
}
