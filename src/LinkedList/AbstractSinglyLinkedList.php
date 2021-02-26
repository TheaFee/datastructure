<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace LinkedList;

/**
 *
 * @author thea
 */
abstract class SinglyLinkedListInterface {

    protected $headPointer;
    protected $numberOfNodes;

    abstract public function insertFirst($element);

    abstract public function deleteFirst();

    public function printList(): void {
        $node = $this->headPointer;
        while ($node != null) {
            echo $node->getElement() . "<br/>";
            $node = $node->getNext();
        }
    }

    protected function deleteIfOneNodeInList() {
        $deletedNode = $this->headPointer;
        $this->headPointer = null;
        $this->numberOfNodes--;
        return $deletedNode;
    }

    protected function deleteBegin() {
        $newFirstNode = $this->headPointer->getNext();
        $oldHeadPoint = $this->headPointer;
        $this->headPointer = $newFirstNode;
        $this->numberOfNodes--;
        return $oldHeadPoint;
    }

    protected function insertFirstEmptyList($newNode) {
        $oldFirstNode = $this->headPointer;
        $oldHeadPointer = &$oldFirstNode;
        $newNode->setNext($oldHeadPointer);
    }

    protected function excpetionEmptyList() {
        if ($this->headPointer === null) {
            return "Empty list";
        }
    }

}
