<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 9/29/16
 * Time: 10:27 AM
 */

namespace tests;

use function Nerd\Config\getValue;
use function Nerd\Config\getConfig;
use PHPUnit\Framework\TestCase;

class ConfigTest extends TestCase
{
    public function testPhpConfig()
    {
        $configDir = __DIR__ . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "php";
        $config = getConfig($configDir, \Nerd\Config\Formats\PHP);

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

    public function testJsonConfig()
    {
        $configDir = __DIR__ . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "json";
        $config = getConfig($configDir, \Nerd\Config\Formats\JSON);

        $this->assertTrue(is_array($config));
        $this->assertTrue(is_array(getValue($config, "app")));

        $this->assertEquals("bar", getValue($config, "app.foo"));
        $this->assertEquals("it", getValue($config, "app.go.deep"));
        $this->assertEquals("world", getValue($config, "app.go.deeper.hello"));
    }

    public function testIniConfig()
    {
        $configDir = __DIR__ . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "ini";
        $config = getConfig($configDir, \Nerd\Config\Formats\INI);

        $this->assertTrue(is_array($config));
        $this->assertTrue(is_array(getValue($config, "app")));

        $this->assertEquals("bar", getValue($config, "app.common.foo"));
        $this->assertEquals(10, getValue($config, "app.common.a"));

        $this->assertTrue(is_array(getValue($config, "app.common.arr")));
        $this->assertEquals([1, 2], getValue($config, "app.common.arr"));

        $this->assertEquals("y", getValue($config, "app.group2.x"));
    }

    /**
     * @expectedException \Exception
     */
    public function testWrongFormat()
    {
        getConfig(__DIR__, 'wrong');
    }

    /**
     * @param $config
     * @depends testPhpConfig
     */
    public function testDefaultValue($config)
    {
        $defaultValue = "some_value";
        $this->assertEquals($defaultValue, getValue($config, "nonexistent", $defaultValue));
    }
}
