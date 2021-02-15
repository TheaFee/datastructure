<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Stack;

/**
 * Description of customException
 *
 * @author thea
 */
class CustomException extends \Exception {

    public function errorMessage($code) {
      $errorMessage = $code . " is not correct";
        new \Exception($errorMessage);
        
    }

}
