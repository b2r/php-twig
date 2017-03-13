<?php

namespace b2r\Component\Twig;

use b2r\Component\Twig\Loader\ {
    ArrayLoader,
    FileSystemLoader
};
use b2r\Component\SimpleAccessor\Getter;
use b2r\Component\PropertyMethodDelegator\ {
    PropertyMethodDelegator,
    PropertyMethodDelegatorInterface
};

/**
 * Smart Twig Loader
 *
 * - FileSystemLoader + ArrayLoader
 */
class Loader extends \Twig_Loader_Chain implements PropertyMethodDelegatorInterface
{
    use Getter;
    use PropertyMethodDelegator;

    private static $propertyMethodDelegator = [
        'filesystem' => [],
        'array'      => [],
    ];

    /**
     * @var Loader\ArrayLoader
     */
    private $array = null;

    /**
     * @var Loader\FileSystemLoader
     */
    private $filesystem = null;

    /**
     * Construcotr
     *
     * @param string|array $paths FileSystemLoader template path
     * @param array $templates  ArrayLoader templates
     */
    public function __construct($paths = [], array $templates = [])
    {
        // FileSystem loader
        $this->filesystem = new FilesystemLoader($paths);
        $this->addLoader($this->filesystem);

        // Array loader
        $this->array = new ArrayLoader($templates);
        $this->addLoader($this->array);
    }

    public function getArrayLoader(): ArrayLoader
    {
        return $this->array;
    }

    public function getFileSystemLoader(): FileSystemLoader
    {
        return $this->filesystem;
    }
}
