<?php
require_once ".." . DIRECTORY_SEPARATOR . "autoload.php";


$Tipo = new TipoDeLivro();

$tipolivro = $_POST['tipo'];
$codigo = $_POST['codigotipo'];


if (strpos($tipolivro, " ") === TRUE) {
    $tipolivro= ucwords($tipolivro);
} else {
    $tipolivro = ucfirst($tipolivro);
}

$vetDados = array(
    $nome,$codigo
);


$Tipo->Inserir($vetDados);