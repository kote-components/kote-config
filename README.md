# Kote-Config
[![Build Status](https://travis-ci.org/kote-components/kote-config.svg?branch=master)](https://travis-ci.org/kote-components/kote-config)
[![Code Climate](https://codeclimate.com/repos/57ee25d08a3bb33c48001436/badges/19fda0eff80b9527ef5f/gpa.svg)](https://codeclimate.com/repos/57ee25d08a3bb33c48001436/feed)
[![Test Coverage](https://codeclimate.com/repos/57ee25d08a3bb33c48001436/badges/19fda0eff80b9527ef5f/coverage.svg)](https://codeclimate.com/repos/57ee25d08a3bb33c48001436/coverage)


Configuration Manager

## Usage

```php
use Kote\Config;

// Get configuration from `configPath`
$config = Config\getConfig("configPath");

// Get value associated with given key or returns `defaultValue` if no value
$value  = Config\getValue($config, "file.key", "defaultValue");
```

## Structure

Will be later...
