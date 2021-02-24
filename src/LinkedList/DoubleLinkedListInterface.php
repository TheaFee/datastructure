<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace LinkedList;

use \LinkedList\SinglyLinkedListInterface;

/**
 *
 * @author thea
 */
interface DoubleLinkedListInterface extends SinglyLinkedListInterface {
    public function insertLast($element);
    public function deleteLast();
}
