<?php

namespace Kambo\Testing\ClassOpener;

use Kambo\Testing\ClassOpener\Visitor\RemoveFinal;

use Kambo\Testing\ClassOpener\ClassManipulation\Locator\Reflection;
use Kambo\Testing\ClassOpener\ClassManipulation\Reader\PhpParser;
use Kambo\Testing\ClassOpener\ClassManipulation\Patcher\EvalExecution;
use Kambo\Testing\ClassOpener\ClassManipulation\Transformer\Traverser;
use Kambo\Testing\ClassOpener\ClassManipulation\Node\Traverser as NodeTraverser;

use Kambo\Testing\ClassOpener\ClassManipulation\Reader;
use Kambo\Testing\ClassOpener\ClassManipulation\Patcher;
use Kambo\Testing\ClassOpener\ClassManipulation\Transformer;

use BetterReflection\SourceLocator\Ast\Locator as AstLocator;
use BetterReflection\SourceLocator\Type\AutoloadSourceLocator;
use BetterReflection\Reflector\ClassReflector;

/**
 * Description of ClassOpener
 *
 * @author  Bohuslav Simek <bohuslav@simek.si>
 * @license MIT
 */
class ClassOpener
{
    private $reader;
    private $transformer;
    private $patcher;

    public function __construct(Reader $reader, Transformer $transformer, Patcher $patcher)
    {
        $this->reader = $reader;
        $this->transformer = $transformer;
        $this->patcher = $patcher;
    }

    public function open(string $className)
    {
        $classAst = $this->reader->getAst($className);

        $this->transformer->transform($className, $classAst, $this->getVisitors());

        $this->patcher->patch($classAst);
    }

    private function getVisitors() : array 
    {
        return [
            new RemoveFinal
        ];
    }

    public static function create() : self
    {
        $astLocator = new AstLocator;
        $locator    = new AutoloadSourceLocator($astLocator);
        $reflector  = new ClassReflector($locator);

        $locator = new Reflection($reflector);

        $reader = new PhpParser($locator);
        $transformer = new Traverser(new NodeTraverser);
        $patcher = new EvalExecution;

        return new self($reader, $transformer, $patcher);
    }
}
