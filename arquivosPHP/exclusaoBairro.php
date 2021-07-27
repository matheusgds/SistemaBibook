<?php

require_once "..". DIRECTORY_SEPARATOR . "autoload.php";


$Bairro = new Bairro();
$id = $_GET['bairro'];

$vetDados = array(
    $id
);

$Bairro->Excluir($vetDados);