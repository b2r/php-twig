b2r\Component\Twig\Environment
==============================

**Flags:** `class` 

#### Index
[Parents](#parents) | [Implements](#implements) | [Uses](#uses) | [Methods](#methods)
Extends
----------
- Twig_Environment

Implements
----------
- b2r\Component\PropertyMethodDelegator\PropertyMethodDelegatorInterface

Uses
----------
- b2r\Component\SimpleAccessor\Getter
- b2r\Component\PropertyMethodDelegator\PropertyMethodDelegator

Methods
----------
- [__call](#__call)
- [__construct](#__construct) Constructor
- [__get](#__get)
- [addTemplate](#addtemplate)
- [addTemplates](#addtemplates)
- [getArrayLoader](#getarrayloader)
- [getFilesystemLoader](#getfilesystemloader)
- [getLoader](#getloader)
- [getPropertyMethodDelegatorInfo](#getpropertymethoddelegatorinfo)
- [resolveDelegateMethod](#resolvedelegatemethod) Resolve delegate method
- [setTemplate](#settemplate)
- [setTemplates](#settemplates) Set templates

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

### __get

`public function __get($name)`

**Flags:** `public` 

#### Parameters
| name  | type | default | description | 
| ----- | ---- | ------- | ----------- | 
| $name |      |         |             | 

[(Back to index)](#index)

----------------------------------------

### addTemplate

`public function addTemplate($name, $template)`

**Flags:** `public` 

#### Parameters
| name      | type   | default | description | 
| --------- | ------ | ------- | ----------- | 
| $name     | string |         |             | 
| $template | string |         |             | 


- @alias [setTemplate](#settemplate)

[(Back to index)](#index)

----------------------------------------

### addTemplates

`public function addTemplates($templates)`

**Flags:** `public` 

#### Parameters
| name       | type  | default | description | 
| ---------- | ----- | ------- | ----------- | 
| $templates | array |         |             | 


- @alias [setTemplates](#settemplates)

[(Back to index)](#index)

----------------------------------------

### getArrayLoader

`public function getArrayLoader(): Twig_Loader_Array`

**Flags:** `public` 

[(Back to index)](#index)

----------------------------------------

### getFilesystemLoader

`public function getFilesystemLoader(): b2r\Component\Twig\Loader\FilesystemLoader`

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

### setTemplate

`public function setTemplate($name, $template): self`

**Flags:** `public` 

#### Parameters
| name      | type   | default | description | 
| --------- | ------ | ------- | ----------- | 
| $name     | string |         |             | 
| $template | string |         |             | 


- @invoke `Twig_Loader_Array::setTemplate`

[(Back to index)](#index)

----------------------------------------

### setTemplates

`public function setTemplates($templates): self`

**Flags:** `public` 

#### Parameters
| name       | type  | default | description                        | 
| ---------- | ----- | ------- | ---------------------------------- | 
| $templates | array |         | [string $name => string $template] | 


Set templates

[(Back to index)](#index)

----------------------------------------

