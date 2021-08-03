<?php

require_once ".." . DIRECTORY_SEPARATOR . "autoload.php";

class padrao {

    public function returnClientePorEstado() {
        $cliente = new Cliente();
        $sql = "select * from Cliente;";
        $array = $cliente->PesquisarTodos($sql);

        $estado = new Estado();
        $grafico = [];
        $contagem = 0;
        $pos = 0;

        for ($index = 0; $index < count($array); $index++) {
            $contagem = 0;
            $est = $array[$index]->getEstado();
            $sigla = $estado->retornaSigla($est);
            for ($index1 = 0; $index1 < count($array); $index1++) {
                if ($array[$index1]->getEstado() == $est) {
                    $contagem = $contagem + 1;
                }
            }

            if (empty($grafico)) {

                $newarray = [];
                $newarray = [$contagem, $sigla];
                $grafico[$pos] = $newarray;
                //print_r($grafico);
            } else {
                $i = 0;
                $var = FALSE;
              

                for ($index2 = 0; $index2 < count($grafico); $index2++) { // nao existe index1, tem q ver como fazer o calculo
                    $estadografico = $grafico[$index2][$i + 1]; //estado dentro do grafico.
                    if ($sigla == $estadografico) {// eh pq ja existe no grafico
                        $var = TRUE;
                    }
                }

                if ($var == FALSE) {
                    $pos = $pos + 1;
                    $newarray = [];
                    $newarray = [$contagem, $sigla];
                    $grafico[$pos] = $newarray;
                }
            }
        }

        return $grafico;
    }

}
