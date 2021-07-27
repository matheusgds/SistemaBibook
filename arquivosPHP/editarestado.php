<?php

//require_once "..".DIRECTORY_SEPARATOR."DTO".DIRECTORY_SEPARATOR."Estado.php";
require_once (".." . DIRECTORY_SEPARATOR . "autoload.php");

$Estado = new Estado();
$id = $_POST['codigo'];
$nome = $_POST['nome'];
$sigla = $_POST['sigla'];


if (strpos($nome, " ") === TRUE) {
    $nome = ucwords($nome);
} else {
    $nome = ucfirst($nome);
}

$sigla = mb_strtoupper($sigla, "utf-8");


$vetDados = array(
    $id, $nome, $sigla
);

$Estado->Editar($vetDados);
?>



