<?php

namespace Kambo\Testing\ClassOpener\ClassManipulation;

interface Locator
{
    public function getFileName(string $className) : string;
}
