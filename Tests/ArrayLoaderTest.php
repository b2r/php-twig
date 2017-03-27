<?php

namespace b2r\Component\Twig;

require_once __DIR__ . '/boot.php';

class ArrayLoaderTest extends Base
{
    public function testBasic()
    {
        $twig = new Twig();
        $loader = $twig->loader;


        $this->is($loader instanceof \Twig_Loader_Chain);

        $twig->addTemplate('foo', 'FOO');
        $twig->addTemplates(['bar' => 'BAR']);
        $twig->setTemplates(['baz' => 'BAZ']);
        
        $this->is($loader->exists('foo'));
        $this->is($loader->exists('bar'));
        $this->is($loader->exists('baz'));
    }
}
