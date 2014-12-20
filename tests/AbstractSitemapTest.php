<?php
/**
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 * Date: 12/21/14
 * Time: 12:23 AM
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\NilPortugues\Sitemap;

/**
 * Class AbstractSitemapTest
 */
class AbstractSitemapTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var string
     */
    protected $exception = 'NilPortugues\Sitemap\SitemapException';

    /**
     * @test
     */
    public function itShouldThrowExceptionIfFilePathDoesNotExist()
    {
        $this->setExpectedException(
            $this->exception,
            'Provided path \'i/do/not/exist\' does not exist or is not writable.'
        );
        new DummyAbstractSitemap('i/do/not/exist', 'sitemap.xml', false);
    }

    /**
     * @test
     */
    public function itShouldThrowExceptionIfFilePathIsNotWritable()
    {
        $this->setExpectedException(
            $this->exception,
            'Provided path \'/\' does not exist or is not writable.'
        );
        new DummyAbstractSitemap('/', 'sitemap.xml', false);
    }

    /**
     * @test
     */
    public function itShouldThrowExceptionWhenFileAlreadyExists()
    {
        touch('sitemap.xml');

        $this->setExpectedException($this->exception);
        new DummyAbstractSitemap('.', 'sitemap.xml', false);

        unlink('sitemap.xml');
    }
}
