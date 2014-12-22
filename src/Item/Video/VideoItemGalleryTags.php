<?php
/**
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 * Date: 12/12/14
 * Time: 5:24 PM
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace NilPortugues\Sitemap\Item\Video;

use NilPortugues\Sitemap\Item\AbstractItem;

/**
 * Class VideoItemPriceTags
 * @package NilPortugues\Sitemap\Item\Video
 */
abstract class VideoItemGalleryTags extends AbstractItem
{
    /**
     * @var string
     */
    protected static $tag = '';

    /**
     * @var string
     */
    protected static $exception = 'NilPortugues\Sitemap\Item\Video\VideoItemException';

    /**
     * @param VideoItemValidator $validator
     * @param                    $galleryLoc
     * @param null               $title
     *
     * @return string
     */
    public static function setGalleryLoc($validator, $galleryLoc, $title = null)
    {
        self::validateInput(
            $galleryLoc,
            $validator,
            'validateGalleryLoc',
            self::$exception,
            'Provided gallery URL is not a valid value.'
        );

        self::$xml['gallery_loc'] = '<video:gallery_loc';
        self::setGalleryTitle($validator, $title);
        self::$xml['gallery_loc'] .= '>'.$galleryLoc.'</video:gallery_loc>';

        return self::$xml['gallery_loc'];
    }

    /**
     * @param VideoItemValidator $validator
     * @param $title
     */
    protected static function setGalleryTitle($validator, $title)
    {
        if (null !== $title) {
            self::writeAttribute(
                $title,
                'gallery_loc',
                'title',
                $validator,
                'validateGalleryLocTitle',
                self::$exception,
                'Provided gallery title is not a valid value.'
            );
        }
    }
}
