<?php

namespace Kambo\Testing\ClassOpener\ClassManipulation\Transformer;

use Kambo\Testing\ClassOpener\ClassManipulation\Transformer;

/**
 * Description of ClassTransformer
 *
 * @author  Bohuslav Simek <bohuslav@simek.si>
 * @license MIT
 */
class Traverser implements Transformer
{
    private $traverser;

    public function __construct($traverser)
    {
        $this->traverser = $traverser;
    }

    public function transform(string $className, $ast, array $visitors)
    {
        $this->traverser->removeVisitors();
        foreach ($visitors as $nodeVisitor) {
            $nodeVisitor->className = $this->getClassName($className);
            $this->traverser->addVisitor($nodeVisitor);
        }

        $newClassAst = $this->traverser->traverse($ast);

        return $newClassAst;
    }

    private function getClassName(string $className) : string
    {
        $parsed = explode('\\', $className);
        return end($parsed);
    }
}
