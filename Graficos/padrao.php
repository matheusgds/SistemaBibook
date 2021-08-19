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

    public function returnLivroMaisAlocado() {
        $livro_has_locacao = new locacao_livros();
        $sql = "select * from livro_has_locacao;";
        $array = $livro_has_locacao->PesquisarTodos($sql);

        $livro = new Livro();
        $grafico = [];
        $contagem = 0;
        $pos = 0;

        for ($index = 0; $index < count($array); $index++) {
            $contagem = 0;
            $livroid = $array[$index]->getIdlivro();
            $nomelivro = $livro->buscaNomePeloID($livroid);
            for ($index1 = 0; $index1 < count($array); $index1++) {
                if ($array[$index1]->getIdlivro() == $livroid) {
                    $contagem = $contagem + 1;
                }
            }

            if (empty($grafico)) {

                $newarray = [];
                $newarray = [$contagem, $nomelivro];
                $grafico[$pos] = $newarray;
                //print_r($grafico);
            } else {
                $i = 0;
                $var = FALSE;


                for ($index2 = 0; $index2 < count($grafico); $index2++) { // nao existe index1, tem q ver como fazer o calculo
                    $livrografico = $grafico[$index2][$i + 1]; //estado dentro do grafico.
                    if ($nomelivro == $livrografico) {// eh pq ja existe no grafico
                        $var = TRUE;
                    }
                }

                if ($var == FALSE) {
                    $pos = $pos + 1;
                    $newarray = [];
                    $newarray = [$contagem, $nomelivro];
                    $grafico[$pos] = $newarray;
                }
            }
        }

        return $grafico;
    }

    public function returnDevedores() {
        $multa = new Multa();
        $sql = "select * from multa where status=1;";
        $array = $multa->PesquisarTodos($sql); // lista de multas.

        $locacao = new Locacao();
        $cliente = new Cliente();
        $grafico = [];
        $contagem = 0;
        $pos = 0;

        for ($index = 0; $index < count($array); $index++) {
            $contagem = 0;
            $locacaoid = $array[$index]->getIdlocacao();
            $idcliente = $locacao->retornaClienteLocacao($locacaoid);
            $nomecliente = $cliente->retornaNome($idcliente);
            for ($index1 = 0; $index1 < count($array); $index1++) {
                $locacaoid2 = $array[$index1]->getIdlocacao();
                $idcliente2 = $locacao->retornaClienteLocacao($locacaoid2);
                if ($idcliente2 == $idcliente) {
                    $contagem = $contagem + $array[$index1]->getValor();
                }
            }

            if (empty($grafico)) {

                $newarray = [];
                $newarray = [$contagem, $nomecliente];
                $grafico[$pos] = $newarray;
                //print_r($grafico);
            } else {
                $i = 0;
                $var = FALSE;


                for ($index2 = 0; $index2 < count($grafico); $index2++) { // nao existe index1, tem q ver como fazer o calculo
                    $clientegrafico = $grafico[$index2][$i + 1]; //estado dentro do grafico.
                    if ($nomecliente == $clientegrafico) {// eh pq ja existe no grafico
                        $var = TRUE;
                    }
                }

                if ($var == FALSE) {
                    $pos = $pos + 1;
                    $newarray = [];
                    $newarray = [$contagem, $nomecliente];
                    $grafico[$pos] = $newarray;
                }
            }
        }

        return $grafico;
    }

}
