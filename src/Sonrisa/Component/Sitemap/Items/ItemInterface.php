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
 * Interface ItemInterface
 * @package Sonrisa\Component\Sitemap\Items
 */
interface ItemInterface
{
    /**
     * @param AbstractValidator $validator
     */
    public function __construct(AbstractValidator $validator);

    /**
     * @return string
     */
    public function __toString();

    /**
     * @return mixed
     */
    public function build();

    /**
     * @return mixed
     */
    public function getItemSize();

    /**
     * @return mixed
     */
    public function getHeader();

    /**
     * @return mixed
     */
    public function getHeaderSize();

    /**
     * @return mixed
     */
    public function getFooter();

    /**
     * @return mixed
     */
    public function getFooterSize();
}