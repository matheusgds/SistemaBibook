<?php

require_once "..". DIRECTORY_SEPARATOR . "autoload.php";


$Rua = new Rua();
$id = $_GET['rua'];

$vetDados = array(
    $id
);

$Rua->Excluir($vetDados);
