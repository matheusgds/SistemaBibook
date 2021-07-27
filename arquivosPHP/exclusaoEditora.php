<?php

require_once "..". DIRECTORY_SEPARATOR . "autoload.php";


$Editora = new Editora();
$id = $_GET['editora'];

$vetDados = array(
    $id
);

$Editora->Excluir($vetDados);