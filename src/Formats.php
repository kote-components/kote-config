<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 9/30/16
 * Time: 12:06 PM
 */

namespace Kote\Config\Formats;

const PHP = 'php';
const JSON = 'json';


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
            return \Kote\Config\Parsers\PHP\PARSER;
        case JSON:
            return \Kote\Config\Parsers\JSON\PARSER;
        default:
            throw new \Exception("File format '$format' is not supported.");
    }
}
