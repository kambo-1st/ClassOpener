<?php

namespace Kambo\Tests\Testing\ClassOpener;

use ReflectionClass;

use PHPUnit\Framework\TestCase;

use Kambo\Testing\ClassOpener\ClassOpener;
use Kambo\Tests\Testing\ClassOpener\Fixtures\Foo;
use Kambo\Testing\ClassOpener\ClassManipulation\Exception\NotFoundException;

/**
 * Unit tests for the class Kambo\Testing\ClassOpener\ClassOpener
 *
 * @author  Bohuslav Simek <bohuslav@simek.si>
 * @license MIT
 *
 * @runTestsInSeparateProcesses
 */
class ClassOpenerTest extends TestCase
{
    /**
     * Test open method
     *
     * @return void
     */
    public function testOpen()
    {
        $classOpener = ClassOpener::create();
        $classOpener->open(Foo::class);

        $fooClass = new ReflectionClass(Foo::class);
        $this->assertFalse($fooClass->isFinal());
    }

    /**
     * Test open method - method does not exists
     *
     * @return void
     */
    public function testOpenNonExisting()
    {
        $this->expectException(NotFoundException::class);

        $classOpener = ClassOpener::create();
        $classOpener->open('xxxx');
    }
}
