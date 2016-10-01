<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 01.10.16
 * Time: 22:48
 */

namespace Kote\Config\Parsers\INI;

const PARSER = __NAMESPACE__ . '\parse';

/**
 * @param $filename
 * @return array
 */
function parse($filename)
{
    return parse_ini_file($filename);
}
