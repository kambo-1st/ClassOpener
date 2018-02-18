<?php

namespace Kambo\Testing\ClassOpener\ClassManipulation;

/**
 * Patch class with its modified version.
 *
 * @author  Bohuslav Simek <bohuslav@simek.si>
 * @license MIT
 */
interface Patcher
{
    /**
     * Replace global class definition with class defined in the provided nodes.
     *
     * @param Node[] $statmentNodes Array of statements
     *
     * @return void
     */
    public function patch(array $statmentNodes);
}
