<?php
/**
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 * Date: 12/20/14
 * Time: 7:46 PM
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace NilPortugues\Sitemap;

use NilPortugues\Sitemap\Item\ValidatorTrait;

/**
 * Class AbstractSitemap
 * @package NilPortugues\Sitemap
 */
abstract class AbstractSitemap implements SitemapInterface
{
    /**
     * Variable holding the items added to a file.
     *
     * @var int
     */
    protected $totalItems = 0;

    /**
     * Array holding the files created by this class.
     *
     * @var array
     */
    protected $files = [];

    /**
     * Variable holding the number of files created by this class.
     *
     * @var int
     */
    protected $totalFiles = 0;

    /**
     * Maximum amount of URLs elements per sitemap file.
     *
     * @var int
     */
    protected $maxItemsPerSitemap = 50000;

    /**
     * @var int
     */
    protected $maxFilesize = 52428800; // 50 MB

    /**
     * @var bool
     */
    protected $gzipOutput;

    /**
     * @var string
     */
    protected $filePath;

    /**
     * @var string
     */
    protected $fileBaseName;

    /**
     * @var string
     */
    protected $fileExtension;

    /**
     * @var resource
     */
    protected $filePointer;

    /**
     * Due to the structure of a video sitemap we need to accumulate
     * the items under an array holding the URL they belong to.
     *
     * @var array
     */
    protected $items = [];

    /**
     * Byte counter.
     *
     * @var int
     */
    protected $accommulatedFileSize = 0;

    /**
     * @param string $filePath
     * @param string $fileName
     * @param bool   $gzip
     * @param int    $maxFileSize
     */
    public function __construct($filePath, $fileName, $gzip = false, $maxFileSize = null)
    {
        $this->validateFilePath($filePath);
        $this->prepareOutputFile($filePath, $fileName);
        $this->createOutputPlaceholderFile();
        $this->maxFilesize = (empty($maxFileSize)) ? $this->maxFilesize : $maxFileSize;

        $this->gzipOutput = $gzip;
    }

    /**
     * @param string $filePath
     *
     * @throws SitemapException
     */
    protected function validateFilePath($filePath)
    {
        if (false === (is_dir($filePath) && is_writable($filePath))) {
            throw new SitemapException(
                sprintf("Provided path '%s' does not exist or is not writable.", $filePath)
            );
        }
    }

    /**
     * @param string $filePath
     * @param string $fileName
     */
    protected function prepareOutputFile($filePath, $fileName)
    {
        $this->filePath      = realpath($filePath);
        $pathParts           = pathinfo($fileName);
        $this->fileBaseName  = $pathParts['filename'];
        $this->fileExtension = $pathParts['extension'];
    }

    /**
     * @return bool
     * @throws SitemapException
     */
    protected function createOutputPlaceholderFile()
    {
        $filePath = $this->getFullFilePath();

        if (true === file_exists($filePath)) {
            throw new SitemapException(
                sprintf('Cannot create sitemap. File \'%s\' already exists.', $filePath)
            );
        }

        return touch($filePath);
    }

    /**
     * @return string
     */
    protected function getFullFilePath()
    {
        $number = (0 == $this->totalFiles) ? '' : $this->totalFiles;

        return $this->filePath . DIRECTORY_SEPARATOR . $this->fileBaseName . $number . "." . $this->fileExtension;
    }

    /**
     * @return bool
     */
    protected function isNewFileIsRequired()
    {
        return (($this->totalItems+1) > $this->maxItemsPerSitemap);
    }

    /**
     * @return integer
     */
    protected function getCurrentFileSize()
    {
        return filesize($this->getFullFilePath());
    }

    /**
     * Before appending data we need to check if we'll surpass the file size limit or not.
     *
     * @param $stringData
     *
     * @return bool
     */
    protected function isSurpassingFileSizeLimit($stringData)
    {
        $expectedFileSize = $this->accommulatedFileSize + $this->getStringSize($stringData);

        return $this->maxFilesize < $expectedFileSize;
    }

    /**
     * @param string $xmlData
     *
     * @return int
     */
    protected function getStringSize($xmlData)
    {
        return mb_strlen($xmlData, mb_detect_encoding($xmlData));
    }

    /**
     * @param        $item
     * @param string $url
     */
    protected function createAdditionalSitemapFile($item, $url = '')
    {
        $this->build();
        $this->totalFiles++;

        $this->createNewFilePointer();
        $this->appendToFile($this->getHeader());
        $this->appendToFile($item->build());
        $this->totalItems = 1;

        $this->accommulatedFileSize = $this->getStringSize($this->getHeader()) + $this->getStringSize($item->build());
    }

    /**
     * Generates sitemap file.
     *
     * @return mixed
     */
    public function build()
    {
        $this->appendToFile($this->getFooter());

        if ($this->gzipOutput) {
            $this->writeGZipFile();
        }

        fclose($this->filePointer);
    }

    /**
     * @param $xmlData
     */
    protected function appendToFile($xmlData)
    {
        $this->accommulatedFileSize = $this->accommulatedFileSize + $this->getStringSize($xmlData);
        fwrite($this->filePointer, $xmlData);
    }

    /**
     * @return string
     */
    abstract protected function getFooter();

    /**
     * @return bool
     */
    protected function writeGZipFile()
    {
        $status      = false;
        $gZipPointer = gzopen($this->getFullGZipFilePath(), 'w9');

        if ($gZipPointer !== false) {
            gzwrite($gZipPointer, file_get_contents($this->getFullFilePath()));
            $status = gzclose($gZipPointer);
        }
        return $status;
    }

    /**
     * @return string
     */
    protected function getFullGZipFilePath()
    {
        return $this->getFullFilePath() . '.gz';
    }

    /**
     *
     */
    protected function createNewFilePointer()
    {
        $this->filePointer = fopen($this->getFullFilePath(), 'w');
        $this->files[]     = $this->getFullFilePath();
    }

    /**
     * @return string
     */
    abstract protected function getHeader();

    /**
     * @param        $item
     * @param string $url
     *
     * @return $this
     */
    protected function delayedAdd($item, $url = '')
    {
        $this->validateItemClassType($item);
        $this->validateLoc($url);


        $this->items[$url][] = $item->build();

        return $this;
    }

    /**
     * @param $item
     *
     * @throws SitemapException
     */
    abstract protected function validateItemClassType($item);

    /**
     * @param string $url
     *
     * @throws SitemapException
     */
    protected function validateLoc($url)
    {
        if (false === ValidatorTrait::validateLoc($url)) {
            throw new SitemapException(
                sprintf('Provided url is not valid.')
            );
        }
    }

    /**
     *
     */
    protected function createSitemapFile()
    {
        if (null === $this->filePointer || 0 === $this->totalItems) {
            $this->createNewFilePointer();
            $this->appendToFile($this->getHeader());
        }
    }
}
