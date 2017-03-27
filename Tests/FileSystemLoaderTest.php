<?php

namespace b2r\Component\Twig;

require_once __DIR__ . '/boot.php';

class MyFilesystemLoader extends Loader\FilesystemLoader
{
    public function invokeFindTemplate($name, $throw = true)
    {
        return $this->findTemplate($name, $throw);
    }
}

class FilesystemLoaderTest extends Base
{
    public function testBasic()
    {
        $loader = new Loader\FilesystemLoader(__DIR__ . '/templates');
        $this->is($loader instanceof Loader\FilesystemLoader);

        $this->is(!$loader->exists('sample'));

        // Add extension
        $loader->addSuffixes(['.twig']);
        $this->is($loader->exists('sample'));

        // Compare
        $this->is(
            $loader->getSourceContext('sample.twig')->getCode(),
            $loader->getSourceContext('sample')->getCode()
        );

        // Clear
        $loader->clearSuffixes();
        $this->is(!$loader->exists('sample'));
    }

    /**
     * @expectedException \Twig_Error_Loader
     */
    public function testUndefinedTemplate()
    {
        $loader = new MyFilesystemLoader(__DIR__ . '/templates');
        $this->dump($loader->invokeFindTemplate('undefined'));
        $loader->invokeFindTemplate('undefined');
    }
}
