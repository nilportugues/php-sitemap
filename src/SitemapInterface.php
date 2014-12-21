<?php
/**
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 * Date: 12/20/14
 * Time: 7:38 PM
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace NilPortugues\Sitemap;

/**
 * Class Sitemap
 * @package NilPortugues\Sitemap
 */
interface SitemapInterface
{
    /**
     * Adds a new sitemap item.
     *
     * @param        $item
     * @param string $url
     *
     * @return mixed
     */
    public function add($item, $url = '');

    /**
     * Generates sitemap file.
     *
     * @return mixed
     */
    public function build();
}
