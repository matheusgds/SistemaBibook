<?php

include_once "../confs/inc.php";
require_once "../confs/Conexao.php";

$id = $_POST['codigo'];
$nome = $_POST['nome'];
$sigla = $_POST['sigla'];

$nome2 = retornaNome($id);
$sigla2 = retornaSigla($id);


if (!comparacao($nome, $nome2)) {
$pdo = Conexao::getInstance();
$stmt = $pdo->prepare('update estado set nome =:novonome where idEstado = :id');
$stmt2 = $pdo->prepare('commit;');
$stmt->bindParam(':novonome', $nome, PDO::PARAM_STR);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$stmt2->execute();
}

if (!comparacao($sigla, $sigla2)) {
$pdo = Conexao::getInstance();
$stmt = $pdo->prepare('update estado set sigla =:novosigla where idEstado = :id');
$stmt2 = $pdo->prepare('commit;');
$stmt->bindParam(':novosigla', $sigla, PDO::PARAM_STR);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$stmt2->execute();
}

$url = "listarestados.php";
redirect($url);

function comparacao($valor1, $valor2) {
if ($valor1 == $valor2) {
return true;
} else {
return false;
}
}

function retornaNome($valor) {
include_once "../confs/inc.php";
require_once "../confs/Conexao.php";

$pdo = Conexao::getInstance();
$sql = "select nome from estado where idEstado= '$valor' ";
$consulta = $pdo->query($sql);
while ($linha = $consulta->fetch(PDO::FETCH_BOTH)) {
return $linha['nome'];
}
}

function retornaSigla($valor) {
include_once "../confs/inc.php";
require_once "../confs/Conexao.php";

$pdo = Conexao::getInstance();
$sql = "select sigla from estado where idEstado= '$valor' ";
$consulta = $pdo->query($sql);
while ($linha = $consulta->fetch(PDO::FETCH_BOTH)) {
return $linha['sigla'];
}
}

function redirect($url) {
echo "<HTML>\n";
echo "<HEAD>\n";
echo "<TITLE></TITLE>\n";
echo "<script language=\"JavaScript\">window.location='" . $url . "';</script>\n";
echo "</HEAD>\n";
echo "<BODY>\n";
echo "</BODY>\n";
echo "</HTML>\n";

}


