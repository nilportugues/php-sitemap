<?php
/*
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Sonrisa\Component\Sitemap\Items;

/**
 * Interface ItemInterface
 * @package Sonrisa\Component\Sitemap\Items
 */
interface ItemInterface
{

    /**
     * @return string
     */
    public function __toString();

    /**
     * @return string
     */
    public function build();

    /**
     * @return integer
     */
    public function getItemSize();

    /**
     * @return string
     */
    public function getHeader();

    /**
     * @return integer
     */
    public function getHeaderSize();

    /**
     * @return string
     */
    public function getFooter();

    /**
     * @return integer
     */
    public function getFooterSize();
}
