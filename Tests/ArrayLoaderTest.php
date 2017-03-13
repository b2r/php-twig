<?php

namespace b2r\Component\Twig;

require_once __DIR__ . '/boot.php';

class ArrayLoaderTest extends Base
{
    public function testBasic()
    {
        $loader = new Loader\ArrayLoader();
        $this->is($loader instanceof Loader\ArrayLoader);

        $loader->addTemplate('foo', 'FOO');
        $loader->addTemplates(['bar' => 'BAR']);
        $loader->setTemplates(['baz' => 'BAZ']);
        
        $this->is($loader->exists('foo'));
        $this->is($loader->exists('bar'));
        $this->is($loader->exists('baz'));
    }
}
