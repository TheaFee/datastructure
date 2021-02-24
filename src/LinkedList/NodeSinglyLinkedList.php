<?php

namespace LinkedList;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Element
 *
 * @author thea
 */
class NodeSinglyLinkedList {

    
    private $element;
    private $next;

    public function __construct() {
        $this->element = 0;
        $this->next = null;
    }

    function getNext() {
        return $this->next;
    }

    function setNext($next): void {
        $this->next = $next;
    }

    function setElement($element): void {
        $this->element = $element;
    }

    function getElement() {
        return $this->element;
    }

}
