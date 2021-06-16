<?php

require_once (realpath($_SERVER["DOCUMENT_ROOT"]) . "\SistemaBibook\SistemaBibook\Interface\Crud.php");

class Estado implements Crud {

    public $id;
    public $nome;

    function __construct() {
        
    }

    public function setid($num) {
        $this->id = $num;
    }

    public function getid() {
        return $this->id;
    }

    public function setNome($n) {
        $this->nome = $n;
    }

    public function getNome() {
        return $this->nome;
    }

    //put your code here
    public function Delete() {
        
    }

    public function Insert() {
        
    }

    public function SearchAll() {
        
    }

    public function Update() {
        
    }

    public function verifyDigits($objeto) {
        $cont = mb_strlen($objeto); // retorna o array de todas as letras

        if (($cont <= 3) || (cont > 100)) {
            return false;
        } else {
            return true;
        }
    }

}
