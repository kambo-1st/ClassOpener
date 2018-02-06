<?php

namespace Kambo\Testing\ClassOpener\ClassManipulation\Locator;

use Exception;
use Kambo\Testing\ClassOpener\ClassManipulation\Exception\NotFoundException;
use Kambo\Testing\ClassOpener\ClassManipulation\Locator;


class Reflection implements Locator
{
    private $reflector;

    public function __construct($reflector=null)
    {
        $this->reflector = $reflector;
    }

    public function getFileName(string $className) : string
    {
        try {
            $reflectionClass = $this->reflector->reflect($className);
        } catch (Exception $e) {
            throw new NotFoundException("Unable to locate class {$className}");
        }

        return realpath($reflectionClass->getFileName());
    }
}
