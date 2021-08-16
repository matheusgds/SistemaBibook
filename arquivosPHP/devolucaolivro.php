<?php

session_start();

if ((!isset($_SESSION['loginextra']) == true) and ( !isset($_SESSION['senhaextra']) == true)) {
    unset($_SESSION['loginextra']);
    unset($_SESSION['senhaextra']);

    $linkprincipal = ".." . DIRECTORY_SEPARATOR . "index.php";
    header('location:' . $linkprincipal);
}
$logado = $_SESSION['loginextra'];
require_once ".." . DIRECTORY_SEPARATOR . "autoload.php";

$idlivro = $_GET['id'];


$conta = new ContaDeAcesso;
$idconta = $conta->buscaIDpeloNome($logado);
$locacao = new Locacao();
$cliente = new Cliente();
$funcoesdata = new FuncoesData();

$cli = $cliente->retornaClientePeloLogin($idconta);


$sql = "select * from locacao where Cliente_idCliente = " . $cli;
$listalocacoesdocliente = $locacao->PesquisarTodos($sql);


$livro_locacao = new locacao_livros();
$vetresultante = array();


for ($index = 0; $index < count($listalocacoesdocliente); $index++) {
    $idloc = $listalocacoesdocliente[$index]->getId();

    $sql = "select * from livro_has_locacao where locacao_idlocacao = " . $idloc;
    $lista = $livro_locacao->PesquisarTodos($sql);

    for ($index1 = 0; $index1 < count($lista); $index1++) {
        if (($lista[$index1]->getStatus() == TRUE) && ($lista[$index]->getIdlivro() == $idlivro)) {

            $livro_locacao->alteraStatusLocacao($idlivro);

            $loc = $livro_locacao->getIdlocacao();

            $dataentrega = $locacao->retornodata($loc);

            $hoje = date('Y-m-d', strtotime($funcoesdata->retornoHoje()));

            $diferenca = strtotime($dataentrega) - strtotime($hoje);
            echo $diferenca;
            $dias = floor($diferenca / (60 * 60 * 24));
            echo $dias;

            if ($dias < 0) {
                $multa = new Multa();
                $valor = 2 * $dias;

                $vetDados = array(
                    $valor, $loc
                );

                $multa->Inserir($vetDados);
            }
        }
    }
}

$livro = new Livro();

$livro->aumentaQuantidade($idlivro);

