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
abstract class VideoItemPriceTags extends AbstractItem
{
    /**
     * @var string
     */
    protected static $exception = 'NilPortugues\Sitemap\Item\Video\VideoItemException';

    /**
     * @param VideoItemValidator $validator
     * @param                    $price
     * @param                    $currency
     * @param string|null        $type
     * @param string|null        $resolution
     *
     * @return string
     */
    public static function setPrice($validator, $price, $currency, $type = null, $resolution = null)
    {
        self::$xml['price'] .= '<video:price';
        self::setPriceValue($validator, $price);
        self::setPriceCurrency($validator, $currency);
        self::setPriceType($validator, $type);
        self::setPriceResolution($validator, $resolution);
        self::$xml['price'] .= '>'.$price.'</video:price>';

        return self::$xml['price'];
    }

    /**
     * @param VideoItemValidator $validator
     * @param $price
     */
    protected static function setPriceValue($validator, $price)
    {
        self::validateInput(
            $price,
            $validator,
            'validatePrice',
            self::$exception,
            'Provided price is not a valid value.'
        );
    }

    /**
     * @param VideoItemValidator $validator
     * @param $currency
     *
     */
    protected static function setPriceCurrency($validator, $currency)
    {
        self::writeAttribute(
            $currency,
            'price',
            'currency',
            $validator,
            'validatePriceCurrency',
            self::$exception,
            'Provided price currency is not a valid value.'
        );
    }

    /**
     * @param             VideoItemValidator $validator
     * @param string|null $type
     *
     */
    protected static function setPriceType($validator, $type)
    {
        if (null !== $type) {
            self::writeAttribute(
                $type,
                'price',
                'type',
                $validator,
                'validatePriceType',
                self::$exception,
                'Provided price type is not a valid value.'
            );
        }
    }

    /**
     * @param             VideoItemValidator $validator
     * @param string|null $resolution
     *
     */
    protected static function setPriceResolution($validator, $resolution)
    {
        if (null !== $resolution) {
            self::writeAttribute(
                $resolution,
                'price',
                'resolution',
                $validator,
                'validatePriceResolution',
                self::$exception,
                'Provided price resolution is not a valid value.'
            );
        }
    }
}
