<?php
/*
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Sonrisa\Component\Sitemap;

use \Sonrisa\Component\Sitemap\Exceptions\SitemapException as SitemapException;

/**
 * Class SubmitSitemap
 * @package Sonrisa\Component\Sitemap
 */
class SubmitSitemap
{
    protected static $sites = array
    (
        'google' => 'http://www.google.com/webmasters/tools/ping?sitemap={{sitemap}}',
        'bing' => 'http://www.bing.com/webmaster/ping.aspx?siteMap={{sitemap}}',
    );

    /**
     * Submits a Sitemap to the available search engines. If provided it will first to send the GZipped version.
     *
     * @param $url            string
     *
     * @throws Exceptions\SitemapException
     * @return array                       Holds the status of the submission for each search engine queried.
     */
    public static function send($url)
    {
        //Validate URL format and Response
        if (filter_var($url, FILTER_VALIDATE_URL, array('options' => array('flags' => FILTER_FLAG_PATH_REQUIRED)))) {
            if (self::sendHttpHeadRequest($url) === true) {
                return self::submitSitemap($url);
            }
            throw new SitemapException("The URL provided ({$url}) holds no accessible sitemap file.");
        }
        throw new SitemapException("The URLs provided do not hold accessible sitemap files.");
    }

    /**
     * Submits a sitemap to the search engines using file_get_contents
     *
     * @param $url string        Valid URL being submitted.
     * @return array Array with the search engine submission success status as a boolean.
     */
    protected static function submitSitemap($url)
    {
        $response = array();
        $http_response_header = null;
        foreach (self::$sites as $site => $submit_url) {
            file_get_contents((str_replace('{{sitemap}}', $url, $submit_url)));
            $response[$site] = (
                ($http_response_header[0] == "HTTP/1.1 200 OK")
                || ($http_response_header[0] == "HTTP/1.0 200 OK")
            );
        }

        return $response;
    }

    /**
     * Validates if the URL to submit as a sitemap actually exists and is accessible.
     *
     * @param $url string        URL being submitted.
     * @return boolean
     */
    protected static function sendHttpHeadRequest($url)
    {
        $http_response_header = null;
        $opts = array
        (
            'http' => array
            (
                'method' => "HEAD",
                'header' => "Accept-language: en\r\n",
            ),
        );

        $context = stream_context_create($opts);

        $fp = @fopen($url, 'r', false, $context);
        @fpassthru($fp);
        @fclose($fp);

        $response = false;
        if (!empty($http_response_header)) {
            $response =
                (
                    ($http_response_header[0] == "HTTP/1.1 200 OK") ||
                    ($http_response_header[0] == "HTTP/1.0 200 OK") ||
                    ($http_response_header[0] == "HTTP/1.0 301 Moved Permanently") ||
                    ($http_response_header[0] == "HTTP/1.1 301 Moved Permanently") ||
                    ($http_response_header[0] == "HTTP/1.0 301 Moved") ||
                    ($http_response_header[0] == "HTTP/1.1 301 Moved") ||
                    ($http_response_header[0] == "HTTP/1.1 302 Found") ||
                    ($http_response_header[0] == "HTTP/1.0 302 Found")
                );
        }

        return $response;
    }
}
