# Kote-Config

Configuration Manager

## Usage

```php
use Kote\Config\Config;

$config = Config\getConfig("configPath"); // Read configuration from `configPath`

$value  = Config\getValue($config, "file.key", "defaultValue"); // Gets value associated with given key or returns `defaultValue` if no value
```

## Structure

Will be later...
