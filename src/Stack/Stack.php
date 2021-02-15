<?php

declare(strict_types=1);

namespace Stack;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Stack
 *
 * @author thea
 */
class Stack {

    private array $stack;

    public function __construct() {
        $this->stack = [];
    }

    public function push($element) {
        try {
            if (!(array_key_exists(0, $this->stack))) {
                array_push($this->stack, $element);
            } elseif (gettype($this->stack[0]) === gettype($element)) {
                array_push($this->stack, $element);
            } else {
                throw new \Exception('Datentyp ' . '"' . gettype($element) . '"' .
                        ' des Elements ' . '"' . (string) $element . '"' . ' entspricht nicht dem Datentyp '
                        . '"' . gettype($this->stack[0]) . '"' . ' des ersten Stack-Elements!');
            }
        } catch (Exception $e) {
            echo $e->getMessage(), "\n";
        }
    }

    public function pull() {
        if (!(array_key_exists(0, $this->stack))) {
            throw new \InvalidArgumentException('Es befindet sich kein Element im Stack');
        } else {
            return array_pop($this->stack);
        }
    }

}
