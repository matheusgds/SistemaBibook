<?php

require_once ".." . DIRECTORY_SEPARATOR . "autoload.php";

$Bairro = new Bairro();

$nome = $_POST['nome'];


if (strpos($nome, " ") === TRUE) {
    $nome = ucwords($nome);
} else {
    $nome = ucfirst($nome);
}

$nomeCidade = $_POST['nomeCidade'];

$vetDados = array(
    $nome, $nomeCidade
);

$Bairro->Inserir($vetDados);


?>