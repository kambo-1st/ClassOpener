<?php

namespace Kambo\Testing\ClassOpener;

use Kambo\Testing\ClassOpener\ClassManipulation\Node\Visitor\RemoveFinal;

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
 * Open the final class for the further modification eg.: for mocking
 *
 * @author  Bohuslav Simek <bohuslav@simek.si>
 * @license MIT
 */
class ClassOpener
{
    private $reader;
    private $transformer;
    private $patcher;

    /**
     * Constructor
     *
     * @param Reader      $reader      Source code class reader, which will parse code into AST.
     * @param Transformer $transformer Transform class AST.
     * @param Patcher     $patcher     Patch class with its modified version.
     */
    public function __construct(Reader $reader, Transformer $transformer, Patcher $patcher)
    {
        $this->reader = $reader;
        $this->transformer = $transformer;
        $this->patcher = $patcher;
    }

    /**
     * Open the final class for the further modification
     *
     * @param string $className Name of the class, a fully qualified class name must be provided
     *                          eg.: \foo\bar\qaz
     *
     * @return void
     */
    public function open(string $className)
    {
        $classAst = $this->reader->getNodes($className);

        $this->transformer->transform($className, $classAst, $this->getVisitors());

        $this->patcher->patch($classAst);
    }

    /**
     * Create a new instance of the class with the default dependencies.
     *
     * @return self A new instance of self
     */
    public static function create() : self
    {
        $astLocator = new AstLocator;
        $locator = new AutoloadSourceLocator($astLocator);
        $reflector = new ClassReflector($locator);

        $reflectionLocator = new Reflection($reflector);

        $reader = new PhpParser($reflectionLocator);
        $transformer = new Traverser(new NodeTraverser);
        $patcher = new EvalExecution;

        return new self($reader, $transformer, $patcher);
    }

    /**
     * Get all visitors which will be applied to the class
     *
     * @return array
     */
    private function getVisitors() : array
    {
        return [
            new RemoveFinal
        ];
    }
}
