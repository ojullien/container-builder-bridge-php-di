# Container Builder Bridge PHP-DI

![PHP Composer](https://github.com/oseille/container-builder-bridge-php-di/workflows/PHP%20Composer/badge.svg?branch=master)

A concrete implementation of the [Container Builder Bridge](https://github.com/oseille/container-builder-bridge) using [php-di/php-di](https://github.com/PHP-DI/PHP-DI)

## Table of Contents

- [Requirements](#requirements) | [Installation](#installation) | [Documentation](#documentation) | [Test](#test) | [Contributing](#contributing) | [License](#license)

## Requirements

- PHP: ^7.4
- oseille/container-builder-bridge: ^1.0
- php-di/php-di: ^6.1

## Installation

This package requires PHP 7.4. For specifics, please examine the package [composer.json](https://github.com/oseille/container-builder-bridge-php-di/blob/master/composer.json) file.

You may check if your PHP and extension versions match the platform requirements using `composer diagnose` and `composer check-platform-reqs`. (This requires [Composer](https://getcomposer.org/) to be available as composer.)

This package is installable and PSR-4 autoloadable via [Composer](https://getcomposer.org/) as oseille/container-builder-bridge-php-di. For no dev, use `composer install --no-dev` and for dev, use `composer install`.

Alternatively, [download a release](https://github.com/oseille/container-builder-bridge-php-di/releases), or clone this repository, then map the Oseille\ContainerBuilderBridge\PHPDI namespace to the package src/ directory.

## Documentation

We do not provide exhaustive documentation. Please read the code and the comments ;)

```php
// Instanciates the container builder
$container_builder = new new \DI\ContainerBuilder();

// Configures the container builder if needed
$container_builder->enableCompilation(__DIR__ . '/tmp');
$container_builder->writeProxiesToFile(true, __DIR__ . '/tmp/proxies');
$container_builder->useAutowiring(false);
$container_builder->useAnnotations(false);

// Instanciates the implementor to use thru the bridge builder
$bridge_builder = new \Oseille\ContainerBuilderBridge\PHPDI\Implementor($container_builder);

// Adds the definitions to the builder
$bridge_builder->addDefinitions($definitions);

// Builds the container
$container = $bridge_builder->build();
```

## Test

To run the unit tests at the command line, issue `composer install` and then `./vendor/bin/phpunit` at the package root. (This requires [Composer](https://getcomposer.org/) to be available as composer.)

## Contributing

Thanks you for taking the time to contribute. Please fork the repository and make changes as you'd like.

If you have any ideas, just open an [issue](https://github.com/oseille/container-builder-bridge-php-di/issues) and tell me what you think. Pull requests are also warmly welcome.

If you encounter any **bugs**, please open an [issue](https://github.com/oseille/container-builder-bridge-php-di/issues).

Be sure to include a title and clear description,as much relevant information as possible, and a code sample or an executable test case demonstrating the expected behavior that is not occurring.

## License

**Container Builder Bridge PHP-DI** is open-source and is licensed under the [MIT license](LICENSE).
