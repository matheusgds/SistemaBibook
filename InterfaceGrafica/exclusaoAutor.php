<?php

require_once "..". DIRECTORY_SEPARATOR . "autoload.php";


$Autor = new Autor();
$id = $_GET['autor'];

$vetDados = array(
    $id
);

$Autor->Excluir($vetDados);