<?php

namespace b2r\Component\Twig;

require_once __DIR__ . '/boot.php';

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
            $loader->getSource('sample.twig'),
            $loader->getSource('sample')
        );

        // Clear
        $loader->clearSuffixes();
        $this->is(!$loader->exists('sample'));
    }
}
