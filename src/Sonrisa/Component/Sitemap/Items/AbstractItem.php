<?php
/*
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sonrisa\Component\Sitemap\Items;

use Sonrisa\Component\Sitemap\Exceptions\SitemapException;

/**
 * Class AbstractItem
 * @package Sonrisa\Component\Sitemap\Items
 */
abstract class AbstractItem implements ItemInterface
{
    /**
     * Holds data as a key->value format.
     * @var array
     */
    protected $data = array();

    /**
     * Holds the item's data as an array. One line per field.
     * @var array
     */
    protected $item = array();

    /**
     * Class that will be validating.
     * @var null
     */
    protected $validator = NULL;

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->build();
    }

    /**
     * Converts data to string and measures its size in bytes.
     *
     * @return int
     */
    public function getItemSize()
    {
        return mb_strlen($this->build(),'UTF-8');
    }

    /**
     * @return string
     */
    abstract public function getHeader();

    /**
     * @return int
     */
    public function getHeaderSize()
    {
        return mb_strlen($this->getHeader(),'UTF-8');
    }

    /**
     * @return string
     */
    abstract public function getFooter();

    /**
     * @return int
     */
    public function getFooterSize()
    {
        return mb_strlen($this->getFooter(),'UTF-8');
    }

    /**
     * Sets value if data provided is valid and can be validated.
     *
     * @param string $key
     * @param $value
     *
     * @throws \Sonrisa\Component\Sitemap\Exceptions\SitemapException
     * @return $this
     */
    protected function setField($key,$value)
    {
        $keyFunction = $this->underscoreToCamelCase($key);

        if (method_exists($this->validator,'validate'.$keyFunction)) {
            $value = call_user_func_array(array($this->validator, 'validate'.$keyFunction), array($value));

            if (!empty($value)) {
                $this->data[$key] = $value;
            } else {
                throw new SitemapException('Value not valid for '.$keyFunction);
            }
        }

        return $this;
    }

    /**
     * @param string $string
     * @return string
     */
    protected function underscoreToCamelCase($string)
    {
        return str_replace(" ","",ucwords(strtolower(str_replace(array("_","-")," ",$string))));
    }

    /**
     * Collapses the item to its string XML representation.
     *
     * @return string
     */
    abstract public function build();

}
