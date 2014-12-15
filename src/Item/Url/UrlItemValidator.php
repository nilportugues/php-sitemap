<?php
/**
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 * Date: 12/10/14
 * Time: 1:59 AM
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace NilPortugues\Sitemap\Item\Url;

use NilPortugues\Sitemap\Item\Url\Validator\ChangeFreqValidator;
use NilPortugues\Sitemap\Item\Url\Validator\PriorityValidator;
use NilPortugues\Sitemap\Item\ValidatorTrait;

/**
 * Class UrlItemValidator
 * @package NilPortugues\Sitemap\Items
 */
class UrlItemValidator
{
    use ValidatorTrait;

    /**
     * @param $lastmod
     *
     * @return string|false
     */
    public function validateLastMod($lastmod)
    {
        return self::validateDate($lastmod);
    }

    /**
     * @param $changeFreq
     *
     * @return string|false
     */
    public function validateChangeFreq($changeFreq)
    {
        return ChangeFreqValidator::validate($changeFreq);
    }

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
    public function validatePriority($priority)
    {
        return PriorityValidator::validate($priority);
    }
}
