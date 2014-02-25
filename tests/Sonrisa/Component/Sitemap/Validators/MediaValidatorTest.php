<?php
/*
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Validators;


use Sonrisa\Component\Sitemap\Validators\MediaValidator;

/**
 * Class MediaValidatorTest
 * @package Validators
 */
class MediaValidatorTest  extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Sonrisa\Component\Sitemap\Validators\MediaValidator
     */
    protected $validator;

    public function setUp()
    {
        $this->validator = new MediaValidator();
    }

    public function testPlaceholder()
    {

    }
} 