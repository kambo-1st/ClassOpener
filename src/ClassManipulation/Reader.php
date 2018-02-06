<?php

namespace Kambo\Testing\ClassOpener\ClassManipulation;

interface Reader
{
    public function getAst(string $className) : array;
}
