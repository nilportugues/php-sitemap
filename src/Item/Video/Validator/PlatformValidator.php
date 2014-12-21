<?php
/**
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 * Date: 12/12/14
 * Time: 5:13 PM
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace NilPortugues\Sitemap\Item\Video\Validator;

/**
 * Class PlatformValidator
 * @package NilPortugues\Sitemap\Item\Video\Validator
 */
final class PlatformValidator
{
    /**
     * @param $platform
     *
     * @return string|false
     */
    public static function validate($platform)
    {
        $platforms = explode(" ", $platform);
        array_filter($platforms);

        foreach ($platforms as $key => $platform) {
            if (strtolower($platform) != 'tv' && strtolower($platform) != 'mobile' && strtolower($platform) != 'web') {
                unset($platforms[$key]);
            }
        }

        $data = implode(' ', $platforms);

        return (strlen($data) > 0) ? $data : false;
    }
}
