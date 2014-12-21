<?php
/**
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 * Date: 12/21/14
 * Time: 8:11 PM
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace NilPortugues\Sitemap;

/**
 * Class SubmitSitemap
 * @package NilPortugues\Sitemap
 */
class SubmitSitemap
{
    /**
     * @var array
     */
    protected static $sites = [
        'google' => 'http://www.google.com/webmasters/tools/ping?sitemap={{sitemap}}',
        'bing'   => 'http://www.bing.com/webmaster/ping.aspx?siteMap={{sitemap}}',
    ];

    /**
     * Submits a Sitemap to the available search engines. If provided it will first to send the GZipped version.
     *
     * @param string $url
     *
     * @return array
     * @throws SitemapException
     */
    public static function send($url)
    {
        if (false === filter_var($url, FILTER_VALIDATE_URL, ['options' => ['flags' => FILTER_FLAG_PATH_REQUIRED]])) {
            throw new SitemapException("The value for \$url is not a valid URL resource.");
        }

        return self::submitSitemap($url);
    }

    /**
     * Submits a sitemap to the search engines using file_get_contents
     *
     * @param $url string       Valid URL being submitted.
     *
     * @return array            Array with the search engine submission success status as a boolean.
     */
    protected static function submitSitemap($url)
    {
        $response = [];

        foreach (self::$sites as $site => $baseUrl) {
            $submitUrl = str_replace('{{sitemap}}', $url, $baseUrl);
            $response  = self::executeCurl($submitUrl, $response, $site);
        }

        return $response;
    }

    /**
     * @param string $submitUrl
     * @param array  $response
     * @param string $site
     *
     * @return array
     */
    protected static function executeCurl($submitUrl, array &$response, $site)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $submitUrl);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_exec($ch);

        $response[$site] = ('' === curl_error($ch));
        curl_close($ch);
        return $response;
    }
}
