<?php

namespace Kambo\Testing\ClassOpener\ClassManipulation\Reader;

use Kambo\Testing\ClassOpener\ClassManipulation\Reader;
use Kambo\Testing\ClassOpener\ClassManipulation\Locator;
use Kambo\Testing\ClassOpener\ClassManipulation\Exception\ParseErrorException;

use PhpParser\Error;
use PhpParser\ParserFactory;

/**
 * Source code class reader, which will parse code into nodes with PHP parser.
 *
 * @author  Bohuslav Simek <bohuslav@simek.si>
 * @license MIT
 */
class PhpParser implements Reader
{
    private $reflectionClassLocator;
    private $astParser;

    /**
     * Constructor
     *
     * @param Locator $locator Class source code locator
     */
    public function __construct(Locator $locator)
    {
        $this->reflectionClassLocator = $locator;
        $this->astParser = (new ParserFactory)->create(ParserFactory::PREFER_PHP7);
    }

    /**
     * Parses PHP code into a node tree.
     *
     * @param string $className A fully qualified name of class, which will be parsed
     *
     * @return Node[] Array of php nodes
     */
    public function getNodes(string $className) : array
    {
        $fileName = $this->reflectionClassLocator->locate($className);
        try {
            $ast = $this->astParser->parse(file_get_contents($fileName));
        } catch (Error $error) {
            throw new ParseErrorException("File Parser error: {$error->getMessage()}");
        }

        return $ast;
    }
}
