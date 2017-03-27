<?php

namespace b2r\Component\Twig\Traits;

use Closure;
use Twig_Extension;
use Twig_Filter;
use Twig_Function;
use Twig_Loader_Chain;
use Twig_Environment;

trait EnvironmentComposition
{
    /**
     * @var Twig_Environment
     */
    protected $twig = null;

    protected function initEnvironment(Twig_Loader_Chain $loader, array $options = [])
    {
        $this->twig = new Twig_Environment($loader, $options);
    }

    /**
     * @param Twig_Extension|string $extension Extension instance or class name
     * @return self
     */
    public function addExtension($extension)
    {
        if (is_string($extension) && class_exists($extension)) {
            $extension = new $extension();
        }
        $this->twig->addExtension($extension);
        return $this;
    }

    /**
     * @param iterable $extensions `[Twig_Extension $instance|string $className]`
     * @return self
     */
    public function addExtensions($extensions)
    {
        foreach ($extensions as $extension) {
            $this->addExtension($extension);
        }
        return $this;
    }

    /**
     * @param string|Twig_Filter $name
     * @param Closure|Twig_Filter $filter
     * @return self
     */
    public function addFilter($name, $filter = null)
    {
        if ($name instanceof Twig_Filter) {
            $filter = $name;
        } elseif ($filter instanceof Closure) {
            $filter = new Twig_Filter($name, $filter);
        }
        $this->twig->addFilter($filter);
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
     * @param string|Twig_Function $name
     * @param Closure|Twig_Function $function
     * @return self
     */
    public function addFunction($name, $function = null)
    {
        if ($name instanceof Twig_Function) {
            $function = $name;
        } elseif ($function instanceof Closure) {
            $function = new Twig_Function($name, $function);
        }
        $this->twig->addFunction($function);
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
     * @param iterable $globals `[string $name => mixed $value]`
     * @return self
     */
    public function addGlobal($name, $value)
    {
        $this->twig->addGlobal($name, $value);
        return $this;
    }

    /**
     * @param iterable $globals `[string $name => mixed $value]`
     * @return self
     */
    public function addGlobals($globals)
    {
        foreach ($globals as $name => $value) {
            $this->addGlobal($name, $value);
        }
        return $this;
    }

    public function getEngine(): Twig_Environment
    {
        return $this->twig;
    }

    public function getEnv(): Twig_Environment
    {
        return $this->twig;
    }

    public function getEnvironment(): Twig_Environment
    {
        return $this->twig;
    }
}
