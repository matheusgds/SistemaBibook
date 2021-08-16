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

$loc = new Locacao();
$livro = new Livro();
$qntdlivro = $livro->buscaQuantidade($idlivro);

if ($qntdlivro > 0) {

    $datas = new FuncoesData();

    $dataatual = $datas->retornoHoje();
    $data = $datas->BRtoMySql($dataatual);
  
    $dataentrega = date('Y-m-d', strtotime($data . ' + 2 days'));


    $hora = $datas->retornoHojeHora();

    $horatual = str_replace("/", "-", $hora);
    // agora teria q inverter a data.
    $vethora = explode(" ", $horatual);
    $datadahora = $vethora[0];
    $geracao = explode("-", $datadahora);
    $novavardata = $geracao[2] . "-" . $geracao[1] . "-" . $geracao[0];
    $novahorageral = $novavardata . " " . $vethora[1];

    //$dataentrega = date($data, strtotime("+2 days"));
    //$dataentregamysql = $datas->BRtoMySql($dataentrega);

    $cliente = new Cliente();
    $cli = $cliente->retornaClientePeloLogin($idconta);


    $vetlocal = array(
        $data, $novahorageral, $dataentrega, $cli
    );


    $loc->Inserir($vetlocal);

    $location = $loc->retornaLocacao($vetlocal);


    $locacao_livro = new locacao_livros();

    echo $idlivro;
    $vetdados = array(
        $idlivro, $location
    );

    $locacao_livro->Inserir($vetdados);


    $livro->alteraQuantidade($idlivro);
} else {
    $url = ".." . DIRECTORY_SEPARATOR . "InterfaceGrafica" . DIRECTORY_SEPARATOR . "listarlivros.php";

    $livro->redirectPHP($url);
}
