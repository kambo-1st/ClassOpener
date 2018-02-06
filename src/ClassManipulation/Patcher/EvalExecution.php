<?php

namespace Kambo\Testing\ClassOpener\ClassManipulation\Patcher;

use PhpParser\PrettyPrinter\Standard;
use Kambo\Testing\ClassOpener\ClassManipulation\Patcher;

/**
 * Description of Eval
 *
 * Lorem ipsum dolor
 *
 * @package 
 * @author  Bohuslav Simek <bohuslav@simek.si>
 * @license MIT
 */
class EvalExecution implements Patcher
{
    public function patch($classAst)
    {
        $prettyPrinter = new Standard;
        $newClassCode  = $prettyPrinter->prettyPrintFile($classAst).PHP_EOL;

        eval('?>' . $newClassCode);
    }
}
