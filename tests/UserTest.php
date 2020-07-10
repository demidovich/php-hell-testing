<?php

namespace Tests;

use App\User;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

class AppTest extends TestCase
{
    protected function mockSigleton(string $class, array $attrs = [])
    {
        $refl = new ReflectionClass($class);
        $item = $refl->newInstanceWithoutConstructor();

        foreach ($attrs as $name => $value) {
            $prop = $refl->getProperty($name);
            $prop->setAccessible(true);
            $prop->setValue($item, $value);
        }

        $prop = $refl->getProperty('instance');
        $prop->setAccessible(true);
        $prop->setValue($item, $item);

        return $item;
    }

    protected function user(int $id, string $name): User
    {
        return $this->mockSigleton(User::class, [
            'id'   => $id,
            'name' => $name,
        ]);
    }

    public function test_one()
    {
        $this->user(1, 'User 1');
        $user = User::getInstance();

        $this->assertEquals(1, $user->id());
    }

    public function test_two()
    {
        $this->user(2, 'User 2');
        $user = User::getInstance();

        $this->assertEquals(2, $user->id());
    }
}
