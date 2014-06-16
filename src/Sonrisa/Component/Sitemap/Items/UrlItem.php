<?php
/*
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Sonrisa\Component\Sitemap\Items;

use Sonrisa\Component\Sitemap\Validators\UrlValidator;

/**
 * Class UrlItem
 * @package Sonrisa\Component\Sitemap\Items
 */
class UrlItem extends AbstractItem implements ItemInterface
{
    /**
     * @var \Sonrisa\Component\Sitemap\Validators\UrlValidator
     */
    protected $validator;

    /**
     *
     */
    public function __construct()
    {
        $this->validator = UrlValidator::getInstance();
    }

    /**
     * @return string
     */
    public function getHeader()
    {
        return '<?xml version="1.0" encoding="UTF-8"?>' . "\n" .
        '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
    }

    /**
     * @return string
     */
    public function getFooter()
    {
        return "</urlset>";
    }

    /**
     * @return string
     */
    public function getLoc()
    {
        return (!empty($this->data['loc'])) ? $this->data['loc'] : '';
    }

    /**
     * @param $loc
     * @return $this
     */
    public function setLoc($loc)
    {
        return $this->setField('loc', $loc);
    }

    /**
     * @param $lastmod
     * @return $this
     */
    public function setLastMod($lastmod)
    {
        return $this->setField('lastmod', $lastmod);
    }

    /**
     * @param $changefreq
     * @return $this
     */
    public function setChangeFreq($changefreq)
    {
        return $this->setField('changefreq', $changefreq);
    }

    /**
     * @param $priority
     * @return $this
     */
    public function setPriority($priority)
    {
        return $this->setField('priority', $priority);
    }

    /**
     * Collapses the item to its string XML representation.
     *
     * @return string
     */
    public function build()
    {
        $data = '';
        //Create item ONLY if all mandatory data is present.
        if (!empty($this->data['loc'])) {
            $xml = array();

            $xml[] = "\t" . '<url>';
            $xml[] = (!empty($this->data['loc'])) ? "\t\t<loc>{$this->data['loc']}</loc>" : '';
            $xml[] = (!empty($this->data['lastmod'])) ? "\t\t<lastmod>{$this->data['lastmod']}</lastmod>" : '';
            $xml[] = (!empty($this->data['changefreq'])) ? "\t\t<changefreq>{$this->data['changefreq']}</changefreq>" : '';
            $xml[] = (!empty($this->data['priority'])) ? "\t\t<priority>{$this->data['priority']}</priority>" : '';
            $xml[] = "\t" . '</url>';

            $xml = array_filter($xml);

            $data = implode("\n", $xml);
        }

        return $data;
    }
}
