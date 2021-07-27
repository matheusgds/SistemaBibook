<?php

//require_once "..".DIRECTORY_SEPARATOR."DTO".DIRECTORY_SEPARATOR."Estado.php";
require_once "..". DIRECTORY_SEPARATOR . "autoload.php";

$Estado = new Estado();
$nome = $_POST['nome'];
if (strpos($nome, " ") === TRUE) {
    $nome = ucwords($nome);
} else {
    $nome = ucfirst($nome);
}

$sigla = $_POST['sigla'];
$sigla = mb_strtoupper($sigla, "utf-8");

$vetDados = array(
    $nome,$sigla
); 

$Estado->Inserir($vetDados);
?>