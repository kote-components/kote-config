<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 9/29/16
 * Time: 10:31 AM
 */

namespace Kote\Config;

const SEPARATOR = '.';

/**
 * Returns configuration represented as array.
 *
 * @param $configDir
 * @return array
 */
function getConfig($configDir)
{
    $absFilePath = function ($file) use ($configDir) {
        return $configDir . DIRECTORY_SEPARATOR . $file;
    };
    $isValidConfigFile = function ($file) use ($configDir, $absFilePath) {
        return is_file($absFilePath($file)) && pathinfo($file, PATHINFO_EXTENSION) == "php";
    };
    $filesReduce = function ($acc, $file) use ($configDir, $absFilePath) {
        $config = require $absFilePath($file);
        $filename = pathinfo($file, PATHINFO_FILENAME);
        $acc[$filename] = $config;
        return $acc;
    };
    $files = array_filter(scandir($configDir), $isValidConfigFile);
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
