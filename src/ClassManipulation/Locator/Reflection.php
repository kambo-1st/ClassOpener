<?php

namespace Kambo\Testing\ClassOpener\ClassManipulation\Locator;

use BetterReflection\Reflector\Reflector;

use Exception;
use Kambo\Testing\ClassOpener\ClassManipulation\Exception\NotFoundException;
use Kambo\Testing\ClassOpener\ClassManipulation\Locator;

/**
 * Locate a class filename with path without actual loading.
 *
 * @author  Bohuslav Simek <bohuslav@simek.si>
 * @license MIT
 */
class Reflection implements Locator
{
    private $reflector;

    /**
     * Constructor
     *
     * @param string $reflector Roave BetterReflection reflector
     */
    public function __construct(Reflector $reflector)
    {
        $this->reflector = $reflector;
    }

    /**
     * Get the file path to the class
     *
     * @param string $className Name of the class
     *
     * @return string File path to the file
     */
    public function locate(string $className) : string
    {
        try {
            $reflectionClass = $this->reflector->reflect($className);
        } catch (Exception $e) {
            throw new NotFoundException("Unable to locate class {$className}");
        }

        return realpath($reflectionClass->getFileName());
    }
}
