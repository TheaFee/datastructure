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
 * Description of TestStack
 *
 * @author thea
 */
class StackTest extends TestCase {

    private Stack $stack;

    protected function setUp(): void {
        parent::setUp();

        $this->stack = new Stack();
    }

    public function testPush_oneInt() {
        //given
        $int = 3;
        $property = $this->getPrivateProperty('stack');

        //when
        $this->stack->push($int);

        //then
        $this->assertEquals([3], $property->getValue($this->stack));
    }

    public function testPush_twoInts() {
        //given
        $int1 = 3;
        $int2 = 5;
        $property = $this->getPrivateProperty('stack');
        //when
        $this->stack->push($int1);
        $this->stack->push($int2);
        //then
        $this->assertEquals([3, 5], $property->getValue($this->stack));
    }

    public function testPush_oneInt_oneFloat() {
        //then
        $this->expectExceptionMessage('Datentyp "double" des Elements "5.5" entspricht nicht dem Datentyp "integer" des ersten Stack-Elements!');
        //given
        $int = 3;
        $float = 5.5;
        $property = $this->getPrivateProperty('stack');
        //when
        $this->stack->push($int);
        $this->stack->push($float);
        $property->getValue($this->stack);
    }

    public function testPop_EmptyStack() {
        //then
        $this->expectException(InvalidArgumentException::class);
        //given
        $this->getPrivateProperty('stack');
        //when
        $this->stack->pull();
    }

    public function testPop_NotEmptyStack() {
        //given
        $property = $this->getPrivateProperty('stack');
        $this->stack->push(4);
        $this->stack->push(8);
        //when
        $result = $this->stack->pull();
        $stack = $property->getValue($this->stack);

        //then
        $this->assertEquals(8, $result);
        $this->assertEquals([4], $stack);
    }

    private function getPrivateProperty($propertyName) {

        $reflector = new ReflectionClass($this->stack);
        $property = $reflector->getProperty($propertyName);
        $property->setAccessible(true);

        return $property;
    }

}
