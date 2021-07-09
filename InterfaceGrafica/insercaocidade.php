<?php

require_once ".." . DIRECTORY_SEPARATOR . "autoload.php";

$cidade = new Cidade();


// dois posts

$nome = $_POST['nome'];
$siglaestadovinc = $_POST['select']; //para fazer o vinculo


if (strpos($nome, " ") === TRUE) {
    $nome = ucwords($nome);
} else {
    $nome = ucfirst($nome);
}

$vetDados = array(
    $nome,$siglaestadovinc
);

$cidade->Inserir($vetDados);
?>