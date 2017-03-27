<?php

namespace b2r\Component\Twig\Loader;

/**
 * Extended Filesystem loader
 *
 * - Allow suffixes
 */
class FilesystemLoader extends \Twig_Loader_Filesystem
{
    protected $suffixes = [];

    /**
     * @return self
     */
    public function addSuffix(string $suffix)
    {
        $this->suffixes[] = $suffix;
        return $this;
    }

    /**
     * @return self
     */
    public function addSuffixes(array $suffixes)
    {
        foreach ($suffixes as $suffix) {
            $this->addSuffix($suffix);
        }
        return $this;
    }

    /**
     * @return self
     */
    public function clearSuffixes()
    {
        $this->suffixes = [];
        return $this;
    }

    protected function findTemplate($name, $throw = true)
    {
        $result = parent::findTemplate($name, false);
        if ($result) {
            return $result;
        }

        foreach ($this->suffixes as $suffix) {
            $result = parent::findTemplate($name . $suffix, false);
            if ($result) {
                return $result;
            }
        }

        return $throw ? parent::findTemplate($name, true) : false;
    }
}
