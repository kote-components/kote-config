# Kote-Config
[![Build Status](https://travis-ci.org/kote-components/kote-config.svg?branch=master)](https://travis-ci.org/kote-components/kote-config)
[![Code Climate](https://codeclimate.com/repos/57ee25d08a3bb33c48001436/badges/19fda0eff80b9527ef5f/gpa.svg)](https://codeclimate.com/repos/57ee25d08a3bb33c48001436/feed)
[![Test Coverage](https://codeclimate.com/repos/57ee25d08a3bb33c48001436/badges/19fda0eff80b9527ef5f/coverage.svg)](https://codeclimate.com/repos/57ee25d08a3bb33c48001436/coverage)

Kote Configuration Manager

## Formats
Supported formats: `PHP` and `JSON`.

## Usage

Let you have configuration files in configuration folder `/path/to/config`:

```
config1.php
config2.php
other.php
app.php
```

With content like:

```php
<?php

return [
    'someKey' => 'Some Value',
    'otherKey' => 'Other Value',
    'deep' => [
        "key" => "value"
    ]
];
```

Example of usage:

```php
use Kote\Config;

$config = Config\getConfig("/path/to/config", Config\Formats\PHP);

$someKey = Config\getValue($config, "config1.someKey", "defaultValue");
$key = Config\getValue($config, "other.key");
$token = Config\getValue($config, "app.token");
```

