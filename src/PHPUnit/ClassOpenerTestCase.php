<?php

namespace Kambo\Testing\ClassOpener\PHPUnit;

use PHPUnit\Framework\TestCase;

use Kambo\Testing\ClassOpener\ClassOpener;

/**
 * A TestCase which allows to mock final classes with annotation "@disableFinal"
 * eg.: "@disableFinal \Foo\Bar" will allows to mock class \Foo\Bar
 *
 * @author  Bohuslav Simek <bohuslav@simek.si>
 * @license MIT
 */
class ClassOpenerTestCase extends TestCase
{

    const ANNOTATION_NAME = 'disableFinal';

    /**
     * Open all class which are defined in the @disableFinal annotation
     *
     * @return void
     */
    protected function checkRequirements()
    {
        parent::checkRequirements();

        $classesNames = $this->extractDisableFinalNamesAnnotations($this->getAnnotations());

        if (!empty($classesNames)) {
            $this->openClasses($classesNames);
        }
    }

    /**
     * Open the provided final classes for the further modification
     *
     * @param array $classesNames Name of the classes which should be opened, a fully
     *                            qualified class names must be provided in the array
     *                            eg.: ['foo\bar\qaz', ...]
     *
     * @return void
     */
    protected function openClasses(array $classesNames)
    {
        $ClassOpener = ClassOpener::create();
        foreach ($classesNames as $name) {
            $ClassOpener->open($name);
        }
    }

    /**
     * Extract specific annotations from the class
     *
     * @param array $annotations Annotations for this test.
     *
     * @return array Extract annotation, empty array, if there are not any annotations
     */
    private function extractDisableFinalNamesAnnotations(array $annotations) : array
    {
        if (isset($annotations['method'][self::ANNOTATION_NAME])) {
            return $annotations['method'][self::ANNOTATION_NAME];
        }

        return [];
    }
}
