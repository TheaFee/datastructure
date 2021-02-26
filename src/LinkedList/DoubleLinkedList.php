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
class DoubleLinkedList extends DoubleLinkedListInterface {

    protected $tailPointer;

    public function __construct() {
        $this->headPointer = null;
        $this->numberOfNodes = 0;
        $this->tailPointer = null;
    }

    public function insertFirst($element): void {
        $newNode = $this->getNewNode($element);

        if ($this->headPointer != null) {
            $newHeadPointer = &$newNode;
            $this->headPointer->setBefore($newHeadPointer);

            $this->insertFirstEmptyList($newNode);
        } elseif ($this->headPointer === null) {
            $newNode->setNext(null);
            $this->tailPointer = &$newNode;
        }
        $this->headPointer = &$newNode;
        $this->numberOfNodes++;
    }

    public function insertLast($element): void {
        $newNode = $this->getNewNode($element);

        $oldLastNode = $this->tailPointer;
        $this->tailPointer = &$newNode;

        $pointerOldLastNode = &$oldLastNode;
        $pointerNewNode = &$newNode;
        $newNode->setBefore($pointerOldLastNode);
        $oldLastNode->setNext($pointerNewNode);
        $this->numberOfNodes++;
    }

    public function deleteFirst() {
        $this->excpetionEmptyList();
        if ($this->numberOfNodes === 1) {
            $deletedNode = $this->deleteIfOneNodeInList();
            $this->tailPointer = null;
        } else {
            $deletedNode = $this->deleteBegin();
            $this->headPointer->setBefore(null);
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

    private function getNewNode($element) {
        $newNode = new NodeDoubleLinkedList();
        $newNode->setElement($element);
        $newNode->setNext(null);

        return $newNode;
    }

}
