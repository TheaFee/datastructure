<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Queue\BoundedQueue;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BoundedQueueTest
 *
 * @author thea
 */
class BoundedQueueTest extends TestCase {

    private BoundedQueue $boundedQueue;
    private Ds\Queue $queue;

    protected function setUp(): void {
        parent::setUp();

        $this->boundedQueue = new BoundedQueue();
        $this->queue = new \Ds\Queue();
    }

    public function testEnqueue() {
        //given
        $element = 3;
        $property = $this->getPrivateProperty('queue');
        $this->getPrivateProperty('size');

        //when
        $this->boundedQueue->boundedQueue(3);
        $this->boundedQueue->enqueue($element);
        $actual = $property->getValue($this->boundedQueue);

        //then
        $this->queue = new \Ds\Queue();
        $this->queue->push($element);
        $expected = $this->queue->copy();
        $this->assertEquals($expected, $actual);
    }

    public function testDequeue() {
        //given
        $property = $this->getPrivateProperty('queue');
//        $property->setValue($this->boundedQueue, [3]);
//        var_dump($property);
        
        //when
        $this->boundedQueue->enqueue(3);
        $actual = $this->boundedQueue->dequeue();
        //then
        $this->queue = new \Ds\Queue();
        $this->queue->push(3);
        $expected = $this->queue->pop();
        $this->assertEquals($expected, $actual);
    }

    private function getPrivateProperty($propertyName) {

        $reflector = new ReflectionClass($this->boundedQueue);
        $property = $reflector->getProperty($propertyName);
        $property->setAccessible(true);

        return $property;
    }

}
