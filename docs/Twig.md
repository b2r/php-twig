b2r\Component\Twig\Twig
=======================

**Flags:** `class` 

#### Index
[Implements](#implements) | [Uses](#uses) | [Methods](#methods)

Twig composition

## Features
- Fluent interface
- Smart loader
- Context container


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

Implements
----------
- b2r\Component\PropertyMethodDelegator\PropertyMethodDelegatorInterface

Uses
----------
- b2r\Component\SimpleAccessor\Getter
- b2r\Component\PropertyMethodDelegator\PropertyMethodDelegator
- b2r\Component\Twig\Traits\EnvironmentComposition

Methods
----------
- [__call](#__call) Magic method
- [__construct](#__construct) Constructor
- [__get](#__get)
- [__set](#__set) Magic setter
- [__toString](#__tostring)
- [addContext](#addcontext)
- [addExtension](#addextension)
- [addExtensions](#addextensions)
- [addFilter](#addfilter)
- [addFilters](#addfilters)
- [addFunction](#addfunction)
- [addFunctions](#addfunctions)
- [addGlobal](#addglobal)
- [addGlobals](#addglobals)
- [bind](#bind) Bind context value
- [bindArray](#bindarray)
- [bindValue](#bindvalue)
- [clearContext](#clearcontext)
- [context](#context)
- [display](#display)
- [getContext](#getcontext)
- [getContextValue](#getcontextvalue)
- [getEngine](#getengine)
- [getEnv](#getenv)
- [getEnvironment](#getenvironment)
- [getLoader](#getloader)
- [getPropertyMethodDelegatorInfo](#getpropertymethoddelegatorinfo)
- [getTemplateName](#gettemplatename)
- [params](#params)
- [render](#render) Render
- [resolveDelegateMethod](#resolvedelegatemethod) Resolve delegate method
- [save](#save) Save renderd string to file
- [setContextValue](#setcontextvalue)
- [setTemplate](#settemplate) Set template
- [template](#template)
- [toString](#tostring)
- [unsetContextValue](#unsetcontextvalue)

----------------------------------------

### __call

`public function __call($name, $arguments): mixed`

**Flags:** `public` 

#### Parameters
| name       | type   | default | description | 
| ---------- | ------ | ------- | ----------- | 
| $name      | string |         |             | 
| $arguments | array  |         |             | 


Magic method


- @throws `b2r\Component\Exception\InvalidMethodException`

[(Back to index)](#index)

----------------------------------------

### __construct

`public function __construct()`

**Flags:** `public`  `constructor` 


Constructor

[(Back to index)](#index)

----------------------------------------

### __get

`public function __get($name)`

**Flags:** `public` 

#### Parameters
| name  | type | default | description | 
| ----- | ---- | ------- | ----------- | 
| $name |      |         |             | 

[(Back to index)](#index)

----------------------------------------

### __set

`public function __set($name, $value): self`

**Flags:** `public` 

#### Parameters
| name   | type   | default | description   | 
| ------ | ------ | ------- | ------------- | 
| $name  | string |         | Context name  | 
| $value | mixed  |         | Context value | 


Magic setter

- Assume context value setter

[(Back to index)](#index)

----------------------------------------

### __toString

`public function __toString()`

**Flags:** `public` 


- @alias [render](#render)

[(Back to index)](#index)

----------------------------------------

### addContext

`public function addContext()`

**Flags:** `public` 


- @alias [bind](#bind)

[(Back to index)](#index)

----------------------------------------

### addExtension

`public function addExtension($extension): self`

**Flags:** `public` 

#### Parameters
| name       | type                   | default | description                      | 
| ---------- | ---------------------- | ------- | -------------------------------- | 
| $extension | Twig_Extension, string |         | Extension instance or class name | 

[(Back to index)](#index)

----------------------------------------

### addExtensions

`public function addExtensions($extensions): self`

**Flags:** `public` 

#### Parameters
| name        | type     | default | description                                   | 
| ----------- | -------- | ------- | --------------------------------------------- | 
| $extensions | iterable |         | [Twig_Extension $instance\|string $className] | 

[(Back to index)](#index)

----------------------------------------

### addFilter

`public function addFilter($name, $filter): self`

**Flags:** `public` 

#### Parameters
| name    | type                 | default | description | 
| ------- | -------------------- | ------- | ----------- | 
| $name   | string, Twig_Filter  |         |             | 
| $filter | Closure, Twig_Filter | null    |             | 

[(Back to index)](#index)

----------------------------------------

### addFilters

`public function addFilters($filters): self`

**Flags:** `public` 

#### Parameters
| name     | type     | default | description                                         | 
| -------- | -------- | ------- | --------------------------------------------------- | 
| $filters | iterable |         | [string $name => Twig_SimpleFilter\|Closure $value] | 

[(Back to index)](#index)

----------------------------------------

### addFunction

`public function addFunction($name, $function): self`

**Flags:** `public` 

#### Parameters
| name      | type                   | default | description | 
| --------- | ---------------------- | ------- | ----------- | 
| $name     | string, Twig_Function  |         |             | 
| $function | Closure, Twig_Function | null    |             | 

[(Back to index)](#index)

----------------------------------------

### addFunctions

`public function addFunctions($functions): self`

**Flags:** `public` 

#### Parameters
| name       | type     | default | description                                              | 
| ---------- | -------- | ------- | -------------------------------------------------------- | 
| $functions | iterable |         | [string $name => Twig_SimpleFunction\|Closure $function] | 

[(Back to index)](#index)

----------------------------------------

### addGlobal

`public function addGlobal($name, $value): self`

**Flags:** `public` 

#### Parameters
| name   | type | default | description | 
| ------ | ---- | ------- | ----------- | 
| $name  |      |         |             | 
| $value |      |         |             | 

[(Back to index)](#index)

----------------------------------------

### addGlobals

`public function addGlobals($globals): self`

**Flags:** `public` 

#### Parameters
| name     | type     | default | description                    | 
| -------- | -------- | ------- | ------------------------------ | 
| $globals | iterable |         | [string $name => mixed $value] | 

[(Back to index)](#index)

----------------------------------------

### bind

`public function bind(): self`

**Flags:** `public` 


Bind context value

#### Parameters
- `(string $name, mixed $value)`
- `(array $values)`


- @throws `b2r\Component\Exception\InvalidArgumentException`
- @invoke [bindValue](#bindvalue)
- @invoke [bindArray](#bindarray)

[(Back to index)](#index)

----------------------------------------

### bindArray

`public function bindArray($values): self`

**Flags:** `public` 

#### Parameters
| name    | type  | default | description | 
| ------- | ----- | ------- | ----------- | 
| $values | array |         |             | 

[(Back to index)](#index)

----------------------------------------

### bindValue

`public function bindValue($name, $value): self`

**Flags:** `public` 

#### Parameters
| name   | type   | default | description | 
| ------ | ------ | ------- | ----------- | 
| $name  | string |         |             | 
| $value |        |         |             | 

[(Back to index)](#index)

----------------------------------------

### clearContext

`public function clearContext(): self`

**Flags:** `public` 

[(Back to index)](#index)

----------------------------------------

### context

`public function context()`

**Flags:** `public` 


- @alias [bind](#bind)

[(Back to index)](#index)

----------------------------------------

### display

`public function display($name, $context)`

**Flags:** `public` 

#### Parameters
| name     | type   | default | description   | 
| -------- | ------ | ------- | ------------- | 
| $name    | string | null    | Template name | 
| $context | array  | []      |               | 


- @invoke `Twig_Environment::display`

[(Back to index)](#index)

----------------------------------------

### getContext

`public function getContext(): array`

**Flags:** `public` 

[(Back to index)](#index)

----------------------------------------

### getContextValue

`public function getContextValue($name, $default): mixed`

**Flags:** `public` 

#### Parameters
| name     | type   | default | description | 
| -------- | ------ | ------- | ----------- | 
| $name    | string |         |             | 
| $default |        | null    |             | 

[(Back to index)](#index)

----------------------------------------

### getEngine

`public function getEngine(): b2r\Component\Twig\Environment`

**Flags:** `public` 

[(Back to index)](#index)

----------------------------------------

### getEnv

`public function getEnv(): b2r\Component\Twig\Environment`

**Flags:** `public` 

[(Back to index)](#index)

----------------------------------------

### getEnvironment

`public function getEnvironment(): b2r\Component\Twig\Environment`

**Flags:** `public` 

[(Back to index)](#index)

----------------------------------------

### getLoader

`public function getLoader(): Twig_Loader_Chain`

**Flags:** `public` 

[(Back to index)](#index)

----------------------------------------

### getPropertyMethodDelegatorInfo

`public static function getPropertyMethodDelegatorInfo(): array`

**Flags:** `public`  `static` 

[(Back to index)](#index)

----------------------------------------

### getTemplateName

`public function getTemplateName(): string`

**Flags:** `public` 

[(Back to index)](#index)

----------------------------------------

### params

`public function params()`

**Flags:** `public` 


- @alias [bind](#bind)

[(Back to index)](#index)

----------------------------------------

### render

`public function render($name, $context): string`

**Flags:** `public` 

#### Parameters
| name     | type   | default | description   | 
| -------- | ------ | ------- | ------------- | 
| $name    | string | null    | Template name | 
| $context | array  | []      |               | 


Render


- @invoke `Twig_Environment::render`

[(Back to index)](#index)

----------------------------------------

### resolveDelegateMethod

`public function resolveDelegateMethod($name): array|false`

**Flags:** `public` 

#### Parameters
| name  | type   | default | description | 
| ----- | ------ | ------- | ----------- | 
| $name | string |         | Method name | 


Resolve delegate method

[(Back to index)](#index)

----------------------------------------

### save

`public function save($filename, $name, $context): self`

**Flags:** `public` 

#### Parameters
| name      | type   | default | description | 
| --------- | ------ | ------- | ----------- | 
| $filename | string |         |             | 
| $name     | string | null    |             | 
| $context  | array  | []      |             | 


Save renderd string to file

[(Back to index)](#index)

----------------------------------------

### setContextValue

`public function setContextValue($name, $value)`

**Flags:** `public` 

#### Parameters
| name   | type   | default | description | 
| ------ | ------ | ------- | ----------- | 
| $name  | string |         |             | 
| $value |        |         |             | 


- @alias [bindValue](#bindvalue)

[(Back to index)](#index)

----------------------------------------

### setTemplate

`public function setTemplate($name, $source): self`

**Flags:** `public` 

#### Parameters
| name    | type   | default | description     | 
| ------- | ------ | ------- | --------------- | 
| $name   | string |         | Template name   | 
| $source | string | null    | Template source | 


Set template

[(Back to index)](#index)

----------------------------------------

### template

`public function template($name, $source)`

**Flags:** `public` 

#### Parameters
| name    | type   | default | description | 
| ------- | ------ | ------- | ----------- | 
| $name   | string |         |             | 
| $source | string | null    |             | 


- @alias [setTemplate](#settemplate)

[(Back to index)](#index)

----------------------------------------

### toString

`public function toString(): string`

**Flags:** `public` 


- @alias [render](#render)

[(Back to index)](#index)

----------------------------------------

### unsetContextValue

`public function unsetContextValue($name): self`

**Flags:** `public` 

#### Parameters
| name  | type   | default | description | 
| ----- | ------ | ------- | ----------- | 
| $name | string |         |             | 

[(Back to index)](#index)

----------------------------------------

