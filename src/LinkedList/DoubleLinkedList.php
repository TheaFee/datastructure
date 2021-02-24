<?php

namespace LinkedList;

use LinkedList\DoubleLinkedListInterface;
use LinkedList\SinglyLinkedList;

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
class DoubleLinkedList extends SinglyLinkedList implements DoubleLinkedListInterface {

    //protected $headPointer;
    protected $tailPointer;

    //protected $numberOfNodes;

    public function __construct() {
        parent::__construct();
        $this->tailPointer = null;
    }

    public function insertFirst($element, $type = 'double'): void {
//        if ($type === 'single') {
//           $singlyLinkedList = new SinglyLinkedList();
//            $singlyLinkedList->insertFirst($element);
//        }
        if ($type === 'double') {
            $newNode = new NodeDoubleLinkedList();
            $newNode->setElement($element);
            $newNode->setBefore(null);

            if ($this->headPointer != null) {
                $oldFirstNode = $this->headPointer;
                $oldHeadPointer = &$oldFirstNode;
                $newNode->setNext($oldHeadPointer);

                $newHeadPointer = &$newNode;
                $oldFirstNode->setBefore($newHeadPointer);
            } elseif ($this->headPointer === null) {
                $newNode->setNext(null);
                $this->tailPointer = &$newNode;
            }

            $this->headPointer = &$newNode;
            $this->numberOfNodes++;
        }
    }

    public function insertLast($element): void {
        $newNode = new NodeDoubleLinkedList();
        $newNode->setElement($element);
        $newNode->setNext(null);

        $oldLastNode = $this->tailPointer;
        $this->tailPointer = &$newNode;

        $pointer = &$oldLastNode;
        $newNode->setBefore($pointer);
        $oldLastNode->setNext($newNode);
        $this->numberOfNodes++;
    }

    public function deleteFirst($type = 'double') {
//        $singlyLinkedList = new SinglyLinkedList();

        if ($this->headPointer === null) {
            return "Empty list";
        }
        if ($this->numberOfNodes === 1) {
            $deletedNode = $this->deleteIfOneNodeInList();
        } else {
            $deletedNode = $this->deleteBegin();
        }

        return $deletedNode;
    }

    public function deleteLast(): NodeDoubleLinkedList {
        $oldLastNode = $this->tailPointer;
        $newLastNode = $oldLastNode->getBefore();
        $newLastNode->setNext(null);
        $this->tailPointer = &$newLastNode;

        return $oldLastNode;
    }

    private function deleteIfOneNodeInList() {
        $deletedNode = $this->headPointer;
        $this->headPointer = null;
        $this->tailPointer = null;
        $this->numberOfNodes--;
        return $deletedNode;
    }

    private function deleteBegin() {
        $newFirstNode = $this->headPointer->getNext();
        $oldHeadPoint = $this->headPointer;
        $this->headPointer = $newFirstNode;
        $this->headPointer->setBefore(null);
        $this->numberOfNodes--;
        return $oldHeadPoint;
    }

}
