<?php

namespace b2r\Component\Twig;

require_once __DIR__ . '/boot.php';

class MySampleTwigExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return [new \Twig_Filter('l', function ($value) {
            return strtolower($value);
        })];
    }
}

class TwigTest extends Base
{
    protected $twig = null;

    public function setup()
    {
        $this->twig = new Twig(__DIR__  . '/templates');
        $this->twig->addSuffix('.twig');
    }

    public function testBasic()
    {
        $twig = $this->twig;
        $this->is($twig instanceof Twig);

        $twig->name('world'); // Set context value

        // From array
        $ac = $twig->template('hello', 'Hello, {{ name }}')->toString();
        $this->is('Hello, world', $ac);

        // From file
        $ac = $twig->template('sample')->render();
        $this->is('Hello, world', $ac);
    }

    public function testSetContextOnRender()
    {
        $twig = $this->twig;
        $ac = $twig->template('sample')->render(['name' => 'WORLD']);
        $this->is('Hello, WORLD', $ac);
    }

    public function testLoader()
    {
        $twig = $this->twig;
        $this->is($twig->getLoader() instanceof \Twig_Loader_Chain);
        $this->is($twig->getArrayLoader() instanceof \Twig_Loader_Array);
        $this->is($twig->getFileSystemLoader() instanceof Loader\FilesystemLoader);
    }

    public function testExtension()
    {
        $twig = $this->twig;
        $twig->addExtensions([MySampleTwigExtension::class]);
        $ac = $twig->name('WORLD')->template('name', '{{ name|l }}')->render();
        $this->is('world', $ac);
    }

    public function testFilter()
    {
        $twig = new Twig();


        $twig->addFilters([
            'u' => function ($value) {
                return strtoupper($value);
            },
            new \Twig_Filter('t', function ($value) {
                return trim($value);
            }),
        ]);

        $twig->addFilter(new \Twig_Filter('l', function ($value) {
                return strtolower($value);
        }));

        $ac = $twig->name('world')->template('name', '{{ name|u }}')->render();
        $this->is('WORLD', $ac);

        $ac = $twig->name('WORLD')->template('name', '{{ name|l }}')->render();
        $this->is('world', $ac);

        $ac = $twig->name('     WORLD     ')->template('name', '{{ name|t }}')->render();
        $this->is('WORLD', $ac);
    }

    public function testFunctions()
    {
        $twig = new Twig();
        $twig->addFunctions([
            'x2' => function ($value) {
                return $value * 2;
            },
            new \Twig_Function('x3', function ($value) {
                return $value * 3;
            }),
        ]);

        $twig->addFunction(new \Twig_Function('x4', function ($value) {
            return $value * 4;
        }));

        $ac = $twig->template('x2', '{{ x2(2) }}')->render();
        $this->is('4', $ac);
        $ac = $twig->template('x3', '{{ x3(2) }}')->render();
        $this->is('6', $ac);
        $ac = $twig->template('x4', '{{ x4(2) }}')->render();
        $this->is('8', $ac);
    }

    public function testGlobal()
    {
        $twig = $this->twig;
        $twig->addGlobals(['foo' => 'FOO', 'bar' => 'BAR']);
        $twig->template('foobar', '{{ foo }}{{ bar }}');
        $ac = $twig->render();
        $this->is('FOOBAR', $ac);
    }

    /**
     * @expectedException \b2r\Component\Exception\InvalidArgumentException
     */
    public function testBind()
    {
        $twig = $this->twig;

        $ex = 'FOO';
        $twig->foo = 'FOO';
        $this->is($ex, $twig->getContextValue('foo'));

        $ex = 'FOOO';
        $twig->bind('foo', $ex);
        $this->is($ex, $twig->getContextValue('foo'));

        $ex = 'FOOOO';
        $twig->bind(['foo' => $ex]);
        $this->is($ex, $twig->getContextValue('foo'));

        $ex = 'FOOOOO';
        $twig->context(['foo' => $ex]);
        $this->is($ex, $twig->getContextValue('foo'));

        $ex = 'FOOOOOO';
        $twig->params(['foo' => $ex]);
        $this->is($ex, $twig->getContextValue('foo'));

        $ex = 'FOOOOOOO';
        $twig->setContextValue('foo', $ex);
        $this->is($ex, $twig->getContextValue('foo'));


        $twig->clearContext();
        $twig->addContext('foo', 'FOO');
        $this->is('FOO', $twig->getContextValue('foo'));

        $twig->unsetContextValue('foo');
        $this->is(null, $twig->getContextValue('foo'));

        $this->is(is_array($twig->context));

        $twig->bind((object)1);
    }

    public function testEnv()
    {
        $twig = $this->twig;
        $env = $twig->getEnvironment();
        $this->is($env instanceof Environment);
        $this->is($env, $twig->getEnv());
        $this->is($env, $twig->getEngine());
    }

    public function testDisplay()
    {
        $twig = $this->twig;
        $this->expectOutputString('Hello, world');
        $twig->template('hello', 'Hello, {{ name }}')->display(['name' => 'world']);
    }

    public function testSave()
    {
        $twig = $this->twig;
        $filename = __DIR__ . '/hello.txt';
        $twig->template('Hello', 'Hello, {{ name }}')->name('world')->save($filename);
        $this->is('Hello, world', file_get_contents($filename));
        unlink($filename);
    }

    public function testTemplateName()
    {
        $twig = $this->twig;
        $twig->setTemplate('hello');
        $this->is('hello', $twig->getTemplateName());
    }

    public function testToString()
    {
        $twig = $this->twig;
        $twig->template('Hello', 'Hello, {{ name }}')->name('world');
        $ex = 'Hello, world';
        $this->is($ex, $twig->toString());
        $this->is($ex, (string)$twig);
    }

    /**
     * @expectedException \Twig_Error_Loader
     */
    public function testUndefinedTemplate()
    {
        $this->twig->render('undefined');
    }

    /**
     * @expectedException b2r\Component\Exception\InvalidMethodException
     */
    public function testCallException()
    {
        $this->twig->undefinedMethod(1, 2, 3, 4, 5);
    }
}
