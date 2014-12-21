<?php
/**
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 * Date: 12/20/14
 * Time: 7:45 PM
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace NilPortugues\Sitemap;

use NilPortugues\Sitemap\Item\Video\VideoItem;

/**
 * Class VideoSitemap
 * @package NilPortugues\Sitemap
 */
class VideoSitemap extends ImageSitemap
{
    /**
     * Due to the structure of a video sitemap we need to accumulate
     * the items under an array holding the URL they belong to.
     *
     * @var array
     */
    protected $items = [];

    /**
     * Adds a new sitemap item.
     *
     * @param VideoItem $item
     * @param string $url
     *
     * @return $this
     * @throws SitemapException
     */
    public function add($item, $url = '')
    {
        return $this->delayedAdd($item, $url);
    }

    /**
     * @return mixed
     */
    public function build()
    {
        return parent::build();
    }

    /**
     * @return bool
     */
    protected function isNewFileIsRequired()
    {
        return AbstractSitemap::isNewFileIsRequired();
    }

    /**
     * @param VideoItem $item
     *
     * @throws SitemapException
     */
    protected function validateItemClassType($item)
    {
        if (!($item instanceof VideoItem)) {
            throw new SitemapException(
                "Provided \$item is not instance of \\NilPortugues\\Sitemap\\Item\\Video\\VideoItem."
            );
        }
    }

    /**
     * @return string
     */
    protected function getHeader()
    {
        return '<?xml version="1.0" encoding="UTF-8"?>' . "\n"
        . '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"'
        . ' xmlns:video="http://www.google.com/schemas/sitemap-video/1.1">' . "\n";
    }

    /**
     * @return string
     */
    protected function getFooter()
    {
        return "</urlset>";
    }
}
