<?php

namespace b2r\Component\Twig;

require_once __DIR__ . '/boot.php';

class MyLoaderComposition
{
    use Traits\LoaderComposition;

    public function __construct()
    {
        $this->initLoader();
    }
}

class LoaderCompositionTest extends Base
{
    public function testBasic()
    {
        $loader = new MyLoaderComposition();

        // ArrayLoader
        $loader->setTemplate('hello', 'Hello, {{ name }}');
        $loader->setTemplates(['hello2', 'Hello, {{ name }}']);
        $loader->addTemplate('hello3', 'Hello, {{ name }}');
        $loader->addTemplates(['hello4', 'Hello, {{ name }}']);

        // FileLoader
        $loader->addSuffix('.twig');
        $loader->addSuffixes(['.html.twig', '.sql.twig']);

        $this->is($loader->getLoader() instanceof \Twig_Loader_Chain);
        $this->is($loader->getFileLoader() instanceof \Twig_Loader_Filesystem);
        $this->is($loader->getArrayLoader() instanceof \Twig_Loader_Array);
    }
}
