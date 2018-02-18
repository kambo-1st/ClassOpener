<?php

namespace Kambo\Testing\ClassOpener\ClassManipulation\Node;

use PhpParser\NodeVisitor;

/**
 * Node visitor interface
 *
 * @author  Bohuslav Simek <bohuslav@simek.si>
 * @license MIT
 */
interface Visitor extends NodeVisitor
{
    /**
     * Set the name of the class into the visitor.
     *
     * @param string $className name of the class
     *
     * @return void
     */
    public function setClassName(string $className);
}
