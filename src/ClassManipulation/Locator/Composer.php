<?php

namespace Kambo\Testing\ClassOpener\ClassManipulation\Locator;

use Exception;

use Composer\Autoload\ClassLoader;

use BetterReflection\SourceLocator\Ast\Locator as AstLocator;
use BetterReflection\SourceLocator\Type\AutoloadSourceLocator;

use BetterReflection\Reflector\ClassReflector;

class Composer
{
    private $classLoader;

    public function __construct(ClassLoader $classLoader=null)
    {
        $this->classLoader = $classLoader;
    }

    public function getFileName(string $className) : string
    {
        $astLocator = new AstLocator();

        $locator = new AutoloadSourceLocator($astLocator);
        $reflector = new ClassReflector($locator/*new ComposerSourceLocator($this->classLoader, $astLocator)*/);
        try {
            $reflectionClass = $reflector->reflect($className);
        } catch (Exception $e) {
            throw new Exception("Unable to locate class {$className}");
        }

        return realpath($reflectionClass->getFileName());
    }
}
