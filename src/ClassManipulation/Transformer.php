<?php

namespace Kambo\Testing\ClassOpener\ClassManipulation;

/**
 * Description of ClassTransformer
 *
 * @author  Bohuslav Simek <bohuslav@simek.si>
 * @license MIT
 */
interface Transformer
{
    public function transform(string $className, array $nodes, array $visitors) : array;
}
