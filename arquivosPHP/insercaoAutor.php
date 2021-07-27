<?php
require_once ".." . DIRECTORY_SEPARATOR . "autoload.php";


$Autor = new Autor();

$nome = $_POST['nome'];


if (strpos($nome, " ") === TRUE) {
    $nome = ucwords($nome);
} else {
    $nome = ucfirst($nome);
}

$vetDados = array(
    $nome
);


$Autor->Inserir($vetDados);