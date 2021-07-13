<?php

require_once ".." . DIRECTORY_SEPARATOR . "autoload.php";


$nome = $_POST['nome'];

if (strpos($nome, " ") === TRUE) {
    $nome = ucwords($nome);
} else {
    $nome = ucfirst($nome);
}

//se todos os dados existirem segue esse processo

$estado  = new Estado();
$cidade = new Cidade();
$bairro = new Bairro();
$rua = new Rua();

$dadoest = $_POST['selectest']; 
$estado = $estado->buscaSigla($dadoest);

$dadocid = $_POST['cidade'];
$cidade = $cidade->buscaIDpeloNome($dadocid);

$dadob = $_POST['bairro'];
$bairro  = $bairro->buscaIDpeloNome($dadob);

$dador = $_POST['rua'];
$rua = $rua->buscaIDpeloNome($dador);

$numero = $_POST['numerocasa'];


//verificar se existe algum tipo deste contato abaixo:


$dadoemail = $_POST['email'];
$dadotelefone1 = $_POST['telefone1'];
$dadotelefone2 = $_POST['telefone2'];
$dadocelular = $_POST['celular'];



$vetDados = array(
    $nome, $estado,$cidade,$bairro,$rua,$numero,$contato
);



?>