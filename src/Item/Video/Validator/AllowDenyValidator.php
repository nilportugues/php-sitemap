<?php
/**
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 * Date: 12/20/14
 * Time: 5:46 PM
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace NilPortugues\Sitemap\Item\Video\Validator;

/**
 * Class AllowDenyValidator
 * @package NilPortugues\Sitemap\Item\Video\Validator
 */
class AllowDenyValidator extends AbstractYesNoValidator
{
    /**
     * @param string $confirmation
     *
     * @return string|false
     */
    public static function validate($confirmation)
    {
        return parent::validateMethod($confirmation, 'allow', 'deny');
    }
}
