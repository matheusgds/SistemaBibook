<?php

require_once "..". DIRECTORY_SEPARATOR . "autoload.php";


$Cidade = new Cidade();
$id = $_GET['cidade'];

$vetDados = array(
    $id
);

$Cidade->Excluir($vetDados);

   

