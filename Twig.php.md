# Twig

#### Member docs
- [Environment](Environment.md)

#### Usage

```php
use b2r\Component\Twig\Twig;

$twig = new Twig(__DIR__ . '/templates');

$twig->template('hello', 'Hello, {{ name }}');
echo $twig->name('world'); #=>'Hello, world'
```

```php
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

**output**
```
Hello, world
Hello, WORLD
Hello, world
Hello, FOO
Hello, BAR
Hello, BAZ
Score: 200
```
