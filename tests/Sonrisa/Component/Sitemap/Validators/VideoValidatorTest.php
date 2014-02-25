<?php
/*
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Validators;


use Sonrisa\Component\Sitemap\Validators\VideoValidator;

/**
 * Class VideoValidatorTest
 * @package Validators
 */
class VideoValidatorTest  extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Sonrisa\Component\Sitemap\Validators\VideoValidator
     */
    protected $validator;

    public function setUp()
    {
        $this->validator = new VideoValidator();
    }

    public function testPlaceholder()
    {

    }
} 