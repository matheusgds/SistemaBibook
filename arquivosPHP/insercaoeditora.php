<?php
require_once ".." . DIRECTORY_SEPARATOR . "autoload.php";


$Editora = new Editora();

$nome = $_POST['nome'];


if (strpos($nome, " ") === TRUE) {
    $nome = ucwords($nome);
} else {
    $nome = ucfirst($nome);
}

$vetDados = array(
    $nome
);


$Editora->Inserir($vetDados);