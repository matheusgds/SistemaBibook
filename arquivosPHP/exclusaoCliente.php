<?php
require_once "..". DIRECTORY_SEPARATOR . "autoload.php";


$Cliente = new Cliente();
$id = $_GET['cliente'];

$vetDados = array(
    $id
);

$Cliente->Excluir($vetDados);