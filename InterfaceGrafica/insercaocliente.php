<?php

require_once ".." . DIRECTORY_SEPARATOR . "autoload.php";

//dados cliente
$nomecli = $_POST['nome'];
$cpf = $_POST['cpf'];
$rg = $_POST['rg'];
$datanascimento = $_POST['datanasc']; // ja vem no formato de banco de dados AAAA-MM-DD
$sexo = $_POST['sexo']; // m ou f
//dados localização
$dadoest = $_POST['select'];
$dadocid = $_POST['cidade'];
$dadob = $_POST['bairro'];
$dador = $_POST['rua'];
$numero = $_POST['numerocasa'];

//dados contato
$dadoemail = $_POST['email'];
$dadotelefone1 = $_POST['telefone1'];
$dadotelefone2 = $_POST['telefone2'];
$dadocelular = $_POST['celular'];

$vetDadosCont = array(
    $dadoemail, $dadotelefone1, $dadotelefone2, $dadocelular
);

//dados conta de acesso
$contaacesso = new ContaDeAcesso();

$login = $_POST['login'];
$password = new Criptografia();
$pass = $password->Encriptografar($_POST['senha']);
$idacesso = $_POST['acesso'];



$teste = FALSE;


