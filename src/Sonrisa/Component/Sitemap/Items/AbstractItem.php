<?php
/*
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sonrisa\Component\Sitemap\Items;

use Sonrisa\Component\Sitemap\Validators\AbstractValidator;

/**
 * Class AbstractItem
 * @package Sonrisa\Component\Sitemap\Items
 */
abstract class AbstractItem
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
     * @param AbstractValidator $validator
     */
    public function __construct(AbstractValidator $validator)
    {
        $this->validator = $validator;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->buildItem();
    }

    /**
     * Converts data to string and measures its size in bytes.
     *
     * @return int
     */
    public function getItemSize()
    {
        return mb_strlen($this->buildItem(),'UTF-8');
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
     * @param $key
     * @param $value
     *
     * @return $this
     */
    public function setField($key,$value)
    {
        $keyFunction = $this->underscoreToCamelCase($key);

        if (method_exists($this->validator,'validate'.$keyFunction)) {
            $value = call_user_func_array(array($this->validator, 'validate'.$keyFunction), array($value));

            if (!empty($value)) {
                $this->data[$key] = $value;
            }
        }

        return $this;
    }

    /**
     * Collapses the item to its string XML representation.
     *
     * @return string
     */
    abstract public function buildItem();

    /**
     * @param $string
     * @return mixed
     */
    protected function underscoreToCamelCase( $string )
    {
       return str_replace(" ","",ucwords(strtolower(str_replace(array("_","-")," ",$string))));
    }
}
