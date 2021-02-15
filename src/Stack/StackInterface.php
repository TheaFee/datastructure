<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author thea
 */
interface StackInterface {

    public function pushInt(int $int);

    public function pullInt(): int;

    public function pushFloat(float $float);

    public function pullFloat(): float;

    public function pullString(): string;
}
