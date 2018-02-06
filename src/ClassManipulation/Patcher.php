<?php

namespace Kambo\Testing\ClassOpener\ClassManipulation;

/**
 * XXX
 *
 * @author  Bohuslav Simek <bohuslav@simek.si>
 * @license MIT
 */
interface Patcher
{
    public function patch($classAst);
}
