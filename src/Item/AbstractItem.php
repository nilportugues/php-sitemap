<?php
/*
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace NilPortugues\Sitemap\Item;

/**
 * Class AbstractItem
 * @package NilPortugues\Sitemap\Items
 */
abstract class AbstractItem implements ItemInterface
{
    /**
     * @var array
     */
    protected static $xml = [];

    /**
     * Collapses the item to its string XML representation.
     *
     * @return string
     */
    public function build()
    {
        $xml  = array_filter(self::$xml);
        $data = implode("", $xml);

        return $data."\n";
    }

    /**
     * Resets the data structure used to represent the item as XML.
     *
     * @return array
     */
    abstract protected function reset();

    /**
     * @param mixed  $value
     * @param string $name
     * @param bool   $cdata
     * @param string $tag
     * @param mixed  $validationClass
     * @param string $validationMethod
     * @param string $exceptionClass
     * @param string $exceptionMsg
     */
    protected static function writeFullTag(
        $value,
        $name,
        $cdata,
        $tag,
        $validationClass,
        $validationMethod,
        $exceptionClass,
        $exceptionMsg
    ) {
        $value = self::validateInput($value, $validationClass, $validationMethod, $exceptionClass, $exceptionMsg);
        self::writeFullTagTemplate($value, $name, $cdata, $tag);
    }

    /**
     * @param         $value
     * @param string  $name
     * @param boolean $cdata
     * @param string  $tag
     */
    protected static function writeFullTagTemplate($value, $name, $cdata, $tag)
    {
        $xml = "<{$tag}>$value</{$tag}>";
        if ($cdata) {
            $xml = "<{$tag}><![CDATA[$value]]></{$tag}>";
        }
        self::$xml[$name] .= $xml;
    }

    /**
     * @param mixed  $value
     * @param string $name
     * @param string $attributeName
     * @param mixed  $validationClass
     * @param string $validationMethod
     * @param string $exceptionClass
     * @param string $exceptionMsg
     */
    protected static function writeAttribute(
        $value,
        $name,
        $attributeName,
        $validationClass,
        $validationMethod,
        $exceptionClass,
        $exceptionMsg
    ) {
        $value = self::validateInput($value, $validationClass, $validationMethod, $exceptionClass, $exceptionMsg);
        self::$xml[$name] .= " {$attributeName}=\"{$value}\"";
    }

    /**
     * @param mixed  $value
     * @param mixed  $validationClass
     * @param string $validationMethod
     * @param string $exceptionClass
     * @param string $exceptionMsg
     *
     * @return mixed
     */
    protected static function validateInput($value, $validationClass, $validationMethod, $exceptionClass, $exceptionMsg)
    {
        $value = call_user_func_array([$validationClass, $validationMethod], [$value]);
        if (false === $value) {
            throw new $exceptionClass($exceptionMsg);
        }

        return $value;
    }
}
