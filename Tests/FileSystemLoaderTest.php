<?php

namespace b2r\Component\Twig;

require_once __DIR__ . '/boot.php';

class FileSystemLoaderTest extends Base
{
    public function testBasic()
    {
        $loader = new Loader\FileSystemLoader(__DIR__ . '/templates');
        $this->is($loader instanceof Loader\FileSystemLoader);

        $this->is(!$loader->exists('sample'));

        // Add extension
        $loader->addSuffixes(['.twig']);
        $this->is($loader->exists('sample'));

        // Compare
        $this->is(
            $loader->getSource('sample.twig'),
            $loader->getSource('sample')
        );

        // Clear
        $loader->clearSuffixes();
        $this->is(!$loader->exists('sample'));
    }
}
