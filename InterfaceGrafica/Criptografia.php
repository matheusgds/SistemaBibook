<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Criptografia
 *
 * @author mathe
 */
class Criptografia {
    
    
    public function Encriptografar($senha) {
        return base64_encode($senha);
    }
    public function Descriptografar($senha) {
         return base64_decode($senha);
    }
}
