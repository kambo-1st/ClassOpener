<?php

namespace Kambo\Testing\ClassOpener\ClassManipulation;

/**
 * Source code class reader, that parse code into nodes.
 *
 * @author  Bohuslav Simek <bohuslav@simek.si>
 * @license MIT
 */
interface Reader
{
    /**
     * Parses PHP code into a node tree.
     *
     * @param string $className A fully qualified name of class, which will be parsed
     *
     * @return Node[] Array of php nodes
     */
    public function getNodes(string $className) : array;
}
