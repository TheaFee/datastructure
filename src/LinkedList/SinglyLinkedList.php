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
class SinglyLinkedList extends SinglyLinkedListInterface {

    public function __construct() {
        $this->headPointer = null;
        $this->numberOfNodes = 0;
    }

    public function insertFirst($element): void {
        $newNode = $this->getNewNode($element);

        if ($this->headPointer != null) {
            $this->insertFirstEmptyList($newNode);
        } elseif ($this->headPointer === null) {
            $newNode->setNext(null);
        }
        $this->headPointer = &$newNode;
        $this->numberOfNodes++;
    }

    public function deleteFirst() {
        $this->excpetionEmptyList();
        if ($this->numberOfNodes === 1) {
            $deletedNode = $this->deleteIfOneNodeInList();
        } else {
            $deletedNode = $this->deleteBegin();
        }
        return $deletedNode;
    }

    private function getNewNode($element) {
        $newNode = new NodeSinglyLinkedList();
        $newNode->setElement($element);

        return $newNode;
    }

}
