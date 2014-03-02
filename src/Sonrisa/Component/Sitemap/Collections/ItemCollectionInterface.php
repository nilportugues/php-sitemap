<?php
/*
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sonrisa\Component\Sitemap\Collections;
use Sonrisa\Component\Sitemap\Items\ItemInterface;

/**
 * Class AbstractItem
 * @package Sonrisa\Component\Sitemap\Collections
 */
interface ItemCollectionInterface
{
    /**
     * @param  ItemInterface $item
     * @return mixed
     */
    public function add(ItemInterface $item);

    /**
     * @return array
     */
    public function get();
}
