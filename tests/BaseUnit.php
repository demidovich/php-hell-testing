<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use ReflectionClass;

class AppTest extends TestCase
{
    protected function mockSigleton(string $class, array $attrs = [], string $instanceAttr = 'instance')
    {
        $refl = new ReflectionClass($class);
        $item = $refl->newInstanceWithoutConstructor();

        foreach ($attrs as $name => $value) {
            $prop = $refl->getProperty($name);
            $prop->setAccessible(true);
            $prop->setValue($item, $value);
        }

        $prop = $refl->getProperty($instanceAttr);
        $prop->setAccessible(true);
        $prop->setValue($item, $item);

        return $item;
    }
}
