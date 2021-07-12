<?php


require_once ".." . DIRECTORY_SEPARATOR . "autoload.php";

$Rua = new Rua();

$nome = $_POST['nome'];


if (strpos($nome, " ") === TRUE) {
    $nome = ucwords($nome);
} else {
    $nome = ucfirst($nome);
}


$nomeBairro = $_POST['nomeBairro'];

$vetDados = array(
    $nome, $nomeBairro
);

$Rua->Inserir($vetDados);

?>