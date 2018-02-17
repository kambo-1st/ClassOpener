<?php

namespace Kambo\Testing\ClassOpener\ClassManipulation\Patcher;

use PhpParser\PrettyPrinter\Standard;
use Kambo\Testing\ClassOpener\ClassManipulation\Patcher;

/**
 * Patch class with its modified version.
 *
 * @author  Bohuslav Simek <bohuslav@simek.si>
 * @license MIT
 */
class EvalExecution implements Patcher
{
    /**
     * Replace global class definition with class defined in the provided nodes.
     *
     * @param Node[] $statmentNodes Array of statements
     *
     * @return void
     */
    public function patch(array $statmentNodes)
    {
        $prettyPrinter = new Standard;
        $newClassCode  = $prettyPrinter->prettyPrintFile($statmentNodes).PHP_EOL;

        // Force PHP interpreter to use modified version of the class, by evaluating.
        eval('?>' . $newClassCode);
    }
}
