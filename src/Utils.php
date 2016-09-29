<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 9/29/16
 * Time: 11:54 AM
 */

namespace Kote\Config\Utils;

function absolutePathMaker($absoluteRootPath)
{
    $isRootDir = function ($location) {
        return $location == '/';
    };

    $isAbsolutePath = function ($location) {
        return strlen($location) > 0 && $location[0] == '/';
    };

    if (!$isAbsolutePath($absoluteRootPath)) {
        throw new \Exception("Path '$absoluteRootPath' is not absolute, but must.");
    }

    $step = function ($location, $node) use ($isRootDir) {
        if ($node == '.' || $node == '') {
            return $location;
        } if ($node == '..') {
            return $isRootDir($location)
                ? $location
                : pathinfo($location, PATHINFO_DIRNAME);
        }
        return $location . DIRECTORY_SEPARATOR . $node;
    };

    return function ($path) use ($isAbsolutePath, $absoluteRootPath, $step) {
        if ($isAbsolutePath($path)) {
            throw new \Exception("Path '$path' is absolute, but must not.");
        }

        $nodes = explode(DIRECTORY_SEPARATOR, $path);

        return array_reduce($nodes, $step, $absoluteRootPath);
    };
}
