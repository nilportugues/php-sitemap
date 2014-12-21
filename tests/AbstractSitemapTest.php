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
     * @var string
     */
    protected $sitemapFile = 'sitemap.xml';

    /**
     * @test
     */
    public function itShouldThrowExceptionWhenAddWithInvalidUrl()
    {
        $sitemap = new DummyAbstractSitemap('.', $this->sitemapFile, false);

        $this->setExpectedException($this->exception);
        $sitemap->add('dummy', 'not-a-url');
    }

    /**
     * @test
     */
    public function itShouldWriteXmlFile()
    {
        $sitemap = new DummyAbstractSitemap('.', $this->sitemapFile, false);
        $sitemap->build();

        $this->assertFileExists($this->sitemapFile);
    }

    /**
     * @test
     */
    public function itShouldWriteGZipFile()
    {
        $sitemap = new DummyAbstractSitemap('.', $this->sitemapFile, true);
        $sitemap->build();

        $this->assertFileExists($this->sitemapFile.'.gz');
    }

    /**
     * @test
     */
    public function itShouldThrowExceptionIfFilePathDoesNotExist()
    {
        $this->setExpectedException(
            $this->exception,
            'Provided path \'i/do/not/exist\' does not exist or is not writable.'
        );
        new DummyAbstractSitemap('i/do/not/exist', $this->sitemapFile, false);
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
        new DummyAbstractSitemap('/', $this->sitemapFile, false);
    }

    /**
     * @test
     */
    public function itShouldThrowExceptionWhenFileAlreadyExists()
    {
        touch($this->sitemapFile);

        $this->setExpectedException($this->exception);
        new DummyAbstractSitemap('.', $this->sitemapFile, false);
    }

    /**
     *
     */
    protected function tearDown()
    {
        $fileNames = [
            $this->sitemapFile,
            $this->sitemapFile.'.gz'
        ];

        foreach ($fileNames as $fileName) {
            if (file_exists($fileName)) {
                unlink($fileName);
            }
        }
    }
}
