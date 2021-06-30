<?php

require_once "../autoload.php";

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