# Kote-Config
[![Build Status](https://travis-ci.org/nerd-components/config.svg?branch=master)](https://travis-ci.org/nerd-components/config)
[![Coverage Status](https://coveralls.io/repos/github/nerd-components/config/badge.svg)](https://coveralls.io/github/nerd-components/config)
[![StyleCI](https://styleci.io/repos/69541489/shield?branch=master)](https://styleci.io/repos/69541489)

Simple stateless configuration manager

## Formats
Supported formats: `PHP`, `JSON` and `INI`.

## Usage

```php
use Kote\Config;

$config = Config\getConfig("/path/to/config", Config\Formats\JSON);

$someKey = Config\getValue($config, "config1.someKey", defaultValue);
$key = Config\getValue($config, "other.key");
$token = Config\getValue($config, "app.token");
```
