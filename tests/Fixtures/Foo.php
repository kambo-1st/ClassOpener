<?php

namespace Kambo\Tests\Testing\ClassOpener\Fixtures;

/**
 * Description of finalClass
 *
 * @author  Bohuslav Simek <bohuslav@simek.si>
 * @license MIT
 */
final class Foo
{
    public final function bar() : bool
    {
        return true;
    }

    public function qux () : array
    {
        return [];
    }
}
