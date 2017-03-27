<?php

namespace b2r\Component\Twig;

use b2r\Component\Exception\ {
    InvalidArgumentException,
    InvalidMethodException
};
use b2r\Component\SimpleAccessor\Getter;

/**
 * Twig composition
 *
 * ## Features
 * - Fluent interface
 * - Smart loader
 * - Context container
 */
class Twig
{
    use Getter;
    use Traits\EnvironmentComposition;
    use Traits\LoaderComposition;

    /**
     * Context container
     *
     * @var array
     */
    protected $context = [];

    /**
     * Current template name
     *
     * @var string
     */
    protected $template = null;

    /**
     * Constructor
     *
     * @param string|array Template paths
     * @param array Environment options
     */
    public function __construct($paths = [], array $options = [])
    {
        $loader = $this->initLoader($paths, $options['templates'] ?? []);
        $this->initEnvironment($loader, $options);
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
     * @return mixed
     * @throws b2r\Component\Exception\InvalidMethodException
     */
    public function __call($name, $arguments)
    {
        // Assume context setter
        if (count($arguments) === 1) {
            return $this->bindValue($name, $arguments[0]);
        }
        // Throw
        throw new InvalidMethodException($this, $name);
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
     * @throws b2r\Component\Exception\InvalidArgumentException
     * @invoke bindValue
     * @invoke bindArray
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
     * Prepare template name and context
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
     * @return self
     */
    public function save(string $filename, string $name = null, array $context = [])
    {
        file_put_contents($filename, $this->render($name, $context));
        return $this;
    }

    /**
     * @alias bind
     */
    public function set()
    {
        return $this->bind(...func_get_args());
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
            $this->arrayLoader->setTemplate($name, $source);
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
     * @alias render
     */
    public function toString(): string
    {
        return $this->render();
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
