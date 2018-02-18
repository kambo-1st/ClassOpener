<?php

namespace Kambo\Tests\Testing\ClassOpener\Fixtures;

/**
 * Mock of the final class
 *
 * @author  Bohuslav Simek <bohuslav@simek.si>
 * @license MIT
 */
final class Foo
{
    /**
     * Mock final method
     *
     * @return bool
     */
    final public function bar() : bool
    {
        return true;
    }

    /**
     * Mock non final method
     *
     * @return array
     */
    public function qux() : array
    {
        return [];
    }
}
