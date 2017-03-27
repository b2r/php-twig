<?php

namespace b2r\Component\Twig\Traits;

use Twig_Loader_Chain;
use Twig_Loader_Array;
use b2r\Component\Twig\Loader\FilesystemLoader;

trait LoaderComposition
{
    /**
     * @var Twig_Loader_Array
     */
    protected $arrayLoader = null;

    /**
     * @var b2r\Component\Twig\Loader\FilesystemLoader;
     */
    protected $fileLoader = null;

    /**
     * @var Twig_Loader_Chain
     */
    protected $loader = null;

    /**
     * @param string|array File template paths
     * @param array Array templates
     * @return Twig_Loader_Chain
     */
    protected function initLoader($paths = [], array $templates = [])
    {
        $this->loader = new Twig_Loader_Chain();
        $this->fileLoader = new FilesystemLoader($paths);
        $this->arrayLoader = new Twig_Loader_Array($templates);
        $this->loader->addLoader($this->fileLoader);
        $this->loader->addLoader($this->arrayLoader);
        return $this->loader;
    }

    #------------------------------------------------------------
    # Accessor
    #------------------------------------------------------------

    public function getArrayLoader(): Twig_Loader_Array
    {
        return $this->arrayLoader;
    }

    public function getFileLoader(): FilesystemLoader
    {
        return $this->fileLoader;
    }

    public function getFilesystemLoader(): FilesystemLoader
    {
        return $this->fileLoader;
    }

    public function getLoader(): Twig_Loader_Chain
    {
        return $this->loader;
    }

    #------------------------------------------------------------
    # ArrayLoader
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
        $this->arrayLoader->setTemplate($name, $template);
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
            $this->arrayLoader->setTemplate($name, $template);
        }
        return $this;
    }

    #------------------------------------------------------------
    # FileLoader
    #------------------------------------------------------------

    public function addSuffix(string $suffix)
    {
        $this->fileLoader->addSuffix($suffix);
        return $this;        
    }

    public function addSuffixes(array $suffixes)
    {
        $this->fileLoader->addSuffixes($suffixes);
        return $this;        
    }
}
