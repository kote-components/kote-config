<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 9/30/16
 * Time: 12:09 PM
 */

namespace Kote\Config\Parsers\PHP;

const PARSER = __NAMESPACE__ . '\parse';

/**
 * @param $filename
 * @return array
 */
function parse($filename)
{
    return require $filename;
}
