<?php

require_once ".." . DIRECTORY_SEPARATOR . "autoload.php";

class Contato implements ICrud {

    private $id;
    private $email;
    private $telefone1;
    private $telefone2;
    private $celular;

    function getId() {
        return $this->id;
    }

    function getEmail() {
        return $this->email;
    }

    function getTelefone1() {
        return $this->telefone1;
    }

    function getTelefone2() {
        return $this->telefone2;
    }

    function getCelular() {
        return $this->celular;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setTelefone1($telefone1) {
        $this->telefone1 = $telefone1;
    }

    function setTelefone2($telefone2) {
        $this->telefone2 = $telefone2;
    }

    function setCelular($celular) {
        $this->celular = $celular;
    }

    public function __toString() {
        $string = "ID: " . $this->id . "<br/>";
        if (($this->email != null) || ($this->email != "")) {
            $string = $string . ($this->email) . "<br/>";
        } else if (($this->telefone1 != null) || ($this->telefone1 != "")) {
            $string = $string . ($this->telefone1) . "<br/>";
        } else if (($this->telefone2 != null) || ($this->telefone2 != "")) {
            $string = $string . ($this->telefone2) . "<br/>";
        } else if (($this->celular != null) || ($this->celular != "")) {
            $string = $string . ($this->celular) . "<br/>";
        }

        return $string;
    }

    
    public function Editar($vetDados) {
        
    }

    public function Excluir($vetDados) {
        
    }

    public function Inserir($vetDados) {
        
    }

    public function PesquisarTodos($sql) {
        
    }

}
