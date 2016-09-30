<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 9/29/16
 * Time: 10:27 AM
 */

namespace Kote\Config\tests;

use function Kote\Config\getValue;
use function Kote\Config\getConfig;
use PHPUnit\Framework\TestCase;

class ConfigTest extends TestCase
{
    public function testConfig()
    {
        $configDir = __DIR__ . DIRECTORY_SEPARATOR . "config";
        $config = getConfig($configDir);

        $this->assertTrue(is_array($config));
        $this->assertTrue(is_array(getValue($config, "app")));
        $this->assertTrue(is_array(getValue($config, "other")));

        $this->assertEquals("bar", getValue($config, "app.foo"));
        $this->assertEquals("it", getValue($config, "app.go.deep"));
        $this->assertEquals("world", getValue($config, "app.go.deeper.hello"));

        $this->assertEquals("idea", getValue($config, "other.good"));
        $this->assertEquals(10, getValue($config, "other.limit"));
        $this->assertEquals(true, getValue($config, "other.value"));

        return $config;
    }

    /**
     * @param $config
     * @depends testConfig
     */
    public function testDefaultValue($config)
    {
        $defaultValue = "some_value";
        $this->assertEquals($defaultValue, getValue($config, "nonexistent", $defaultValue));
    }
}
