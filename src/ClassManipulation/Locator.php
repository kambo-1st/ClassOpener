<?php

namespace Kambo\Testing\ClassOpener\ClassManipulation;

/**
 * Locate a class filename with path without actual loading.
 *
 * @author  Bohuslav Simek <bohuslav@simek.si>
 * @license MIT
 */
interface Locator
{
    /**
     * Get the file path to the class
     *
     * @param string $className Name of the class
     *
     * @return string File path to the file
     */
    public function locate(string $className) : string;
}
