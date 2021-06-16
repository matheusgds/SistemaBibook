<?php

include_once "confs/inc.php";
require_once "confs/Conexao.php";

$pdo = Conexao::getInstance();
$stmt = $pdo->prepare('INSERT INTO estado (nome,sigla) VALUES(:nome,:sigla)');
$stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
$stmt->bindParam(':sigla', $sigla, PDO::PARAM_STR);
$nome = $_POST['nome'];
$sigla = $_POST['sigla'];
$stmt->execute();
header("location:listarestados.php");

?>