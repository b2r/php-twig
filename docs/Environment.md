b2r\Component\Twig\Environment
==============================

**Flags:** `class` 

#### Index
[Parents](#parents) | [Methods](#methods)
Extends
----------
- Twig_Environment

Methods
----------
- [__construct](#__construct) Constructor
- [addExtensions](#addextensions)
- [addFilter](#addfilter)
- [addFilters](#addfilters)
- [addFunction](#addfunction)
- [addFunctions](#addfunctions)
- [addGlobals](#addglobals) Add globals

----------------------------------------

### __construct

`public function __construct($paths, $options)`

**Flags:** `public`  `constructor` 

#### Parameters
| name     | type  | default | description         | 
| -------- | ----- | ------- | ------------------- | 
| $paths   |       | []      |                     | 
| $options | array | []      | Environment options | 


Constructor

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
| name    | type                       | default | description | 
| ------- | -------------------------- | ------- | ----------- | 
| $name   |                            |         |             | 
| $filter | Twig_SimpleFilter, Closure | null    |             | 

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

`public function addFunction($name, $function)`

**Flags:** `public` 

#### Parameters
| name      | type                         | default | description | 
| --------- | ---------------------------- | ------- | ----------- | 
| $name     | string                       |         |             | 
| $function | Twig_SimpleFunction, Closure | null    |             | 

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

### addGlobals

`public function addGlobals($globals): self`

**Flags:** `public` 

#### Parameters
| name     | type     | default | description | 
| -------- | -------- | ------- | ----------- | 
| $globals | iterable |         |             | 


Add globals

#### $globals
- Key: Global name
- Value: Global value

[(Back to index)](#index)

----------------------------------------

