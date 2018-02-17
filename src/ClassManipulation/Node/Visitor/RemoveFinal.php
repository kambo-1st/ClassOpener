<?php

namespace Kambo\Testing\ClassOpener\ClassManipulation\Node\Visitor;

use Kambo\Testing\ClassOpener\ClassManipulation\Node\Visitor;

use PhpParser\Node;
use PhpParser\NodeVisitorAbstract;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\ClassMethod;

/**
 * Remove 'final' modifier from the class and its methods
 *
 * @author  Bohuslav Simek <bohuslav@simek.si>
 * @license MIT
 */
class RemoveFinal extends NodeVisitorAbstract implements Visitor
{
    protected $parsingTargetClass = false;
    protected $className;

    /**
     * Set the name of the class into the visitor.
     *
     * @param string $className name of the class
     *
     * @return void
     */
    public function setClassName(string $className)
    {
        $this->className = $className;
    }

    /**
     * Called when entering a node.
     *
     * @param Node $node Node
     *
     * @return void
     */
    public function enterNode(Node $node)
    {
        if (($node instanceof ClassMethod) && $node->isPublic() && $this->parsingTargetClass) {
            $node->type &= ~Class_::MODIFIER_FINAL;
        } elseif (($node instanceof Class_) && ($node->name == $this->className)) {
            $this->parsingTargetClass = true;
        }
    }

    /**
     * Called when leaving a node.
     *
     * @param Node $node Node
     *
     * @return void
     */
    public function leaveNode(Node $node)
    {
        if ($node instanceof Class_) {
            // If the node is a class node
            if ($node->name == $this->className) {
                $node->type &= ~Class_::MODIFIER_FINAL;
            }

            $this->parsingTargetClass = false;
        }
    }
}
