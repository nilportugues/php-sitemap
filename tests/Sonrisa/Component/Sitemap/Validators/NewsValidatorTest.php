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

    public function testValidateLocValid()
    {
        $result = $this->validator->validateLoc('http://google.com/news');
        $this->assertEquals('http://google.com/news',$result);
    }

    public function testValidateLocInvalid()
    {
        $result = $this->validator->validateLoc('not-a-url');
        $this->assertEquals('',$result);
    }


    public function testValidateLanguageISO639_1()
    {
        $result = $this->validator->validateLanguage('ca');
        $this->assertEquals('ca',$result);
    }

    public function testValidateLanguageISO639_2()
    {
        $result = $this->validator->validateLanguage('cat');
        $this->assertEquals('cat',$result);
    }

    public function testValidateLanguageISO639_3()
    {
        $result = $this->validator->validateLanguage('aaa');
        $this->assertEquals('aaa',$result);
    }

    public function testValidateAccessSubscription()
    {
        $result = $this->validator->validateAccess('Subscription');
        $this->assertEquals('Subscription',$result);
    }

    public function testValidateAccessRegistration()
    {
        $result = $this->validator->validateAccess('Registration');
        $this->assertEquals('Registration',$result);
    }

    public function testValidateAccessInvalid()
    {
        $result = $this->validator->validateAccess('');
        $this->assertEquals('',$result);
    }

    public function testValidateGenresMethod1()
    {
        $result = $this->validator->validateGenres('PressRelease, Satire, Blog, OpEd , Opinion, UserGenerated');
        $this->assertEquals('PressRelease, Satire, Blog, OpEd, Opinion, UserGenerated',$result);
    }

    public function testValidateGenresMethod2()
    {
        $result = $this->validator->validateGenres(array('PressRelease','Satire','Blog','OpEd','Opinion','UserGenerated'));
        $this->assertEquals('PressRelease, Satire, Blog, OpEd, Opinion, UserGenerated',$result);
    }

    public function testValidateGenresSkipInvalid()
    {
        $result = $this->validator->validateGenres(array('PreXXXXssRelease','Satire','Blog','OpEd','Opinion','UserGenerated'));
        $this->assertEquals('Satire, Blog, OpEd, Opinion, UserGenerated',$result);
    }
} 