<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 9/30/16
 * Time: 12:06 PM
 */

namespace Nerd\Config\Formats;

const PHP = 'php';
const JSON = 'json';
const INI = 'ini';

/**
 * Get parser for given file format.
 *
 * @param $format
 * @return callable
 * @throws \Exception
 */
function getParser($format)
{
    switch ($format) {
        case PHP:
            return \Nerd\Config\Parsers\PHP\PARSER;
        case JSON:
            return \Nerd\Config\Parsers\JSON\PARSER;
        case INI:
            return \Nerd\Config\Parsers\INI\PARSER;
        default:
            throw new \Exception("File format '$format' is not supported.");
    }
}
