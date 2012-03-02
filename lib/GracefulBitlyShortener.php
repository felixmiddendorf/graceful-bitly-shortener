<?php
/**
 * GracefulBitlyShortener - A php library for shortening URL using bitly
 *
 * This library is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published
 * by the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.
 * If not, see <{@link http://www.gnu.org/licenses/lgpl-3.0.txt}>.
 *
 * @author Felix Middendorf
 * @copyright 2012 Felix Middendorf
 * @link http://www.felixmiddendorf.eu/
 * @package GracefulBitlyShortener
 * @version 0.1
 * @license http://www.gnu.org/licenses/lgpl-3.0.txt GNU Lesser General Public License 3.0
 */

/**
 * GracefulBitlyShortener offers functionality to shorten URLs using bitly. If
 * this fails, the original URL is retained.
 * @link http://bit.ly/
 */
class GracefulBitlyShortener{
	/**
	 * bitly API Endpoint.
	 * @var string
	 */
	const API_ENDPOINT = 'https://api-ssl.bit.ly/v3/';
	
	/**
	 * bitly API Key, e.g. 'R_....'.
	 * @link https://bitly.com/a/your_api_key
	 * @var string
	 */
	protected $bitly_api_key;
	
	/**
	 * bitly Login, e.g. 'johndoesblog'.
	 * @ling https://bitly.com/a/your_api_key
	 * @var string
	 */
	protected $bitly_login;
	
	/**
	 * Last response received, e.g. '{"status_code": 200, "data": {...}}'.
	 * @var string
	 */
	protected $last_response = '';
	
	/**
	 * Last http code received, e.g. '200'.
	 * @var string
	 */
	protected $last_http_code = '';

	/**
	 * Creates a shortener object that is tied to a bitly account.
	 * @link https://bitly.com/a/your_api_key
	 * @param string $login bitly username
	 * @param string $api_key bitly API key
	 */
	public function __construct($login, $api_key){
		$this->bitly_login = $login;
		$this->bitly_api_key = $api_key;
	}

	/**
	 * This method creates a short bitly URL for the supplied URL. If this
	 * fails, it gracefully degrades to the original URL. 
	 * @param string $url The URL that is to be shortened.
	 * @return Shortened URL if successful, else original, long URL.
	 */
	public function shorten($url){
		if(!function_exists('curl_init')){
			// cURL is not installed
			return $url;
		}
		$handler = $this->curl_init();
		curl_setopt($handler, CURLOPT_URL, $this->apiShorten($url));
		$this->last_response = curl_exec($handler);
		$this->last_http_code = curl_getinfo($handler, CURLINFO_HTTP_CODE);
		curl_close($handler);

		if($this->last_http_code != 200 || empty($this->last_response)){
			// invalid response (no data)
			return $url;
		}

		$json = json_decode($this->last_response);
		if($json === NULL || $json->status_code != 200 || !isSet($json->data) || !isSet($json->data->url)){
			// invalid response (invalid or wrong format)
			return $url;
		}

		return $json->data->url;
	}

	protected function curl_init(){
		$handler = curl_init();
		$options = array(
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_FAILONERROR => true
		);
		curl_setopt_array($handler, $options);
		return $handler;
	}

	protected function apiShorten($url){
		$data = array(
			'login' => $this->bitly_login,
			'apiKey' => $this->bitly_api_key,
			'longUrl' => $url,
			'format' => 'json'
		);
		return self::API_ENDPOINT.'shorten?'.http_build_query($data, '', '&');
	}

	/**
	 * Returns the last response.
	 * @return string
	 */
	public function getLastResponse(){
		return $this->last_response;
	}

	/**
	 * Returns the last HTTP code.
	 * @return string e.g. 200, 403, 404
	 */
	public function getLastHttpCode(){
		return $this->last_http_code;
	}
}