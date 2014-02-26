<?php
/*
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sonrisa\Component\Sitemap\Validators;

/**
 * Class AbstractValidator
 * @package Sonrisa\Component\Sitemap\Validators
 */
abstract class AbstractValidator
{
    /**
     * The location URI of a document. The URI must conform to RFC 2396 (http://www.ietf.org/rfc/rfc2396.txt)
     *
     * @param string $value
     *
     * @return string
     */
    public static function validateLoc($value)
    {
        $data = '';
        if ( filter_var( $value, FILTER_VALIDATE_URL, array('options' => array('flags' => FILTER_FLAG_PATH_REQUIRED)) ) ) {
            $data = htmlentities($value);
        }

        return $data;
    }

    /**
     * The date must conform to the W3C DATETIME format (http://www.w3.org/TR/NOTE-datetime).
     * Example: 2005-05-10 Lastmod may also contain a timestamp or 2005-05-10T17:33:30+08:00
     *
     * @param string $value
     *
     * @return string
     */
    protected static function validateDate($value)
    {
        $data = '';
        if ( ($date = \DateTime::createFromFormat( 'Y-m-d\TH:i:sP', $value )) !== false ) {
            $data = htmlentities($date->format( 'c' ));
        }

        if ( ($date = \DateTime::createFromFormat( 'Y-m-d', $value )) !== false ) {
            $data = htmlentities($date->format( 'Y-m-d' ));
        }

        return $data;
    }
}
