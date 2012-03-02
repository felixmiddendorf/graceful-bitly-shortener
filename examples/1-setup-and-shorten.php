<?php
/**
 * Lesson 1: Set-up and Shorten
 *
 * This example shows how to set up an instance of GracefulBitlyShortener and
 * use it to shorten a URL.
 *
 * @see http://code.google.com/p/bitly-api/wiki/ApiDocumentation#/v3/shorten
 */

/**
 * Obviously, you have to import the GracefulBitlyShortener class.
 */
require '../lib/GracefulBitlyShortener.php';

/**
 * Replace this with your own bitly credentials. You can find them here:
 * @link http://bit.ly/a/your_api_key
 */
$bitly = new GracefulBitlyShortener('bitlyapidemo', 'R_0da49e0a9118ff35f52f629d2d71bf07');

/**
 * Now you can start shortening URLs using bitly. If the call bitly's API was
 * successful, 'http://bit.ly/xyz..' is echoed. Else: 'http://betaworks.com/'.
 */
echo $bitly->shorten('http://betaworks.com/'), PHP_EOL;