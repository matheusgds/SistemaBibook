<?php

session_start();

require_once ".." . DIRECTORY_SEPARATOR . "autoload.php";
require_once (".." . DIRECTORY_SEPARATOR . "index.php");

$login = $_POST['txtLog'];
$senha = $_POST['txtPass'];
$obj3 = new Criptografia();

$SenhaExtraE = $obj3->Encriptografar($senha);

$pdo = Conexao::getInstance();

$query = "SELECT * FROM `contadeacesso`WHERE `login` = '$login' AND `pass`= '$SenhaExtraE';";
$consulta = $pdo->query($query);

if (empty($linha)) {
    unset($_SESSION['loginextra']);
    unset($_SESSION['senhaextra']);
    $linkprincipal = ".." . DIRECTORY_SEPARATOR . "index.php";
    header('location:' . $linkprincipal);
}
while ($linha = $consulta->fetch(PDO::FETCH_BOTH)) {

    if (!empty($linha)) {
        //lembrar de colocar um link php aqui embaixo nao ta achando a pasta
        $_SESSION['loginextra'] = $login;
        $_SESSION['senhaextra'] = $SenhaExtraE;

        $lnk = ".." . DIRECTORY_SEPARATOR . "InterfaceGrafica".DIRECTORY_SEPARATOR."JanelaPrincipal.php";
        header('location:' . $lnk);
        // die();
    } else {
        unset($_SESSION['loginextra']);
        unset($_SESSION['senhaextra']);
       
        $linkprincipal = ".." . DIRECTORY_SEPARATOR . "index.php";
        header('location:' . $linkprincipal);
        //die();
    }
}
