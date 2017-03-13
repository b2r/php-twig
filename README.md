b2rPHP: Twig
============

Twig composition

- [CHANGELOG](CHANGELOG.md)

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
