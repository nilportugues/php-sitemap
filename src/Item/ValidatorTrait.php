<?php

namespace NilPortugues\Sitemap\Item;

/**
 * Trait ValidatorTrait
 * @package NilPortugues\Sitemap\Item
 */
trait ValidatorTrait
{
    use SingletonTrait;

    /**
     * @param $string
     *
     * @return string|false
     */
    public static function validateString($string)
    {
        if (is_string($string) && strlen($string) > 0) {
            return $string;
        }

        return false;
    }

    /**
     * The location URI of a document. The URI must conform to RFC 2396 (http://www.ietf.org/rfc/rfc2396.txt)
     *
     * @param $value
     *
     * @return string|false
     */
    public static function validateLoc($value)
    {
        if (filter_var($value, FILTER_VALIDATE_URL, ['options' => ['flags' => FILTER_FLAG_PATH_REQUIRED]])
            && strlen($value) > 0
        ) {
            return htmlentities($value);
        }

        return false;
    }

    /**
     * The date must conform to the W3C DATETIME format (http://www.w3.org/TR/NOTE-datetime).
     * Example: 2005-05-10 Lastmod may also contain a timestamp or 2005-05-10T17:33:30+08:00
     *
     * @param string $value
     *
     * @return string|false
     */
    public static function validateDate($value)
    {
        if (is_string($value) && strlen($value) > 0 && (
                false !== ($date1 = \DateTime::createFromFormat('Y-m-d\TH:i:sP', $value))
                || false !== \DateTime::createFromFormat('Y-m-d', $value)
            )
        ) {
            $format = 'Y-m-d';

            if (false !== $date1) {
                $format = 'c';
            }

            return htmlentities((new \DateTime($value))->format($format));
        }

        return false;
    }

    public static function validateInteger($dimension)
    {
        if (filter_var($dimension, FILTER_SANITIZE_NUMBER_INT) && $dimension > 0) {
            return $dimension;
        }

        return false;
    }
}
