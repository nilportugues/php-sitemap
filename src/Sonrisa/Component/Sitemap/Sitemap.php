<?php

namespace Sonrisa\Component\Sitemap;

use \Sonrisa\Component\Sitemap\Exceptions\SitemapException as SitemapException;

class Sitemap
{
	protected static $sites = array
	(
		'google' 	=> 'http://www.google.com/webmasters/tools/ping?sitemap={{sitemap}}',
		'bing'		=> 'http://www.bing.com/webmaster/ping.aspx?siteMap={{sitemap}}',
	);

	/**
	 * Submits a Sitemap to the available search engines. If provided it will first to send the GZipped version.
	 *
	 * @param $url 			string
	 * @param $url_gzip 	string	 
	 *
	 * @return array 		Holds the status of the submission for each search engine queried.
	 */
	public static function submit($url,$url_gzip = '')
	{		
		$url_response = false;
		$url_gzip_response = false;

		//Try with gzipped version (always best option)
		if( filter_var( $url_gzip, FILTER_VALIDATE_URL, array('options' => array('flags' => FILTER_FLAG_PATH_REQUIRED)) ) )
		{
			if( self::do_head_check($url_gzip) )
			{
				return self::do_submit($url_gzip);	
			}			
		}	
		//Validate URL format and Response
		elseif( filter_var( $url, FILTER_VALIDATE_URL, array('options' => array('flags' => FILTER_FLAG_PATH_REQUIRED)) ) )
		{
			if(self::do_head_check($url))
			{
				return self::do_submit($url);	
			}		
			throw new SitemapException("The URL provided ({$url}) holds no accessible sitemap file.");
		}
		throw new SitemapException("The URLs provided do not hold accessible sitemap files.");				
	}

	/**
	 * Submits a sitemap to the search engines using file_get_contents
	 *
	 * @param $url string 		Valid URL being submitted.
	 * @return array 			Array with the search engine submission success status as a boolean.
	 */
	protected static function do_submit($url)
	{
		$response = array();

		foreach(self::$sites as $site => $submit_url)
		{
			file_get_contents((str_replace('{{sitemap}}',$url,$submit_url)));
			$response[$site] = (($http_response_header[0] == "HTTP/1.1 200 OK") || ($http_response_header[0] == "HTTP/1.0 200 OK"));
		}			
		return $response;
	}

	/**
	 * Validates if the URL to submit as a sitemap actually exists and is accessible.
	 *
	 * @param $url string 		URL being submitted.
	 * @return boolean
	 */
	protected static function do_head_check($url)
	{
		$opts = array
		(
			'http'=>array
			(
				'method'=>"HEAD",
				'header'=>"Accept-language: en\r\n" .
				"Cookie: foo=bar\r\n"
			)
		);

		$context = stream_context_create($opts);

		$fp = @fopen($url, 'r', false, $context);
		@fpassthru($fp);
		@fclose($fp);

		return (($http_response_header[0] == "HTTP/1.1 200 OK") || ($http_response_header[0] == "HTTP/1.0 200 OK"));
	}

}