<?php

namespace Kambo\Testing\ClassOpener\ClassManipulation\Node;

use PhpParser\NodeTraverser;

/**
 * Description of Traverser
 *
 * @author  Bohuslav Simek <bohuslav@simek.si>
 * @license MIT
 */
class Traverser extends NodeTraverser
{
    public function removeVisitors()
    {
        $this->visitors = [];
    }
}
