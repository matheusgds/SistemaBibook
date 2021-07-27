<?php

//require_once "..".DIRECTORY_SEPARATOR."DTO".DIRECTORY_SEPARATOR."Estado.php";
require_once (".." . DIRECTORY_SEPARATOR . "autoload.php");

$Autor = new Autor();
$id = $_POST['codigo'];
$nome = $_POST['nome'];


if (strpos($nome, " ") === TRUE) {
    $nome = ucwords($nome);
} else {
    $nome = ucfirst($nome);
}

$vetDados = array(
    $id, $nome
);

$Autor->Editar($vetDados);
?>



