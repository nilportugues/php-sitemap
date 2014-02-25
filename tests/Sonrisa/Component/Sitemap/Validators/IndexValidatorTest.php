<?php
/*
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Validators;


use Sonrisa\Component\Sitemap\Validators\IndexValidator;

/**
 * Class IndexValidatorTest
 * @package Validators
 */
class IndexValidatorTest  extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Sonrisa\Component\Sitemap\Validators\IndexValidator
     */
    protected $validator;

    public function setUp()
    {
        $this->validator = new IndexValidator();
    }

    public function testValidateLastmodValidFormat1()
    {
        $date = new \DateTime('now');
        $date = $date->format('c');
        $result = $this->validator->validateLastmod($date);

        $this->assertEquals($date,$result);

    }

    public function testValidateLastmodValidFormat2()
    {
        $date = new \DateTime('now');
        $date = $date->format('Y-m-d\TH:i:sP');
        $result = $this->validator->validateLastmod($date);

        $this->assertEquals($date,$result);

    }

    public function testValidateLastmodValidFormat3()
    {
        $date = new \DateTime('now');
        $date = $date->format('Y-m-d');

        $result = $this->validator->validateLastmod($date);

        $this->assertEquals($date,$result);
    }

    public function testValidateLastmodInvalidFormat()
    {
        $date = '2A-13-03';

        $result = $this->validator->validateLastmod($date);

        $this->assertEquals('',$result);
    }
} 