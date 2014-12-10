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
     * @var
     */
    protected $validatorClass;

    /**
     * @var array
     */
    protected $xml = [];

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
        return mb_strlen($this->build(), 'UTF-8');
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
        return mb_strlen($this->getHeader(), 'UTF-8');
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
        return mb_strlen($this->getFooter(), 'UTF-8');
    }

    /**
     * Collapses the item to its string XML representation.
     *
     * @return string
     */
    public function build()
    {
        $xml  = array_filter($this->xml);
        $data = implode("\n", $xml);

        return $data;
    }

    /**
     * Resets the data structure used to represent the item as XML.
     *
     * @return array
     */
    abstract protected function reset();
}
