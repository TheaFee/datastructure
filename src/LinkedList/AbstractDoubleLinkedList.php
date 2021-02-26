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
abstract class DoubleLinkedListInterface extends SinglyLinkedListInterface {

    abstract public function insertLast($element);

    abstract public function deleteLast();
}
