b2r\Component\Twig\Loader
=========================

**Flags:** `class` 

#### Index
[Parents](#parents) | [Implements](#implements) | [Uses](#uses) | [Methods](#methods)

Smart Twig Loader

- FileSystemLoader + ArrayLoader

Extends
----------
- Twig_Loader_Chain

Implements
----------
- Twig_SourceContextLoaderInterface
- Twig_ExistsLoaderInterface
- Twig_LoaderInterface
- b2r\Component\PropertyMethodDelegator\PropertyMethodDelegatorInterface

Uses
----------
- b2r\Component\SimpleAccessor\Getter
- b2r\Component\PropertyMethodDelegator\PropertyMethodDelegator

Methods
----------
- [__call](#__call)
- [__construct](#__construct) Construcotr
- [__get](#__get)
- [getArrayLoader](#getarrayloader)
- [getFileSystemLoader](#getfilesystemloader)
- [getPropertyMethodDelegatorInfo](#getpropertymethoddelegatorinfo)
- [resolveDelegateMethod](#resolvedelegatemethod) Resolve delegate method

----------------------------------------

### __call

`public function __call($name, $arguments)`

**Flags:** `public` 

#### Parameters
| name       | type | default | description | 
| ---------- | ---- | ------- | ----------- | 
| $name      |      |         |             | 
| $arguments |      |         |             | 

[(Back to index)](#index)

----------------------------------------

### __construct

`public function __construct($paths, $templates)`

**Flags:** `public`  `constructor` 

#### Parameters
| name       | type          | default | description                    | 
| ---------- | ------------- | ------- | ------------------------------ | 
| $paths     | string, array | []      | FileSystemLoader template path | 
| $templates | array         | []      | ArrayLoader templates          | 


Construcotr

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

### getArrayLoader

`public function getArrayLoader(): b2r\Component\Twig\Loader\ArrayLoader`

**Flags:** `public` 

[(Back to index)](#index)

----------------------------------------

### getFileSystemLoader

`public function getFileSystemLoader(): b2r\Component\Twig\Loader\FileSystemLoader`

**Flags:** `public` 

[(Back to index)](#index)

----------------------------------------

### getPropertyMethodDelegatorInfo

`public static function getPropertyMethodDelegatorInfo(): array`

**Flags:** `public`  `static` 

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

