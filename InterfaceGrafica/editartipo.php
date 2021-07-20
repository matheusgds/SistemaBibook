<?php

//require_once "..".DIRECTORY_SEPARATOR."DTO".DIRECTORY_SEPARATOR."Estado.php";
require_once (".." . DIRECTORY_SEPARATOR . "autoload.php");

$tipo = new TipoDeLivro();
$id = $_POST['codigoid'];
$tipo = $_POST['tipo'];
$codigo = $_POST['codigo'];


if (strpos($tipo, " ") === TRUE) {
    $tipo = ucwords($tipo);
} else {
    $tipo = ucfirst($tipo);
}

$vetDados = array(
    $id, $tipo,$codigo
);

$tipo->Editar($vetDados);
?>




