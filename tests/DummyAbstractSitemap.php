<?php
/**
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 * Date: 12/21/14
 * Time: 12:22 AM
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\NilPortugues\Sitemap;

use NilPortugues\Sitemap\AbstractSitemap;
use NilPortugues\Sitemap\SitemapException;

/**
 * Class DummyAbstractSitemap
 * @package Tests\NilPortugues\Sitemap
 */
class DummyAbstractSitemap extends AbstractSitemap
{
    /**
     * @return string
     */
    protected function getFooter()
    {
        return 'footer';
    }

    /**
     * @return string
     */
    protected function getHeader()
    {
        return 'header';
    }

    /**
     * @return mixed|void
     */
    public function build()
    {
        $this->createNewFilePointer();
        parent::build();
    }

    /**
     * @param $item
     *
     * @throws SitemapException
     */
    protected function validateItemClassType($item)
    {
        return;
    }

    /**
     * @param        $item
     * @param string $url
     *
     * @return $this|mixed
     */
    public function add($item, $url = '')
    {
        $this->validateLoc($url);
        return $this;
    }
}
