<?php

namespace b2r\Component\Twig\Loader;

/**
 * Extended array loader
 *
 * - Allow set multiple templates
 */
class ArrayLoader extends \Twig_Loader_Array
{
    /**
     * @alias setTemplate
     */
    public function addTemplate(string $name, string $source)
    {
        return $this->setTemplate($name, $source);
    }

    /**
     * @alias setTemplates
     */
    public function addTemplates(array $templates)
    {
        return $this->setTemplates($templates);
    }

    /**
     * Set templates
     *
     * @param array $templates [string $name => string $source]
     * @return self
     */
    public function setTemplates(array $templates)
    {
        foreach ($templates as $name => $source) {
            $this->setTemplate($name, $source);
        }
        return $this;
    }
}
