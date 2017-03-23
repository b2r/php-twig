<?php

namespace b2r\Component\Twig;

use b2r\Component\SimpleAccessor\Getter;
use b2r\Component\PropertyMethodDelegator\ {
    PropertyMethodDelegator,
    PropertyMethodDelegatorInterface
};
use Twig_Environment;
use Twig_Loader_Chain;
use Twig_Loader_Array;
use b2r\Component\Twig\Loader\FilesystemLoader;

class Environment extends Twig_Environment implements PropertyMethodDelegatorInterface
{
    use Getter;
    use PropertyMethodDelegator;

    protected static $propertyMethodDelegator = [
        'loader'     => [],
        'filesystem' => [],
        'array'      => [],
    ];

    /**
     * @var Twig_Loader_Array
     */
    protected $array = null;

    /**
     * @var Loader\FilesystemLoader
     */
    protected $filesystem = null;

    /**
     * @var Twig_Loader_Chain
     */
    protected $loader;

    /**
     * Constructor
     *
     * @param string|array $path Template directory
     * @param array $options Environment options
     */
    public function __construct($paths = [], array $options = [])
    {
        $this->loader = $loader = new Twig_Loader_Chain();

        // Filesystem loader
        $this->filesystem = new FilesystemLoader($paths);
        $loader->addLoader($this->filesystem);

        // Array loader
        $this->array = new Twig_Loader_Array($options['templates'] ?? []);
        $loader->addLoader($this->array);

        parent::__construct($this->loader, $options);
    }

    #------------------------------------------------------------
    # Accessor
    #------------------------------------------------------------

    public function getArrayLoader(): Twig_Loader_Array
    {
        return $this->array;
    }

    public function getFilesystemLoader(): FilesystemLoader
    {
        return $this->filesystem;
    }

    public function getLoader(): Twig_Loader_Chain
    {
        return $this->loader;
    }

    #------------------------------------------------------------
    # ArrayLoader Helper
    #------------------------------------------------------------

    /**
     * @alias setTemplate
     */
    public function addTemplate(string $name, string $template)
    {
        return $this->setTemplate($name, $template);
    }

    /**
     * @alias setTemplates
     */
    public function addTemplates(array $templates)
    {
        return $this->setTemplates($templates);
    }

    /**
     * @invoke Twig_Loader_Array::setTemplate
     * @return self
     */
    public function setTemplate(string $name, string $template)
    {
        $this->array->setTemplate($name, $template);
        return $this;
    }

    /**
     * Set templates
     *
     * @param array $templates [string $name => string $template]
     * @return self
     */
    public function setTemplates(array $templates)
    {
        foreach ($templates as $name => $template) {
            $this->array->setTemplate($name, $template);
        }
        return $this;
    }
}
