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
interface SinglyLinkedListInterface {
  public function insertFirst($element, $type = 'single');
  public function deleteFirst($type = "single");
  public function printList();

}
