<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 9/29/16
 * Time: 10:31 AM
 */

namespace Nerd\Config;

use Nerd\Config\Formats;

const SEPARATOR = '.';

/**
 * Scan directory for configuration files and return configuration represented as array.
 *
 * @param string $configDir
 * @param string $format
 * @return array
 */
function getConfig($configDir, $format = Formats\PHP)
{
    $parser = Formats\getParser($format);

    $absFilePath = function ($file) use ($configDir) {
        return $configDir . DIRECTORY_SEPARATOR . $file;
    };

    $filesReduce = function ($acc, $file) use ($configDir, $parser) {
        $filename = pathinfo($file, PATHINFO_FILENAME);
        $config = $parser($file);
        return array_merge($acc, [$filename => $config]);
    };

    $filesList = scandir($configDir);
    $absoluteList = array_map($absFilePath, $filesList);
    $filteredList = array_filter($absoluteList, isValidConfigFile($format));

    return array_reduce($filteredList, $filesReduce, []);
}

/**
 * Make recursive value accessor.
 *
 * @param $key
 * @return \Closure
 */
function makeValueAccessor($key)
{
    $path = explode(SEPARATOR, $key);
    $getValue = function ($config, $value) {
        return is_array($config) && array_key_exists($value, $config)
            ? $config[$value]
            : null;
    };
    return function ($config) use ($path, $getValue) {
        return array_reduce($path, $getValue, $config);
    };
}

/**
 * Get value from given configuration.
 *
 * @param array $config
 * @param string $key
 * @param mixed $default
 * @return mixed
 */
function getValue(array $config, $key, $default = null)
{
    $valueAccessor = makeValueAccessor($key);
    return $valueAccessor($config) ?: $default;
}

/**
 * Test config file is valid.
 *
 * @param string $format
 * @return \Closure
 */
function isValidConfigFile($format)
{
    return function ($file) use ($format) {
        return is_file($file) && pathinfo($file, PATHINFO_EXTENSION) == $format;
    };
}
