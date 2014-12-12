<?php
/**
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 * Date: 12/12/14
 * Time: 5:23 PM
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace NilPortugues\Sitemap\Item\Video;

use NilPortugues\Sitemap\Item\AbstractItem;


/**
 * Class VideoItemPlayerTags
 * @package NilPortugues\Sitemap\Item\Video
 */
abstract class VideoItemPlayerTags extends AbstractItem
{
    /**
     * @var string
     */
    protected static $xml = '';

    /**
     * @var string
     */
    protected static $exception = 'NilPortugues\Sitemap\Item\Video\VideoItemException';

    /**
     * @param $validator
     * @param $loc
     * @param $playerEmbedded
     * @param $playerAutoPlay
     *
     * @return $this
     */
    protected static function setPlayerLoc($validator, $loc, $playerEmbedded, $playerAutoPlay)
    {
        self::validateInput(
            $loc,
            $validator,
            'validatePlayerLoc',
            self::$exception,
            'Provided player URL is not a valid value.'
        );

        self::$xml .= '<video:player_loc';
        self::setPlayerEmbedded($validator, $playerEmbedded);
        self::setPlayerAutoPlay($validator, $playerAutoPlay);

        self::$xml .= '>'.$loc.'</video:player_loc>';

        return self::$xml;
    }

    /**
     * @param $validator
     * @param $playerEmbedded
     *
     */
    protected function setPlayerEmbedded($validator, $playerEmbedded)
    {
        if (null !== $playerEmbedded) {
            self::writeAttribute(
                $playerEmbedded,
                'player_loc',
                'allow_embed',
                $validator,
                'validateAllowEmbed',
                self::$exception,
                'Provided player allow embed is not a valid value.'
            );
        }
    }

    /**
     * @param $validator
     * @param $playerAutoplay
     */
    protected function setPlayerAutoPlay($validator, $playerAutoplay)
    {
        if (null !== $playerAutoplay) {
            self::writeAttribute(
                $playerAutoplay,
                'player_loc',
                'autoplay',
                $validator,
                'validateAutoPlay',
                self::$exception,
                'Provided player autoplay is not a valid value.'
            );
        }
    }
} 