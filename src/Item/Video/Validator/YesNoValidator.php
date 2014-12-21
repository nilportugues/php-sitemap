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
class YesNoValidator extends AbstractYesNoValidator
{
    /**
     * @param string $confirmation
     *
     * @return string|false
     */
    public static function validate($confirmation)
    {
        return parent::validateMethod($confirmation, 'yes', 'no');
    }
}
