<?php

require_once "..". DIRECTORY_SEPARATOR . "autoload.php";


$tipodelivro = new TipoDeLivro();
$id = $_GET['tipo'];

$vetDados = array(
    $id
);

$tipodelivro->Excluir($vetDados);