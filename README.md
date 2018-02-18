# Class opener - Mock/stub final classes and methods in PHPUnit.
[![Build Status](https://travis-ci.org/kambo-1st/ClassOpener.svg?branch=master)](https://travis-ci.org/kambo-1st/ClassOpener)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/kambo-1st/ClassOpener/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/kambo-1st/ClassOpener/?branch=master)
[![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/kambo-1st/ClassOpener.svg?style=flat-square)](https://scrutinizer-ci.com/g/kambo-1st/ClassOpener/)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
Wouldn't it be great if you can mock/stub final classes and methods in PHPUnit? With this package you can do exactly that. Just extend your test case from ``` ClassOpenerTestCase ``` and add to the test method comment following annotation``` @disableFinal name\of\the\final\class ``` After this you can continue with your regular mock/stub techniques.

But be aware, there are few gotchas as this is basically a hack packed in a nice package with ribbon.
## Install

Prefered way to install library is with composer:
```sh
composer require kambo/classopener
```

## Usage
Extend your test case from ``` ClassOpenerTestCase ``` and add to the test method comment following annotation``` @disableFinal name\of\the\final\class ``` After this you can continue with your regular mock/stub techniques.

Example:
```php
<?php

use Kambo\Testing\ClassOpener\PHPUnit\ClassOpenerTestCase;

class ClassOpenerTestCaseTest extends ClassOpenerTestCase
{
    /**
     * Disable final and mock the class
     *
     * @disableFinal Kambo\Tests\Testing\ClassOpener\Fixtures\Foo
     */
    public function testAnnotationMocking()
    {
        // You can use your traditional mocking/stubing techniques
        $fooMock = $this->getMockBuilder(Foo::class)
                        ->disableOriginalConstructor()
                        ->getMock();

        $fooMock->method('bar')->will($this->returnValue(false));

        $this->assertFalse($fooMock->bar());
    }
}
```

### Gotchas
The "opening" of class must be done before the creation of any class instance. This premise can be easilly broken by the previously running tests. One of the possible solutions is to isolate the tests, which are using Class open with annotation ``` @runInSeparateProcess ```

Example:

```php
<?php

use Kambo\Testing\ClassOpener\PHPUnit\ClassOpenerTestCase;

class ClassOpenerTestCaseTest extends ClassOpenerTestCase
{
    /**
     * Disable final and mock the class
     *
     * @runInSeparateProcess
     * @disableFinal Kambo\Tests\Testing\ClassOpener\Fixtures\Foo
     */
    public function testAnnotationMocking()
    {
```

## Credits
Based on the excelent article by the Mark Baker: [Extending final Classes and Methods by manipulating the AST](https://markbakeruk.net/2017/11/19/extending-final-classes-and-methods-by-manipulating-the-ast/)
## License
The MIT License (MIT), https://opensource.org/licenses/MIT
