# Kote-Config
[![Build Status](https://travis-ci.org/kote-components/kote-config.svg?branch=master)](https://travis-ci.org/kote-components/kote-config)
[![Coverage Status](https://coveralls.io/repos/github/kote-components/kote-config/badge.svg)](https://coveralls.io/github/kote-components/kote-config)
[![StyleCI](https://styleci.io/repos/69541489/shield?branch=master)](https://styleci.io/repos/69541489)

Kote Configuration Manager

## Configuration Formats
Supported formats: `PHP` and `JSON`.

## Usage

Let's say you have configuration files in configuration folder `/path/to/config`:

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

