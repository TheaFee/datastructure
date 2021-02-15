<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Stack\Stack;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of StackFunctionalTest
 *
 * @author thea
 */
class StackFunctionalTest extends TestCase {

    private Stack $stack;

    protected function setUp(): void {
        parent::setUp();

        $this->stack = new Stack();
    }

    public function testStack() {
        $property = $this->getPrivateProperty('stack');

        $this->stack->push(5);
        $this->assertEquals([5], $property->getValue($this->stack));
        $this->stack->pull();
        $this->assertEquals([], $property->getValue($this->stack));
        $this->stack->push(7);
        $this->assertEquals([7], $property->getValue($this->stack));
        $this->stack->push(9);
        $this->assertEquals([7, 9], $property->getValue($this->stack));
        $this->stack->push(1);
        $this->assertEquals([7, 9, 1], $property->getValue($this->stack));
        $this->stack->pull();
        $this->assertEquals([7, 9], $property->getValue($this->stack));
        $this->stack->pull();
        $this->assertEquals([7], $property->getValue($this->stack));
        $this->stack->pull();
        $this->assertEquals([], $property->getValue($this->stack));
        $this->expectException(InvalidArgumentException::class);
        $this->stack->pull();
    }

    private function getPrivateProperty($propertyName) {

        $reflector = new ReflectionClass($this->stack);
        $property = $reflector->getProperty($propertyName);
        $property->setAccessible(true);

        return $property;
    }

}
