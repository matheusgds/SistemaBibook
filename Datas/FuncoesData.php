<?php

class FuncoesData {
    
    
    
    public function MySqltoBR($data) {
        return $data = implode("/", array_reverse(explode("-", $data)));
    }
    
    //$today = date("Y-m-d H:i:s");
    public function BRtoMySql($data) {
        return $data = implode("-", array_reverse(explode("/", $data)));
    }
    

    public function retornoHoje() {
        return $hoje = date('d/m/Y');
    }
    
     public function retornoHojeTraco() {
        return $hoje = date('d-m-Y');
    }

    public function retornoHojeHora() {
        date_default_timezone_set('America/Sao_Paulo');
        return $hoje = date('d/m/Y H:i:s');
    }

    public function retornoHora() {
        date_default_timezone_set('America/Sao_Paulo');
        return $hoje = date('H:i:s');
    }

    function horaparaMysql(string $date): string {
        $timestamp = strtotime($date);
        $date_formated = date('H:i:s', $timestamp);
        return $date_formated;
    }

}
