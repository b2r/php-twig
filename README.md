b2rPHP: Twig
============

Twig composition

[![Build Status](https://travis-ci.org/b2r/php-twig.svg?branch=master)](https://travis-ci.org/b2r/php-twig)

- [CHANGELOG](CHANGELOG.md)
- [Packagist](https://packagist.org/packages/b2r/twig)

## Features
- Fluent interface
- Smart loader
- Context container

## Simple Usage
```php
use b2r\Component\Twig\Twig;

$twig = new Twig(__DIR__ . '/tempaltes');
$twig->addSuffixes(['.twig']);

$twig->template('hello') // Load 'templates/hello.twig'
    ->name('world') // Set context value
    ->render(); #=> 'Hello, world';
```
**hello.twig**
```
Hello, {{ name }}
```

## Docs
- [Twig](docs/Twig.md)
