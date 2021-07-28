<?php
require_once "..". DIRECTORY_SEPARATOR . "autoload.php";


$Fornecedor = new Fornecedor();
$id = $_GET['fornecedor'];

$vetDados = array(
    $id
);

$Fornecedor->Excluir($vetDados);