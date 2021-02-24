<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use LinkedList\DoubleLinkedList;
use LinkedList\SinglyLinkedList;
use LinkedList\NodeDoubleLinkedList;

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
class DoubleLinkedListTest extends TestCase {

    private DoubleLinkedList $doubleLinkedList;
    private SinglyLinkedList $singlyLinkedList;
    private $headPointer;
    private $tailPointer;
    private $numberOfNodes;
    private $node;

    //private $middleNode;

    protected function setUp(): void {
        parent::setUp();

        $this->doubleLinkedList = new DoubleLinkedList();
        $this->singlyLinkedList = new SinglyLinkedList();
        $this->node = new NodeDoubleLinkedList();

        $this->headPointer = $this->getPrivateProperty($this->doubleLinkedList, 'headPointer');
        $this->tailPointer = $this->getPrivateProperty($this->doubleLinkedList, 'tailPointer');
        $this->numberOfNodes = $this->getPrivateProperty($this->doubleLinkedList, 'numberOfNodes');

        $this->tailPointer->setValue($this->doubleLinkedList, null);
        $this->numberOfNodes->setValue($this->doubleLinkedList, 0);

        $this->next = $this->getPrivateProperty($this->node, 'next');
        $this->next->setValue($this->node, null);

        $this->data = $this->getPrivateProperty($this->node, 'element');
        $this->data->setValue($this->node, 0);
    }

    public function testInsertNode_emptyList() {
        //given
        $expectedNumberOfNodes = 1;
        $expectedHeadPointer = $this->getNode(3, null, null);
        //when
        $this->doubleLinkedList->insertFirst(3, 'double');
        $actualNumberOfNodes = $this->numberOfNodes->getValue($this->doubleLinkedList);
        $actualHeadPointer = $this->headPointer->getValue($this->doubleLinkedList);
        //then
        $this->assertEquals($expectedNumberOfNodes, $actualNumberOfNodes);
        $this->assertEquals($expectedHeadPointer, $actualHeadPointer);

        echo "\n" . "numberOfNodes: " . $actualNumberOfNodes . "\n";
        echo "HeadPointer: ";
        var_dump($actualHeadPointer);
    }

    public function testInsertNode_twoNodesInsertBegin() {
        //given
        $expectedNumberOfNodes = 2;

        $next = $this->getNode(3, null, null);
        $expectedHeadPointer = $this->getNode(5, $next, null);
        $next->setBefore($expectedHeadPointer);

        //when
        $this->doubleLinkedList->insertFirst(3, 'double');
        $this->doubleLinkedList->insertFirst(5, 'double');
        $actualNumberOfNodes = $this->numberOfNodes->getValue($this->doubleLinkedList);
        $actualHeadPointer = $this->headPointer->getValue($this->doubleLinkedList);

        //then
        $this->assertEquals($expectedNumberOfNodes, $actualNumberOfNodes);
        $this->assertEquals($expectedHeadPointer, $actualHeadPointer);

        echo "\n" . "numberOfNodes: " . $actualNumberOfNodes . "\n";
        echo "HeadPointer: ";
        var_dump($actualHeadPointer);
    }

    public function testInsertNode_twoNodesInsertEnd() {
        //given
        $expectedNumberOfNodes = 2;

        $next = $this->getNode(5, null, null);
        $expectedHeadPointer = $this->getNode(3, $next, null);
        $next->setBefore($expectedHeadPointer);

        //when
        $this->doubleLinkedList->insertFirst(3, 'double');
        $this->doubleLinkedList->insertLast(5, 'double');
        $actualNumberOfNodes = $this->numberOfNodes->getValue($this->doubleLinkedList);
        $actualHeadPointer = $this->headPointer->getValue($this->doubleLinkedList);

        //then
        $this->assertEquals($expectedNumberOfNodes, $actualNumberOfNodes);
//        $this->assertEquals($expectedHeadPointer, $actualHeadPointer);

        echo "\n" . "numberOfNodes: " . $actualNumberOfNodes . "\n";
        echo "HeadPointer: ";
        var_dump($actualHeadPointer);
    }

    public function testInsertNode_threeNodes_InsertBeginAndEnd() {
        //given
        $expectedNumberOfNodes = 3;
        $expectedHeadPointer = $this->getNode(5, null, null);
        $expectedTailPointer = $this->getNode(8, null, null);

        $middleNode = $this->getNode(3, $expectedTailPointer, $expectedHeadPointer);
        $expectedTailPointer->setBefore($middleNode);
        $expectedHeadPointer->setNext($middleNode);

        //when
        $this->doubleLinkedList->insertFirst(3, 'double');
        $this->doubleLinkedList->insertFirst(5, 'double');
        $this->doubleLinkedList->insertLast(8, 'double');
        $actualHeadPointer = $this->headPointer->getValue($this->doubleLinkedList);
        var_dump($actualHeadPointer);

        //then
        $actualNumberOfNodes = $this->numberOfNodes->getValue($this->doubleLinkedList);
        // $actualHeadPointer = $this->headPointer->getValue($this->doubleLinkedList);
        $actualTailPointer = $this->tailPointer->getValue($this->doubleLinkedList);


        echo "\n" . "numberOfNodes: " . $actualNumberOfNodes . "\n";
        echo "HeadPointer: ";
        var_dump($actualHeadPointer);
        echo "TailPointer: ";
        var_dump($actualTailPointer);

        $this->assertEquals($expectedNumberOfNodes, $actualNumberOfNodes);
        $this->assertEquals($expectedHeadPointer, $actualHeadPointer);
        $this->assertEquals($expectedTailPointer, $actualTailPointer);

        echo "\n" . "numberOfNodes: " . $actualNumberOfNodes . "\n";
        echo "HeadPointer: ";
        var_dump($actualHeadPointer);
        echo "TailPointer: ";
        var_dump($actualTailPointer);
    }

    public function testDeleteNode_OneNodeInList() {
        //given
        $node = $this->getNode(5, null, null);

        $this->headPointer->setValue($this->doubleLinkedList, $node);
        $this->tailPointer->setValue($this->doubleLinkedList, $node);
        $this->numberOfNodes->setValue($this->doubleLinkedList, 1);
        //when
        $oldHeadPoint = $this->doubleLinkedList->deleteFirst();
        $actualHeadPointer = $this->headPointer->getValue($this->doubleLinkedList);
        $actualTailPointer = $this->tailPointer->getValue($this->doubleLinkedList);
        //then
        $this->assertEquals(null, $actualHeadPointer);
        $this->assertEquals(null, $actualTailPointer);
        $this->assertEquals($node, $oldHeadPoint);
        echo "linkedList: ";
        var_dump($this->doubleLinkedList);
        echo "\noldheadPoint: ";
        var_dump($oldHeadPoint);
    }

    public function testDeleteNode_Begin() {
        //given
        $tailPointer = $this->getNode(8, null, null);
        $headPointer = $this->getNode(5, null, null);
        $middleNode = $this->getNode(3, $tailPointer, $headPointer);
        $headPointer->setNext($middleNode);
        $tailPointer->setBefore($middleNode);

        $exectedHeadPointer = $this->getNode(3, $tailPointer, null);

        $this->headPointer->setValue($this->doubleLinkedList, $headPointer);
        $this->tailPointer->setValue($this->doubleLinkedList, $tailPointer);
        $this->numberOfNodes->setValue($this->doubleLinkedList, 3);

        //when
        $oldHeadPointer = $this->doubleLinkedList->deleteFirst();
        $actualHeadPointer = $this->headPointer->getValue($this->doubleLinkedList);
        $actualTailPointer = $this->tailPointer->getValue($this->doubleLinkedList);
        //then
        $this->assertEquals($exectedHeadPointer, $actualHeadPointer);
        $this->assertEquals($tailPointer, $actualTailPointer);
        $this->assertEquals($headPointer, $oldHeadPointer);
        echo "linkedList: ";
        var_dump($this->doubleLinkedList);
        echo "\noldheadPoint: ";
        var_dump($oldHeadPointer);
    }

    public function testDeleteNode_End() {
        //given
        $tailPointer = $this->getNode(8, null, null);
        $headPointer = $this->getNode(5, null, null);
        $middleNode = $this->getNode(3, $tailPointer, $headPointer);
        $headPointer->setNext($middleNode);
        $tailPointer->setBefore($middleNode);

        $this->headPointer->setValue($this->doubleLinkedList, $headPointer);
        $this->tailPointer->setValue($this->doubleLinkedList, $tailPointer);
        $this->numberOfNodes->setValue($this->doubleLinkedList, 3);
        //when
        $oldTailPointer = $this->doubleLinkedList->deleteLast();
        $actualHeadPointer = $this->headPointer->getValue($this->doubleLinkedList);
        $actualTailPointer = $this->tailPointer->getValue($this->doubleLinkedList);
        //then
        $expectedTailPointer = $this->getNode(3, null, $headPointer);
        $this->assertEquals($headPointer, $actualHeadPointer);
        $this->assertEquals($expectedTailPointer, $actualTailPointer);
        $this->assertEquals($tailPointer, $oldTailPointer);

        echo "linkedList: ";
        var_dump($this->doubleLinkedList);
        echo "\noldheadPoint: ";
        var_dump($oldTailPointer);
    }

    public function testPrintList() {
        //given
        $tailPointer = $this->getNode(8, null, null);
        $headPointer = $this->getNode(5, null, null);
        $middleNode = $this->getNode(3, $tailPointer, $headPointer);
        $headPointer->setNext($middleNode);
        $tailPointer->setBefore($middleNode);

        $this->headPointer->setValue($this->doubleLinkedList, $headPointer);
        $this->tailPointer->setValue($this->doubleLinkedList, $tailPointer);
        $this->numberOfNodes->setValue($this->doubleLinkedList, 3);
        //then
        $expected = "5<br/>3<br/>8<br/>";
        $this->expectOutputString($expected);
        //when
        $this->doubleLinkedList->printList();
    }

    private function getNode($element, $next, $before) {
        $node = new NodeDoubleLinkedList();
        $node->setElement($element);
        $node->setNext($next);
        $node->setBefore($before);

        return $node;
    }

    private function getPrivateProperty($class, $propertyName) {

        $reflector = new ReflectionClass($class);
        $property = $reflector->getProperty($propertyName);
        $property->setAccessible(true);

        return $property;
    }

}
