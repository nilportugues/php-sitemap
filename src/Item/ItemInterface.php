<?php
/*
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace NilPortugues\Sitemap\Item;

/**
 * Interface ItemInterface
 * @package NilPortugues\Sitemap\Items
 */
interface ItemInterface
{
    /**
     * @return string
     */
    public function build();
}
