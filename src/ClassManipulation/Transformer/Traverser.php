<?php

namespace Kambo\Testing\ClassOpener\ClassManipulation\Transformer;

use PhpParser\NodeTraverserInterface;

use Kambo\Testing\ClassOpener\ClassManipulation\Transformer;

/**
 * Transform class AST, by applying provided visitors.
 *
 * @author  Bohuslav Simek <bohuslav@simek.si>
 * @license MIT
 */
class Traverser implements Transformer
{
    private $traverser;

    /**
     * Constructor
     *
     * @param NodeTraverserInterface $traverser Node traverser
     */
    public function __construct(NodeTraverserInterface $traverser)
    {
        $this->traverser = $traverser;
    }

    /**
     * Constructor
     *
     * @param string    $className A fully qualified class name
     * @param Node[]    $nodes     Array of AST nodes
     * @param Visitor[] $visitors  List of the node visitors
     */
    public function transform(string $className, array $nodes, array $visitors) : array
    {
        $this->traverser->removeVisitors();
        foreach ($visitors as $nodeVisitor) {
            $nodeVisitor->setClassName($this->getClassName($className));
            $this->traverser->addVisitor($nodeVisitor);
        }

        $newClassAst = $this->traverser->traverse($nodes);

        return $newClassAst;
    }

    /**
     * Get non qualified name of the class from the fully qualified class name
     * eg.: from 'foo\bar\qaz' extract 'qaz'
     *
     * @param string $className A fully qualified class name
     *
     * @return string non qualified name of the class
     */
    private function getClassName(string $className) : string
    {
        $parsed = explode('\\', $className);

        if (!is_array($parsed)) {
            return $className;
        }

        return end($parsed);
    }
}
