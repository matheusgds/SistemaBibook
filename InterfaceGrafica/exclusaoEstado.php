<?php

require_once "..". DIRECTORY_SEPARATOR . "autoload.php";


$Estado = new Estado();
$id = $_GET['estado'];

$vetDados = array(
    $id
);

$Estado->Excluir($vetDados);

   

