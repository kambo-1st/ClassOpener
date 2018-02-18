<?php

namespace Kambo\Testing\ClassOpener\ClassManipulation\Node;

use PhpParser\NodeTraverser;

/**
 * Node traverser
 *
 * @author  Bohuslav Simek <bohuslav@simek.si>
 * @license MIT
 */
class Traverser extends NodeTraverser
{
    /**
     * Remove all visitors from the traverser
     *
     * @return void
     */
    public function removeVisitors()
    {
        $this->visitors = [];
    }
}
