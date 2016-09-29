<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 9/29/16
 * Time: 10:31 AM
 */

namespace Kote\Config;

use function Kote\Config\Utils\absolutePathMaker;

const SEPARATOR = '.';

/**
 * Returns configuration represented as array.
 *
 * @param $configDir
 * @return array
 */
function getConfig($configDir)
{
    $absFilePath = absolutePathMaker($configDir);

    $isValidConfigFile = function ($file) use ($configDir) {
        return is_file($file) && pathinfo($file, PATHINFO_EXTENSION) == "php";
    };

    $filesReduce = function ($acc, $file) use ($configDir) {
        $config = require $file;
        $filename = pathinfo($file, PATHINFO_FILENAME);
        $acc[$filename] = $config;
        return $acc;
    };

    $files = array_filter(array_map($absFilePath, scandir($configDir)), $isValidConfigFile);

    return array_reduce($files, $filesReduce, []);
}

/**
 * Makes recursive value accessor.
 *
 * @param $key
 * @return \Closure
 */
function makeValueAccessor($key)
{
    $path = explode(SEPARATOR, $key);
    $getValue = function ($config, $value) {
        return array_key_exists($value, $config) ? $config[$value] : null;
    };
    return function ($config) use ($path, $getValue) {
        return array_reduce($path, $getValue, $config);
    };
}

/**
 * Gets value from given configuration.
 *
 * @param $config
 * @param $key
 * @param null $default
 * @return null
 */
function getValue(array $config, $key, $default = null)
{
    $valueAccessor = makeValueAccessor($key);
    return $valueAccessor($config) ?: $default;
}
