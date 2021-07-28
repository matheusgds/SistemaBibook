<?php

require_once (".." . DIRECTORY_SEPARATOR . "autoload.php");

$Multa = new Multa();
$id = $_GET['multa'];
$valor = 0;

$vetDados = array(
    $id, $valor
);


$Multa->Editar($vetDados);