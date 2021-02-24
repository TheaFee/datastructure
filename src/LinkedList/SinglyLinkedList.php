<?php

namespace LinkedList;

use LinkedList\NodeSinglyLinkedList;
use LinkedList\SinglyLinkedListInterface;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LinkedList
 *
 * @author thea
 */
class SinglyLinkedList implements SinglyLinkedListInterface {

    protected $headPointer;
    protected $numberOfNodes;

    public function __construct() {
        $this->headPointer = null;
        $this->numberOfNodes = 0;
    }

    public function insertFirst($element, $type = 'single'): void {
        $newNode = new NodeSinglyLinkedList();
        $newNode->setElement($element);

        if ($this->headPointer != null) {
            $pointer = &$this->headPointer;
            $newNode->setNext($pointer);
        }
        if ($this->headPointer === null) {
            $newNode->setNext(null);
        }
        $this->headPointer = &$newNode;
        $this->numberOfNodes++;
    }

    public function deleteFirst($type = 'single') {
        if ($this->headPointer === null) {
            echo "hier";
            return "Empty list";
        }
        
        if ($this->numberOfNodes === 1) {
            $deletedNode = $this->deleteIfOneNodeInList();
        } else {
            $deletedNode = $this->deleteBegin();
        }
        return $deletedNode;
    }

    public function printList(): void {
        $node = $this->headPointer;
        while ($node != null) {
            echo $node->getElement() . "<br/>";
            $node = $node->getNext();
        }
    }

    private function deleteIfOneNodeInList(): NodeSinglyLinkedList {
        $deletedNode = $this->headPointer;
        $this->headPointer = null;
        $this->numberOfNodes--;
        return $deletedNode;
    }

    private function deleteBegin(): NodeSinglyLinkedList {
        $oldHeadPoint = $this->headPointer;
        var_dump($oldHeadPoint->getNext());
        $this->headPointer = $oldHeadPoint->getNext();
        $this->numberOfNodes--;
        return $oldHeadPoint;
    }

}
