<?php
/**
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 * Date: 12/20/14
 * Time: 7:13 PM
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace NilPortugues\Sitemap\Item\Video\Validator;

/**
 * Class DescriptionValidator
 * @package NilPortugues\Sitemap\Item\Video\Validator
 */
final class DescriptionValidator
{
    /**
     * The description of the video. Maximum 2048 characters.
     * The description must be in plain text only, and any HTML entities should be escaped or wrapped in a CDATA block.
     *
     * @param $description
     *
     * @return string|false
     */
    public static function validate($description)
    {
        $length = mb_strlen($description, 'UTF-8');
        if ($length > 0 && $length < 2048) {
            return $description;
        }

        return false;
    }
}
