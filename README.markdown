# GracefulBitlyShortener README

## Name
GracefulBitlyShortener - Gracefully shorten URLs with [bitly][bitly]

## Version
0.1

## Project Home
GracefulBitlyShortener can be found on [github][home].

## Synopsis
    <?php
    $bitly = new GracefulBitlyShortener('johndoesblog', 'R_...');
    $shortened_url = $bitly->shorten('http://www.felixmiddendorf.eu/');
    // If the connection failed (bit.ly down, network issues etc.)
    // the link is not shortened and the long URL is returned.
    ?>

## Description
GracefulBitlyShortener allows you to programmatically shorten URLs using
[bitly][bitly]. Data is transferred using the [cURL library][cURL], which
therefore needs to be installed.

## Author
GracefulBitlyShortener was written and is maintained by
[Felix Middendorf][felixmiddendorf]. Please get in touch if you would like to
contribute to its development.

## Bug Reports
Please report bugs to the [issue tracker on github][issues].

## Copyright & License
Copyright 2012 Felix Middendorf. All rights reserved. GracefulBitlyShortener is
released under [GNU Lesser Public License 3.0][lgpl] or later (see
COPYING.LESSER). Please respect copyright and license when using
GracefulBitlyShortener.

## Disclaimer
Neither the author, nor the php GracefulBitlyShortener library is in any way
associated with [bitly][bitly].

[bitly]: http://bit.ly
[home]: http://github.com/felixmiddendorf/graceful-bitly-shortener/
[cURL]: http://php.net/curl/
[felixmiddendorf]: http://www.felixmiddendorf.eu/
[issues]: http://github.com/felixmiddendorf/graceful-bitly-shortener/issues/
[lgpl]: http://www.gnu.org/licenses/lgpl-3.0.txt
