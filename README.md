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

$twig = new Twig();

echo $twig
    ->template('hello', 'Hello, {{ name }}') // Define 'hello' template and 'hello' as current template
    ->name('world') // Set name context
    ; #=>'Hello, world' invoke __toString()

```

## With template, filter, function, global
```php
use b2r\Component\Twig\Twig;

$twig = new Twig(__DIR__ . '/templates');

$twig->addSuffix('.twig');

$twig->addFilters([
    'l' => function ($value) {
        return strtolower($value);
    },
    'u' => function ($value) {
        return strtoupper($value);
    },
]);

$twig->addFunctions([
    'x2' => function ($value) {
        return $value * 2;
    },
]);

$twig->addGlobals([
    'foo' => 'FOO',
    'bar' => 'BAR',
    'baz' => 'BAZ',
]);

echo $twig->template('hello')->name('world');
```
**hello.twig**
```
Hello, {{ name }}
Hello, {{ name|u }}
Hello, {{ name|l }}
Hello, {{ foo }}
Hello, {{ bar }}
Hello, {{ baz }}
Score: {{ x2(100) }}
```

**outputs**
```
Hello, world
Hello, WORLD
Hello, world
Hello, FOO
Hello, BAR
Hello, BAZ
Score: 200
```

## Docs
- [Twig](docs/Twig.md)
