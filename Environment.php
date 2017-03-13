<?php

namespace b2r\Component\Twig;

use Closure;
use Twig_Environment;
use Twig_Extension;
use Twig_SimpleFilter as Filter;
use Twig_SimpleFunction as Func;

class Environment extends Twig_Environment
{
    /**
     * Constructor
     *
     * @param string|array $path Template directory
     * @param array $options Environment options
     */
    public function __construct($paths = [], array $options = [])
    {
        parent::__construct(new Loader($paths), $options);
    }

    /**
     * @param iterable $extensions `[Twig_Extension $instance|string $className]`
     * @return self
     */
    public function addExtensions($extensions)
    {
        foreach ($extensions as $extension) {
            if (is_string($extension) && class_exists($extension)) {
                $extension = new $extension();
            }
            $this->addExtension($extension);
        }
        return $this;
    }

    /**
     * @param Twig_SimpleFilter|Closure $filter
     * @return self
     */
    public function addFilter($name, $filter = null)
    {
        if ($filter instanceof Closure) {
            $filter = new Filter($name, $filter);
        }
        parent::addFilter($name, $filter);
        return $this;
    }

    /**
     * @param iterable $filters `[string $name => Twig_SimpleFilter|Closure $value]`
     * @return self
     */
    public function addFilters($filters)
    {
        foreach ($filters as $name => $filter) {
            $this->addFilter($name, $filter);
        }
        return $this;
    }

    /**
     * @param string $name
     * @param Twig_SimpleFunction|Closure $function
     */
    public function addFunction($name, $function = null)
    {
        if ($function instanceof Closure) {
            $function = new Func($name, $function);
        }
        parent::addFunction($name, $function);
        return $this;
    }

    /**
     * @param iterable $functions `[string $name => Twig_SimpleFunction|Closure $function]`
     * @return self
     */
    public function addFunctions($functions)
    {
        foreach ($functions as $name => $function) {
            $this->addFunction($name, $function);
        }
        return $this;
    }

    /**
     * Add globals
     *
     * #### $globals
     * - Key: Global name
     * - Value: Global value
     *
     * @param iterable $globals
     * @return self
     */
    public function addGlobals($globals)
    {
        foreach ($globals as $name => $value) {
            $this->addGlobal($name, $value);
        }
        return $this;
    }
}
