<?php

require_once "..". DIRECTORY_SEPARATOR . "autoload.php";


$Conta = new ContaDeAcesso();
$id = $_GET['conta'];

$vetDados = array(
    $id
);

$Conta->Excluir($vetDados);
