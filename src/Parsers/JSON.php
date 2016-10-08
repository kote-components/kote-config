<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 9/30/16
 * Time: 12:19 PM
 */

namespace Nerd\Config\Parsers\JSON;

const PARSER = __NAMESPACE__ . '\parse';

/**
 * @param $filename
 * @return array
 */
function parse($filename)
{
    return json_decode(file_get_contents($filename), true);
}
