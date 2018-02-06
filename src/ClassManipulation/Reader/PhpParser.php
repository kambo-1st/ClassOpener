<?php

namespace Kambo\Testing\ClassOpener\ClassManipulation\Reader;

use Kambo\Testing\ClassOpener\ClassManipulation\Reader;
use Kambo\Testing\ClassOpener\ClassManipulation\Locator;
use Exception;

use PhpParser\Error;
use PhpParser\ParserFactory;

class PhpParser implements Reader
{
    private $reflectionClassLocator;
    private $astParser;

    public function __construct(Locator $locator)
    {
        $this->reflectionClassLocator = $locator;
        $this->astParser = (new ParserFactory)->create(ParserFactory::PREFER_PHP7);
    }

    public function getAst(string $className) : array
    {
        $fileName = $this->reflectionClassLocator->getFileName($className);
        try {
            $ast = $this->astParser->parse(file_get_contents($fileName));
        } catch (Error $error) {
            throw new Exception("File Parser error: {$error->getMessage()}");
        }

        return $ast;
    }
}
