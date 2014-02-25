<?php
/*
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Validators;


use Sonrisa\Component\Sitemap\Validators\NewsValidator;

/**
 * Class NewsValidatorTest
 * @package Validators
 */
class NewsValidatorTest  extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Sonrisa\Component\Sitemap\Validators\NewsValidator
     */
    protected $validator;

    public function setUp()
    {
        $this->validator = new NewsValidator();
    }

    public function testPlaceholder()
    {

    }
} 