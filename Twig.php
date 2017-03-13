<?php

namespace b2r\Component\Twig;

use b2r\Component\Exception\InvalidArgumentException;
use b2r\Component\SimpleAccessor\Getter;
use b2r\Component\PropertyMethodDelegator\ {
    PropertyMethodDelegator,
    PropertyMethodDelegatorInterface
};

/**
 * Twig composition
 *
 * ## Features
 * - Fluent interface
 * - Smart loader
 * - Context container
 */
class Twig implements PropertyMethodDelegatorInterface
{
    use Getter;
    use PropertyMethodDelegator;

    protected static $propertyMethodDelegator = [
        'twig'   => [],
        'loader' => [],
    ];

    /**
     * Context container
     *
     * @var array
     */
    protected $context = [];

    /**
     * @var Loader
     */
    protected $loader = null;

    /**
     * Current template name
     *
     * @var string
     */
    protected $template = null;

    /**
     * @var Environment Twig core instance
     */
    protected $twig = null;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->twig = new Environment(...func_get_args());
        $this->loader = $this->twig->getLoader();
    }

    /**
     * Magic setter
     *
     * - Assume context value setter
     *
     * @param string $name Context name
     * @param mixed $value Context value
     * @return self
     */
    public function __set($name, $value)
    {
        return $this->bindValue($name, $value);
    }

    /**
     * Magic method
     *
     * @param string $name
     * @param array $arguments
     * @return self
     */
    public function __call($name, $arguments)
    {
        // Invoke method
        $method = $this->resolveDelegateMethod($name);
        if ($method) {
            return call_user_func_array($method, $arguments);
        }
        // Assume context setter
        $value = count($arguments) <= 1 ? array_shift($arguments) : $arguments;
        return $this->bindValue($name, $value);
    }

    /**
     * @alias render
     */
    public function __toString()
    {
        return $this->render();
    }

    /**
     * @alias bind
     */
    public function addContext()
    {
        return $this->bind(...func_get_args());
    }

    /**
     * Bind context value
     *
     * #### Parameters
     * - `(string $name, mixed $value)`
     * - `(array $values)`
     *
     * @return self
     * @invoke bindValue
     * @invoke bindArray
     * @throws b2r\Component\Exception\InvalidArgumentException
     */
    public function bind()
    {
        $args = func_get_args();
        $argc = count($args);
        if ($argc === 1 && is_array($args[0])) {
            $this->bindArray($args[0]);
        } elseif ($argc === 2 && is_string($args[0])) {
            $this->bindValue($args[0], $args[1]);
        } else {
            throw new InvalidArgumentException('Arguments must be [string $key, mixed $value] or [array $values]');
        }
        return $this;
    }

    /**
     * @return self
     */
    public function bindArray(array $values)
    {
        foreach ($values as $name => $value) {
            $this->context[$name] = $value;
        }
        return $this;
    }

    /**
     * @return self
     */
    public function bindValue(string $name, $value)
    {
        $this->context[$name] = $value;
        return $this;
    }

    /**
     * Clear context
     *
     * @return self
     */
    public function clearContext()
    {
        $this->context = [];
        return $this;
    }

    /**
     * @alias bind
     */
    public function context()
    {
        return $this->bind(...func_get_args());
    }

    /**
     * @param string $name Template name
     * @param array $context
     * @invoke Twig_Environment::display
     */
    public function display($name = null, array $context = [])
    {
        list($name, $context) = $this->prepareNameAndContext($name, $context);
        return $this->twig->display($name, $context);
    }

    public function getContext(): array
    {
        return $this->context;
    }

    /**
     * @return mixed
     */
    public function getContextValue(string $name, $default = null)
    {
        return $this->context[$name] ?? $default;
    }

    public function getEngine(): Environment
    {
        return $this->twig;
    }

    public function getEnv(): Environment
    {
        return $this->twig;
    }

    public function getEnvironment(): Environment
    {
        return $this->twig;
    }

    public function getLoader(): Loader
    {
        return $this->loader;
    }

    public function getTemplateName(): string
    {
        return $this->template;
    }

    /**
     * @alias bind
     */
    public function params()
    {
        return $this->bind(...func_get_args());
    }

    /**
     * Prepare name and context
     *
     * @param string|null $name
     * @param array|null $context
     * @return array [string $name, array $context]
     */
    protected function prepareNameAndContext($name, array $context = null)
    {
        // Swap parameters $name <=> $context
        if (is_array($name)) {
            $context = $name;
            $name = null;
        }
        $name = $name ?: $this->template;
        $context = $context ? array_merge($this->context, $context) : $this->context;
        return [$name, $context];
    }

    /**
     * Render
     * 
     * @param string $name Template name
     * @param array $context
     * @invoke Twig_Environment::render
     */
    public function render($name = null, array $context = []): string
    {
        list($name, $context) = $this->prepareNameAndContext($name, $context);
        return $this->twig->render($name, $context);
    }

    /**
     * Save renderd string to file
     *
     * @param string $filename
     * @param string|null $name
     * @param array $context
     * @return self
     */
    public function save(string $filename, string $name = null, array $context = [])
    {
        file_put_contents($filename, $this->render($name, $context));
        return $this;
    }

    /**
     * @alias bindValue
     */
    public function setContextValue(string $name, $value)
    {
        return $this->bindValue($name, $value);
    }

    /**
     * Set template
     *
     * @param string $name Template name
     * @param string $source Template source
     * @return self
     */
    public function setTemplate(string $name, string $source = null)
    {
        $this->template = $name;
        if ($source) {
            $this->loader->setTemplate($name, $source);
        }
        return $this;
    }

    /**
     * @alias setTemplate
     */
    public function template(string $name, string $source = null)
    {
        return $this->setTemplate($name, $source);
    }

    /**
     * @return self
     */
    public function unsetContextValue(string $name)
    {
        unset($this->context[$name]);
        return $this;
    }
}
