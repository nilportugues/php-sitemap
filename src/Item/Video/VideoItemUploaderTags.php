<?php
/**
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 * Date: 12/12/14
 * Time: 5:25 PM
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace NilPortugues\Sitemap\Item\Video;

use NilPortugues\Sitemap\Item\AbstractItem;

/**
 * Class VideoItemUploaderTags
 * @package NilPortugues\Sitemap\Item\Video
 */
abstract class VideoItemUploaderTags extends AbstractItem
{
    /**
     * @var string
     */
    protected static $exception = 'NilPortugues\Sitemap\Item\Video\VideoItemException';

    /**
     * @param VideoItemValidator $validator
     * @param                    $uploader
     * @param null               $info
     *
     * @return string
     */
    public static function setUploader($validator, $uploader, $info = null)
    {
        self::validateInput(
            $uploader,
            $validator,
            'validateUploader',
            self::$exception,
            'Provided uploader is not a valid value.'
        );

        self::$xml['uploader'] = '<video:uploader';
        self::setUploaderInfo($validator, $info);
        self::$xml['uploader'] .= '>'.$uploader.'</video:uploader>';

        return self::$xml['uploader'];
    }

    /**
     * @param VideoItemValidator $validator
     * @param $info
     */
    protected static function setUploaderInfo($validator, $info)
    {
        if (null !== $info) {
            self::writeAttribute(
                $info,
                'uploader',
                'info',
                $validator,
                'validateUploaderInfo',
                self::$exception,
                'Provided uploader info is not a valid value.'
            );
        }
    }
}
