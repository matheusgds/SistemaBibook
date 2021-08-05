<?php

class FuncoesData {

    //$today = date("Y-m-d H:i:s");
    public function BRtoMySql($data) {
        return $data = implode("-", array_reverse(explode("/", $data)));
    }

    public function MySqltoBR($data) {
        return $data = implode("/", array_reverse(explode("-", $data)));
    }

    public function retornoHoje() {
       return $hoje = date('d/m/Y');
    }
    
    public function retornoHojeHora() {
       return $hoje = date('d/m/Y H:i');
    }
    
    public function retornoHora() {
        return $hoje = date('H:i:s');
    }

}
