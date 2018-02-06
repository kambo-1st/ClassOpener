<?php

namespace Kambo\Testing\ClassOpener\Visitor;

use PhpParser\NodeVisitorAbstract;
use PhpParser\Node;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\ClassMethod;

/**
 * Description of RemoveFinal
 *
 * @author  Bohuslav Simek <bohuslav@simek.si>
 * @license MIT
 */
class RemoveFinal extends NodeVisitorAbstract
{
    protected $parsingTargetClass = false;
    public $className;

    public function enterNode(Node $node)
    {
        if (($node instanceof ClassMethod) && $node->isPublic() && $this->parsingTargetClass) {
            $node->type &= ~Class_::MODIFIER_FINAL;
        } elseif (($node instanceof Class_) && ($node->name == $this->className)) {
            $this->parsingTargetClass = true;
        }
    }

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
