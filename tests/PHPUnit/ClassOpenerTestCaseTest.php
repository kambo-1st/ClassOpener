<?php

namespace Kambo\Tests\Testing\ClassOpener\PHPUnit;

use ReflectionClass;

use Kambo\Tests\Testing\ClassOpener\Fixtures\Foo;
use Kambo\Testing\ClassOpener\PHPUnit\ClassOpenerTestCase;

/**
 * Unit tests for the class ClassOpenerTestCase
 *
 * @author  Bohuslav Simek <bohuslav@simek.si>
 * @license MIT
 *
 * @runTestsInSeparateProcesses
 */
class ClassOpenerTestCaseTest extends ClassOpenerTestCase
{
    /**
     * Test annotation reading
     *
     * @disableFinal \Kambo\Tests\Testing\ClassOpener\Fixtures\Foo
     */
    public function testAnnotation()
    {
        $fooClass = new ReflectionClass(Foo::class);
        $this->assertFalse($fooClass->isFinal());
    }

    /**
     * Test annotation reading
     */
    public function testNoAnnotation()
    {
        $fooClass = new ReflectionClass(Foo::class);
        $this->assertTrue($fooClass->isFinal());
    }

    /**
     * Test annotation reading
     *
     * @disableFinal Kambo\Tests\Testing\ClassOpener\Fixtures\Foo
     */
    public function testAnnotationMocking()
    {
        $fooMock = $this->getMockBuilder(Foo::class)
                        ->disableOriginalConstructor()
                        ->getMock();

        $fooMock->method('bar')->will($this->returnValue(false));

        $this->assertFalse($fooMock->bar());
    }
}
