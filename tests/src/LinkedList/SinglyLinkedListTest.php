<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use LinkedList\SinglyLinkedList;
use LinkedList\NodeSinglyLinkedList;

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
class SinglyLinkedListTest extends TestCase {

    public SinglyLinkedList $singlyLinkedList;
    private $headPointer;
    private $numberOfNodes;
    private $node;

    //private $middleNode;

    protected function setUp(): void {
        parent::setUp();

        $this->singlyLinkedList = new SinglyLinkedList();
        $this->node = new NodeSinglyLinkedList();

        $this->headPointer = $this->getPrivateProperty($this->singlyLinkedList, 'headPointer');
        $this->numberOfNodes = $this->getPrivateProperty($this->singlyLinkedList, 'numberOfNodes');

        $this->numberOfNodes->setValue($this->singlyLinkedList, 0);

        $this->next = $this->getPrivateProperty($this->node, 'next');
        $this->next->setValue($this->node, null);

        $this->data = $this->getPrivateProperty($this->node, 'element');
        $this->data->setValue($this->node, 0);
    }

    public function testInsertNode_emptyList() {
        //given
        $expectedNumberOfNodes = 1;
        $expectedHeadPointer = $this->getNode(3, null);

        //when
        $this->singlyLinkedList->insertFirst(3);
        $actualNumberOfNodes = $this->numberOfNodes->getValue($this->singlyLinkedList);
        $actualHeadPointer = $this->headPointer->getValue($this->singlyLinkedList);

        //then
        $this->assertEquals($expectedNumberOfNodes, $actualNumberOfNodes);
        $this->assertEquals($expectedHeadPointer, $actualHeadPointer);

        echo "\n" . "numberOfNodes: " . $actualNumberOfNodes . "\n";
        echo "HeadPointer: ";
        var_dump($actualHeadPointer);
    }

    public function testInsertNode_twoNodes() {
        //given
        $expectedNumberOfNodes = 2;
        $nextNode = $this->getNode(3, null);
        $expectedHeadPointer = $this->getNode(5, $nextNode);

        //when
        $this->singlyLinkedList->insertFirst(3);
        $this->singlyLinkedList->insertFirst(5);
        $actualNumberOfNodes = $this->numberOfNodes->getValue($this->singlyLinkedList);
        $actualHeadPointer = $this->headPointer->getValue($this->singlyLinkedList);

        //then
        $this->assertEquals($expectedNumberOfNodes, $actualNumberOfNodes);
        $this->assertEquals($expectedHeadPointer, $actualHeadPointer);

        echo "\n" . "numberOfNodes: " . $actualNumberOfNodes . "\n";
        echo "HeadPointer: ";
        var_dump($actualHeadPointer);
    }

    public function testInsertNode_threeNodes() {
        //given
        $expectedNumberOfNodes = 3;
        $lastNode = $this->getNode(3, null);
        $middleNode = $this->getNode(5, $lastNode);
        $expectedHeadPointer = $this->getNode(8, $middleNode);

        //when
        $this->singlyLinkedList->insertFirst(3);
        $this->singlyLinkedList->insertFirst(5);
        $this->singlyLinkedList->insertFirst(8);
        $actualNumberOfNodes = $this->numberOfNodes->getValue($this->singlyLinkedList);
        $actualHeadPointer = $this->headPointer->getValue($this->singlyLinkedList);

        $this->assertEquals($expectedNumberOfNodes, $actualNumberOfNodes);
        $this->assertEquals($expectedHeadPointer, $actualHeadPointer);

        echo "\n" . "numberOfNodes: " . $actualNumberOfNodes . "\n";
        echo "HeadPointer: ";
        var_dump($actualHeadPointer);
    }

    public function testDeleteNode_OneNodeInList() {
        //given
        $node = $this->getNode(5, null);

        $this->headPointer->setValue($this->singlyLinkedList, $node);
        $this->numberOfNodes->setValue($this->singlyLinkedList, 1);
        //when
        $oldHeadPoint = $this->singlyLinkedList->deleteFirst(1);
        $actualHeadPointer = $this->headPointer->getValue($this->singlyLinkedList);
        //then
        $this->assertEquals(null, $actualHeadPointer);
        $this->assertEquals($node, $oldHeadPoint);
        echo "linkedList: ";
        var_dump($this->singlyLinkedList);
        echo "\noldheadPoint: ";
        var_dump($oldHeadPoint);
    }

    public function testDeleteNode() {
        //given
        $lastNode = $this->getNode(5, null);
        $middleNode = $this->getNode(3, $lastNode);
        $firstNode = $this->getNode(8, $middleNode);
        
        $this->headPointer->setValue($this->singlyLinkedList, $firstNode);
        $this->numberOfNodes->setValue($this->singlyLinkedList, 3);

        //when
        $oldHeadPointer = $this->singlyLinkedList->deleteFirst(1);
        $actualHeadPointer = $this->headPointer->getValue($this->singlyLinkedList);
        //then
        $this->assertEquals($middleNode, $actualHeadPointer);
        $this->assertEquals($firstNode, $oldHeadPointer);
        echo "linkedList: ";
        var_dump($this->singlyLinkedList);
        echo "\noldheadPoint: ";
        var_dump($oldHeadPointer);
    }

    public function testPrintList() {
        //given
        $lastNode = $this->getNode(8, null);
        $middleNode = $this->getNode(3, $lastNode);
        $firstNode = $this->getNode(5, $middleNode);
        
        $this->headPointer->setValue($this->singlyLinkedList, $firstNode);
        $this->numberOfNodes->setValue($this->singlyLinkedList, 3);

        //then
        $expected = "5<br/>3<br/>8<br/>";
        $this->expectOutputString($expected);
        //when
        $this->singlyLinkedList->printList();
    }

    private function getNode($element, $next) {
        $node = new NodeSinglyLinkedList();
        $node->setElement($element);
        $node->setNext($next);

        return $node;
    }

    private function getPrivateProperty($class, $propertyName) {

        $reflector = new ReflectionClass($class);
        $property = $reflector->getProperty($propertyName);
        $property->setAccessible(true);

        return $property;
    }

}
