<?php

require_once ".." . DIRECTORY_SEPARATOR . "autoload.php";


$contaacesso = new ContaDeAcesso();

$login = $_POST['login'];
$password = new Criptografia();
$pass = $password->Encriptografar($_POST['senha']);
$idacesso = $_POST['acesso'];

$vetDados = array(
    $login,$pass,$idacesso
);



$contaacesso->Inserir($vetDados);

?>