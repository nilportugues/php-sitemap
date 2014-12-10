<?php
/**
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 * Date: 12/10/14
 * Time: 1:58 AM
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace NilPortugues\Sitemap\Item\Index;

use NilPortugues\Sitemap\Item\SingletonTrait;
use NilPortugues\Sitemap\Item\ValidatorTrait;

/**
 * Class IndexItemValidator
 * @package NilPortugues\Sitemap\Items
 */
class IndexItemValidator
{
    use SingletonTrait;
    use ValidatorTrait;

    /**
     * @param $lastmod
     * @return string
     */
    public function validateLastmod($lastmod)
    {
        return $this->validateDate($lastmod);
    }
}
