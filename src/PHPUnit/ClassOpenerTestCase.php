<?php

namespace Kambo\Testing\ClassOpener\PHPUnit;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Error;

use Kambo\Testing\ClassOpener\ClassOpener;

/**
 * Description of ClassOpener
 *
 * @author  Bohuslav Simek <bohuslav@simek.si>
 * @license MIT
 */
class ClassOpenerTestCase extends TestCase
{
    protected function checkRequirements()
    {
        parent::checkRequirements();

        $classesNames = $this->extractDisableFinalNames($this->getAnnotations());

        if (!empty($classesNames)) {
            $this->openClasses($classesNames);
        }
    }

    protected function openClasses(array $classesNames)
    {
        $ClassOpener = ClassOpener::create();
        foreach ($classesNames as $name) {
            $ClassOpener->open($name);
        }
    }

    protected function openClass(string $className)
    {
        $ClassOpener = ClassOpener::create();
        $ClassOpener->open($className);
    }

    private function addError($msg, Exception $previous = null)
    {
        $testResultObject = $this->getTestResultObject();
        $errorMessage = new Error($msg, 0, $previous);

        $testResultObject->addError($this, $errorMessage, time());
    }

    private function extractDisableFinalNames($annotations) : array
    {
        if (isset($annotations['method']['disableFinal'])) {
            return $annotations['method']['disableFinal'];
        }

        return [];
    }
}
